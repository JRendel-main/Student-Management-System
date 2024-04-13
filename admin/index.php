<?php include 'layouts/session.php'; ?>
<?php include 'layouts/main.php'; ?>
<?php

if (!isset($_SESSION['login'])) {
    header('Location: ../index.php');
}

if ($_SESSION['role'] != 'admin') {
    header('Location: ../teacher/index.php');
}
?>

<head>
    <title>Teacher Dashboard | Admin Portal</title>
    <?php include 'layouts/title-meta.php'; ?>

    <?php include 'layouts/head-css.php'; ?>
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
                                <h4 class="page-title">Dashboard</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-3 col-sm-6">
                            <!-- Teacher count, add icon and count of teacher-->
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <i class="bi bi-person-lines-fill" style="font-size: 50px; color: #f1b44c;"
                                                data-feather="users" height="50" width="50"></i>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-end">
                                                <h3 class="text-dark mt-1">0</h3>
                                                <p class="text-muted mb-1 text-truncate">Teachers</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6">
                            <!-- Student count -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <i class="bi bi-person-fill" style="font-size: 50px; color: #f1b44c;"
                                                data-feather="users" height="50" width="50"></i>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-end">
                                                <h3 class="text-dark mt-1">0</h3>
                                                <p class="text-muted mb-1 text-truncate">Students</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6">
                            <!-- Section count -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <i class="bi bi-person-fill" style="font-size: 50px; color: #f1b44c;"
                                                data-feather="users" height="50" width="50"></i>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-end">
                                                <h3 class="text-dark mt-1">0</h3>
                                                <p class="text-muted mb-1 text-truncate">Sections</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-sm-6">
                            <!-- Subject count -->
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-6">
                                            <i class="bi bi-book-fill" style="font-size: 50px; color: #f1b44c;"
                                                data-feather="book" height="50" width="50"></i>
                                        </div>
                                        <div class="col-6">
                                            <div class="text-end">
                                                <h3 class="text-dark mt-1">0</h3>
                                                <p class="text-muted mb-1 text-truncate">Subjects</p>
                                            </div>
                                        </div>
                                    </div>
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
    <script src="scripts/index.js"></script>

</body>

</html>