<?php include 'layouts/session.php'; ?>
<?php include 'layouts/main.php'; ?>
<?php

if (!isset($_SESSION['login'])) {
    header('Location: ../index.php');
}

if ($_SESSION['role'] != 'teacher') {
    header('Location: ../admin/index.php');
}
?>

<head>
    <title>Teacher Dashboard | Admin Portal</title>
    <?php include 'layouts/title-meta.php'; ?>

    <?php include 'layouts/head-css.php'; ?>
    <link href="../assets/vendor/fullcalendar/main.min.css" rel="stylesheet" type="text/css" />
    <link href="../assets/vendor/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet"
        type="text/css" />
    <link href="../assets/vendor/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet"
        type="text/css" />
    <link href="../assets/vendor/datatables.net-fixedcolumns-bs5/css/fixedColumns.bootstrap5.min.css" rel="stylesheet"
        type="text/css" />
    <link href="../assets/vendor/datatables.net-fixedheader-bs5/css/fixedHeader.bootstrap5.min.css" rel="stylesheet"
        type="text/css" />
    <link href="../assets/vendor/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet"
        type="text/css" />
    <link href="../assets/vendor/datatables.net-select-bs5/css/select.bootstrap5.min.css" rel="stylesheet"
        type="text/css" />
</head>

<body>
    <!-- Begin page -->
    <div class="wrapper">

        <?php include 'layouts/menu.php'; ?>
        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item active">Dashboard</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Subject Lists</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php
                        $teacher = new Academic($conn);
                        $teacherId = $teacher->getTeacherId($userId);

                        // display all section with card
                        $section = new Section($conn);
                        $sectionLists = $section->getAdvisorySection($teacherId);

                        if ($sectionLists) {
                            $sectionId = $sectionLists['section_id'];
                            $sectionName = $sectionLists['section_name'];
                            $strand_id = $sectionLists['strand_id'];

                            $academic = new Academic($conn);
                            $strand = $academic->getStrand($strand_id);

                            foreach ($strand as $row) {
                                $strand_name = $row['strand_name'];
                            }

                            $grade = $sectionLists['year'];
                            $totalStudents = $academic->getTotalStudents($teacherId);

                            echo '<div class="col-md-6 col-xl-3 text-center">
                                <div class="card" style="border: 1px solid #ddd; box-shadow: 2px 2px 5px rgba(0,0,0,0.1);">
                                    <div class="card-body">
                                        <h5 class="card-title font-size-16" style="color: #333;">' . $sectionName . ' - Grade ' . $grade . '</h5>
                                        <p class="card-text text-muted" style="font-size: 14px;">' . $strand_name . '</p>
                                        <p class="card-text text-muted" style="font-size: 14px;">Total Students: ' . $totalStudents . '</p>
                                        <a href="subject.php?section_id=' . $sectionId . '" class="btn btn-success">
                                        <i class="bi bi-eye"></i>
                                        View Students</a>
                                    </div>
                                </div>
                            </div>';
                        } else {
                            echo '<div class="col-md-6 col-xl-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title font-size-16">No Subject</h5>
                                <p class="card-text text-muted">You have no subject yet.</p>
                                </div>
                            </div>
                        </div>';
                        }
                        ?>

                    </div>
                </div>
            </div> <!-- container -->
        </div> <!-- content -->
    </div>

    <!-- ============================================================== -->
    <!-- End Page content -->
    <!-- ============================================================== -->
    <!-- END wrapper -->

    <?php include 'layouts/right-sidebar.php'; ?>

    <?php include 'layouts/footer-scripts.php'; ?>

    <!-- App js -->
    <script src="../assets/js/app.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.1.11/index.global.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="../assets/vendor/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../assets/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="../assets/vendor/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../assets/vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
    <script src="../assets/vendor/datatables.net-fixedcolumns-bs5/js/fixedColumns.bootstrap5.min.js"></script>
    <script src="../assets/vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../assets/vendor/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
    <script src="../assets/vendor/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../assets/vendor/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../assets/vendor/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../assets/vendor/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../assets/vendor/datatables.net-select/js/dataTables.select.min.js"></script>
    <script src="scripts/section.js"></script>


</body>

</html>