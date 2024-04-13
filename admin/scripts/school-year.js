$(document).ready(function () {
    // Initiate DataTable
    var table = $('#school-year').DataTable({
        "columns": [
            {
                title: 'Academic ID',
                data: null,
                render: function (data, type, row, meta) {
                    return meta.row + 1;
                }
            },
            {
                title: 'Academic Year',
                data: 'year'
            },
            {
                title: 'Status',
                data: 'status'
            },
            {
                title: 'Action',
                data: null,
                render: function (data, type, row) {
                    return '<button class="btn btn-danger btn-sm btn-delete" data-id="' + row.id + '">Delete</button>' +
                        '<button class="btn btn-info btn-sm btn-edit" data-id="' + row.id + '">Edit</button>';
                }
            }
        ],
        dom: 'Bfrtip'
    });

    // Fetch data from PHP controller
    $.ajax({
        url: 'controllers/getAcademicYear.php',
        type: 'GET',
        dataType: 'json',
        success: function (response) {
            // Populate DataTable with fetched data
            table.rows.add(response).draw();
        },
        error: function (error) {
            console.error('Error fetching data:', error);
        }
    });

    // Event handler for delete button
    $('#school-year').on('click', '.btn-delete', function (e) {
        e.preventDefault();
        var rowId = $(this).data('id');

        // Remove row from DataTable (optional)
        var index = table.row($(this).parents('tr')).index();
        table.row(index).remove().draw();

        // Perform delete operation (AJAX call to server)
        // Example AJAX call:
        // $.post('controllers/deleteAcademicYear.php', { id: rowId })
        //    .done(function(response) {
        //        // Handle success
        //    })
        //    .fail(function(error) {
        //        // Handle error
        //    });
    });

    // Event handler for edit button
    $('#school-year').on('click', '.btn-edit', function (e) {
        e.preventDefault();
        var rowId = $(this).data('id');

        // Redirect to edit page
        // Example:
        // window.location.href = 'editAcademicYear.php?id=' + rowId;
    });

    // Event handler for form submission
    $('#addTeacherForm').submit(function (e) {
        e.preventDefault();
        var formData = $(this).serialize();

        // Perform add operation (AJAX call to server)
        // Example AJAX call:
        // $.post('controllers/addTeacher.php', formData)
        //    .done(function(response) {
        //        // Handle success
        //    })
        //    .fail(function(error) {
        //        // Handle error
        //    });
    });
});
