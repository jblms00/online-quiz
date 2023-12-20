$(document).ready(function () {
    loadTests();
    displayQuestions();
    submitTest();
    displayResults();
    recommendedWorkDescription();

    $(document).on('click', '.confirm-btn', function () {
        var button = $(this);
        var exam_type = button.data('test-exam');

        var modalDialog = $('#testConfirmationDialog');
        var contentHTML = `
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">${exam_type}</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">Are you sure you want to take the ${exam_type}? Please note that each test can only be taken once.</p>
                </div>
                <div class="modal-footer p-1">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <a href="student-test-questionnaire.php?category=${exam_type}" class="btn btn-primary">Yes</a>
                </div>
            </div>
        `;
        if (modalDialog.children().length > 0) {
            modalDialog.empty();
        }
        modalDialog.append(contentHTML);
    });

    var duration = 900;
    var display = document.querySelector('#testTimer');
    displayTimer(duration, display);
});

function loadTests() {
    var subTestsContainer = $('#subTestsContainer');
    var contentHTML = `
        <div class="row my-3 mt-0">
            <div class="col">
                <div class="test-desc">
                    <h5 class="fw-light">The <span>Verbal Ability</span> subtest assesses your proficiency in
                        understanding and
                        working with written language. It evaluates your reading comprehension, vocabulary, and
                        grammar
                        skills.
                    </h5>
                    <div class="btn-container">
                        <button type="button" class="btn btn-primary confirm-btn" data-bs-toggle="modal"
                            data-bs-target="#modalConfirmTest" data-test-exam="Verbal Ability">Take Test</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row my-3">
            <div class="col">
                <div class="test-desc">
                    <h5 class="fw-light">The <span>Numerical Ability</span> subtest measures your aptitude for
                        working with
                        numbers and mathematical concepts. It includes tasks related to arithmetic, algebra,
                        geometry, and mathematical problem-solving.
                    </h5>
                    <div class="btn-container">
                        <button type="button" class="btn btn-primary confirm-btn" data-bs-toggle="modal"
                            data-bs-target="#modalConfirmTest" data-test-exam="Numerical Ability">Take Test</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row my-3">
            <div class="col">
                <div class="test-desc">
                    <h5 class="fw-light">The <span>Science Test</span> evaluates your knowledge and comprehension of
                        scientific
                        principles, concepts, and facts from various scientific disciplines.</h5>
                    <div class="btn-container">
                        <button type="button" class="btn btn-primary confirm-btn" data-bs-toggle="modal"
                            data-bs-target="#modalConfirmTest" data-test-exam="Science Test">Take Test</button>
                    </div>
                </div>
            </div>
        </div>
    `;
    subTestsContainer.append(contentHTML)

    var get_category = subTestsContainer.find('.confirm-btn').data('test-exam');
    
    $.ajax({
        method: "GET",
        data: { get_category },
        url: "../../includes/load-tests.php",
        dataType: "json",
        success: function (response) {
            if (response.status === 'success') {
                // Iterate through the buttons and disable them if their category is in the database
                subTestsContainer.find('.confirm-btn').each(function () {
                    var button = $(this);
                    var category = button.data('test-exam');
                    
                    if (response.categories.includes(category)) {
                        button.addClass('disabled');
                        button.text('Already Taken');
                    }
                });
            }
        },
        error: function (xhr, status, error) {
            console.log("AJAX Error:", error);
        }
    });
}

function shuffleArray(array) {
    for (let i = array.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [array[i], array[j]] = [array[j], array[i]];
    }
}

