$(document).ready(function () {
    displayStudents();
    addNewStudent();

    $("#searchStudent").on("input", function() {
        displayStudents();
    });
    
    setInterval(displayStudents, 3000);
});


function displayStudents() {
    var searchValue = $("#searchStudent").val().toLowerCase();

    $.ajax({
        method: "GET",
        url: "../../includes/load-students-data.php",
        dataType: "json",
        success: function (response) {
            var studentsTable = $("#displayStudents");
            studentsTable.empty();
            var number = 1;

            if (response.status === 'success' && response.results) {
                response.results.forEach(function (result) {
                    if (result.user_name.toLowerCase().includes(searchValue)) {
                        var row = $("<tr></tr>");
                        row.append("<td>" + number + "</td>");
                        row.append("<td>" + result.user_name + "</td");
                        row.append("<td>" + result.user_email + "</td");

                        studentsTable.append(row);
                        number++;
                    }
                });

                if (number === 1) {
                    var noResultsRow = $("<tr></tr>");
                    noResultsRow.append("<td colspan='4' class='text-danger fw-semibold'>No results found</td>");
                    studentsTable.append(noResultsRow);
                }
            } else {
                var noResultsRow = $("<tr></tr>");
                noResultsRow.append("<td colspan='4' class='text-danger fw-semibold'>No results found</td>");
                studentsTable.append(noResultsRow);
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", error);
        }
    });
}

function addNewStudent() {
    $(document).on('click', '.btn-save', function () {
        var button = $(this);
        var modal = button.closest('.modal');
        var errorContent = modal.find('.text-danger');
        var showPasswordDiv = modal.find('.modal-body');

        var user_email = modal.find('#studentEmail').val();
        var user_name = modal.find('#studentName').val();
        var user_password = modal.find('#studentPassword').val();

        $.ajax({
            method: "POST",
            url: "../../includes/add-new-student.php",
            data: { user_email, user_name, user_password },
            dataType: "json",
            success: function (response) {
                if (response.status === 'success') {
                    modal.closest('.admin-index-page').find('a, button, input').prop('disabled', true);

                    var successMessage = $('<p class="alert alert-success p-2 text-center" data-aos="fade-left">' + response.message + '</p>').hide();
                    showPasswordDiv.append(successMessage);
                    successMessage.fadeIn(100);

                    setTimeout(function () {
                        successMessage.fadeOut(400, function () {
                            successMessage.remove();
                            setTimeout(function () {
                                location.reload();
                            }, 2000);
                        });
                    }, 2000);
                } else {
                    if (errorContent.length) {
                        errorContent.text(response.message);
                    } else {
                        errorContent = $('<p class="mb-0 mt-3 text-danger text-center fw-bold">' + response.message + '</p>');
                        showPasswordDiv.append(errorContent);
                    }
                    errorContent.fadeIn(400).delay(3000).fadeOut(400, function () {
                        errorContent.remove();
                    });
                }
            },
            error: function (xhr, status, error) {
                console.log("AJAX Error:", error);
            }
        });
    });
}
