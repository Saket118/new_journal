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
                                Most downloaded articles
                            </button>
                        </li>

                    </ul>

                    <div class="tab-content" id="article-tabs-content">

                        <div class="tab-pane fade active show" id="tab-abstract" role="tabpanel"
                            aria-labelledby="tab-abstract-tab">


                            <div class="card-body p-3">
                                <?php foreach ($issue['articles'] as $article): ?>
  <?php        $title = strip_tags(html_entity_decode($article['title'], ENT_QUOTES, 'UTF-8'));

$title = str_replace(
    ['%0D%0A', '%2C','%3A'],
    ['', ',',':'],
    urlencode($title)); ?>
                                    <div class="card border-0 shadow-sm mb-4">
                                        <div class="card-body p-3">

                                            <!-- <span class="badge article-badge mb-2">
                                                <?= $article['category_name'] ?>
                                            </span> -->

                                            <h5 class="fw-bold mb-3">
                                                <a href="<?= $base_url ?>fulltext.php?article_id=<?= $article['article_id'] ?>&title=<?= $title ?>"
                                                    class="text-decoration-none text-black">

                                                    <?= $article['title']; ?>

                                                </a>
                                            </h5>

                                            <p class="text-secondary mb-1">
                                                <strong>Author details:</strong>
                                                <?= $article['authors'] ?>
                                            </p>

                                            <p class="text-muted fst-italic mb-1">
                                                Pages <?= $article['pages'] ?>,
                                                    <?= date("Y", strtotime($article['publish_date'])); ?>
                                            </p>

                                            <hr>

                                            <div class="d-flex flex-wrap gap-4 small text-muted mb-3">

                                                <?php if (!empty($article['doi'])): ?>
                                                    <span>
                                                        <i class="bi bi-link-45deg me-1"></i>
                                                        DOI:
                                                        <a href="<?= $article['doiurl'] ?>" target="_blank"
                                                            class="text-decoration-none text-success">
                                                            <?= $article['doi'] ?>
                                                        </a>
                                                    </span>
                                                <?php endif; ?>

                                                <span>
                                                    <i class="bi bi-eye"></i>
                                                    <?= (int) $article['view'] ?> Views
                                                </span>

                                                <span>
                                                    <i class="bi bi-download"></i>
                                                    <?= (int) $article['download'] ?> Downloads
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
                            </div>
                        </div>


                        <div class="tab-pane fade" id="tab-metrics" role="tabpanel" aria-labelledby="tab-metrics-tab">
                            <div class="card-body p-3">


                                <?php if (!empty($mostViewed)) { ?>

                                    <?php foreach ($mostViewed as $article) { ?>
  <?php        $title = strip_tags(html_entity_decode($article['title'], ENT_QUOTES, 'UTF-8'));

$title = str_replace(
    ['%0D%0A', '%2C','%3A'],
    ['', ',',':'],
    urlencode($title)); ?>
                                        <div class="card border-0 shadow-sm mb-4">
                                            <div class="card-body p-3">

                                                <!-- <span class="badge article-badge mb-2">
                                            <?= $article['category_name'] ?>
                                        </span> -->

                                                <h5 class="fw-bold mb-3">
                                                    <a href="<?= $base_url ?>fulltext.php?article_id=<?= $article['article_id'] ?>&title=<?= $title ?>"
                                                        class="text-decoration-none text-black">

                                                        <?= $article['title']; ?>

                                                    </a>
                                                </h5>

                                                <p class="text-secondary mb-1">
                                                    <strong>Author details:</strong>
                                                    <?= $article['authors']; ?>
                                                </p>

                                                <p class="text-muted fst-italic mb-1">
                                                    Pages <?= $article['pages']; ?>,
                                                    <?= date("Y", strtotime($article['publish_date'])); ?>
                                                </p>

                                                <hr>

                                                <div class="d-flex flex-wrap gap-4 small text-muted mb-3">

                                                    <?php if (!empty($article['doi'])): ?>
                                                        <span>
                                                            <i class="bi bi-link-45deg me-1"></i>
                                                            DOI:
                                                            <a href="<?= $article['doiurl']; ?>" target="_blank"
                                                                class="text-decoration-none text-green">

                                                                <?= $article['doi']; ?>

                                                            </a>
                                                        </span>
                                                    <?php endif; ?>

                                                    <span>
                                                        <i class="bi bi-eye"></i>
                                                        <?= (int) $article['view']; ?> Views
                                                    </span>

                                                    <span>
                                                        <i class="bi bi-download"></i>
                                                        <?= (int) $article['download']; ?> Downloads
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

                                    <?php } ?>

                                <?php } ?>

                            </div>
                        </div>

                        <div class="tab-pane fade" id="tab-comment" role="tabpanel" aria-labelledby="tab-comment-tab">
                            <div class="card-body p-3">

                                <?php if (!empty($mostDownloaded)) { ?>

                                    <?php foreach ($mostDownloaded as $article) { ?>
  <?php        $title = strip_tags(html_entity_decode($article['title'], ENT_QUOTES, 'UTF-8'));

$title = str_replace(
    ['%0D%0A', '%2C','%3A'],
    ['', ',',':'],
    urlencode($title)); ?>
                                        <div class="card border-0 shadow-sm mb-4">
                                            <div class="card-body p-3">

                                                <!-- <span class="badge article-badge mb-2">
                                                        <?= $article['article_type']; ?>
                                                    </span> -->

                                                <h5 class="fw-bold mb-3">
                                                    <a href="<?= $base_url ?>fulltext.php?article_id=<?= $article['article_id'] ?>&title=<?= $title ?>"
                                                        class="text-decoration-none text-black">

                                                        <?= $article['title']; ?>

                                                    </a>
                                                </h5>

                                                <p class="text-secondary mb-1">
                                                    <strong>Author details:</strong>
                                                    <?= $article['authors']; ?>
                                                </p>

                                                <p class="text-muted fst-italic mb-1">
                                                    Pages <?= $article['pages']; ?>,
                                                    <?= date("Y", strtotime($article['publish_date'])); ?>
                                                </p>

                                                <hr>

                                                <div class="d-flex flex-wrap gap-4 small text-muted mb-3">

                                                    <?php if (!empty($article['doi'])): ?>
                                                        <span>
                                                            <i class="bi bi-link-45deg me-1"></i>
                                                            DOI:
                                                            <a href="<?= $article['doiurl']; ?>" target="_blank"
                                                                class="text-decoration-none text-green">

                                                                <?= $article['doi']; ?>

                                                            </a>
                                                        </span>
                                                    <?php endif; ?>

                                                    <span>
                                                        <i class="bi bi-eye me-1"></i>
                                                        <?= (int) $article['view']; ?> Views
                                                    </span>

                                                    <span>
                                                        <i class="bi bi-download me-1"></i>
                                                        <?= (int) $article['download']; ?> Downloads
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

                                    <?php } ?>

                                <?php } ?>
                            </div>
                        </div>

                    </div>
