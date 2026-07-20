
<!DOCTYPE html>
<html lang="en">
<head>
<?php include_once "./include/link.php"; ?>
<?php
$article_id = $_GET['article_id'] ?? 0;
$article = $functions->getabstract($article_id);
$article = $functions->getfulltext($article_id);
$organization_name= $functions->getOrgnazationData()["org_name"];


$articleTitle = strip_tags($article['title'] ?? 'Article');

$description = !empty($article['long_desc']) ? substr(trim(strip_tags(html_entity_decode($article['long_desc']))), 0, 300) : '';
$keywords = !empty($article['keywords']) ? strip_tags($article['keywords']) : '';
$articleUrl = $base_url.'abstract.php?article_id=' . $article['article_id'];
$pdfUrl = !empty($article['pdf'])
    ? $base_url('uploads/articles/' . $article['pdf'])
    : '';
$coverImage ='';
?>
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
</head>
<body>
    <?php include_once "./include/header.php"; ?>

<!-- ///ABSTRACT////// -->
 <div class="container">
<div class="card border-0 shadow-sm">

    <div class="card-body p-3">

     <h2 class="border-bottom pb-2 mb-4">Abstract</h2>

        <h3 class="fw-bold mb-3">
            <?= $article['title'] ?>
        </h3>

        <p class="text-secondary mb-1">
            <strong>Author Details:</strong>
            <?= $article['authors'] ?>
        </p>

        <p class="text-muted fst-italic mb-1">
            Published:
            <?= date("d M Y", strtotime($article['publish_date'])) ?>
            &nbsp; | &nbsp;
            Pages <?= $article['pages'] ?>
        </p>

        <hr>

        <div class="d-flex flex-wrap gap-4 small text-muted mb-3">

            <span>
                <strong>Category:</strong>
                <?= $article['article_type'] ?>
            </span>

            <?php if (!empty($article['doi'])): ?>
                <span>
                    <i class="bi bi-link-45deg me-1"></i>
                    DOI:
                    <a href="<?= $article['doi'] ?>"
                        target="_blank"
                        class="text-decoration-none text-success">

                        <?= $article['doi'] ?>

                    </a>
                </span>
            <?php endif; ?>

            <span>
                <i class="bi bi-eye"></i>
                <?= (int)$article['view'] ?> Views
            </span>

            <span>
                <i class="bi bi-download"></i>
                <?= (int)$article['download'] ?> Downloads
            </span>

        </div>

        <?= $functions->articleButtons(
            $article['article_id'],
            $article['title'],
            $article['file_url'],
            $base_url,
            'abstract'
        ); ?>

        <hr>

        <h5 class="fw-bold mb-3">
            Abstract
        </h5>

        <div class="mb-4">
            <?= html_entity_decode($article['long_desc']) ?>
        </div>

        <hr>

        <div class="mb-3">
            <strong>References:</strong><br>
            <?= html_entity_decode($article['referances']) ?>
        </div>

        <div class="mb-3">
            <strong>Keywords:</strong><br>
            <?= $article['keywords'] ?>
        </div>

    </div>
</div>
</div>


<?php include_once "./include/footer.php"; ?>
</body>
</html>






