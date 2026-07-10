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
        $this->org_id= 1;
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
public function Archives($status)
{
    $stmt = $this->conn->prepare("
        SELECT issue_id, issue_no, issue_status, date_publish
        FROM issue_master
        WHERE org_id = ?
        AND issue_type = 0
        AND issue_status = ?
        ORDER BY date_publish DESC
    ");
    $stmt->bind_param("is", $this->org_id, $status);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}
public function issue($issue_id = null)
{
    // Get issue details
    if ($issue_id === null) {
        $issue = $this->Archives("Current")[0] ?? null;

        if (!$issue) {
            return [
                "issue"      => null,
                "categories" => [],
                "articles"   => []
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
                "issue"      => null,
                "categories" => [],
                "articles"   => []
            ];
        }
    }

    // Get Categories
    $category = $this->conn->prepare("
        SELECT
            articles.article_type,
            article_type.category_name,
            article_type.category_id
        FROM articles
        INNER JOIN article_type
            ON articles.article_type = article_type.category_id
        WHERE articles.issue_id = ?
        AND articles.org_id = ?
        AND article_type.org_id = ?
        GROUP BY articles.article_type
        ORDER BY article_type.article_sort ASC
    ");

    $category->bind_param("iii", $issue_id, $this->org_id, $this->org_id);
    $category->execute();
    $categories = $category->get_result()->fetch_all(MYSQLI_ASSOC);

    // Get Articles
    $article = $this->conn->prepare("
        SELECT
            article_id,
            authors,
            title,
            pages,
            view,
            download,
            doi,
            doiurl,
            article_type
        FROM articles
        WHERE issue_id = ?
        AND org_id = ?
        ORDER BY article_type ASC
    ");

    $article->bind_param("ii", $issue_id, $this->org_id);
    $article->execute();
    $articles = $article->get_result()->fetch_all(MYSQLI_ASSOC);

    return [
        "issue"      => $issue,
        "categories" => $categories,
        "articles"   => $articles
    ];
}

<<<<<<< HEAD
// public function current_issue()
// {
//     $issue = $this->Archives("Current")[0];
//     $issue_id = $issue["issue_id"];

 
//     $category = $this->conn->prepare("
//         SELECT
//             articles.article_type,
//             article_type.category_name,
//             article_type.category_id
//         FROM articles
//         INNER JOIN article_type
//             ON articles.article_type = article_type.category_id
//         WHERE articles.issue_id = ?
//         AND articles.org_id = ?
//         AND article_type.org_id = ?
//         GROUP BY articles.article_type
//         ORDER BY article_type.article_sort
//     ");

//     $category->bind_param("iii", $issue_id, $this->org_id, $this->org_id);
//     $category->execute();
//     $categories = $category->get_result()->fetch_all(MYSQLI_ASSOC);


//     $article = $this->conn->prepare("
//         SELECT
//             article_id,
//             authors,
//             title,
//             pages,
//             view,
//             download,
//             doi,
//             doiurl,
//             article_type
//         FROM articles
//         WHERE issue_id = ?
//         AND org_id = ?
//         ORDER By article_type
//     ");

//     $article->bind_param("ii", $issue_id, $this->org_id);
//     $article->execute();
//     $articles = $article->get_result()->fetch_all(MYSQLI_ASSOC);

//     return [
//         "issue"      => $issue,    
//         "categories" => $categories,   
//         "articles"   => $articles     
//     ];
// }

// public function past_issue($issue_id)
// {
//     // Get issue details
//     $issue = $this->conn->prepare("
//         SELECT issue_id,issue_no,date_publish
//         FROM issue_master
//         WHERE issue_id = ?
//         AND org_id = ?
//         LIMIT 1
//     ");

//     $issue->bind_param("ii", $issue_id, $this->org_id);
//     $issue->execute();
//     $issue = $issue->get_result()->fetch_assoc();

    
//     $category = $this->conn->prepare("
//         SELECT
//             articles.article_type,
//             article_type.category_name,
//             article_type.category_id
//         FROM articles
//         INNER JOIN article_type
//             ON articles.article_type = article_type.category_id
//         WHERE articles.issue_id = ?
//         AND articles.org_id = ?
//         AND article_type.org_id = ?
//         GROUP BY articles.article_type
//         ORDER BY article_type.article_sort ASC
//     ");

//     $category->bind_param("iii", $issue_id, $this->org_id, $this->org_id);
//     $category->execute();
//     $categories = $category->get_result()->fetch_all(MYSQLI_ASSOC);

   
//     $article = $this->conn->prepare("
//         SELECT
//             article_id,
//             authors,
//             title,
//             pages,
//             view,
//             download,
//             doi,
//             doiurl,
//             article_type
//         FROM articles
//         WHERE issue_id = ?
//         AND org_id = ?
//         ORDER BY article_type ASC
//     ");

//     $article->bind_param("ii", $issue_id, $this->org_id);
//     $article->execute();
//     $articles = $article->get_result()->fetch_all(MYSQLI_ASSOC);

//     return [
//         "issue"      => $issue,
//         "categories" => $categories,
//         "articles"   => $articles
//     ];
// }
=======

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



public function registerUser($data)
{
    $status       = 1;
    $org_id       = $this->org_id;
    $created_date = date("Y-m-d H:i:s");
    $group_id = ($data['userType'] == 'Author') ? 2 : (($data['userType'] == 'Reviewer') ? 4 : '');


    $stmt = $this->conn->prepare("
        INSERT INTO user_login
        (
            user_name, pwd, status, Type, Email, Salutation, First_Name, Qualification, Address, City, State, Country, Mobile, org_id, group_id, created_date
        )
        VALUES
        (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
    ");

        $stmt->bind_param(
        "sssssssssiiiiiss",
        $data['email'],                             
        $this->encrypt($data['password']),
        $status,
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
        $org_id,
        $group_id,      
        $created_date
    );

    return $stmt->execute();
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
    $org_name       = "Anirudh";      
    $org_email      = "anirudh@gmail.com";  
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



// public function getMostViewedArticles($limit = 2)
// {
//     $stmt = $this->conn->prepare("
//         SELECT article_id, title, view
//         FROM articles
//         WHERE org_id = ?
//         ORDER BY view DESC
//         LIMIT ?
//     ");
//     $stmt->bind_param("ii", $this->org_id, $limit);
//     $stmt->execute();
//     return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
// }


// public function getMostDownloadedArticles($limit = 2)
// {
//     $stmt = $this->conn->prepare("
//         SELECT article_id, title, download
//         FROM articles
//         WHERE org_id = ?
//         ORDER BY download DESC
//         LIMIT ?
//     ");
//     $stmt->bind_param("ii", $this->org_id, $limit);
//     $stmt->execute();
//     return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
// }
public function getMostViewedArticles()
{
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
        ORDER BY view DESC
        LIMIT 5
    ");

    $stmt->bind_param("i", $this->org_id);
    $stmt->execute();

    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}

public function getMostDownloadedArticles()
{
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
        ORDER BY download DESC
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
        AND status = 1
        ORDER BY ad_id DESC
    ");

    $stmt->bind_param("i", $this->org_id);
    $stmt->execute();
   return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}
//CONFERENCE
public function getConferenceTitles()
{
    $stmt = $this->conn->prepare("
        SELECT title
        FROM conference
        WHERE org_id = ?
        AND sts = 1
        ORDER BY id DESC
    ");

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
        AND news_sts = 1
        ORDER BY news_sort ASC
    ");

    $stmt->bind_param("i", $this->org_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}


// manuscript
public function getManuscriptChartData()
{
    $stmt = $this->conn->prepare("
        SELECT current_phase, COUNT(*) AS total
        FROM manuscript_submit
        WHERE org_id = ?
        GROUP BY current_phase
        ORDER BY current_phase ASC
    ");

    $stmt->bind_param("i", $this->org_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
}



public function getArticleById($article_id)
{
    $stmt = $this->conn->prepare("
        SELECT
            article_id,
            article_type,
            referances,
            title,
            authors,
            pages,
            publish_date,
            doi,
            file_url,
            keywords,
            long_desc,
            view,
            download
        FROM articles
        WHERE article_id = ?
        AND org_id = ?
        LIMIT 1
    ");

    $stmt->bind_param("ii", $article_id, $this->org_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}





public function getfulltext($article_id)
{
    $stmt = $this->conn->prepare("
        SELECT
            article_id,
            article_type,
            referances,
            title,
            authors,
            pages,
            publish_date,
            doi,
            file_url,
            keywords,
            long_desc,
            full_text,
            view,
            download
        FROM articles
        WHERE article_id = ?
        AND org_id = ?
        LIMIT 1
    ");

    $stmt->bind_param("ii", $article_id, $this->org_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}


>>>>>>> 1281b9ca73ba0b919b6899a0356e605bbed8155f
}



