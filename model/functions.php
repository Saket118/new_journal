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

public function current_issue()
{
    $issue = $this->Archives("Current")[0];
    $issue_id = $issue["issue_id"];

 
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
    ");

    $category->bind_param("iii", $issue_id, $this->org_id, $this->org_id);
    $category->execute();
    $categories = $category->get_result()->fetch_all(MYSQLI_ASSOC);


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
        ORDER By article_type
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
}



