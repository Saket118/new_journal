<!DOCTYPE html>
<html lang="en">
<head>
   <?php include_once "./include/link.php"; ?>
   <?php
 $page = $functions->getSinglePageData("Contact Us");
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


<!-- Contact Form -->
<div class="border-0 shadow-lg mx-auto my-4 bg-white rounded-4" style="max-width: 750px;">
    <div class="p-4 p-md-5">

        <div class="text-center mb-4">
            <h4 class="fw-bold mb-2 text-green">Contact Us</h4>
            <p class="text-muted mb-0 small">
                Have questions? Drop us a message below.
            </p>
        </div>

        <form onsubmit="return registrationForm()">
            <div class="row g-3">
                <div class="col-md-6 d-flex flex-column justify-content-between">
                    <div class="mb-3">
                        <input type="text" id="fullName" class="form-control rounded-4 py-2" placeholder="Enter Name*">
                    </div>

                    <div class="mb-3">
                        <input type="text" id="journal" class="form-control rounded-4 py-2" placeholder="Subscription of a Journal">
                    </div>

                    <div class="mb-3 mb-md-0">
                        <input type="text" id="qualification" class="form-control rounded-4 py-2" placeholder="Qualification">
                    </div>
                </div>

                <div class="col-md-6 d-flex flex-column justify-content-between">
                    <div class="mb-3">
                        <input type="email" id="email" class="form-control rounded-4 py-2" placeholder="Enter Email*">
                    </div>

                    <div class="mb-0 flex-grow-1 d-flex">
                        <textarea id="message" class="form-control rounded-4 py-2 flex-grow-1" style="min-height: 110px; resize: none;" placeholder="Message"></textarea>
                    </div>
                </div>
            </div>

            <div class="row g-3 mt-1">
                <div class="col-12 mb-3">
                    <input type="text" id="address" class="form-control rounded-4 py-2" placeholder="Address">
                </div>
            </div>

            <div class="text-start">
                <button type="submit" class="btn btn-theme px-4 py-2 rounded-3 fw-semibold">
                    Submit
                </button>
            </div>
        </form>

    </div>
</div>

<?php include_once "./include/footer.php"; ?>

<!-- ////////////// -->
<script>
    function registrationForm() {

        var fullName = document.getElementById('fullName');
        var email = document.getElementById('email');
        var address = document.getElementById('address');

        if (fullName.value.trim() === '') {
            alert("Please Enter Full Name");
            fullName.focus(); 
            return false;
        }

        if (email.value.trim() === '') {
            alert("Please Enter Email");
            email.focus();
            return false;
        }

        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value.trim())) {
            alert("Please Enter Valid Email");
            email.focus();
            return false;
        }

        if (address.value.trim() === '') {
            alert("Please Enter Address");
            address.focus();
            return false;
        }

        alert("Form Submitted Successfully!");
        return true;
    }
</script>

</body>
</html>