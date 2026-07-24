<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once "./include/link.php"; ?>
    <?php
    $page = $functions->getSinglePageData("News");
    echo $meta = $functions->meta_tag($page["meta_title"], $page["meta_desc"], $page["meta_key"], $base_url);

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
                        <?= $page["meta_title"] ?? "News"; ?>
                    </h2>

                    <div>
                        <?= html_entity_decode($page["page_content"]) ?>
                    </div>

                </div>
            </div>
            <div class="col-lg-2">
                <?php include_once "./include/right_sidebar.php"; ?>
            </div>
        </div>
    </div>

    <?php include_once "./include/footer.php"; ?>


</body>

</html>