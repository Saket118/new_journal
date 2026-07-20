
<!DOCTYPE html>
<html lang="en">

<head>
<?php
include_once "./include/link.php";
echo $functions->meta_tag( 'Contact us', '', '', $base_url . "contact.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['contact'])) {

    $result = $functions->contactUs($_POST);

    if ($result['status']) {
        echo "<script>
                alert('".$result['message']."');
                window.location.href='contact.php';
              </script>";
    } else {
        echo "<script>
                alert('".$result['message']."');
              </script>";
    }

}

    ?>

</head>

<body>

<?php include_once "./include/header.php"; ?>

<div class="container my-5">

    <div class="card border-0 shadow-lg rounded-4 mx-auto" style="max-width:750px;">

        <div class="card-body p-4">

            <div class="text-center mb-4">
                <h3 class="fw-bold">Contact Us</h3>
                <hr>
            </div>

          <form method="post" id="contactForm" novalidate>

    <div class="row g-3">

        <!-- Name -->
        <div class="col-md-6">
            <label class="form-label fw-semibold">
                Name <span class="text-danger">*</span>
            </label>

            <input
                type="text"
                id="fullName"
                name="fullName"
                class="form-control rounded-3 py-2"
                placeholder="Enter your name"
                value="<?= isset($_POST['fullName']) ? htmlspecialchars($_POST['fullName']) : ''; ?>">

            <div class="invalid-feedback"></div>
        </div>

        <!-- Email -->
        <div class="col-md-6">
            <label class="form-label fw-semibold">
                Email <span class="text-danger">*</span>
            </label>

            <input
                type="email"
                id="email"
                name="email"
                class="form-control rounded-3 py-2"
                placeholder="Enter your email"
                value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">

            <div class="invalid-feedback"></div>
        </div>

        <!-- Subject -->
        <div class="col-12">
            <label class="form-label fw-semibold">
                Subject <span class="text-danger">*</span>
            </label>

            <input
                type="text"
                id="subject"
                name="subject"
                class="form-control rounded-3 py-2"
                placeholder="Enter subject"
                value="<?= isset($_POST['subject']) ? htmlspecialchars($_POST['subject']) : ''; ?>">

            <div class="invalid-feedback"></div>
        </div>

        <!-- Message -->
        <div class="col-12">
            <label class="form-label fw-semibold">
                Message <span class="text-danger">*</span>
            </label>

            <textarea
                id="message"
                name="message"
                rows="6"
                class="form-control rounded-3"
                style="resize:none;"
                placeholder="Write your message here..."><?= isset($_POST['message']) ? htmlspecialchars($_POST['message']) : ''; ?></textarea>

            <div class="invalid-feedback"></div>
        </div>

    </div>

    <div class="mt-4">
        <button
            type="submit"
            name="contact"
            class="btn btn-theme px-5 py-2 rounded-3 fw-semibold">
            Submit
        </button>
    </div>

</form>



        </div>

    </div>

</div>

<?php include_once "./include/footer.php"; ?>
<script>
document.getElementById("contactForm").addEventListener("submit", function(e) {

    let valid = true;

    function checkField(id, message, type = "") {

        const field = document.getElementById(id);
        const value = field.value.trim();
        const error = field.nextElementSibling;

        field.classList.remove("is-valid", "is-invalid");

        if (value === "") {
            field.classList.add("is-invalid");
            error.innerHTML = message;
            valid = false;
            return;
        }

        if (type === "email") {

            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!emailPattern.test(value)) {
                field.classList.add("is-invalid");
                error.innerHTML = "Please enter a valid email address.";
                valid = false;
                return;
            }
        }

        field.classList.add("is-valid");
    }

    checkField("fullName", "Please enter your name.");
    checkField("email", "Please enter your email.", "email");
    checkField("subject", "Please enter the subject.");
    checkField("message", "Please enter your message.");

    if (!valid) {
        e.preventDefault();
    }

});
</script>
</body>
</html>