<!DOCTYPE html>
<html lang="en">

<head>
    <?php include_once "./include/link.php"; ?>
    <?php
    if (isset($_POST['register'])) {
        if ($functions->registerUser($_POST)) {
            echo "<script>alert('Registration Successful');</script>";
        } else {
            echo "<script>alert('Registration Failed');</script>";
        }
    }
    $countries = $functions->getCountries();
    echo $meta = $functions->meta_tag("Register", "", "", $base_url . "register.php");
    ?>

</head>
<body>
    <?php include_once "./include/header.php"; ?>


    <!-- Form Start -->
    <div class="container-fluid">
        <div class="row">

            <div class="container">
                <!-- <h2 class=""><?= !empty($page['meta_title']) ? $page['meta_title'] : "Register" ?></h2>    -->

                <div>

                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9 px-5">
                <div class="m-lg-5 shadow">

                    <form method="POST" class="p-4" onsubmit="return validateForm();">
                        <h3 class="text-center">Registration</h3>
                        <hr>

                        <h4 class="fw-bold pb-3 pt-1">Login Details</h4>

                        <div class="row g-3">
                            <div class="col-md-3">
                                <label for="title">
                                    Salutation <span class="text-danger">*</span>
                                </label>
                                <select id="title" name="title" class="form-select rounded-4 py-2">
                                    <option value="">Select Salutation</option>
                                    <option>Mr.</option>
                                    <option>Ms.</option>
                                    <option>Miss</option>
                                    <option>Dr.</option>
                                    <option>Prof.</option>
                                </select>
                                <small id="titleError" class="invalid-feedback"></small>
                            </div>

                            <div class="col-md-9">
                                <label for="fullName">
                                    Full Name <span class="text-danger">*</span>
                                </label>
                                <input type="text" id="fullName" name="fullName" class="form-control rounded-4 py-2"
                                    placeholder="Enter Full Name">
                                <small id="fullNameError" class="invalid-feedback"></small>
                            </div>
                        </div>

                        <div class="mt-3">
                            <label for="email">
                                Email <span class="text-danger">*</span>
                            </label>
                            <input type="email" id="email" name="email" class="form-control rounded-4 py-2"
                                placeholder="Enter Email Address">
                            <small id="emailError" class="invalid-feedback"></small>
                        </div>

                        <div class="mt-3">
                            <label for="password">
                                Password <span class="text-danger">*</span>
                            </label>
                            <input type="password" id="password" name="password" class="form-control rounded-4 py-2"
                                placeholder="Enter Password">
                            <small id="passwordError" class="invalid-feedback"></small>
                        </div>

                        <div class="mt-3">
                            <label for="userType">
                                User Type <span class="text-danger">*</span>
                            </label>
                            <select id="userType" name="userType" class="form-select rounded-4 py-2">
                                <option value="">Select User Type</option>
                                <option>Author</option>
                                <option>Reviewer</option>
                            </select>
                            <small id="userTypeError" class="invalid-feedback"></small>
                        </div>

                        <h4 class="fw-bold pb-2 pt-4">Contact Details</h4>

                        <div class="mb-3">
                            <label for="qualification">
                                Qualification
                            </label>
                            <input type="text" id="qualification" name="qualification"
                                class="form-control rounded-4 py-2" placeholder="Enter Qualification">
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="country">
                                    Country <span class="text-danger">*</span>
                                </label>
                                <select id="country" name="country" class="form-select rounded-4 py-2">
                                    <option value="">Select Country</option>
                                    <?php foreach ($countries as $country) { ?>
                                        <option value="<?= $country['id']; ?>">
                                            <?= $country['country_name']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                                <small id="countryError" class="invalid-feedback"></small>
                            </div>

                            <div class="col-md-6">
                                <label for="state">
                                    State
                                </label>
                                <select id="state" name="state" class="form-select rounded-4 py-2">
                                    <option value="">Select State</option>
                                </select>
                            </div>
                        </div>

                        <div class="row g-3 mt-1">
                            <div class="col-md-6">
                                <label for="city">
                                    City
                                </label>
                                <select id="city" name="city" class="form-select rounded-4 py-2">
                                    <option value="">Select City</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label for="contact">
                                    Contact No. <span class="text-danger">*</span>
                                </label>
                                <input type="text" id="contact" name="contact" class="form-control rounded-4 py-2"
                                    placeholder="Enter Contact Number">
                                <small id="contactError" class="invalid-feedback"></small>
                            </div>
                        </div>

                        <div class="mt-3">
                            <label for="address">
                                Address <span class="text-danger">*</span>
                            </label>
                            <textarea id="address" name="address" class="form-control rounded-4 py-2" rows="3"
                                placeholder="Enter Address"></textarea>
                            <small id="addressError" class="invalid-feedback"></small>
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" name="register" class="btn btn-theme px-4">
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
    <script>
        const country = document.getElementById("country");
        const state = document.getElementById("state");
        const city = document.getElementById("city");

        function post(data) {
            return fetch("ajax.php", {
                method: "POST",
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: new URLSearchParams(data)
            }).then(res => res.text());
        }

        country.addEventListener("change", () => {

            if (!country.value) {
                state.innerHTML = '<option value="">--Select State--</option>';
                city.innerHTML = '<option value="">--Select City--</option>';
                return;
            }
            post({ country_id: country.value }).then(data => {
                const [states, cities] = data.split("|||");
                state.innerHTML = states;
                city.innerHTML = cities;
            });
        });

        state.addEventListener("change", () => {

            if (!state.value) {
                city.innerHTML = '<option value="">--Select City--</option>';
                return;
            }
            post({
                country_id: country.value,
                state_id: state.value
            }).then(data => city.innerHTML = data);
        });
    </script>

</body>

</html>