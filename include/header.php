
<header>
    <!-- Top Bar -->
    <div class="top-bar-premium text-light py-1 d-none d-md-block">
        <div class="container-fluid d-flex justify-content-between align-items-center">

            <div class="d-flex align-items-center gap-4">
                <span class="text-nowrap">
                    <i class="bi bi-patch-check  me-1"></i>
                    <strong>ISSN (Online):</strong>
               coming soon
                </span>
                <span class="opacity-35">|</span>

                <span>
                    <i class="bi bi-envelope-open me-1"></i>
                    testing@gmail.com
                </span>
            </div>

            <div class="d-flex align-items-center gap-3">

                <a href="<?= $base_url ?>admin" class="top-bar-link">
                    <i class="bi bi-box-arrow-in-right"></i> Login
                </a>
                <a href="<?= $base_url ?>/register.php" class="top-bar-link">
                    <i class="bi bi-person-plus"></i> Register
                </a>
            </div>

        </div>
    </div>

    <!--  Search -->
    <div class="green">
        <div class="container">
            <div class="row align-items-center py-4">

                <div class="col-md-8 col-lg-7 d-flex align-items-center flex-nowrap text-decoration-none">
                    <a href="#" class="">

                        <div class="journal-logo me-3">
                            <img src="<?= $base_url ?>assets/images/clogo.jpg" alt="Logo" class="img-fluid">
                        </div>
                    </a>
                    <div>
                        <h2 class="journal-title mb-1">
                     African Journal of Health Economics
                        </h2>


                        <!-- <div class="journal-subtitle text-black">
                                Official Journal of AARAIS

                            </div> -->

                    </div>

                </div>

                <!-- <div class="col-md-4 col-lg-5 d-none d-md-block">
                    <div class="d-flex justify-content-end">
                        <div class="header-search">
                            <input type="text" class="form-control" placeholder="Search articles...">
                            <button type="button">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                </div> -->
                <div class="col-md-4 col-lg-5 d-none d-md-block">
                    <div class="d-flex justify-content-end">
<form action="<?= $base_url ?>search.php" method="post">
    <div class="header-search">
        <input
            type="text"
            name="q"
            class="form-control"
            placeholder="Search articles..."
            required>
        <button type="submit">
            <i class="bi bi-search"></i>
        </button>
    </div>
</form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</header>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg sticky-top navbar-sticky-container  shadow-sm">
    <div class="container">

        <div class="p-2 d-flex align-items-center justify-content-between w-100 d-lg-none">
            <span class="fw-semibold">Menu</span>
            <button class="navbar-toggler border-0 p-0" type="button" data-bs-toggle="collapse"
                data-bs-target="#premiumNavbar">
                <i class="bi bi-grid-fill fs-3"></i>
            </button>
        </div>

        <div class="collapse navbar-collapse justify-content-center" id="premiumNavbar">
            <ul class="navbar-nav align-items-lg-center gap-1 py-2 py-lg-0">

                <li class="nav-item">
                    <a class="nav-link nav-link-premium" href="<?= $base_url ?>">Home</a>
                </li>

                <!-- <li class="nav-item dropdown">
                    <a class="nav-link nav-link-premium dropdown-toggle d-flex align-items-center gap-1" href="#"
                        data-bs-toggle="dropdown">
                        Journal Hub
                    </a>
                    <ul class="dropdown-menu border-0 shadow py-2">
                        <li><a class="dropdown-item dropdown-item-premium" href="#">About Journal</a></li>
                        <li><a class="dropdown-item dropdown-item-premium" href="#">Aims & Scope</a></li>
                    </ul>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link nav-link-premium" href="<?= $base_url ?>editorial_board.php">Editorial Board</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link nav-link-premium" href="<?= $base_url ?>current_issue.php">Current Issue</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link nav-link-premium" href="<?= $base_url ?>Archive.php">Archives</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link nav-link-premium" href="<?= $base_url ?>news.php">News</a>
                </li>


                <!-- <li class="nav-item">
                    <a class="nav-link nav-link-premium" href="#">Online Submission</a>
                </li> -->

                <li class="nav-item">
                    <a class="nav-link nav-link-premium" href="<?= $base_url ?>author_guidelines.php">Author Guidelines</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link nav-link-premium" href="<?= $base_url ?>contact.php">Contact us</a>
                </li>

                <li class="nav-item ms-lg-3 mt-2 mt-lg-0">
                    <a class="btn btn-cta-premium" href="<?= $base_url ?>submit_manuscript.php">
                        Submit Manuscript
                    </a>
                </li>

            </ul>
        </div>

    </div>
</nav>