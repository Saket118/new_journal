<!DOCTYPE html>
<html lang="en">

<head>
   <?php include_once "./include/link.php"; ?>
   <?php
 $page = $functions->getSinglePageData("Archives");
echo $meta= $functions->meta_tag($page["meta_title"],$page["meta_desc"],$page["meta_key"],$base_url.'Archive.php');
  $data = $functions->Archives("Archive");
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
         <h2 class="border-bottom"><?= $page["meta_title"] ?></h2>   
        
           <div>
            <?= $page["page_content"] ?>
           </div>
    <div class="list-group list-group-flush">
        <?php foreach ($data as $row) { ?>
            <div class="list-group-item d-flex justify-content-between align-items-center">
                <span class="fw-semibold">
                    <?= htmlspecialchars($row['issue_no']); ?>
                </span>

                <small class="text-muted">
                    <?= date('d M Y', strtotime($row['date_publish'])); ?>
                </small>
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

  

    <!-- ///////cards///// -->
   
    <!-- ///////// -->

    <?php include_once "./include/footer.php"; ?>


 </body>
</html>

   

