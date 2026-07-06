
<?php include_once "../include/header.php"; ?>



<style>
 /* --- current issue  Tabs --- */
#article-tabs .nav-link {
    color: #334155 !important; 
    background-color: transparent;
    border: 1px solid transparent;
    transition: all 0.3s ease;
}

#article-tabs .nav-link:hover {
    color: #0d9488 !important; 
    background-color: #eef8f7; 
}

#article-tabs .nav-link.active {
    background-color: #0d9488 !important; 
    color: #ffffff !important;
    box-shadow: 0 4px 12px rgba(13, 148, 136, 0.2); 
}
</style>

<section class="container-fluid py-5 ">

        <div class="row g-4 ">

            <!-- Left Side -->
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 px-5 article-section">

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <div>
                        <h2 class="fw-bold mb-1 issue-title">
                            Current Issue
                        </h2>
                        <p class="text-muted mb-0">
                            Volume 3 • Issue 2 • 2026
                        </p>
                    </div>
                </div>

                <div class="card border-0 shadow-sm">
                    <div class="card-body p-3">

                        <span class="badge article-badge mb-2">
                            Original Research
                        </span>

                        <h5 class="fw-bold mb-3">
                            <a href="#" class="text-decoration-none text-black">
                                Radiographic Assessment of Common Thoracic Disorders Using Chest X-Ray Imaging
                            </a>
                        </h5>

                        <p class="text-secondary mb-1">
                            <strong>Author details:</strong>
                            Zaira Hassan, Alishba Khusro, Ahmad Huzaifa,
                            Mohd Sofian Dar, Saiyed Adeel Abbas, Ms Taiba
                        </p>

                        <p class="text-muted fst-italic mb-1">
                            Innovative Journal of Medical Imaging, 3(2), 1–7, 2026
                        </p>

                        <hr>

                        <div class="d-flex flex-wrap gap-4 small text-muted mb-3">
                            <span>
                                <i class="bi bi-link-45deg me-1"></i>
                                DOI:
                                <a href="#" class="text-decoration-none text-green">
                                    10.62502/ijmi/v3i2art1
                                </a>
                            </span>

                            <span>
                                <i class="bi bi-eye"></i>
                                128 Views
                            </span>

                            <span>
                                <i class="bi bi-download"></i>
                                40 Downloads
                            </span>
                        </div>

                        <div class="d-flex gap-2">
                            <a href="#" class="btn btn-theme btn-sm">
                                Read Article
                            </a>

                            <a href="#" class="btn btn-outline-secondary btn-sm">
                                PDF
                            </a>
                        </div>

                    </div>
                </div>

            </div>


     
           


    </section>

<div class="pt-2 bg-secondary-subtle">



  <div class="p-4 shadow-sm text-white green ">

    <div class="d-flex flex-column align-items-start mb-2">
      <span class="font-weight-bold ">Review Article</span>
      <span class="small mb-2 text-light opacity-75">Volume: 14, Issue: 5, May, 2024</span>
    </div>

    <h5 class=" font-weight-bold mb-2 word-break-all">
      Review of grapefruit juice-drugs interactions mediated by intestinal CYP3A4 inhibition
    </h5>

    <div class="mb-2 small text-light opacity-90 word-break-all">
      <a class="text-white font-weight-light" href="#" target="_blank">Wael Abu Dayyih</a>,
      <a class="text-white font-weight-light" href="#" target="_blank">Israa Al-Ani</a>,
      <a class="text-white font-weight-light" href="#" target="_blank">Mohammad Hailat</a>,
      <a class="text-white font-weight-light" href="#" target="_blank">Samia Milhem Alarman</a>
    </div>

    <div class="d-flex flex-wrap  align-items-center gap-5">

      <div class="small text-start">
        <p class="mb-1 text-light">Published: May 05, 2024</p>
        <p class="mb-0 text-truncate">
          DOI: <a class="text-white text-decoration-underline" href="#" target="_blank">10.7324/JAPS.2024.160197</a>
        </p>
      </div>

      <div class="dropdown d-flex align-items-center gap-3 pt-3 position-relative">

        <a href="#" class="bg-white p-1 rounded d-inline-block shadow-sm">
          <img width="100" src="https://crossmark-cdn.crossref.org/widget/v2.0/logos/CROSSMARK_Color_horizontal.svg"
            alt="Crossmark">
        </a>


        <button class="btn btn-light btn-sm dropdown-toggle text-dark fw-normal shadow-sm" type="button"
          data-bs-toggle="dropdown" aria-expanded="false">

          Author Affiliations
        </button>

        <div class="dropdown-menu dropdown-menu-end p-2 shadow-lg " >
          <h5 class="text-info">Srinivas Mutalik</h5>
          <p class="mb-0  small text-muted">Coordinator, Centre for Drug Delivery Technologies, Professor & Head,
            Department of Pharmaceutics, Manipal College of Pharmaceutical Sciences, Manipal, India.</p>
        </div>





      </div>

    </div>


  </div>


  <div class="container-fluid">
    <div class="row p-2">

      <div class="col-lg-3 col-md-12 mb-4">
