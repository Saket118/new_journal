<!DOCTYPE html>
<html lang="en">

<head>
   <?php include_once "./include/link.php"; ?>
   <?php
 $page = $functions->getSinglePageData("Editorial Board");
 ?>
 <title><?= $page["meta_title"] ?></title>
 <meta name="description" content=<?= $page["meta_desc"] ?>>
 <?php
$keywords = preg_split('/\r\n|\r|\n/', trim($page['meta_key']));
?>
<meta name="keywords" content="<?= implode(', ', $keywords) ?>">
 <meta name="robots" content="index, follow">
 <link rel="canonical" href="">


<style>
    /* editorial Sidebar */
.editorial-sidebar{
    position:sticky;
    top:50px;
}
.sidebar-link{
    display:block;
    padding:7px 10px;
    text-decoration:none;
    color:#334155;
    font-weight:600;
    border-left:3px solid transparent;
    transition:.3s;
}
.sidebar-link:hover{
    background:#eef8f7;
    color:#0d9488;
    border-left-color:#0d9488;
}
.sidebar-link.active{
    background:#eef8f7;
    color:#0d9488;
    border-left:3px solid #0d9488;
}

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
</head>

<body>


<?php include_once "./include/header.php"; ?>

<div class="py-5">
    <div class="container">

        <!-- Heading -->
        <div class="mb-5">
            <span class="text-uppercase text-success fw-semibold small">
                Editorial Board
            </span>

            <h2 class="fw-bold mt-2 mb-0">
           
            </h2>
        </div>

        <div class="row g-5 ">

            <!-- Sidebar -->
            <div class="col-lg-3 float-start">

                <div class="editorial-sidebar ">

                    <h6 class="fw-bold mb-3 border-bottom pb-3 bm-4 ">
                        On this page
                    </h6>

                    <div class="d-flex flex-column">

                        <a href="#chief" class="sidebar-link active">
                            Chief Editor
                        </a>

                        <a href="#executive" class="sidebar-link">
                            Executive Editor
                        </a>

                        <a href="#board" class="sidebar-link">
                            Board Members
                        </a>

                        <a href="#associate" class="sidebar-link">
                            Associate Editors
                        </a>

                    </div>

                </div>

            </div>
            <!-- Right Content -->
            <div class="col-lg-9">

                    <div class="d-flex justify-content-between align-items-center border-bottom border-2 pb-1">
                        <h4 class="fw-bold mb-0">
                            Chief Editor
                        </h4>
                        <span class="text-muted">
                            1 Member
                        </span>
                    </div>
                    <!-- //////1/////// -->
                    <div class="archive-card border shadow-sm mt-3">
                        <div class="card-body p-2">
                            <div class="row align-items-center">
                                <!-- Left -->
                                <div class="col-md-2 text-center">
                                    <img src="https://spjmhs.com/images/editors/prof-dr-monu-sarin-20260513191625.webp"
                                        class="rounded-circle img-fluid border mb-2"
                                        style="width:75px;height:75px;object-fit:cover;">

                                    <a href="https://sgtuniversity.ac.in/medical/professors/dr-monu-sarin"
                                        target="_blank" class="btn btn-cta-premium btn-sm mt-1 px-2 py-1">

                                        <i class="fas fa-link me-1"></i>
                                        View Profile
                                    </a>
                                </div>

                                <!-- Right -->
                                <div class="col-md-10">
                                    <h5 class="fw-bold mb-1 fs-6">
                                        Prof. (Dr.) Monu Sarin
                                    </h5>

                                    <p class="text-black small fw-semibold mb-1">
                                        Professor, Faculty of Medicine and Health Sciences
                                    </p>

                                    <p class="text-muted small mb-2">
                                        SGT University, Gurgaon, India
                                        <span class="fw-semibold">• INDIA</span>
                                    </p>

                                    <a href="" class="text-decoration-none text-green me-2">
                                        monu_fmhs@sgtuniversity.org
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- //////2/////// -->
                    <div class="archive-card border shadow-sm mt-3">
                        <div class="card-body p-2">
                            <div class="row align-items-center">
                                <!-- Left -->
                                <div class="col-md-2 text-center">
                                    <img src="https://spjmhs.com/images/editors/prof-dr-monu-sarin-20260513191625.webp"
                                        class="rounded-circle img-fluid border mb-2"
                                        style="width:75px;height:75px;object-fit:cover;">

                                    <a href="https://sgtuniversity.ac.in/medical/professors/dr-monu-sarin"
                                        target="_blank" class="btn btn-cta-premium btn-sm mt-1 px-2 py-1">

                                        <i class="fas fa-link me-1"></i>
                                        View Profile
                                    </a>
                                </div>

                                <!-- Right -->
                                <div class="col-md-10">
                                    <h5 class="fw-bold mb-1 fs-6">
                                        Prof. (Dr.) Monu Sarin
                                    </h5>

                                    <p class="text-black small fw-semibold mb-1">
                                        Professor, Faculty of Medicine and Health Sciences
                                    </p>

                                    <p class="text-muted small mb-2">
                                        SGT University, Gurgaon, India
                                        <span class="fw-semibold">• INDIA</span>
                                    </p>

                                    <a href="" class="text-decoration-none text-green me-2">
                                        monu_fmhs@sgtuniversity.org
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- //////3/////// -->
                    <div class="archive-card border shadow-sm mt-3">
                        <div class="card-body p-2">
                            <div class="row align-items-center">
                                <!-- Left -->
                                <div class="col-md-2 text-center">
                                    <img src="https://spjmhs.com/images/editors/prof-dr-monu-sarin-20260513191625.webp"
                                        class="rounded-circle img-fluid border mb-2"
                                        style="width:75px;height:75px;object-fit:cover;">

                                    <a href="https://sgtuniversity.ac.in/medical/professors/dr-monu-sarin"
                                        target="_blank" class="btn btn-cta-premium btn-sm mt-1 px-2 py-1">

                                        <i class="fas fa-link me-1"></i>
                                        View Profile
                                    </a>
                                </div>

                                <!-- Right -->
                                <div class="col-md-10">
                                    <h5 class="fw-bold mb-1 fs-6">
                                        Prof. (Dr.) Monu Sarin
                                    </h5>

                                    <p class="text-black small fw-semibold mb-1">
                                        Professor, Faculty of Medicine and Health Sciences
                                    </p>

                                    <p class="text-muted small mb-2">
                                        SGT University, Gurgaon, India
                                        <span class="fw-semibold">• INDIA</span>
                                    </p>

                                    <a href="" class="text-decoration-none text-green me-2">
                                        monu_fmhs@sgtuniversity.org
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- //////4/////// -->
                    <div class="archive-card border shadow-sm mt-3">
                        <div class="card-body p-2">
                            <div class="row align-items-center">
                                <!-- Left -->
                                <div class="col-md-2 text-center">
                                    <img src="https://spjmhs.com/images/editors/prof-dr-monu-sarin-20260513191625.webp"
                                        class="rounded-circle img-fluid border mb-2"
                                        style="width:75px;height:75px;object-fit:cover;">

                                    <a href="https://sgtuniversity.ac.in/medical/professors/dr-monu-sarin"
                                        target="_blank" class="btn btn-cta-premium btn-sm mt-1 px-2 py-1">

                                        <i class="fas fa-link me-1"></i>
                                        View Profile
                                    </a>
                                </div>

                                <!-- Right -->
                                <div class="col-md-10">
                                    <h5 class="fw-bold mb-1 fs-6">
                                        Prof. (Dr.) Monu Sarin
                                    </h5>

                                    <p class="text-black small fw-semibold mb-1">
                                        Professor, Faculty of Medicine and Health Sciences
                                    </p>

                                    <p class="text-muted small mb-2">
                                        SGT University, Gurgaon, India
                                        <span class="fw-semibold">• INDIA</span>
                                    </p>

                                    <a href="" class="text-decoration-none text-green me-2">
                                        monu_fmhs@sgtuniversity.org
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

        </div>

    </div>
</div>

<?php include_once "./include/footer.php"; ?>
</body>
</html>