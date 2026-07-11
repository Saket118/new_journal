
<?php
   include_once "./include/link.php"; 
$q = trim($_GET['q'] ?? '');
$type = $_GET['type'] ?? 'all';

$articles = [];

if ($q != '') {
    $articles = $functions->searchArticles($q, $type);
}
?>