asdfghj
      </div>

      <div class="col-lg-9 col-md-12 ">

        <ul class="nav nav-pills nav-justified mb-2 shadow-sm rounded bg-white" id="article-tabs" role="tablist">

          <li class="nav-item" role="presentation">
            <button class="nav-link active small font-weight-bold py-1 w-100 text-truncate" id="tab-abstract-tab"
              data-bs-toggle="pill" data-bs-target="#tab-abstract" type="button" role="tab" aria-controls="tab-abstract"
              aria-selected="true">
              Abstract
            </button>
          </li>

          <li class="nav-item" role="presentation">
            <button class="nav-link small font-weight-bold py-1 w-100 text-truncate" id="tab-metrics-tab"
              data-bs-toggle="pill" data-bs-target="#tab-metrics" type="button" role="tab" aria-controls="tab-metrics"
              aria-selected="false">
              HTML
            </button>
          </li>

          <li class="nav-item" role="presentation">
            <button class="nav-link small font-weight-bold py-1 w-100 text-truncate" id="tab-comment-tab"
              data-bs-toggle="pill" data-bs-target="#tab-comment" type="button" role="tab" aria-controls="tab-comment"
              aria-selected="false">
              Comment On This Article
            </button>
          </li>

        </ul>
        
        <div class="tab-content" id="article-tabs-content">

          <div class="tab-pane fade show active" id="tab-abstract" role="tabpanel" aria-labelledby="tab-abstract-tab">
            <div class=" p-4 shadow-sm border-0 bg-white mb-3">
              <h5 class="font-weight-bold text-green border-bottom pb-2 mb-3">Abstract</h5>
              <p class="text-muted ">Drug-related problems (DRPs) significantly impact patients’ medication therapy
                outcomes. These include adverse drug reactions, ineffective drug therapy, excessive or sub-therapeutic
                drug dosage, development of drug resistance, drug–drug interactions, medication errors, and medication
                non-adherence. A clinical decision support system (CDSS) helps mitigate DRPs by providing clinical
                suggestions and reminders that enable decision-making by pharmacists and clinicians toward improving the
                overall well-being of patients. CDSS, associated with pharmacy services, enable pharmacists to consider
                substitutes for specific medications and address specific health problems by providing medication
                therapy
                management (MTM), acute pain management and other related services. Our research focused on identifying
                the benefits of CDSS integration in the pharmacist workflow toward managing DRPs. We conducted a
                thorough
                search across major databases, Scopus, Embase, PubMed, and Google Scholar, to obtain appropriate
                articles
                published through November 2025 and selected articles that met the inclusion criteria. Some of the
                challenges in CDSS implementation identified were integration issues with existing electronic health
                records (EHRs), incompatibility with current workflows, costs, inadequate leadership, and poor data
                quality.</p>

              <div class="mt-4 p-3 bg-light rounded border-start border-info border-3">
                <p class="small mb-2"><strong>Citation:</strong> Dayyih WA, Al-Ani I, Hailat M. J Appl Pharm Sci.
                  2026;16(6):5.</p>
              </div>
              <h5 class="font-weight-bold text-green border-bottom pb-2 mb-3">Abstract</h5>
              <p class="text-muted small">No abstract is available for this review article.</p>

              <div class="mt-4 p-3 bg-light rounded border-start border-info border-3">
                <p class="small mb-2"><strong>Citation:</strong> Dayyih WA, Al-Ani I, Hailat M. J Appl Pharm Sci.
                  2026;16(6):5.</p>
              </div>
              <h5 class="font-weight-bold text-green border-bottom pb-2 mb-3">Abstract</h5>
              <p class="text-muted small">No abstract is available for this review article.</p>

            </div>
          </div>

          <div class="tab-pane fade" id="tab-metrics" role="tabpanel" aria-labelledby="tab-metrics-tab">
            <div class=" p-4 shadow-sm border-0 bg-white mb-3">
              <h5 class="font-weight-bold text-info border-bottom pb-2 mb-3">Article Metrics</h5>
              <div class="d-flex flex-wrap gap-2 mb-4">
                <div class="border rounded px-3 py-2 text-center bg-light">
                  <span class="fw-bold d-block h5 mb-0 text-dark">42</span>
                  <small class="text-muted">Views</small>
                </div>
              </div>
            </div>
          </div>


          <div class="tab-pane fade" id="tab-comment" role="tabpanel" aria-labelledby="tab-comment-tab">
            <div class="p-4 shadow-sm border-0 bg-light mb-3">
              <h5 class="font-weight-bold text-dark mb-3 small text-uppercase">Leave a Comment</h5>
              <form>
                <div class="row g-3 mb-3">
                  <div class="col-md-6">
                    <input type="text" class="form-control form-control-sm" placeholder="Enter Name">
                  </div>
                </div>
              </form>
            </div>
          </div>

        </div>

      </div>


    </div>

  </div>

</div>





<?php include_once "../include/footer.php"; ?>

