
    <?php
    $chartData = $functions->getManuscriptChartData();
    $ArticleStatistics = $functions->Article_Statistics();

    ?>

<!-- Sign In / Sign Up -->
<div class="card mb-3 border-warning-subtle text-center mt-2">
    <div class="card-header bg-warning-subtle text-dark p-1 fw-semibold">
        Sign in / Sign up
    </div>
</div>
<!-- <div class="card border-warning-subtle mt-1"  >

        <div class="card-header bg-warning-subtle text-dark fw-semibold p-1">
            <a class="text-decoration-none text-dark" href="#">Sign in</a> / <a href="#" class="text-decoration-none text-dark">Sign up</a>
        </div>

        </div> -->



<!-- Search Articles -->
 <div class="card mb-3 border-warning-subtle mt-2">

    <div class="card-header bg-warning-subtle text-dark fw-semibold p-1">
        Search Articles
    </div>

    <div class="card-body">

        <form action="<?= $base_url ?>search.php" method="post">

            <div class="mb-3">

                <input
                    type="text"
                    name="q"
                    class="form-control form-control-sm"
                    placeholder="Enter search text"
                    required>

            </div>

            <div class="mb-3">

                <select
                    name="type"
                    class="form-select form-select-sm">

                    <option value="all">All</option>
                    <option value="title">Title</option>
                    <option value="author">Author</option>
                    <option value="keywords">Keywords</option>

                </select>

            </div>

            <div class="text-center">

                <button
                    type="submit"
                    class="btn btn-theme btn-sm px-4 text-white">

                    Search

                </button>

            </div>

        </form>

    </div>

</div>
<!-- <div class="card mb-3 border-warning-subtle mt-2">

    <div class="card-header bg-warning-subtle text-dark fw-semibold p-1">
        Search Articles
    </div>

    <div class="card-body">

        <form>

            <div class="mb-3">
                <input type="text" class="form-control form-control-sm" placeholder="Enter search text">
            </div>

            <div class="mb-3">
                <select class="form-select form-select-sm">
                    <option>Title</option>
                    <option>Author</option>
                    <option>Keywords</option>
                </select>
            </div>

            <div class="text-center">
                <button class="btn btn-theme btn-sm px-4 text-white">
                    Search
                </button>
            </div>

        </form>

    </div>

</div> -->

<!-- Most Downloaded Articles -->
<div class="card border-warning-subtle" style="min-height:220px;">

    <div class="card-header bg-warning-subtle text-dark fw-semibold">
        Most Downloaded Articles
    </div>

    <div class="card-body">
        <marquee height="136" onmouseover="this.stop()" onmouseout="this.start()" scrollamount="3" direction="up">
            <?php if (!empty($mostDownloaded)) { ?>
                <?php foreach ($mostDownloaded as $article) { ?>
                  <?php        $title = strip_tags(html_entity_decode($article['title'], ENT_QUOTES, 'UTF-8'));

$title = str_replace(
    ['%0D%0A', '%2C','%3A'],
    ['', ',',':'],
    urlencode($title)); ?>
                    <a href="<?= $base_url ?>fulltext.php?article_id=<?= $article['article_id'] ?>&title=<?= $title ?>"
                        class="text-decoration-none small mt-3 text-secondary d-block">
                        <?= $article['title']; ?>
                </a>
            <?php } ?>
        <?php } else { ?>
            <p class="text-muted mb-0">coming soon</p>
        <?php } ?>

        </marquee>

    </div>

</div>

<div class="card mb-3 border-warning-subtle mt-2">
    <div class="card-header bg-warning-subtle text-center text-dark fw-semibold p-1">
        TOC Alert </div>

    <div class="card-body">
        <form>
            <div class="mb-3">
                <input type="text" id="tocEmail" class="form-control form-control-sm" placeholder="Enter your email">

                <div id="tocEmailError" class="invalid-feedback"></div>
                <div id="tocSuccess" class="text-success small mt-1"></div>
            </div>

            <div class="text-center">
                <button type="button" class="btn btn-theme btn-sm px-4 text-white"
                    onclick="subscribe('tocEmail','tocEmailError','tocSuccess','TOC subscribed successfully.')">
                    Subscribe
                </button>
            </div>
        </form>
    </div>
</div>



<!-- manuscript -->
<div class="card mb-3 border-warning-subtle mt-2">
    <div class="card-header bg-warning-subtle text-center text-dark fw-semibold p-1">
        Manuscript Submission
    </div>

    <div class="card-body">
        <canvas id="manuscriptChart" height="250"></canvas>
    </div>
</div>


<div class="card mb-3 border-warning-subtle mt-2">
    <div class="card-header bg-warning-subtle text-center text-dark fw-semibold p-1">
        Article Statistics
    </div>

    <div class="card-body">
        <canvas id="articleChart" height="250"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const manuscriptLabels = <?= json_encode(array_column($chartData, 'phase_name')); ?>;
const manuscriptData = <?= json_encode(array_column($chartData, 'total')); ?>;

const manuscriptColors = manuscriptLabels.map(() =>
    '#' + Math.floor(Math.random() * 16777215).toString(16).padStart(6, '0')
);

new Chart(document.getElementById('manuscriptChart'), {
    type: 'pie',
    data: {
        labels: manuscriptLabels, 
        datasets: [{
            data: manuscriptData,
            backgroundColor: manuscriptColors,
            borderWidth: 0
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom'
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                         return context.label + ': ' + context.raw;
                       }
                }
            }
        }
    }
});

const articleLabels = <?= json_encode(array_column($ArticleStatistics, 'article_name')); ?>;
const articleData = <?= json_encode(array_column($ArticleStatistics, 'total')); ?>;

const articleColors = articleLabels.map(() =>
    '#' + Math.floor(Math.random() * 16777215).toString(16).padStart(6, '0')
);

new Chart(document.getElementById('articleChart'), {
    type: 'bar',
    data: {
        labels: articleLabels,
        datasets: [{
            label: 'Articles',
            data: articleData,
            backgroundColor: articleColors,
            borderRadius: 8
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                display: false
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return context.raw + " Articles";
                    }
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    precision: 0
                }
            }
        }
    }
});
</script>