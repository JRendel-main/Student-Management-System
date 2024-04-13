$(document).ready(function () {
    // Initiate DataTable
    var table = $('#teacher-lists').DataTable({
        "processing": true,
        "serverSide": true,
        "columnDefs": [
            { "orderable": false, "targets": 0 },
            { "orderable": false, "targets": 4 }
        ],
        "ajax": {
            "url": "controllers/getTeacherLists.php",
            "type": "GET"
        },
        "columns": [
            {
                title: 'Roll No',
                data: null,
                render: function (data, type, row, meta) {
                    return meta.row + 1;
                }
            },
            {
                title: 'Teacher Name',
                data: 'name'
            },
            {
                title: 'Teacher Title',
                data: 'title'
            },
            {
                title: 'Email Address',
                data: 'email'
            },
            {
                title: 'Gender',
                data: 'gender'
            },
            {
                title: 'Phone',
                data: 'contact_num'
            },
            {
                title: 'Action',
                data: null,
                render: function (data, type, row) {
                    return '<a class="btn btn-primary btn-sm btn-edit" data-id="' + row.teacher_id + '"><i class="bi bi-pencil"></i></a> <a class="btn btn-danger btn-sm btn-delete" data-id="' + row.teacher_id + '"><i class="bi bi-trash"></i></a>';
                }
            }
        ],
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });

    // Event handler for delete button
    $('#teacher-lists').on('click', '.btn-delete', function (e) {
        e.preventDefault();

        // add confirmation alert using swal
        swal.fire({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this record!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            $.ajax({
                url: 'controllers/deleteTeacher.php',
                type: 'POST',
                data: { id: $(this).data('id') },
                success: function (response) {
                    let data = JSON.parse(response);
                    if (data.success == true) {
                        swal.fire({
                            title: "Success!",
                            text: data.message,
                            icon: "success",
                            button: "Ok",
                        }).then((result) => {
                            if (result.value) {
                                table.ajax.reload();
                            }
                        });
                    } else {
                        swal.fire({
                            title: "Error!",
                            text: data.message,
                            icon: "error",
                            button: "Ok",
                        });
                    }
                },
                error: function (error) {
                    swal.fire({
                        title: "Error!",
                        text: "Something went wrong!" + error,
                        icon: "error",
                        button: "Ok",
                    });
                }
            });
        });
    });

    // Event handler for edit button
    $('#teacher-lists').on('click', '.btn-edit', function (e) {
        e.preventDefault();
        var url = "editTeacher.php?id=" + $(this).data('id');
        // Redirect to edit page
        window.location.href = url;
    });

    // Event handler for form submission
    $('#addTeacherForm').submit(function (e) {
        e.preventDefault();
        var formData = $(this).serialize();
        $.ajax({
            url: 'controllers/addTeacher.php',
            type: 'POST',
            data: formData,
            success: function (response) {
                let data = JSON.parse(response);
                if (data.success == true) {
                    swal.fire({
                        title: "Success!",
                        text: data.message,
                        icon: "success",
                        button: "Ok",
                    }).then((result) => {
                        if (result.value) {
                            window.location.reload();
                        }
                    });
                } else {
                    swal.fire({
                        title: "Error!",
                        text: data.message,
                        icon: "error",
                        button: "Ok",
                    });
                }
            },
            error: function (error) {
                swal.fire({
                    title: "Error!",
                    text: "Something went wrong!" + error,
                    icon: "error",
                    button: "Ok",
                })
            }
        });
    });
});
