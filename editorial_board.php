<!DOCTYPE html>
<html>
    <head>
        <?php
        include_once './include/link.php';
       $page = $functions->getSinglePageData("Editorial Board");
    echo $meta = $functions->meta_tag($page["meta_title"], $page["meta_desc"], $page["meta_key"], $base_url . 'editorial_board.php');
    $ed_data = $functions->editorial_data();

        ?>
    </head>
    <body>
    <?php include_once './include/header.php'; ?>
<div class="container-fluid mt-4">
    <div class="row justify-content-center gap-4">
        <div class="col-sm-11 for-editorial">
            <h3 class="jhead pt-2"><?= $page['meta_title']; ?></h3>
            <hr>
                     <?= html_entity_decode($page['page_content']);?>

            <div class="col-sm-12">
                <div class="editorial-team-content">
                    <div class="editorial-team-content-header">
<?php foreach ($ed_data as $row) { ?>

    <?php if (!empty($row['members'])) { ?>

        <h4 class="mt-3"><?= $row['designation']; ?></h4>
        <hr>

        <div class="row p-3 d-flex">

            <?php foreach ($row['members'] as $rows) { ?>

                <div class="col-sm-3 border rounded m-lg-4 my-1 mx-auto shadow">

                    <img src="<?= $base_url ?>admin/editorial_img/<?= $org_id ?>/<?= $rows['Image'] ?>"
                        class="card-img-top rounded-circle w-25 mx-auto">

                    <div class="card-body">

                        <div class="fs-5">
                            <strong><?= $rows['Name'] ?></strong>
                        </div>

                        <div><b>Specialization: </b><span><?= $rows['Specialization'] ?></span></div>
                        <div><b>Department: </b><span><?= $rows['Department'] ?></span></div>
                        <div><b>Address: </b><span><?= $rows['Address'] ?></span></div>
                        <div><b>Email: </b><span><?= $rows['Email'] ?></span></div>
                        <div><b>Contact No: </b><span><?= $rows['Contact'] ?></span></div>

                        <?php if (!empty($rows['comment'])) { ?>
                            <div><?= $rows['comment'] ?></div>
                        <?php } ?>

                    </div>

                </div>

            <?php } ?>

        </div>

    <?php } ?>

<?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
    <?php include './include/footer.php'; ?>
    </body>
</html>