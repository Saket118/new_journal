<?php include_once "./include/link.php"; ?>
<?php
$article_id = $_GET['article_id'] ?? 0;
$article = $functions->getfulltext($article_id);

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

    <div class="mb-4">
        <a href="<?= $article['file_url']; ?>" class="btn btn-warning" target="_blank">
            Download PDF
        </a>
    </div>


    <h4>Full Text</h4>

    <div class="text-justify">
        <?= $article['full_text']; ?>
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