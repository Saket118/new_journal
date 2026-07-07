<!-- Sign In / Sign Up -->
<div class="card mb-3 border-warning-subtle text-center mt-2">
    <div class="card-header bg-warning-subtle text-dark p-1 fw-semibold">
        Sign in / Sign up
    </div>
</div>
<!-- <div class="card border-warning-subtle mt-1"  >

        <div class="card-header bg-warning-subtle text-dark fw-semibold p-1">
            <a class="text-decoration-none text-dark" href="#">Sign in</a> / <a href="#" class="text-decoration-none text-dark">Sign up</a>
        </div>

        </div> -->



<!-- Search Articles -->
<div class="card mb-3 border-warning-subtle mt-2">

    <div class="card-header bg-warning-subtle text-dark fw-semibold p-1">
        Search Articles
    </div>

    <div class="card-body">

        <form>

            <div class="mb-3">
                <input type="text" class="form-control form-control-sm" placeholder="Enter search text">
            </div>

            <div class="mb-3">
                <select class="form-select form-select-sm">
                    <option>Title</option>
                    <option>Author</option>
                    <option>Keywords</option>
                </select>
            </div>

            <div class="text-center">
                <button class="btn btn-theme btn-sm px-4 text-white">
                    Search
                </button>
            </div>

        </form>

    </div>

</div>

<!-- Most Downloaded Articles -->
<div class="card border-warning-subtle" style="min-height:220px;">

    <div class="card-header bg-warning-subtle text-dark fw-semibold">
        Most downloaded articles
    </div>

    <div class="card-body">

        <a href="#" class="text-decoration-none text-secondary">
            test
        </a>
        <hr>

    </div>

</div>

<div class="card mb-3 border-warning-subtle mt-2">
    <div class="card-header bg-warning-subtle text-center text-dark fw-semibold p-1">
        TOC Alert </div>

    <div class="card-body">
        <form>
            <div class="mb-3">
                <input type="text" id="tocEmail" class="form-control form-control-sm" placeholder="Enter your email">

                <div id="tocEmailError" class="invalid-feedback"></div>
                <div id="tocSuccess" class="text-success small mt-1"></div>
            </div>

            <div class="text-center">
                <button type="button" class="btn btn-theme btn-sm px-4 text-white"
                    onclick="subscribe('tocEmail','tocEmailError','tocSuccess','TOC subscribed successfully.')">
                    Subscribe
                </button>
            </div>
        </form>
    </div>
</div>