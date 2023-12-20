$(document).ready(function () {
    displayGraphs(); 
    setInterval(displayGraphs, 3000);
});

function displayGraphs() {
    $.ajax({
        method: "GET",
        url: "../../includes/load-users.php", 
        dataType: "json",
        success: function (response) {
            if (response.status === 'success') {
                var totalStudentsElement = $("#totalStudents");
                var activeStudentsElement = $("#activeStudents");

                totalStudentsElement.text(response.totalUsers);
                activeStudentsElement.text(response.activeUsers);
            }
        },
        error: function (xhr, status, error) {
            console.log("AJAX Error:", error);
        }
    });
}