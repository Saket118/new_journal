
<style>
    /* Cards */
  .archive-card {
        border: 1px solid #dfdfe0;
        border-radius: 12px;
        transition: .25s;
    }
    .archive-card:hover {
        transform: translateX(4px);
        box-shadow: 0 .5rem 1.5rem rgba(0, 0, 0, .08) !important;
    }
</style>

<?php include_once "../include/header.php"; ?>



<div class="container py-5">
    <!-- Heading -->
    <div class="mb-5">
        <h2 class="fw-bold fw-bold text-dark mb-2">
         
        </h2>

        <div class="d-flex flex-wrap align-items-center gap-4">

            <div>
                <span class="fw-bold fs-6">12</span>
                <span class="text-muted">volumes</span>
            </div>

            <div class="vr"></div>

            <div>
                <span class="fw-bold fs-6">23</span>
                <span class="text-muted">issues</span>
            </div>

            <div class="vr"></div>

            <div>
                <span class="fw-bold fs-6">213</span>
                <span class="text-muted">articles</span>
            </div>

        </div>

    </div>

    <!-- Volume -->
    <div class="mb-5">

        <div class="d-flex justify-content-between align-items-center border-bottom pb-1 mb-3">

            <h5 class="fw-bold  mb-0">
                Volume 12
                <span class="fw-normal text-secondary">
                    · 2026
                </span>
            </h5>

            <small class="text-muted">
                1 Issue • 13 Articles
            </small>

        </div>



        <div class="row g-3">

            <div class="col-lg-4 col-md-6">

                <a href="#" class="card archive-card fs-6 text-decoration-none shadow-sm h-100">

                    <div class="card-body py-2">

                        <span class="badge article-badge text-uppercase  fw-semibold mb-2">
                            Issue 1
                        </span>

                        <h5 class="fw-bold text-dark mb-1">
                            January - March, 2026
                        </h5>

                        <div class="d-flex justify-content-between align-items-center text-muted small pt-2 border-top">

                            <span>
                                Jan 2026
                            </span>

                            <div class="d-flex align-items-center">
                                <span>13 Articles</span>
                                <i class="bi bi-arrow-right-short fs-5"></i>
                            </div>

                        </div>

                    </div>

                </a>

            </div>

        </div>

    </div>


</div>

<?php include_once "../include/footer.php"; ?>
