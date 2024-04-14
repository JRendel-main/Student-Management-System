$(document).ready(() => {
    $.ajax({
        url: 'controllers/getSection.php',
        type: 'GET',
        dataType: 'json',
        success: (response) => {
            $('#section').DataTable({
                data: response,
                columns: [
                    {
                        title: 'Section ID',
                        data: 'section_id'
                    },
                    {
                        title: 'Adviser',
                        data: 'advisor_name'
                    },
                    {
                        title: 'Section Name',
                        data: 'section_name'
                    },
                    {
                        title: 'Year Level',
                        data: 'year'
                    },
                    {
                        title: 'Strand',
                        data: 'strand_name'
                    },
                    {
                        title: 'Action',
                        data: null,
                        render: function (data, type, row) {
                            return '<button class="btn btn-danger btn-sm btn-delete" data-id="' + row.section_id + '">Delete</button>' +
                                '<button class="btn btn-info btn-sm btn-edit" data-id="' + row.section_id + '">Edit</button>';
                        }
                    }
                ],
            });
        },
        error: (error) => {
            console.error('Error fetching data:', error);
        }
    });

    // get all teachers for select option and add search bar for modal
    $.ajax({
        url: 'controllers/getTeacherLists.php',
        type: 'GET',
        dataType: 'json',
        success: (response) => {
            response.forEach(teacher => {
                $('#teacher_id').append(`<option value="${teacher.teacher_id}">${teacher.teacher_name}</option>`);
            });
        },
        error: (error) => {
            console.error('Error fetching data:', error);
        }
    });

    $('#section').on('click', '.btn-delete', function (e) {
        e.preventDefault();
        var rowId = $(this).data('id');

        // Remove row from DataTable (optional)
        var table = $('#section').DataTable();
        var index = table.row($(this).parents('tr')).index();
        table.row(index).remove().draw();

        // Perform delete operation (AJAX call to server)
        // Example AJAX call:
        // $.post('controllers/deleteAcademicYear.php', { id: rowId })
        //    .done(function(response) {
        //        // Handle success
    });

    $('#section').on('click', '.btn-edit', function (e) {
        e.preventDefault();
        var rowId = $(this).data('id');

        // Perform edit operation (AJAX call to server)
        // Example AJAX call:
        // $.post('controllers/editAcademicYear.php', { id: rowId })
        //    .done(function(response) {
        //        // Handle success
    });

    $('#addSectionForm').on('submit', function (e) {
        e.preventDefault();

        // Get form data
        var formData = $(this).serialize();

        // Perform add operation (AJAX call to server)
        $.ajax({
            url: 'controllers/addSection.php',
            type: 'POST',
            data: formData,
            success: function (response) {
                var data = JSON.parse(response);

                if (data.success) {
                    swal.fire({
                        title: 'Success!',
                        text: data.message,
                        icon: 'success'
                    }).then(() => {
                        window.location.reload();
                    });
                } else {
                    swal.fire({
                        title: 'Failed!',
                        text: data.message,
                        icon: 'error'
                    });

                }
            },
            error: function (error) {
                // Handle error
                console.error('Error:', error);
            }
        });
    });
})