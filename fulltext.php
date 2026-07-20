<?php include_once "./include/link.php"; ?>
<?php
$article_id = $_GET['article_id'] ?? 0;
$article = $functions->getfulltext($article_id);
$organization_name= $functions->getOrgnazationData()["org_name"];


$articleTitle = strip_tags($article['title'] ?? 'Article');

$description = !empty($article['long_desc']) ? substr(trim(strip_tags(html_entity_decode($article['long_desc']))), 0, 300) : '';
$keywords = !empty($article['keywords']) ? strip_tags($article['keywords']) : '';
$articleUrl = $base_url.'fulltext.php?article_id=' . $article['article_id'];
$pdfUrl = !empty($article['pdf'])
    ? $base_url('uploads/articles/' . $article['pdf'])
    : '';
$coverImage ='';
?>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
 
<title><?= $articleTitle ?></title>
<meta name="robots" content="index, follow, max-image-preview:large">
<meta name="title" content="<?= $articleTitle ?>">
<meta name="description" content="<?= $description ?>">
<?php
$keywordArray = array_filter(array_map('trim', preg_split('/[,;\r\n]+/', $keywords)));
foreach ($keywordArray as $keyword) {
    echo '<meta name="keywords" content="' . htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8') . '">' . PHP_EOL;
}

$authorArray = array_filter(array_map('trim', preg_split('/[,;\r\n]+/', $article['authors'])));
foreach ($authorArray as $author) {
    echo '<meta name="author" content="' . htmlspecialchars($author, ENT_QUOTES, 'UTF-8') . '">' . PHP_EOL;
}
?>
 
<link rel="canonical" href="<?= $articleUrl ?>">
 
<!-- Open Graph -->
<meta property="og:type" content="article">
<meta property="og:url" content="<?= $articleUrl ?>">
<meta property="og:title" content="<?= $articleTitle ?>">
<meta property="og:description" content="<?= $description ?>">
<meta property="og:image" content="<?= $coverImage ?>">
<meta property="og:site_name" content="<?= $organization_name ?>">
 
<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?= $articleTitle ?>">
<meta name="twitter:description" content="<?= $description ?>">
<meta name="twitter:image" content="<?= $coverImage ?>">
 
<!-- Google Scholar / Citation Meta -->
<meta name="citation_title" content="<?= $articleTitle ?>">
<meta name="citation_journal_title" content="<?= $organization_name ?>">
<meta name="citation_language" content="en">
<meta name="citation_public_url" content="<?= $articleUrl ?>">
 
<?php if (!empty($pdfUrl)) : ?>
<meta name="citation_pdf_url" content="<?= $pdfUrl ?>">
<?php endif; ?>
 
<?php if (!empty($article['doi'])) : ?>
<meta name="citation_doi" content="<?= $article['doi'] ?>">
<?php endif; ?>
 
<?php if (!empty($article['published_date'])) : ?>
<meta name="citation_publication_date" content="<?= date('Y/m/d', strtotime($article['published_date'])) ?>">
<?php endif; ?>
 
<!-- Authors -->
<?php
if (!empty($article['authors'])) {
$authorArray = array_filter(array_map('trim', preg_split('/[,;\r\n]+/', $article['authors'])));
foreach ($authorArray as $author) {
    echo '<meta name="citation_author" content="' . htmlspecialchars($author, ENT_QUOTES, 'UTF-8') . '">' . PHP_EOL;
}
}
 
if (!empty($article['keywords'])) {
    $keywordArray = array_filter(array_map('trim', preg_split('/[,;\r\n]+/', $keywords)));
foreach ($keywordArray as $keyword) {
    echo '<meta name="citation_keywords" content="' . htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8') . '">' . PHP_EOL;
}

    }

?>
<?php include_once "./include/header.php"; ?>

<!-- ///ABSTRACT////// -->
<div class="container mt-4">

    <h2 class="border-bottom pb-2 mb-4">Full text</h2>

    <h3><?= $article['title'] ?></h3>

    <div class="text-muted mb-3">
        <!-- <strong>Author :</strong> -->
        <?= $article['authors'] ?>
    </div>

    <div class="mb-2">
        <strong>Category :</strong>
        <?= $article['article_type'] ?>
    </div>


    <div class="mb-2">
        <strong>Pages :</strong>
        <?= $article['pages'] ?>
    </div>

    <div class="mb-2">
        <strong>Published :</strong>
        <?= date("d-M-Y", strtotime($article['publish_date'])) ?>
    </div>

    <div class="mb-3">
        <strong>DOI :</strong>
        <a href="<?= $article['doi'] ?>" target="_blank">
            <?= $article['doi'] ?>
        </a>
    </div>

    <!-- <div class="mb-4">
        <a href="<?= $article['file_url']; ?>" class="btn btn-warning" target="_blank">
            Download PDF
        </a>
    </div> -->
<?= $functions->articleButtons($article['article_id'], $article['title'], $article['file_url'], $base_url, 'fulltext'); ?>

    <h4>Full Text</h4>

    <div class="text-justify">
        <?= html_entity_decode($article['full_text']); ?>
    </div>
    <hr>

    <div class="mb-2">
        <strong>References :</strong>
        <?= $article['referances'] ?>
    </div>


    <div class="mb-2">
        <strong>Keywords :</strong>
        <?= $article['keywords'] ?>
    </div>

    <div class="mb-2">
        <strong>Views :</strong>
        <?= $article['view'] ?>

        &nbsp;&nbsp;

        <strong>Downloads :</strong>
        <?= $article['download'] ?>
    </div>

</div>
<!-- ///////////////////// -->

<?php include_once "./include/footer.php"; ?>