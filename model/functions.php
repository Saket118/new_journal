<?php

require_once "./config/db.php";

class functions
{
    private $conn;
    private $org_id;
    public function __construct()
    {
        $db = new Database();
        $this->conn = $db->getConnection();
        $this->org_id= $this->getOrgnazationData()["org_id"];
    }

    public function getOrgnazationData()
{
    $host = $_SERVER['HTTP_HOST'];
    $host = explode(':', $host)[0];

    $stmt = $this->conn->prepare("
        SELECT org_id, org_name, org_email
        FROM organisation
        WHERE org_web = ?
        LIMIT 1
    ");

    $stmt->bind_param("s", $host);
    $stmt->execute();

    $result = $stmt->get_result();
    return $result->fetch_assoc();
}
    

    public function getSinglePageData($page_name)
    {
        $stmt = $this->conn->prepare("
            SELECT page_title, meta_title, meta_desc, meta_key, page_content
            FROM page_master
            WHERE org_id = $this->org_id
            AND page_title = ?
            AND page_sts = 1
            LIMIT 1
        ");
        $stmt->bind_param("s",$page_name);
        $stmt->execute();

        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }
public function meta_tag($title, $desc, $key, $url = '')
{
    $keywords = preg_split('/\r\n|\r|\n/', trim($key));
    $keywords = implode(', ', array_filter($keywords));

    // if (empty($url)) {
    //     $url = current_url();
    // }

    return '
<title>' . $title . '</title>
<meta name="description" content="' .$desc . '">
<meta name="keywords" content="' . $keywords . '">
<meta name="robots" content="index, follow">
<link rel="canonical" href="' . $url . '">
';
}
// public function Archives($status)
// {
//     $stmt = $this->conn->prepare("
//         SELECT issue_id, issue_no, issue_status, date_publish,image
//         FROM issue_master
//         WHERE org_id = ?
//         AND issue_type = 0
//         AND issue_status = ?
//         ORDER BY date_publish DESC
//     ");
//     $stmt->bind_param("is", $this->org_id, $status);
//     $stmt->execute();
//     $result = $stmt->get_result();
//     return $result->fetch_all(MYSQLI_ASSOC);
// }
public function Archives($status)
{
    $stmt = $this->conn->prepare("
        SELECT
            issue_id,
            issue_no,
            date_publish,
            YEAR(date_publish) AS year
        FROM issue_master
        WHERE org_id = ?
        AND issue_type = 0
        AND issue_status = ?
        ORDER BY date_publish DESC
    ");

    $stmt->bind_param("is", $this->org_id, $status);
    $stmt->execute();

    $result = $stmt->get_result();

    $archive = [];

    while ($row = $result->fetch_assoc()) {

        $year = $row['year'];

        if (preg_match('/Volume\s*(\d+)\s*,\s*Issue\s*(\d+)/i', $row['issue_no'], $match)) {

            $volume = $match[1];
            $issue  = $match[2];

            $archive[$year]['volumes'][$volume][] = [
                'issue_id'     => $row['issue_id'],
                'issue_no'     => $issue,
                'full_issue'   => $row['issue_no'],
                'date_publish' => $row['date_publish']
            ];

        } else {

            $archive[$year]['issues'][] = [
                'issue_id'     => $row['issue_id'],
                'issue_no'     => $row['issue_no'],
                'date_publish' => $row['date_publish']
            ];
        }
    }

    $stmt->close();

    return $archive;
}
 
public function issue($issue_id = null)
{
    // Get issue details
    if ($issue_id === null) {
       $archive = $this->Archives("Current");

$year = array_key_first($archive);

$issue = $archive[$year]['issues'][0] ?? null;
    

        if (!$issue) {
            return [
                "issue"    => null,
                "articles" => []
            ];
        }

        $issue_id = $issue["issue_id"];
    } else {
        $stmt = $this->conn->prepare("
            SELECT issue_id, issue_no, date_publish
            FROM issue_master
            WHERE issue_id = ?
            AND org_id = ?
            LIMIT 1
        ");

        $stmt->bind_param("ii", $issue_id, $this->org_id);
        $stmt->execute();
        $issue = $stmt->get_result()->fetch_assoc();

        if (!$issue) {
            return [
                "issue"    => null,
                "articles" => []
            ];
        }
    }

    // Get Articles with Category
    $article = $this->conn->prepare("
        SELECT
            a.article_id,
            a.authors,
            a.title,
            a.pages,
            a.view,
            a.download,
            a.doi,
            a.publish_date,
            a.doiurl,
            a.file_url,
            at.category_name
        FROM articles a
        INNER JOIN article_type at
            ON a.article_type = at.category_id
            AND at.org_id = a.org_id
        WHERE a.issue_id = ?
        AND a.org_id = ?
        ORDER BY at.article_sort ASC
    ");

    $article->bind_param("ii", $issue_id, $this->org_id);
    $article->execute();
    $articles = $article->get_result()->fetch_all(MYSQLI_ASSOC);

    return [
        "issue"    => $issue,
        "articles" => $articles
    ];
}


public function getCountries()
{
    $stmt = $this->conn->prepare("
        SELECT id, country_name
        FROM country_master
        ORDER BY country_name ASC
    ");

    $stmt->execute();
    $result = $stmt->get_result();

    return $result->fetch_all(MYSQLI_ASSOC);
}

public function getStates($country_id)
{
    $stmt = $this->conn->prepare("
        SELECT id, state_name
        FROM state_master
        WHERE country_id = ?
        ORDER BY state_name ASC
    ");

    $stmt->bind_param("i", $country_id);
    $stmt->execute();

    $result = $stmt->get_result();

    return $result->fetch_all(MYSQLI_ASSOC);
}
public function getCities($country_id, $state_id = 0)
{
    $column = ($state_id > 0) ? "state_id" : "country_id";
    $id     = ($state_id > 0) ? $state_id : $country_id;

    $stmt = $this->conn->prepare("
        SELECT id, city_name
        FROM city_master
        WHERE {$column} = ?
        ORDER BY city_name ASC
    ");

    $stmt->bind_param("i", $id);
    $stmt->execute();

    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}



// public function registerUser($data)
// {
//     $status       = 1;
//     $org_id       = $this->org_id;
//     $created_date = date("Y-m-d H:i:s");
//     $group_id = ($data['userType'] == 'Author') ? 2 : (($data['userType'] == 'Reviewer') ? 4 : '');



//     $stmt = $this->conn->prepare("
//         INSERT INTO user_login
//         (
//             user_name, pwd, status, Type, Email, Salutation, First_Name, Qualification, Address, City, State, Country, Mobile, org_id, group_id, created_date
//         )
//         VALUES
//         (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
//     ");

//         $stmt->bind_param(
//         "sssssssssiiiiiss",
//         $data['email'],                             
//         $this->encrypt($data['password']),
//         $status,
//         $data['userType'],
//         $data['email'],
//         $data['title'],
//         $data['fullName'],
//         $data['qualification'],
//         $data['address'],
//         $data['city'],      
//         $data['state'],   
//         $data['country'],  
//         $data['contact'],
//         $org_id,
//         $group_id,      
//         $created_date
//     );

//     return $stmt->execute();
// }
public function registerUser($data)
{
    $group_id = ($data['userType'] == 'Author') ? 2 : (($data['userType'] == 'Reviewer') ? 4 : 0);

    // Check if the same Email and User Type already exist
    $check = $this->conn->prepare("
        SELECT login_id
        FROM user_login
        WHERE Email = ? AND Type = ? AND org_id = ?
        LIMIT 1
    ");

    $check->bind_param("ssi", $data['email'], $data['userType'], $this->org_id);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        return [
            'status'  => false,
            'message' => 'User already exists with the same email and user type.'
        ];
    }

    $stmt = $this->conn->prepare("
        INSERT INTO user_login
        (
            user_name,
            pwd,
            status,
            Type,
            Email,
            Salutation,
            First_Name,
            Qualification,
            Address,
            City,
            State,
            Country,
            Mobile,
            org_id,
            group_id,
            created_date
        )
        VALUES
        (?, ?, 1, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

    $password = $this->encrypt($data['password']);
    $created_date = date("Y-m-d H:i:s");

    $stmt->bind_param(
        "sssssssssiiiiis",
        $data['email'],
        $password,
        $data['userType'],
        $data['email'],
        $data['title'],
        $data['fullName'],
        $data['qualification'],
        $data['address'],
        $data['city'],
        $data['state'],
        $data['country'],
        $data['contact'],
        $this->org_id,
        $group_id,
        $created_date
    );

    if ($stmt->execute()) {
        return [
            'status'  => true,
            'message' => 'Registration successful.'
        ];
    }

    return [
        'status'  => false,
        'message' => 'Registration failed: ' . $stmt->error
    ];
}

public function contactUs($post)
{
    if (!empty($post)) {
        return [
            'status'  => true,
            'message' => 'Your message has been sent successfully.'
        ];
    }

    return [
        'status'  => false,
        'message' => 'Failed to send your message. Please try again.'
    ];
}



public function encrypt($string, $key="ubitech")
  {
      $result = '';
      for($i=0; $i<strlen($string); $i++)
      {
      $char = substr($string, $i, 1);
      $keychar = substr($key, ($i % strlen($key))-1, 1);
      $char = chr(ord($char)+ord($keychar));
      $result.=$char;
      }
      return base64_encode($result);
  }
 


public function addSubscriber($email, $category)
{
    $sts            = 1; 
    $org_name       = $this->getOrgnazationData()["org_name"];      
    $org_email      = $this->getOrgnazationData()["org_email"];  
    $org_id         = $this->org_id;         
    $subscribe_date = date("Y-m-d H:i:s");

    $stmt = $this->conn->prepare("
        INSERT INTO subscriber 
        (
            email, category, sts, org_name, org_email, org_id, subscribe_date
        ) 
        VALUES 
        (?, ?, ?, ?, ?, ?, ?)
    ");

    $stmt->bind_param(
        "ssissis", 
        $email, 
        $category, 
        $sts, 
        $org_name, 
        $org_email, 
        $org_id, 
        $subscribe_date
    );

    return $stmt->execute();
}


public function getTopArticles($type)
{
    $type = ($type === 'download') ? 'download' : 'view';
    $stmt = $this->conn->prepare("
        SELECT
            article_id,
            article_type,
            title,
            authors,
            pages,
            publish_date,
            doi,
            doiurl,
            view,
            download,
            file_url
        FROM articles
        WHERE org_id = ?
        ORDER BY $type DESC
        LIMIT 5
    ");
    $stmt->bind_param("i", $this->org_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

//advertisement
public function getAdvertisementName()
{
    $stmt = $this->conn->prepare("
        SELECT name
        FROM advertisement
        WHERE org_id = ?
        AND status = 'Visible'
        ORDER BY ad_id DESC
    ");

    $stmt->bind_param("i", $this->org_id);
    $stmt->execute();
   return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

public function getindex_Data()
{
    $sql = "
        SELECT
            index_id,
            index_name
        FROM indexing_master
        WHERE index_sts = 'visible'
          AND org_id = ?
        ORDER BY index_name ASC
    ";

    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $this->org_id);
    $stmt->execute();

    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

//news
public function getNews()
{
    $stmt = $this->conn->prepare("
        SELECT news_desc
        FROM news_master
        WHERE org_id = ?
        AND news_sts = 'visible'
        ORDER BY news_sort ASC
    ");

    $stmt->bind_param("i", $this->org_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}


// manuscript
public function getManuscriptChartData()
{
    $sql = "
        SELECT
            ms.current_phase,
            pm.phase_name,
            COUNT(*) AS total
        FROM manuscript_submit ms
        LEFT JOIN phase_master pm
            ON pm.id = ms.current_phase
        WHERE ms.org_id = ?
        GROUP BY ms.current_phase, pm.phase_name
        ORDER BY ms.current_phase ASC
    ";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $this->org_id);
    $stmt->execute();

    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
public function Article_Statistics()
{
    $sql = "
        SELECT
            at.category_name AS article_name,
            COUNT(DISTINCT a.article_id) AS total
        FROM articles a
        LEFT JOIN article_type at
            ON at.category_id = a.article_type
        LEFT JOIN issue_master im
            ON im.issue_id = a.issue_id
        WHERE a.org_id = ?
          AND im.issue_publish = 0
        GROUP BY at.category_id, at.category_name
        ORDER BY at.category_name ASC
    ";

    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $this->org_id);
    $stmt->execute();

    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}


public function getabstract($article_id)
{
    $sql = "
        SELECT
            a.article_id,
            at.category_name AS article_type,
            a.referances,
            a.title,
            a.authors,
            a.pages,
            a.publish_date,
            a.doi,
            a.file_url,
            a.keywords,
            a.long_desc,
            a.view,
            a.download
        FROM articles a
        LEFT JOIN article_type at
            ON at.category_id = a.article_type
        WHERE a.article_id = ?
        AND a.org_id = ?
        LIMIT 1
    ";

    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("ii", $article_id, $this->org_id);
    $stmt->execute();

    return $stmt->get_result()->fetch_assoc();
}





public function getfulltext($article_id)
{
    $sql = "
        SELECT
            a.article_id,
            at.category_name AS article_type,
            a.referances,
            a.title,
            a.authors,
            a.pages,
            a.publish_date,
            a.doi,
            a.file_url,
            a.keywords,
            a.long_desc,
            a.full_text,
            a.view,
            a.download
        FROM articles a
        LEFT JOIN article_type at
            ON at.category_id = a.article_type
        WHERE a.article_id = ?
        AND a.org_id = ?
        LIMIT 1
    ";

    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("ii", $article_id, $this->org_id);
    $stmt->execute();

    return $stmt->get_result()->fetch_assoc();
}

///////////BUTTONS////////

    public function articleButtons($articleId, $title, $pdf, $base_url, $currentPage = '')
    {
        $html = '<div class="d-flex flex-wrap gap-2 mt-3">';
        if ($currentPage != 'abstract') {
            $html .= ' <a href="'.$base_url.'abstract.php?article_id='.$articleId.'&title='.$title.'"class="btn btn-theme btn-sm" onclick="return update('.$articleId.', \'view\', this.href)">Abstract</a>';
        }
        if ($currentPage != 'fulltext') {
            $html .= '<a href="'.$base_url.'fulltext.php?article_id='.$articleId.'&title='.$title.'"class="btn btn-theme btn-sm">Full Text</a>';
        }
        if (!empty($pdf)) {
        $html .= '<a href="' . $base_url . 'admin/uploads/'.$this->org_id .'/'.$pdf.'"
   target="_blank"class="btn btn-theme btn-sm"
   onclick="return update('.$articleId.', \'download\', this.href, true)">
    Download PDF
</a>';
        }
        $html .=' <a href="' . $base_url . 'admin/down_xml?id=' . $articleId . '" target="_blank" class="btn btn-theme btn-sm">
        Download XML
    </a>';
        $html .= '</div>';
        return $html;
    }


public function getConferenceEvents()
{
    $stmt = $this->conn->prepare("
        SELECT
            id,
            category,
            title,
            con_date,
            country,
            pdf_file,
            cal_url,
            end_date
        FROM cal_event
        WHERE org_id = ?
          AND sts = 'Visible'
        ORDER BY con_date DESC
    ");

    $stmt->bind_param("i", $this->org_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $data = [
        'conference' => [],
        'events'     => [],
        'all'        => []
    ];

    while ($row = $result->fetch_assoc()) {

        $data['all'][] = $row;

        if ($row['category'] === 'Announcement') {
            $data['conference'][] = $row;
        } else {
            $data['events'][] = $row;
        }
    }

    return $data;
}


public function searchArticles($search, $type = 'all')
{
    $search = trim($search);

    $where = "";

    switch ($type) {

        case 'title':
            $where = "a.title LIKE ?";
            break;

        case 'author':
            $where = "a.authors LIKE ?";
            break;

        case 'keywords':
            $where = "a.keywords LIKE ?";
            break;

        default:
            $where = "(a.title LIKE ? OR a.authors LIKE ? OR a.keywords LIKE ?)";
            break;
    }

    $sql = "
        SELECT
            a.article_id,
            a.title,
            a.authors,
            a.keywords,
            a.file_url,
            a.publish_date,
            a.pages,
            a.view,
            a.download,
            a.doi,
            a.doiurl,
            at.category_name,
            im.issue_no
        FROM articles a
        LEFT JOIN article_type at
            ON a.article_type = at.category_id
            AND at.org_id = a.org_id
        LEFT JOIN issue_master im
            ON a.issue_id = im.issue_id
            AND im.org_id = a.org_id
        WHERE
            a.org_id = ?
            AND $where
        ORDER BY a.publish_date DESC
    ";

    $stmt = $this->conn->prepare($sql);

    $like = "%{$search}%";

    if ($type == 'all') {
        $stmt->bind_param(
            "isss",
            $this->org_id,
            $like,
            $like,
            $like
        );
    } else {
        $stmt->bind_param(
            "is",
            $this->org_id,
            $like
        );
    }

    $stmt->execute();

    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
public function editorial_data()
{
    $stmt = $this->conn->prepare("
        SELECT
            d.editorial_id,
            d.Designation AS designation_name,
            b.Name,
            b.Department,
            b.Specialization,
            b.Address,
            b.Contact,
            b.Email,
            b.Image
        FROM editorial_designation d
        LEFT JOIN editorial_board b
            ON d.editorial_id = b.Designation
            AND b.Status='Visible'
        WHERE d.status='Visible'
        ORDER BY d.sort ASC, b.sort ASC
    ");

    $stmt->execute();
    $result = $stmt->get_result();

    $data = [];

    while ($row = $result->fetch_assoc()) {

        $id = $row['editorial_id'];

        if (!isset($data[$id])) {
            $data[$id] = [
                'designation' => $row['designation_name'],
                'members' => []
            ];
        }

        if (!empty($row['Name'])) {
            $data[$id]['members'][] = [
                'Name' => $row['Name'],
                'Department' => $row['Department'],
                'Specialization' => $row['Specialization'],
                'Address' => $row['Address'],
                'Contact' => $row['Contact'],
                'Email' => $row['Email'],
                'Image' => $row['Image']
            ];
        }
    }

    $stmt->close();

    return $data;
}

     public function Search($search)
    {
        $res = [];

        // Use prepared statements to prevent SQL injection
        $sql = "SELECT articles.*, issue_master.issue_id
            FROM articles
            JOIN issue_master ON articles.issue_id = issue_master.issue_id
            WHERE articles.title LIKE ?
               OR articles.authors LIKE ?
               OR articles.article_category LIKE ?
               OR articles.issue_id LIKE ?
               OR articles.keywords LIKE ?
               OR issue_master.issue_no LIKE ?";

        $stmt = $this->conn->prepare($sql);
        $searchTerm = "%" . $search . "%";
        $stmt->bind_param("ssssss", $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm, $searchTerm);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $res[] = $row;
        }

        $stmt->close();
        return $res;
    }


 
 public function updateArticle($id, $action)
 {
 
    $allowed = ['view', 'download'];

    if (!in_array($action, $allowed, true)) {
        return false;
    }

    $sql = "UPDATE articles
            SET `$action` = `$action` + 1
            WHERE article_id = ?
            AND org_id = ?";

    $stmt = $this->conn->prepare($sql);

    if (!$stmt) {
        return false;
    }

    $stmt->bind_param("ii", $id, $this->org_id);

    $result = $stmt->execute();
    $stmt->close();

    return $result;
}


public function curr_issue_img()
{
    $sql = "SELECT image
            FROM issue_master
            WHERE issue_status = 'Current'
            AND org_id = ?";

    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $this->org_id);
    $stmt->execute();

    $image = $stmt->get_result()->fetch_assoc();

    $stmt->close();

    return $image;

}

//////////////share button///////////////
    public function shareButtons($articleId, $base_url)
    {
        $url = $base_url . "abstract.php?article_id=" . $articleId;

        return '
    <div class="share-wrapper position-relative d-inline-block">

      <a class="text-black fw-bold btn-sm share-toggle" style="cursor:pointer;">
      <i class="bi bi-share-fill "></i>
     </a>

        <div class="share-menu bg-white border rounded shadow p-2"
             style="display:none; position:absolute; top:-13px; left:30px; z-index:999; white-space:nowrap;">

         <a href="https://api.whatsapp.com/send?text=' . $url . '" target="_blank" class="text-success text-decoration-none mx-2">
      <i class="bi bi-whatsapp fs-5"></i>
    </a>

<a href="https://www.facebook.com/sharer.php?u=' . $url . '" target="_blank" class="text-primary text-decoration-none mx-2">
    <i class="bi bi-facebook fs-5"></i>
</a>

<a href="https://www.linkedin.com/login/?session_redirect=' . $url . '" target="_blank" class="text-primary text-decoration-none mx-2">
    <i class="bi bi-linkedin fs-5"></i>
</a>

<a href="mailto:?body=' . $url . '" class="text-dark text-decoration-none mx-2">
    <i class="bi bi-envelope-fill fs-5"></i>
</a>

<a href="https://twitter.com/intent/tweet?url=' . $url . '" target="_blank" class="text-dark text-decoration-none mx-2">
    <i class="bi bi-twitter-x fs-5"></i>
</a>

        </div>

    </div>';
    }



}






