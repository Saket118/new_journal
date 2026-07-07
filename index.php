<!DOCTYPE html>
<html lang="en">

<head>
   <?php include_once "./include/link.php"; ?>
   <?php
 $page = $functions->getSinglePageData("Home");
 ?>
 <title><?= $page["meta_title"] ?></title>
 <meta name="description" content=<?= $page["meta_desc"] ?>>
 <?php
$keywords = preg_split('/\r\n|\r|\n/', trim($page['meta_key']));
?>
<meta name="keywords" content="<?= implode(', ', $keywords) ?>">
 <meta name="robots" content="index, follow">
 <link rel="canonical" href="">
</head>
<body>
    <?php include_once "./include/header.php"; ?>


    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-2">
                <?php include_once "./include/left_sidebar.php"; ?>
            </div>
            <div class="col-lg-7 py-2 border my-2">
  
        <div class="container">
            <div class="row align-items-center g-4">


                <div class="col-lg-2 col-md-3 text-center d-none d-md-block">
                    <img src="https://spjmhs.com/images/cover-page/innovative-journal-of-medical-imaging-20260617181659.jpeg"
                        alt="Journal Cover" class="img-fluid rounded shadow-lg journal-cover">
                </div>


                <div class="col-lg-10 col-md-9 text-dark">
                    <h1>Anirudh</h1>

                    <p class="journal-desc mb-3">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut, quae accusantium! Esse corporis,
                        aut tempore earum repellat iure repudiandae voluptas debitis, dolorem nobis enim tempora
                        voluptatibus accusamus laboriosam pariatur ab!
                    </p>

                   

                </div>

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

   

