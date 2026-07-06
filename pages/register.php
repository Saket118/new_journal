
<?php include_once "../include/header.php"; ?>



<!-- Form Start -->
<div class="container-fluid " >
    <div class="row">


        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-9 px-5  ">
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
                        </div>
                        <div class="col-md-9">
                            <input type="text" id="fullName" class="form-control rounded-4 py-2"
                                placeholder="Full Name*">
                        </div>
                    </div>

                    <div class="mt-3">
                        <input type="email" id="email" class="form-control rounded-4 py-2" placeholder="Email Id*">
                    </div>

                    <div class="mt-3">
                        <input type="password" id="password" class="form-control rounded-4 py-2"
                            placeholder="Password*">
                    </div>

                    <div class="mt-3">
                        <select id="userType" class="form-select rounded-4 py-2">
                            <option value="">---Select User Type---</option>
                            <option>Author</option>
                            <option>Reviewer</option>
                        </select>
                    </div>

                    <h6 class="fw-bold pb-1 pt-4 ">Contact Details</h6>

                    <div class="mb-3">
                        <input type="text" class="form-control rounded-4 py-2" placeholder="Qualification">
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <select id="country" class="form-select rounded-4 py-2">
                                <option value="">--Select Country--</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <select id="state" class="form-select rounded-4 py-2">
                                <option value="">--State--</option>
                            </select>
                        </div>
                    </div>

                    <div class="row g-3 mt-1">
                        <div class="col-md-6">
                            <select id="city" class="form-select rounded-4 py-2">
                                <option value="">--City--</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <input type="text" id="contact" class="form-control rounded-4 py-2"
                                placeholder="Contact No.*">
                        </div>
                    </div>

                    <div class="mt-3">
                        <textarea id="address" class="form-control rounded-4 py-2" rows="3"
                            placeholder="Address"></textarea>
                    </div>

                    <div class="text-center mt-4">
                        <button type="button" onclick="return registrationForm()" class="btn btn-theme px-4">
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

<?php include_once "../include/footer.php"; ?>

<!-- ////////////// -->
<script>
    function registrationForm() {
        var title = document.getElementById('title');
        var fullName = document.getElementById('fullName');
        var email = document.getElementById('email');
        var password = document.getElementById('password');
        var userType = document.getElementById('userType');
        var country = document.getElementById('country');
        var state = document.getElementById('state');
        var city = document.getElementById('city');
        var contact = document.getElementById('contact');
        var address = document.getElementById('address');

        if (title.value === '') {
            alert("Please Select Title (Mr./Ms./Dr./etc.)");
            title.focus();
            return false;
        }
        
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

        if (password.value.trim() === '') {
            alert("Please Enter Password");
            password.focus();
            return false;
        }

        if (!/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{6,}$/.test(password.value.trim())) {
            alert("Password must be strong & Min 6 chars long");
            password.focus();
            return false;
        }

        if (userType.value === '') {
            alert("Please Select User Type");
            userType.focus();
            return false;
        }

        if (country.value === '') {
            alert("Please Select Country");
            country.focus();
            return false;
        }

        if (state.value === '') {
            alert("Please Select State");
            state.focus();
            return false;
        }

        if (city.value === '') {
            alert("Please Select City");
            city.focus();
            return false;
        }

        if (contact.value.trim() === '') {
            alert("Please Enter Contact Number");
            contact.focus();
            return false;
        }

        if (!/^[6-9]\d{9}$/.test(contact.value.trim())) {
            alert("Please Enter Valid Mobile Number");
            contact.focus();
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