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


<!-- Form Start -->
<div class="container-fluid">
    <div class="row">

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9 px-5">
            <div class="m-lg-5 shadow">

                <form class="p-4">
                    <h4 class="text-center">Registration</h4>
                    <hr>
                    <h6 class="fw-bold pb-1 pt-3">Login Details</h6>

                    <div class="row g-3">
                        <div class="col-md-3">
                            <select id="title" class="form-select rounded-4 py-2">
                                <option value="">--Select Title--</option>
                                <option>Mr.</option>
                                <option>Ms.</option>
                                <option>Miss</option>
                                <option>Dr.</option>
                                <option>Prof.</option>
                            </select>
                            <small id="titleError" class="invalid-feedback"></small>
                        </div>
                        <div class="col-md-9">
                            <input type="text" id="fullName" class="form-control rounded-4 py-2"
                                placeholder="Full Name*">
                            <small id="fullNameError" class="invalid-feedback"></small>
                        </div>
                    </div>

                    <div class="mt-3">
                        <input type="email" id="email" class="form-control rounded-4 py-2" placeholder="Email">
                        <small id="emailError" class="invalid-feedback"></small>
                    </div>

                    <div class="mt-3">
                        <input type="password" id="password" class="form-control rounded-4 py-2"
                            placeholder="Password*">
                        <small id="passwordError" class="invalid-feedback"></small>
                    </div>

                    <div class="mt-3">
                        <select id="userType" class="form-select rounded-4 py-2">
                            <option value="">---Select User Type---</option>
                            <option>Author</option>
                            <option>Reviewer</option>
                        </select>
                        <small id="userTypeError" class="invalid-feedback"></small>
                    </div>

                    <h6 class="fw-bold pb-1 pt-4">Contact Details</h6>

                    <div class="mb-3">
                        <input type="text" class="form-control rounded-4 py-2" placeholder="Qualification">
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <select id="country" class="form-select rounded-4 py-2">
                                <option value="">--Select Country--</option>
                            </select>
                            <small id="countryError" class="invalid-feedback"></small>
                        </div>
                        <div class="col-md-6">
                            <select id="state" class="form-select rounded-4 py-2">
                                <option value="">--State--</option>
                            </select>
                            <small id="stateError" class="invalid-feedback"></small>
                        </div>
                    </div>

                    <div class="row g-3 mt-1">
                        <div class="col-md-6">
                            <select id="city" class="form-select rounded-4 py-2">
                                <option value="">--City--</option>
                            </select>
                            <small id="cityError" class="invalid-feedback"></small>
                        </div>
                        <div class="col-md-6">
                            <input type="text" id="contact" class="form-control rounded-4 py-2"
                                placeholder="Contact No.*">
                            <small id="contactError" class="invalid-feedback"></small>
                        </div>
                    </div>

                    <div class="mt-3">
                        <textarea id="address" class="form-control rounded-4 py-2" rows="3"
                            placeholder="Address"></textarea>
                        <small id="addressError" class="invalid-feedback"></small>
                    </div>

                    <div class="text-center mt-4">
                        <button type="button" onclick="validateForm()" class="btn btn-theme px-4">
                            Submit
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- <div class="col-lg-1"></div> -->

        <div class="col-lg-3 py-5 d-none d-lg-block side_border">
            <div class="overflow-hidden mb-4 text-center">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQE-foOGxTS37q7nRw-4-ya-ADt92BgnwX-z0iJA-vhpQ&s=10"
                    class="img-fluid" style="max-width:212px; height:300px;" alt="Banner 1">
            </div>
            <div class="overflow-hidden mb-4 text-center">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ5r15SMwMHoYBfKgMNL8rJukhdHDby4XOxfp_Opl6Jpw&s=10"
                    class="img-fluid" style="max-width:212px; height:300px;" alt="Banner 2">
            </div>
        </div>

    </div>
</div>
<!-- Form End -->

<?php include_once "./include/footer.php"; ?>

</body>
</html>