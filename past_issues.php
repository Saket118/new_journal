
<!DOCTYPE html>
<html lang="en">
  <head>
   <?php include_once "./include/link.php"; ?>
   <?php
 $id = isset($_GET['issueid']) ? $_GET['issueid'] : 0;
 $page = $functions->getSinglePageData("Past Articles");

 echo $meta= $functions->meta_tag($page["meta_title"],$page["meta_desc"],$page["meta_key"],$base_url.'past_issues.php?issueid='.$id);
  $data = $functions->issue($id);
  ?>




 <!-- <style>
 /* --- current issue  Tabs --- */
#article-tabs .nav-link {
    color: #334155 !important; 
    background-color: transparent;
    border: 1px solid transparent;
    transition: all 0.3s ease;
}

#article-tabs .nav-link:hover {
    color: #0d9488 !important; 
    background-color: #eef8f7; 
}

#article-tabs .nav-link.active {
    background-color: #0d9488 !important; 
    color: #ffffff !important;
    box-shadow: 0 4px 12px rgba(13, 148, 136, 0.2); 
}
</style> -->
</head>
<body>
<?php include_once "./include/header.php"; ?>

<section class="container-fluid py-5 ">

        <div class="row g-4 ">

            <!-- Left Side -->
          <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 px-5 article-section">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1 issue-title">
                <?= $page["meta_title"] ?>
            </h2>

            <p class="text-muted mb-0">
                <?= $data['issue']['issue_no']; ?> •
                <?= date('Y', strtotime($data['issue']['date_publish'])); ?>
            </p>
        </div>
    </div>

    <?php foreach ($data['categories'] as $category) { ?>


        <?php foreach ($data['articles'] as $article) {
            if ($article['article_type'] == $category['category_id']) { ?>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-3">

                        <span class="badge article-badge mb-2">
                            <?= $category['category_name']; ?>
                        </span>

                        <h5 class="fw-bold mb-3">
                            <a href="#" class="text-decoration-none text-black">
                                <?= $article['title']; ?>
                            </a>
                        </h5>

                        <p class="text-secondary mb-1">
                            <strong>Author details:</strong>
                            <?= $article['authors']; ?>
                        </p>

                        <p class="text-muted fst-italic mb-1">
                            <?= $data['issue']['issue_no']; ?>,
                            Pages <?= $article['pages']; ?>
                        </p>

                        <hr>

                        <div class="d-flex flex-wrap gap-4 small text-muted mb-3">

                            <?php if (!empty($article['doi'])) { ?>
                                <span>
                                    <i class="bi bi-link-45deg me-1"></i>
                                    DOI:
                                    <a href="<?= $article['doiurl']; ?>" target="_blank" class="text-decoration-none text-success">
                                        <?= $article['doi']; ?>
                                    </a>
                                </span>
                            <?php } ?>

                            <span>
                                <i class="bi bi-eye"></i>
                                <?= $article['view']; ?> Views
                            </span>

                            <span>
                                <i class="bi bi-download"></i>
                                <?= $article['download']; ?> Downloads
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

        <?php }
        } ?>

    <?php } ?>

</div>
            </div>


     
           


    </section>







<?php include_once "./include/footer.php"; ?>

</body>
</html>