<?php include_once "./include/link.php"; ?>

<?php
$events = $functions->getConferenceEvents();
?>

<?php include_once "./include/header.php"; ?>
<div class="container-fluid my-3">
    <div class="row justify-content-center">

        <!-- Left Sidebar -->
        <div class="col-lg-2 mb-3">
            <?php include_once "./include/left_sidebar.php"; ?>
        </div>

        <!-- Main Content -->
       <div class="col-lg-7 py-2 border my-2">

       <h2>Conference</h2>
       <hr>
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white p-2">

            <ul class="nav nav-tabs nav-fill border-0 " id="eventTabs" role="tablist">

                <li class="nav-item " role="presentation">
                    <button class="nav-link active fw-semibold"
                        id="conference-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#conference"
                        type="button">

                        Conference & Seminar Proceedings

                    </button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link fw-semibold"
                        id="events-tab"
                        data-bs-toggle="tab"
                        data-bs-target="#events"
                        type="button">

                        Calendar of Events

                    </button>
                </li>

            </ul>

        </div>

        <div class="card-body p-0">

            <div class="tab-content">

                <!-- Conference Tab -->
                <div class="tab-pane fade show active p-3" id="conference">

                    <div class="table-responsive">

                        <table class="table table-hover table-bordered align-middle mb-0">

                            <thead class="table-light text-center">

                                <tr>
                                    <th style="width:15%;">Date</th>
                                    <th style="width:18%;">Country</th>
                                    <th>Title</th>
                                    <th style="width:12%;">PDF</th>
                                </tr>

                            </thead>

                            <tbody>

                                <?php if (!empty($events['conference'])): ?>

                                    <?php foreach ($events['conference'] as $row): ?>

                                        <tr>

                                            <td><?= date('d M Y', strtotime($row['con_date'])) ?></td>

                                            <td><?= htmlspecialchars($row['country']) ?></td>

                                            <td><?= strip_tags($row['title']) ?></td>

                                            <td class="text-center">

                                                <?php if (!empty($row['pdf_file'])): ?>

                                                    <a href="<?= $base_url ?>uploads/<?= htmlspecialchars($row['pdf_file']) ?>"
                                                        target="_blank"
                                                        class="btn btn-outline-danger btn-sm">

                                                        PDF

                                                    </a>

                                                <?php else: ?>

                                                    -

                                                <?php endif; ?>

                                            </td>

                                        </tr>

                                    <?php endforeach; ?>

                                <?php else: ?>

                                    <tr>
                                        <td colspan="4" class="text-center py-4">
                                            No records found.
                                        </td>
                                    </tr>

                                <?php endif; ?>

                            </tbody>

                        </table>

                    </div>

                </div>

                <!-- Events Tab -->
                <div class="tab-pane fade p-3" id="events">

                    <div class="table-responsive">

                        <table class="table table-hover table-bordered align-middle mb-0">

                            <thead class="table-light text-center">

                                <tr>
                                    <th style="width:15%;">Date</th>
                                    <th style="width:18%;">Country</th>
                                    <th>Title</th>
                                    <th style="width:12%;">PDF</th>
                                </tr>

                            </thead>

                            <tbody>

                                <?php if (!empty($events['events'])): ?>

                                    <?php foreach ($events['events'] as $row): ?>

                                        <tr>

                                            <td><?= date('d M Y', strtotime($row['con_date'])) ?></td>

                                            <td><?= htmlspecialchars($row['country']) ?></td>

                                            <td><?= htmlspecialchars($row['title']) ?></td>

                                            <td class="text-center">

                                                <?php if (!empty($row['pdf_file'])): ?>

                                                    <a href="<?= $base_url ?>uploads/<?= htmlspecialchars($row['pdf_file']) ?>"
                                                        target="_blank"
                                                        class="btn btn-outline-danger btn-sm">

                                                        PDF

                                                    </a>

                                                <?php else: ?>

                                                    -

                                                <?php endif; ?>

                                            </td>

                                        </tr>

                                    <?php endforeach; ?>

                                <?php else: ?>

                                    <tr>
                                        <td colspan="4" class="text-center py-4">
                                            No records found.
                                        </td>
                                    </tr>

                                <?php endif; ?>

                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

        <!-- Right Sidebar -->
        <div class="col-lg-2 mb-3">
            <?php include_once "./include/right_sidebar.php"; ?>
        </div>

    </div>
</div>

<?php include_once "./include/footer.php"; ?>