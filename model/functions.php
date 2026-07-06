
<?php

require_once "./connection/db.php";

$db = new Database();
$conn = $db->getConnection();


function getHeader($conn, $org_id)
{

    $query = "SELECT header_text, clogo, issn
              FROM header_footer_master
              WHERE org_id = $org_id";

    $result = mysqli_query($conn, $query);
    return mysqli_fetch_assoc($result);
}


// function getPageData($conn, $org_id, )
// {
    
//     $query = "SELECT page_id, page_title, page_content
//               FROM page_master
//               WHERE org_id = $org_id
//               AND page_sts = 1";

//     $result = mysqli_query($conn, $query);
//     return mysqli_fetch_assoc($result);
// }

// function getSinglePageData($conn, $org_id, $page_id)
// {
//     $org_id = (int)$org_id;
//     $page_id = (int)$page_id;

//     $query = "SELECT * FROM page_master 
//               WHERE org_id = $org_id 
//               AND page_id = $page_id 
//               AND page_sts = 1 
//               LIMIT 1";

//     $result = mysqli_query($conn, $query);
//     return mysqli_fetch_assoc($result);
// }