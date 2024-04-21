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
        <?php
        // Check if student_id and subject_id are set
        if (!isset($_GET['student_id']) || !isset($_GET['subject_id'])) {
            header('Location: some-error-page.php'); // Redirect to an error page
        }

        $student_id = $_GET['student_id'];
        $subject_id = $_GET['subject_id'];

        $student = new Student($conn);
        $grade = new Grades($conn);
        $gradeComponent = $grade->getGradeComponent($subject_id);
        $studentDetails = $student->getStudent($student_id);
        $studentName = $studentDetails['last_name'] . ', ' . $studentDetails['first_name'] . ' ' . $studentDetails['middle_name'];
        ?>
        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">

                                <h4 class="page-title">
                                    <?php echo $studentName; ?>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="card">
                            <div class="card-header text-center">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <?php
                                            $academic = new Academic($conn);
                                            $semester = $academic->getSemester();
                                            // add select dropdown for grading period
                                            echo '<select class="form-select" id="gradingPeriod">';
                                            foreach ($semester as $sem) {
                                                echo '<option value="' . $sem['semester_id'] . '">' . $sem['Quarter'] . ' Grading (' . $sem['semester_name'] . ')</option>';
                                            }
                                            echo '</select>';
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <button class="btn btn-success" id="addGrade">
                                            <i class="bi bi-plus"></i>
                                            Add Grades
                                        </button>
                                    </div>
                                    <div class="col-md-6 align-items-right">
                                        <!-- two button for next and prev -->
                                        <div class="btn-group gap-3" role="group" aria-label="Basic example">
                                            <button type="button" class="btn btn-secondary" id="prev">
                                                <i class="bi bi-arrow-left"></i>
                                                Previous
                                            </button>
                                            <button type="button" class="btn btn-secondary" id="next">
                                                Next
                                                <i class="bi bi-arrow-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <?php
                                $grades = new Grades($conn);

                                ?>
                            </div>
                        </div>
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
    <script>
        $(document).ready(function () {
            // Function to calculate total grade for each component
            function calculateTotalGrade(grades, components) {
                let total = 0;
                components.forEach(function (component) {
                    let componentGrade = grades[component['component_id']] || 0;
                    total += componentGrade * (component['weight'] / 100);
                });
                return total.toFixed(2); // Return total grade rounded to 2 decimal places
            }

            // Add functionality to add grade button
            $('#addGrade').click(function () {
                // Implement your logic to add grades here
                // You may use AJAX to send data to the server and update the database
            });
        });
    </script>
</body>

</html>