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
                                <h4 class="page-title">Teacher Dashboard</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="card">
                                <div class="card-body">
                                    <span class="float-start m-2 me-4">
                                        <img src="https://ui-avatars.com/api/?name=John+Doe" style="height: 100px;"
                                            alt="avatar-2" class="rounded-circle img-thumbnail" id="profile">
                                    </span>
                                    <div class="">
                                        <h4 class="mt-1 mb-1" id="teacher-name"><?php echo $username ?></h4>
                                        <p class="fs-13" id="teacher-title"> <?php echo $category ?></p>

                                        <ul class="mb-0 list-inline">
                                            <li class="list-inline-item me-3">
                                                <h5 class="mb-1">10 Students</h5>
                                                <p class="mb-0 fs-13">Student Count</p>
                                            </li>
                                            <li class="list-inline-item">
                                                <h5 class="mb-1">12 Subjects</h5>
                                                <p class="mb-0 fs-13">Subject Count</p>
                                            </li>
                                            <li class="list-inline-item">
                                                <button class="btn btn-primary btn-sm mt-3" id="edit-profile">Edit
                                                    Profile</button>
                                            </li>
                                        </ul>
                                    </div>
                                    <!-- end div-->
                                </div>
                                <!-- end card-body-->
                            </div>
                        </div>
                        <div class="col-xl-8">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Class Schedule</h4>
                                </div>
                                <div class="card-body">
                                    <div id='calendar'></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- container -->

            </div> <!-- content -->

            <?php include 'layouts/footer.php'; ?>

        </div>

        <!-- ============================================================== -->
        <!-- End Page content -->
        <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <?php include 'layouts/right-sidebar.php'; ?>

    <?php include 'layouts/footer-scripts.php'; ?>

    <!-- App js -->
    <script src="../assets/js/app.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@6.1.11/index.global.min.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="scripts/index.js"></script>

</body>

</html>