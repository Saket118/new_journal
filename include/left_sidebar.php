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

</div>

<!-- Most Downloaded Articles -->
<div class="card border-warning-subtle" style="min-height:220px;">

    <div class="card-header bg-warning-subtle text-dark fw-semibold">
        Most Downloaded Articles
    </div>

    <div class="card-body">
        <marquee height="136" onmouseover="this.stop()" onmouseout="this.start()" scrollamount="3" direction="up">
            <?php if (!empty($mostDownloaded)) { ?>
                <?php foreach ($mostDownloaded as $article) { ?>
                    <a href="<?= $base_url ?>abstract.php?article_id=<?= $article['article_id']; ?>"
                        class="text-decoration-none small mt-3 text-secondary d-block">
                        <?= $article['title']; ?>
                </a>
            <?php } ?>
        <?php } else { ?>
            <p class="text-muted mb-0">No articles found.</p>
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
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const data = <?= json_encode(array_column($chartData, 'total')); ?>;
const colors = [
    '#0d6efd','#ffc107','#20c997','#198754','#dc3545',
    '#6f42c1','#fd7e14','#0dcaf0','#6610f2','#6c757d',
    '#542c43','#3b4006'
];

new Chart(document.getElementById('manuscriptChart'), {
    type: 'pie',
    data: {
        datasets: [{
            data: data,
            backgroundColor: colors,  
             borderWidth: 0,          
        }]
    },
    options: {
        plugins: {
            legend: { display: false },
            tooltip: {
                callbacks: {
                    label: ({raw, dataset}) =>
                        ((raw / dataset.data.reduce((a,b) => a + Number(b), 0)) * 100).toFixed(1) + '%'
                }
            }
        }
    }
});
</script>