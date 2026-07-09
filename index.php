<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once "./include/link.php"; ?>
    <?php
    $page = $functions->getSinglePageData("Home");
    echo $meta = $functions->meta_tag($page["meta_title"], $page["meta_desc"], $page["meta_key"], $base_url);

    $mostViewed = $functions->getMostViewedArticles();
    $mostDownloaded = $functions->getMostDownloadedArticles();
    $news = $functions->getNews();
    $advertisements = $functions->getAdvertisementName();
    $conferences = $functions->getConferenceTitles();
    $chartData = $functions->getManuscriptChartData();
    $issue = $functions->current_issue();

    ?>

</head>

<body>
    <?php include_once "./include/header.php"; ?>


    <div class="container-fluid mb-5">
        <div class="row justify-content-center">
            <div class="col-lg-2">
                <?php include_once "./include/left_sidebar.php"; ?>
            </div>
            <div class="col-lg-7 py-2 border my-2">

                <div class="container">
                    <h2 class="border-bottom"><?= $page["meta_title"] ?></h2>

                    <div>
                        <?= $page["page_content"] ?>
                    </div>



                    <ul class="nav nav-pills nav-justified mb-2 shadow-sm rounded bg-white" id="article-tabs"
                        role="tablist">

                        <li class="nav-item" role="presentation">
                            <button class="nav-link small font-weight-bold py-1 w-100 text-truncate active"
                                id="tab-abstract-tab" data-bs-toggle="pill" data-bs-target="#tab-abstract" type="button"
                                role="tab" aria-controls="tab-abstract" aria-selected="true">
                                Currrent articles
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link small font-weight-bold py-1 w-100 text-truncate"
                                id="tab-metrics-tab" data-bs-toggle="pill" data-bs-target="#tab-metrics" type="button"
                                role="tab" aria-controls="tab-metrics" aria-selected="false" tabindex="-1">
                                Most viewed articles
                            </button>
                        </li>

                        <li class="nav-item" role="presentation">
                            <button class="nav-link small font-weight-bold py-1 w-100 text-truncate"
                                id="tab-comment-tab" data-bs-toggle="pill" data-bs-target="#tab-comment" type="button"
                                role="tab" aria-controls="tab-comment" aria-selected="false" tabindex="-1">
                                most downloaded articles
                            </button>
                        </li>

                    </ul>

                    <div class="tab-content" id="article-tabs-content">

                        <div class="tab-pane fade active show" id="tab-abstract" role="tabpanel"
                            aria-labelledby="tab-abstract-tab">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body p-3">

                                    <span class="badge article-badge mb-2">
                                        Original Research
                                    </span>

                                    <h5 class="fw-bold mb-3">
                                        <a href="#" class="text-decoration-none text-black">
                                            Radiographic Assessment of Common Thoracic Disorders Using Chest X-Ray
                                            Imaging
                                        </a>
                                    </h5>

                                    <p class="text-secondary mb-1">
                                        <strong>Author details:</strong>
                                        Zaira Hassan, Alishba Khusro, Ahmad Huzaifa,
                                        Mohd Sofian Dar, Saiyed Adeel Abbas, Ms Taiba
                                    </p>

                                    <p class="text-muted fst-italic mb-1">
                                        Innovative Journal of Medical Imaging, 3(2), 1–7, 2026
                                    </p>

                                    <hr>

                                    <div class="d-flex flex-wrap gap-4 small text-muted mb-3">
                                        <span>
                                            <i class="bi bi-link-45deg me-1"></i>
                                            DOI:
                                            <a href="#" class="text-decoration-none text-green">
                                                10.62502/ijmi/v3i2art1
                                            </a>
                                        </span>

                                        <span>
                                            <i class="bi bi-eye"></i>
                                            128 Views
                                        </span>

                                        <span>
                                            <i class="bi bi-download"></i>
                                            40 Downloads
                                        </span>
                                    </div>

                                    <div class="d-flex gap-2">
                                        <a href="#" class="btn btn-theme btn-sm">
                                            Read Article
                                        </a>

                                        <a href="#" class="btn btn-outline-secondary btn-sm">
                                            PDF
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="tab-metrics" role="tabpanel" aria-labelledby="tab-metrics-tab">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body p-3">

                                    <?php $mostViewed = $functions->getMostViewedArticles(); ?>

                                    <?php if (!empty($mostViewed)) { ?>

                                        <?php foreach ($mostViewed as $article) { ?>

                                            <div class="card border-0 shadow-sm mb-3">
                                                <div class="card-body">

                                                    <span class="badge bg-success mb-2">
                                                        <?= $article['article_type']; ?>
                                                    </span>

                                                    <h5 class="fw-bold">
                                                        <a href="<?= $base_url ?>abstract.php?article_id=<?= $article['article_id']; ?>"
                                                            class="text-decoration-none text-dark">

                                                            <?= $article['title']; ?>

                                                        </a>
                                                    </h5>

                                                    <p class="mb-1">
                                                        <strong>Author Details :</strong>
                                                        <?= $article['authors']; ?>
                                                    </p>

                                                    <p class="text-muted fst-italic mb-2">
                                                        Pages <?= $article['pages']; ?>
                                                        |
                                                        <?= date("Y", strtotime($article['publish_date'])); ?>
                                                    </p>

                                                    <hr>

                                                    <div class="d-flex flex-wrap gap-4 small mb-3">

                                                        <span>
                                                            DOI :
                                                            <a href="<?= $article['doiurl']; ?>" target="_blank"
                                                                class="text-decoration-none">
                                                                <?= $article['doi']; ?>
                                                            </a>
                                                        </span>

                                                        <span>
                                                            👁 <?= $article['view']; ?> Views
                                                        </span>

                                                        <span>
                                                            ⬇ <?= $article['download']; ?> Downloads
                                                        </span>

                                                    </div>

                                                    <div class="d-flex gap-2">

                                                        <a href="<?= $base_url ?>abstract.php?article_id=<?= $article['article_id']; ?>"
                                                            class="btn btn-success btn-sm">

                                                            Read Article

                                                        </a>

                                                        <a href="<?= $article['file_url']; ?>" target="_blank"
                                                            class="btn btn-outline-secondary btn-sm">

                                                            PDF

                                                        </a>

                                                    </div>

                                                </div>
                                            </div>

                                        <?php } ?>

                                    <?php } ?>

                                </div>
                            </div>
                        </div>


                        <div class="tab-pane fade" id="tab-comment" role="tabpanel" aria-labelledby="tab-comment-tab">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body p-3">

                                    <?php $mostDownloaded = $functions->getMostDownloadedArticles(); ?>

                                    <?php if (!empty($mostDownloaded)) { ?>

                                        <?php foreach ($mostDownloaded as $article) { ?>

                                            <div class="card border-0 shadow-sm mb-3">
                                                <div class="card-body">

                                                    <span class="badge bg-success mb-2">
                                                        <?= $article['article_type']; ?>
                                                    </span>

                                                    <h5 class="fw-bold">
                                                        <a href="<?= $base_url ?>abstract.php?article_id=<?= $article['article_id']; ?>"
                                                            class="text-decoration-none text-dark">

                                                            <?= $article['title']; ?>

                                                        </a>
                                                    </h5>

                                                    <p class="mb-1">
                                                        <strong>Author Details :</strong>
                                                        <?= $article['authors']; ?>
                                                    </p>

                                                    <p class="text-muted fst-italic mb-2">
                                                        Pages <?= $article['pages']; ?>
                                                        |
                                                        <?= date("Y", strtotime($article['publish_date'])); ?>
                                                    </p>

                                                    <hr>

                                                    <div class="d-flex flex-wrap gap-4 small mb-3">

                                                        <span>
                                                            DOI :
                                                            <a href="<?= $article['doiurl']; ?>" target="_blank"
                                                                class="text-decoration-none">
                                                                <?= $article['doi']; ?>
                                                            </a>
                                                        </span>

                                                        <span>
                                                            👁 <?= $article['view']; ?> Views
                                                        </span>

                                                        <span>
                                                            ⬇ <?= $article['download']; ?> Downloads
                                                        </span>

                                                    </div>

                                                    <div class="d-flex gap-2">

                                                        <a href="<?= $base_url ?>abstract.php?article_id=<?= $article['article_id']; ?>"
                                                            class="btn btn-success btn-sm">

                                                            Read Article

                                                        </a>

                                                        <a href="<?= $article['file_url']; ?>" target="_blank"
                                                            class="btn btn-outline-secondary btn-sm">

                                                            PDF

                                                        </a>

                                                    </div>

                                                </div>
                                            </div>

                                        <?php } ?>

                                    <?php } ?>
                                </div>
                            </div>

                        </div>

                    </div>
                    
                </div>

            </div>
            <div class="col-lg-2">
                <?php include_once "./include/right_sidebar.php"; ?>
            </div>
        </div>



        <!-- ///////tabl///// -->

        <!-- ///////// -->

        <?php include_once "./include/footer.php"; ?>


</body>

</html>