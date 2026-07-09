<div class="card border-warning-subtle mt-2" style="min-height:200px;">
    <div class="card-header bg-warning-subtle text-dark fw-semibold p-1 text-center">
        News
    </div>

    <div class="card-body">
        <marquee height="136" onmouseover="this.stop()" onmouseout="this.start()" scrollamount="3" direction="up">

            <?php if (!empty($news)) { ?>
                <?php foreach ($news as $item) { ?>
                    <a href="#" class="text-decoration-none text-secondary">
                        <?=$item['news_desc'] ?>
                    </a>
                <?php } ?>
            <?php } else { ?>
                <p class="text-muted">No News Found.</p>
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
                    <a href="<?= $base_url ?>abstract.php?article_id=<?= $article['article_id']; ?>"
                        class="text-decoration-none small mt-3 text-secondary d-block">
                        <?= $article['title']; ?>
                    </a>
                <?php } ?>
            <?php } else { ?>
                <p class="text-muted">No articles found.</p>
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
                    <a href="#" class="text-decoration-none text-secondary small">
                        <?= $ad['name']; ?>
                    </a>

                <?php } ?>
            <?php } else { ?>
                <p class="text-muted ">No Advertisement Found.</p>
            <?php } ?>

        </marquee>
    </div>
</div>


<div class="card border-warning-subtle mt-2" style="min-height:200px;">
    <div class="card-header bg-warning-subtle text-dark fw-semibold p-1 text-center">
        Conference
    </div>

    <div class="card-body">
        <marquee height="136" onmouseover="this.stop();" onmouseout="this.start();" scrollamount="3" direction="up">

            <?php if (!empty($conferences)) { ?>
                <?php foreach ($conferences as $conference) { ?>
                    <a href="#" class="text-decoration-none text-secondary small">
                        <?= $conference['title'] ?>
                    </a>
                <?php } ?>
            <?php } else { ?>
                <p class="text-muted">No Conference Found.</p>
            <?php } ?>

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