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


    <div class="card border-0 shadow-lg rounded-4 mx-auto my-5" style="max-width: 750px;">
        <div class="card-body p-4">

            <div class="text-center mb-4">
                <h3 class="fw-bold text-green mb-2">Contact Us</h3>
                <hr>
            </div>

            <form id="contactForm">

                <div class="row g-3">


                    <div class="col-md-6">
                        <label for="fullName" class="form-label fw-semibold">
                            Name <span class="text-danger">*</span>
                        </label>
                        <input type="text" id="fullName" class="form-control rounded-3 py-2"
                            placeholder="Enter your name">
                        <small id="fullNameError" class="invalid-feedback"></small>
                    </div>


                    <div class="col-md-6">
                        <label for="email" class="form-label fw-semibold">
                            Email <span class="text-danger">*</span>
                        </label>
                        <input type="email" id="email" class="form-control rounded-3 py-2"
                            placeholder="Enter your email">
                        <small id="emailError" class="invalid-feedback"></small>
                    </div>


                    <div class="col-12">
                        <label for="journal" class="form-label fw-semibold">
                            Subject
                        </label>
                        <input type="text" id="journal" class="form-control rounded-3 py-2" placeholder="Enter subject">
                        <small id="journalError" class="invalid-feedback"></small>
                    </div>


                    <div class="col-12">
                        <label for="message" class="form-label fw-semibold">
                            Message
                        </label>
                        <textarea id="message" class="form-control rounded-3" rows="6" style="resize:none;"
                            placeholder="Write your message here..."></textarea>
                        <small id="messageError" class="invalid-feedback"></small>
                    </div>

                </div>

                <div class="mt-4">
                    <button type="button" onclick="validateForm()"
                        class="btn btn-theme px-5 py-2 rounded-3 fw-semibold">
                        Submit
                    </button>
                </div>
            </form>

        </div>
    </div>

    <?php include_once "./include/footer.php"; ?>

</body>
</html>