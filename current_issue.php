<!DOCTYPE html>
<html lang="en">

<head>
  <?php include_once "./include/link.php"; ?>
  <?php
  $page = $functions->getSinglePageData("Current Issue");
  echo $meta = $functions->meta_tag("Current issue", "", "", $base_url . 'current_issue');
  $issue = $functions->issue();

  ?>

</head>
<body>
  <?php include_once "./include/header.php"; ?>

    <div class="container py-5">

  
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 px-5 article-section">

        <div class="d-flex justify-content-between align-items-center mb-4">
          <div>
            <h2 class="fw-bold mb-1 issue-title">
              <?= $page["meta_title"] ?? "Current_issue"?>
            </h2>

            <p class="text-muted mb-0">
              <?= $issue['issue']['issue_no']; ?> •
              <?= date('Y', strtotime($issue['issue']['date_publish'])); ?>
            </p>
          </div>
        </div>

        <?php foreach ($issue['articles'] as $article): ?>

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
                <a href="<?= $base_url ?>fulltext.php?article_id=<?= $article['article_id'] ?>&title=<?= $title ?>" class="text-decoration-none text-black">
                  <?= $article['title']; ?>
                </a>
              </h5>

              <p class="text-secondary mb-1">
                <strong>Author details:</strong>
                <?= $article['authors']; ?>
              </p>

              <p class="text-muted fst-italic mb-1">
                <?= $issue['issue']['issue_no']; ?>,
                Pages <?= $article['pages']; ?>
              </p>

              <hr>

              <div class="d-flex flex-wrap gap-4 small text-muted mb-3">

                <?php if (!empty($article['doi'])): ?>
                  <span>
                    <i class="bi bi-link-45deg me-1"></i>
                    DOI:
                    <a href="<?= $article['doiurl']; ?>" target="_blank" class="text-decoration-none text-success">
                      <?= $article['doi']; ?>
                    </a>
                  </span>
                <?php endif; ?>

                <span>
                  <i class="bi bi-eye"></i>
                  <?= $article['view']; ?> Views
                </span>

                <span>
                  <i class="bi bi-download"></i>
                  <?= $article['download']; ?> Downloads
                </span>

              </div>

              <!-- <div class="d-flex gap-2">
                <a href="#" class="btn btn-theme btn-sm">
                  Read Article
                </a>

                <a href="<?= $article['file_url'] ?>" target="_blank" class="btn btn-outline-secondary btn-sm">
                  PDF
                </a>
              </div> -->
              <?= $functions->articleButtons( $article['article_id'],$title,$article['file_url'], $base_url); ?>

            </div>
          </div>

        <?php endforeach; ?>

      </div>
    </div>









  <?php include_once "./include/footer.php"; ?>

</body>

</html>