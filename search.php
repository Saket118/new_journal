<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once "./include/link.php"; ?>
    <?php
    echo $meta = $functions->meta_tag('Search', '', '', $base_url . 'search.php');
    $issue = $functions->issue();

    $q    = trim($_POST['q'] ?? '');
    $type = $_POST['type'] ?? 'all';
        $articles = $functions->searchArticles($q, $type);
    ?>

</head>

<body>
    <?php include_once "./include/header.php"; ?>
    <div class="container">

        <div class=" justify-content-center">

           

            <div class=" py-2 border my-2">
                <div class="container">
                    <h2 class="border-bottom mb-4">
                        <?= $page["meta_title"] ?? "Search"; ?>
                    </h2>

                    <?php if (!empty($articles)): ?>

                        <?php foreach ($articles as $article): ?>
  <?php        $title = strip_tags(html_entity_decode($article['title'], ENT_QUOTES, 'UTF-8'));

$title = str_replace(
    ['%0D%0A', '%2C','%3A'],
    ['', ',',':'],
    urlencode($title)); ?>
                            <div class="card border-0 shadow-sm mb-4">
                                <div class="card-body p-3">

                                    <span class="badge article-badge mb-2">
                                        <?= $article['category_name']; ?>
                                    </span>

                                    <h5 class="fw-bold mb-3">
    <a href="<?= $base_url ?>fulltext.php?article_id=<?= $article['article_id'] ?>&title=<?= $title ?>" class="text-decoration-none text-dark">
        <?= $article['title']; ?>
    </a>
</h5>

                                    <p class="text-secondary mb-1">
                                        <strong>Author details:</strong>
                                        <?= $article['authors']; ?>
                                    </p>

                                  
 <div class="d-flex flex-wrap gap-3  mb-3">
                                                  <p class="text-muted fst-italic mb-2">
                                 <?= $article['issue_no']; ?>,
        Pages <?= $article['pages']; ?>
    </p>
    <span class="text-muted">|</span>
    <?= $functions->shareButtons(
                $article['article_id'],
                $base_url
            ); ?>
</div>
                                    <hr>

                                    <div class="d-flex flex-wrap gap-4 small text-muted mb-3">

                                        <?php if (!empty($article['doi'])): ?>
                                            <span>
                                                <i class="bi bi-link-45deg me-1"></i>
                                                DOI :
                                                <a href="<?= $article['doiurl']; ?>" target="_blank" class="text-decoration-none text-success">
                                                    <?= $article['doi']; ?>
                                                </a>
                                            </span>
                                        <?php endif; ?>

                                        <span>
                                            <i class="bi bi-eye me-1"></i>
                                            <?= $article['view']; ?> Views
                                        </span>

                                        <span>
                                            <i class="bi bi-download me-1"></i>
                                            <?= $article['download']; ?> Downloads
                                        </span>

                                    </div>

                                    <?= $functions->articleButtons(
                                        $article['article_id'],
                                         $title,
                                        $article['file_url'],
                                        $base_url
                                    ); ?>

                                </div>
                            </div>

                        <?php endforeach; ?>

                    <?php else: ?>

                        <div class="alert alert-warning text-center">
                            No articles found.
                        </div>

                    <?php endif; ?>
                </div>
            </div>

           
        </div>
        </div>
        <?php include_once "./include/footer.php"; ?>
</body>

</html>