$(document).ready(function () {
    displayResults();
    setInterval(displayResults, 3000);
});

function displayResults() {
    $.ajax({
        method: "GET",
        url: "../../includes/load-student-results.php",
        dataType: "json",
        success: function (response) {
            var testResultTableBody = $("#displayStudentsResults");
            if (response.status === 'success') {
                testResultTableBody.empty();
                var number = 1;

                if (response.results && response.results.length > 0) {
                    response.results.forEach(function (result) {
                        var row = $("<tr></tr>");
                        row.append("<td>" + number + "</td>");
                        row.append("<td>" + result.user_name + "</td");
                        row.append("<td>" + result.user_score + "</td");
                        row.append("<td>" + result.test_category + "</td");

                        // Format the date
                        var takenDate = new Date(result.taken_at);
                        var formattedDate = takenDate.toLocaleString('en-US', {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit',
                        });
                        row.append("<td>" + formattedDate + "</td>");

                        testResultTableBody.append(row);
                        number++;
                    });
                } else {
                    var noResultsRow = $("<tr></tr>");
                    noResultsRow.append("<td colspan='3' class='text-danger fw-semibold'>No results found</td>");
                    testResultTableBody.append(noResultsRow);
                }
            } else {
                var noResultsRow = $("<tr></tr>");
                noResultsRow.append("<td colspan='3' class='text-danger fw-semibold'>No results found</td>");
                testResultTableBody.append(noResultsRow);
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", error);
        }
    });
}
