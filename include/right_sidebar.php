
<?php

    $news = $functions->getNews();
    $advertisements = $functions->getAdvertisementName();
    $conferences = $functions->getConferenceEvents();
    $index_in = $functions->getindex_Data();
    //  $curr_issue_img=  $functions->curr_issue_img();  

?>

<div class="card border-warning-subtle mt-2" style="min-height:200px;">
    <div class="card-header bg-warning-subtle text-dark fw-semibold p-1 text-center">
        News
    </div>

    <div class="card-body">
        <marquee height="136" onmouseover="this.stop()" onmouseout="this.start()" scrollamount="3" direction="up">

            <?php if (!empty($news)) { ?>
                <?php foreach ($news as $item) { ?>
                    <a href="#" class="text-decoration-none text-secondary">
                        <?= $item['news_desc'] ?>
                    </a>
                <?php } ?>
            <?php } else { ?>
                <p class="text-muted">coming soon</p>
            <?php } ?>
        </marquee>
    </div>
</div>


<div class="card border-warning-subtle mt-2" style="min-height:200px;">

    <div class="card-header bg-warning-subtle text-dark fw-semibold p-1 text-center">
        Most Viewed Articles
    </div>

    <div class="card-body">

        <marquee height="136" onmouseover="this.stop()" onmouseout="this.start()" scrollamount="3" direction="up">

            <?php if (!empty($mostViewed)) { ?>
                <?php foreach ($mostViewed as $article) { ?>
                  <?php        $title = strip_tags(html_entity_decode($article['title'], ENT_QUOTES, 'UTF-8'));

$title = str_replace(
    ['%0D%0A', '%2C','%3A'],
    ['', ',',':'],
    urlencode($title)); ?>

                    <a href="<?= $base_url ?>abstract.php?article_id=<?= $article['article_id'] ?>&title=<?= $title ?>"
                        class="text-decoration-none small mt-3 text-secondary d-block">
                        <?= $article['title']; ?>
                    </a>
                <?php } ?>
            <?php } else { ?>
                <p class="text-muted">coming soon</p>
            <?php } ?>

        </marquee>

    </div>

</div>


<div class="card border-warning-subtle mt-2" style="min-height:200px;">
    <div class="card-header bg-warning-subtle text-dark fw-semibold p-1 text-center">
        Advertisment
    </div>

    <div class="card-body">
        <marquee height="136" onmouseover="this.stop();" onmouseout="this.start();" scrollamount="3" direction="up">

            <?php if (!empty($advertisements)) { ?>
                <?php foreach ($advertisements as $ad) { ?>
                    <div class="text-decoration-none text-secondary small">
                        <?= $ad['name']; ?>
                    </div>

                <?php } ?>
            <?php } else { ?>
                <p class="text-muted ">coming soon</p>
            <?php } ?>

        </marquee>
    </div>
</div>



<div class="card border-warning-subtle mt-2" style="min-height:200px;">
    <div class="card-header bg-warning-subtle text-dark fw-semibold p-1 text-center">
        <a class="text-decoration-none text-dark" href="<?= $base_url ?>conference.php">
            Conference
        </a>
    </div>

    <div class="card-body">
        <marquee height="136"
                 direction="up"
                 scrollamount="3"
                 onmouseover="this.stop();"
                 onmouseout="this.start();">

            <?php if (!empty($conferences['all'])): ?>

                <?php foreach ($conferences['all'] as $conference): ?>
                    <div class="mb-2">
                        <div
                           class="text-decoration-none text-secondary small"
                           target="_blank">
                            <?= strip_tags($conference['title']) ?>
                        </div>
                    </div>
                <?php endforeach; ?>

            <?php else: ?>
                <p class="text-muted">Coming soon</p>
            <?php endif; ?>

        </marquee>
    </div>
</div>


<div class="card mb-3 border-warning-subtle mt-2">
    <div class="card-header bg-warning-subtle text-center text-dark fw-semibold p-1">
        Email alert
    </div>
    <div class="card-body">
        <form>
            <div class="mb-3">
                <input type="text" id="alertEmail" class="form-control form-control-sm" placeholder="Enter your email">
                <div id="alertEmailError" class="invalid-feedback"></div>
                <div id="alertSuccess" class="text-success small mt-1"></div>
            </div>
            <div class="text-center">
                <button type="button" class="btn btn-theme btn-sm px-4 text-white"
                    onclick="subscribe('alertEmail','alertEmailError','alertSuccess','Email alert subscribed successfully.')">
                    Subscribe
                </button>
            </div>
        </form>
    </div>
</div>

<div class="card border-warning-subtle mt-2" style="min-height:200px;">
    <div class="card-header bg-warning-subtle text-dark fw-semibold p-1 text-center">
        Indexed in
    </div>

    <div class="card-body">
        <marquee
            height="136"
            direction="up"
            scrollamount="3"
            onmouseover="this.stop();"
            onmouseout="this.start();">

            <?php if (!empty($index_in)) : ?>

                <?php foreach ($index_in as $item) : ?>
                    <?= html_entity_decode($item['index_name']); ?>
                <?php endforeach; ?>

            <?php else : ?>

                <p class="text-muted text-center">Coming Soon</p>

            <?php endif; ?>

        </marquee>
    </div>
</div>