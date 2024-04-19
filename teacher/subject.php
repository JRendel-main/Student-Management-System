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

                <?php
                //check if there is get request
                if (isset($_GET['section_id'])) {
                    $section = new Section($conn);
                    $sectionId = $_GET['section_id'];

                    $section = $section->getSection($sectionId);
                    $strand_id = $section['strand_id'];

                    $strand = new Academic($conn);
                }
                ?>
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
                                <h4 class="page-title">
                                    <?php
                                    $section_name = $section['section_name'];
                                    echo '(' . $strand_name . ') ' . $section_name . ' Section';
                                    ?>
                                </h4>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h4 class="card-title">Component Lists</h4>
                                        </div>
                                        <div class="col-md-6 text-end">
                                            <button type="button" class="btn btn-success waves-effect waves-light mt-2"
                                                data-bs-toggle="modal" data-bs-target="#addComponentModal">
                                                <i class="bi bi-plus"></i> Edit Component
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <?php
                                    $grades = new Grades($conn);
                                    $gradeComponent = $grades->getGradeComponent($_GET['subjectId']);

                                    // display all component with card
                                    if ($gradeComponent) {
                                        echo '<div class="table-responsive">
                                            <table class="table table-centered table-nowrap table-hover mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>Component Name</th>
                                                        <th>Percentage</th>
                                                    </tr>
                                                </thead>
                                                <tbody>';
                                        foreach ($gradeComponent as $component) {
                                            echo '<tr>
                                                    <td>' . $component['component_name'] . '</td>
                                                    <td>' . $component['weight'] . '%</td>
                                                </tr>';
                                        }
                                        echo '</tbody>
                                            </table>
                                        </div>';
                                    } else {
                                        echo '<div class="col-md-6 col-xl-3">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5 class="card-title font-size-16">No Component</h5>
                                                        <p class="card-text text-muted">You have no component yet.</p>
                                                    </div>
                                                </div>
                                            </div>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- container -->
        </div> <!-- content -->
    </div>

    <!-- modal for component -->
    <!-- modal for component -->
    <div class="modal fade" id="addComponentModal" tabindex="-1" aria-labelledby="addComponentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-top">
            <div class="modal-content">
                <form method="post" id="addComponentForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addComponentModalLabel">Edit Grades Component</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div id="component-container">
                                    <!-- component fields will be added dynamically here -->
                                </div>
                                <div class="mb-3">
                                    <a href="#" class="text-small" id="add_component">
                                        <i class="bi bi-plus"></i> Add Component
                                    </a>
                                </div>
                                <small id="emailHelp" class="form-text text-muted">Note: The total percentage should be
                                    equal to 100%.</small>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="submitComponentBtn">Submit Component</button>
                    </div>
                </form>
            </div>
        </div>
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
    <!-- <script src="scripts/subject.js"></script> -->
    <script>
        $(document).ready(() => {
            // Function to open modal and populate form fields for editing
            function openEditModal(componentData) {
                $('#component-container').empty(); // Clear existing fields
                componentData.forEach(component => {
                    $('#component-container').append(`
                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-7">
                                <input type="text" name="component_name[]" class="form-control component-input" value="${component.component_name}" required>
                            </div>
                            <div class="col-md-3">
                                <div class="input-group">
                                    <input type="number" name="component_percentage[]" class="form-control comp-input" value="${component.weight}" required>
                                    <span class="input-group-text">%</span>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <a class="btn btn-light remove_component">
                                    <i class="bi bi-x"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                `);
                });
            }

            // Event listener to open modal for editing
            $('#addComponentModal').on('show.bs.modal', function (e) {
                var
                    componentData = []; // Assuming you have existing component data in this format [{component_name: '...', weight: '...'}, {...}]
                openEditModal(componentData);
            });

            // Event listener to add new component fields
            $('#add_component').click(() => {
                $('#component-container').append(`
                <div class="mb-3">
                    <div class="row">
                        <div class="col-md-7">
                            <input type="text" name="component_name[]" class="form-control component-input" placeholder="Component Name" required>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group">
                                <input type="number" name="component_percentage[]" class="form-control comp-input" placeholder="Percentage" required>
                                <span class="input-group-text">%</span>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <a class="btn btn-light remove_component">
                                <i class="bi bi-x"></i>
                            </a>
                        </div>
                    </div>
                </div>
            `);
            });

            // Event listener to remove component fields
            $('#component-container').on('click', '.remove_component', function () {
                $(this).closest('.mb-3').remove();
            });

            $('#addComponentForm').submit((e) => {
                e.preventDefault();

                // get all component[]
                var component = [];
                $('.component-input').each(function () {
                    component.push($(this).val());
                });

                // get all component_percentage[]
                var percentage = [];
                $('.comp-input').each(function () {
                    percentage.push($(this).val());
                });

                //check if the total percentage is equal to 100
                var total = 0;

                for (var i = 0; i < percentage.length; i++) {
                    total += parseInt(percentage[i]);
                }

                if (total != 100) {
                    swal.fire({
                        icon: 'error',
                        title: 'Total percentage should be equal to 100%'
                    });
                    // disable the button
                    $('#submitComponentBtn').prop('disabled', true);
                    return;
                }

                $.ajax({
                    url: 'controllers/addComponent.php',
                    type: 'POST',
                    data: {
                        component: component,
                        percentage: percentage,
                        subject_id: <?php echo $_GET['subjectId']; ?>
                    },
                    success: function (data) {
                        var response = JSON.parse(data);
                        if (response.success) {
                            swal.fire({
                                icon: 'success',
                                title: 'Component added successfully'
                            });
                            $('#addComponentModal').modal('hide');
                        }
                    }
                });
            });
        });
    </script>



</body>

</html>