function displayQuestions() {
    var containerQuestionnaire = $('#containerQuestionnaire');

    var urlParams = new URLSearchParams(window.location.search);
    var category = urlParams.get("category");

    $.ajax({
        method: "GET",
        data: { category },
        url: "../../includes/load-questions.php",
        dataType: "json",
        success: function (response) {
            // Shuffle the array of questions
            shuffleArray(response);

            $.each(response, function (index, question) {
                var questionIndex = index + 1;
                var questionHTML = `
                    <div class="row my-3">
                        <div class="col">
                            <div class="test-question" data-question-id='${question.id}'>
                                <p>${question.question}</p>
                                <div class="test-choices">
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="question${questionIndex}" id="opt1">
                                        <label class="form-check-label fw-light" for="opt1">${question.opt1}</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="question${questionIndex}" id="opt2">
                                        <label class="form-check-label fw-light" for="opt2">${question.opt2}</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="question${questionIndex}" id="opt3">
                                        <label class="form-check-label fw-light" for="opt3">${question.opt3}</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="question${questionIndex}" id="opt4">
                                        <label class="form-check-label fw-light" for="opt4">${question.opt4}</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                containerQuestionnaire.append(questionHTML);
            });

            var buttonSubmit = `
                <div class="row mt-4 mb-3 text-center">
                    <div class="col">
                        <button type="submit" class="btn btn-success btn-submit">Submit</button>
                    </div>
                </div>
            `;
            containerQuestionnaire.append(buttonSubmit);
        },
        error: function (xhr, status, error) {
            console.log("AJAX Error:", error);
        }
    });
}

var timerStopped = false;
function displayTimer(duration, display) {
    var timer = duration, minutes, seconds;
    var intervalId = setInterval(function () {
        if (timerStopped) {
            clearInterval(intervalId);
            return;
        }
        minutes = parseInt(timer / 60, 10);
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent = minutes + ":" + seconds;

        if (--timer < 0) {
            clearInterval(intervalId);
            $('#modalMessage').modal('show');
            $('#modalMessage').find('p').text('Time is up!').addClass('fw-bold');

            var userEmail = $('.student-index-page').data('user-email');
            var userName = $('.student-index-page').data('user-name');

            var contentHTML = `
                <div class="container-fluid">
                    <div class="row text-center">
                        <div class="col">
                            <input type="hidden" id="userEmail" value="${userEmail}">
                            <input type="hidden" id="userName" value="${userName}">
                            <button type="button" class="btn btn-success btn-test-submit">Submit</button>
                        </div>
                    </div>
                </div>
            `;
            $('#modalMessage').find('.modal-body').append(contentHTML);
        }
    }, 1000);
}

function submitTest() { 
    $(document).on('submit', '#studentTestForm', function (event) {
        event.preventDefault();
        var urlParams = new URLSearchParams(window.location.search);
        var category = urlParams.get("category");
        var selectedAnswers = {};
        var questionIds = [];

        $('.form-check-input:checked').each(function () {
            var questionId = $(this).closest('.test-question').data('question-id');
            var questionIndex = $(this).attr('name');
            var selectedOption = $(this).closest('.form-check').find('label').text();

            selectedAnswers[questionIndex] = selectedOption;
            questionIds.push(questionId);
        });

        var totalQuestions = 5;
        var answeredQuestions = Object.keys(selectedAnswers).length;

        var questionIdsString = questionIds.join('-');
        var questionIdsArray = questionIdsString.split('-');

        if (answeredQuestions < totalQuestions) {
            $('#modalMessage').modal('show');
            setTimeout(function () {
                $('#modalMessage').modal('hide');
            }, 2000);
        } else {
            timerStopped = true;
            $.ajax({
                method: "POST",
                url: "../../includes/evaluate-answers.php",
                data: { test_category: category, questionIdsString, answers: selectedAnswers },
                dataType: "json",
                success: function (response) {
                    if (response.status === 'success') {
                        var modalBody = $('#modalMessage .modal-body');

                        var questions = response.questions;
                        
                        var score = 0;

                        $.each(questionIdsArray, function (index, questionIndex) {
                            var matchingQuestion = questions.find(q => q.question_id === questionIndex);
                        
                            if (matchingQuestion) {
                                var question = matchingQuestion.question;
                                var userAnswersObject = matchingQuestion.user_answers;
                                var correctAnswer = matchingQuestion.correct_answer;
                        
                                var userAnswersArray = Object.values(userAnswersObject);
                                var isCorrect = userAnswersArray[index] === correctAnswer;
                        
                                if (isCorrect) {
                                    console.log("Correct!");
                                    score++;
                                } else {
                                    console.log("Incorrect!");
                                }
                        
                                console.log("");
                            } else {
                                console.log("Question with ID " + questionIndex + " not found.");
                            }
                        });

                        var contentHTML = `
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col">
                                        <p class="mb-0 text-center text-success fw-semibold">Your Score is ${score} out of ${totalQuestions}</p>
                                    </div>
                                </div>
                                <div class="row text-center">
                                    <div class="col">
                                    <input type="hidden" id="userEmail" value="${response.current_user_email}">
                                    <input type="hidden" id="userName" value="${response.current_user_name}">
                                        <button type="button" class="btn btn-success btn-go-back" data-sc="${score}">Go Back</button>
                                    </div>
                                </div>
                            </div>
                        `;
                        modalBody.html(contentHTML);
                        $('#modalMessage').modal('show');
                    }
                },
                error: function (xhr, status, error) {
                    console.log("AJAX Error:", error);
                }
            });
        }
    });

    $(document).on('click', '.btn-test-submit', function () {
        var urlParams = new URLSearchParams(window.location.search);
        var category = urlParams.get("category");
        var selectedAnswers = {};

        $('.form-check-input:checked').each(function () {
            var questionIndex = $(this).attr('name');
            var selectedOption = $(this).next('label').text();
            selectedAnswers[questionIndex] = selectedOption;
        });
        
        $.ajax({
            method: "POST",
            url: "../../includes/submit-answers.php",
            data: { answers: selectedAnswers, test_category: category },
            dataType: "json",
            success: function (response) {
                if (response.status === 'success') {
                    var modalBody = $('#modalMessage .modal-body');
                    var score = 0;

                    $.each(response.correctAnswers, function (questionNo, questionData) {
                        if (selectedAnswers['question' + questionNo] === questionData.answer) {
                            score++;
                        }
                    });

                    var contentHTML = `
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col">
                                    <p class="mb-0 text-center text-success fw-semibold">Your Score is ${score} out of ${response.correctAnswers.length}</p>
                                </div>
                            </div>
                            <div class="row text-center">
                                <div class="col">
                                <input type="hidden" id="userEmail" value="${response.current_user_email}">
                                <input type="hidden" id="userName" value="${response.current_user_name}">
                                    <button type="button" class="btn btn-success btn-go-back" data-sc="${score}">Go Back</button>
                                </div>
                            </div>
                        </div>
                    `;
                    modalBody.html(contentHTML);
                    $('#modalMessage').modal('show');
                }
            },
            error: function (xhr, status, error) {
                console.log("AJAX Error:", error);
            }
        });
    });

    $(document).on('click', '.btn-go-back', function () {
        var button = $(this);
        var modal = button.closest('.modal');

        var user_score = button.data('sc');
        var user_email = modal.find('#userEmail').val();
        var user_name = modal.find('#userName').val();

        var urlParams = new URLSearchParams(window.location.search);
        var category = urlParams.get("category");

        $.ajax({
            method: "POST",
            url: "../../includes/submit-test-results.php",
            data: { user_score, user_email, user_name, category},
            dataType: "json",
            success: function (response) {
                if (response.status === 'success') {
                    button.hide();

                    var contentHTML = `
                        <div class="d-flex align-items-center justify-content-center">
                            <div class="spinner-border text-primary me-4" role="status">
                                <span class="visually-hidden">Loading...</span>
                            </div>
                            <p class="mb-0 text-center">Please wait for a moment...</p>
                        </div>
                    `;
                    modal.find('.modal-body').html(contentHTML);

                    setTimeout(function () {
                        modal.modal('hide');
                        window.location.href = '../student-page/student-take-exam.php';
                    }, 2000);
                }
            },
            error: function (xhr, status, error) {
                console.log("AJAX Error:", error);
            }
        });
    });
}

function displayResults() {
    $.ajax({
        method: "GET",
        url: "../../includes/load-test-results.php",
        dataType: "json",
        success: function (response) {
            var testResultTableBody = $("#testResultTableBody");
            if (response.status === 'success') {
                testResultTableBody.empty();

                if (response.results && response.results.length > 0) {
                    response.results.forEach(function (result) {
                        var row = $("<tr></tr>");
                        row.append("<td>" + result.test_category + "</td>");
                        row.append("<td>" + result.user_score + "</td>");

                        // Format the date
                        var takenDate = new Date(result.taken_at);
                        var formattedDate = takenDate.toLocaleString('en-US', {
                            year: 'numeric',
                            month: 'long',
                            day: 'numeric',
                            hour: '2-digit',
                            minute: '2-digit',
                        });
                        row.append("<td>" + formattedDate + "</td");
                        row.append("<td><button type='button' class='btn btn-primary btn-view-data' data-bs-toggle='modal' data-bs-target='#viewResult' data-test-id=" + result.test_id + "><i class='bi bi-eye-fill'></i></button></td>");

                        testResultTableBody.append(row);
                    });
                } else {
                    var noResultsRow = $("<tr></tr>");
                    noResultsRow.append("<td colspan='6' class='text-danger fw-semibold'>No results found</td>");
                    testResultTableBody.append(noResultsRow);
                }
            } else {
                var noResultsRow = $("<tr></tr>");
                noResultsRow.append("<td colspan='6' class='text-danger fw-semibold'>No results found</td>");
                testResultTableBody.append(noResultsRow);
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", error);
        }
    });
}

function recommendedWorkDescription() {
    $(document).on('click', '.btn-view-data', function () {
        var test_id = $(this).data('test-id');
        var user_email = $('.student-index-page').data('user-email');
        var user_name = $('.student-index-page').data('user-name');

        $.ajax({
            method: "POST",
            url: "../../includes/get-data-results.php",
            data: { test_id, user_email, user_name },
            dataType: "json",
            success: function (response) {
                if (response.status === 'success') {
                    $('#viewResult .modal-title span').text(response.work_recommended);
                    $('.modal-body p').text(response.description);

                    // Open the modal
                    $('#viewResult').modal('show');
                } else {
                    console.log("No result found");
                }
            },
            error: function (xhr, status, error) {
                console.log("AJAX Error:", error);
            }
        });
    });
}
