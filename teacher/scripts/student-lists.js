$(document).ready(() => {
    $.ajax({
        url: 'controllers/getAllBoys.php',
        type: 'GET',
        dataType: 'json',
        success: (response) => {
            $('#boys').DataTable({
                "columns": [
                    {
                        title: "Student ID",
                        data: "student_id",
                        visible: false // This will hide the Student ID column
                    },
                    {
                        title: "Student Name",
                        data: "student_name"
                    },
                    {
                        title: "Action",
                        data: null,
                        render: function (data, type, row) {
                            return '<button class="btn btn-danger btn-sm btn-delete" data-id="' + row.student_id + '">Delete</button>' +
                                '<button class="btn btn-info btn-sm btn-edit" data-id="' + row.student_id + '">Edit</button>';
                        }
                    }
                ],
            });
        },
    })
})