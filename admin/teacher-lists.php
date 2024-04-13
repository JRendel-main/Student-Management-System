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
                                        <li class="breadcrumb-item active">Teacher Lists</li>
                                    </ol>
                                </div>
                                <h4 class="page-title">Teacher Lists</h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col col-md-4">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <div class="float-end">
                                        <i class="ri-group-line text-bg-info widget-icon"></i>
                                    </div>
                                    <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Teachers</h5>
                                    <h3 class="my-3">54,214</h3>
                                    <p class="mb-0 text-muted">
                                        <span class="text-success me-2"><i class="ri-arrow-up-line"></i> 5.27%</span>
                                        <span class="text-nowrap">Since last month</span>
                                    </p>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                        <div class="col col-md-4">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <div class="float-end">
                                        <i class="ri-group-line text-bg-primary widget-icon"></i>
                                    </div>
                                    <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Students</h5>
                                    <h3 class="my-3">32,540</h3>
                                    <p class="mb-0 text-muted">
                                        <span class="text-danger me-2"><i class="ri-arrow-down-line"></i> 1.08%</span>
                                        <span class="text-nowrap">Since last month</span>
                                    </p>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
                        <div class="col col-md-4">
                            <div class="card widget-flat">
                                <div class="card-body">
                                    <div class="float-end">
                                        <i class="ri-group-line text-bg-success widget-icon"></i>
                                    </div>
                                    <h5 class="text-muted fw-normal mt-0" title="Number of Customers">Total Users</h5>
                                    <h3 class="my-3">86,754</h3>
                                    <p class="mb-0 text-muted">
                                        <span class="text-success me-2"><i class="ri-arrow-up-line"></i> 4.87%</span>
                                        <span class="text-nowrap">Since last month</span>
                                    </p>
                                </div> <!-- end card-body-->
                            </div> <!-- end card-->
                        </div> <!-- end col-->
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