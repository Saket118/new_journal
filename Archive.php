<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once "./include/link.php"; ?>
    <?php
    $page = $functions->getSinglePageData("Archives");
    echo $meta = $functions->meta_tag("Archives", "", "", $base_url . 'Archive.php');
    $data = $functions->Archives("Archive");
    // echo "<pre>";
    // print_r($data);
    // exit();
    ?>

</head>

<body>
    <?php include_once "./include/header.php"; ?>

    <div class="container-fluid mb-5">

        <div class="row justify-content-center">

            <div class="col-lg-2">
                <?php include_once "./include/left_sidebar.php"; ?>
            </div>



            <div class="col-lg-7 py-2 border my-2">
                <div class="container">

                    <h2 class="border-bottom">
                        <?= $page["meta_title"] ?? "Archive"; ?>
                    </h2>

                    <div class="mb-3">
                        <?= $page["page_content"] ?? ""; ?>
                    </div>

     <div class="container mt-4">

    <div class="row mb-4">
        <div class="col-md-4">
            <label class="fw-bold mb-2">Select Year</label>

            <select class="form-select" id="yearFilter">
                <option value="all">All Years</option>

                <?php foreach ($data as $year => $yearData) { ?>
                    <option value="<?= $year ?>">
                        <?= $year ?>
                    </option>
                <?php } ?>

            </select>
        </div>
    </div>

    <?php foreach ($data as $year => $yearData) { ?>

        <div class="year-card card shadow-sm mb-4" data-year="<?= $year ?>">

            <div class="card-header fw-bold fs-5">
                <?= $year ?>
            </div>

            <div class="card-body">

                <div class="row row-cols-1 row-cols-md-2 g-3">

                    <?php foreach ($yearData['issues'] as $issue) { ?>

                        <div class="col">

                            <a href="<?= $base_url ?>past_issues.php?issueid=<?= $issue['issue_id']; ?>"
                                class="text-decoration-none">

                                <div class="card h-100">

                                    <div class="card-body d-flex justify-content-between align-items-center">

                                        <div>

                                            <h6 class="mb-1 text-dark">
                                                <?= $issue['issue_no']; ?>
                                            </h6>

                                            <small class="text-muted">
                                                <?= date('F Y', strtotime($issue['date_publish'])); ?>
                                            </small>

                                        </div>

                                        <i class="bi bi-arrow-right-circle fs-4 text-secondary"></i>

                                    </div>

                                </div>

                            </a>

                        </div>

                    <?php } ?>

                </div>

            </div>

        </div>

    <?php } ?>

</div>


                </div>
            </div>
            <div class="col-lg-2">
                <?php include_once "./include/right_sidebar.php"; ?>
            </div>
        </div>
    </div>

    <?php include_once "./include/footer.php"; ?>
    <script>
document.getElementById("yearFilter").addEventListener("change", function () {

    let year = this.value;

    document.querySelectorAll(".year-card").forEach(function(card){

        if(year === "all"){
            card.style.display = "";
        }
        else if(card.dataset.year === year){
            card.style.display = "";
        }
        else{
            card.style.display = "none";
        }

    });

});
</script>

</body>

</html>