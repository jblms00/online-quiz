$(document).ready(function () {
    loginAccount();

    // Show and Hide Password
    $('.toggle-password').click(function () {
        var passwordInput = $('#userPassword');
        if (passwordInput.attr('type') === 'password') {
            passwordInput.attr('type', 'text');
        } else {
            passwordInput.attr('type', 'password');
        }
    });

    // Reset Login Inputs when Modal is Hidden
    $('#modalLogin').on('hidden.bs.modal', function () {
        $('#userEmail').val('');
        $('#userPassword').val('');
    });
});


function loginAccount() {
    $(document).on('click', '.btn-login', function () {
        var button = $(this);
        var modal = button.closest('.modal');
        var showPasswordDiv = modal.find('.show-password');
        var errorContent = showPasswordDiv.find('.text-danger');
        var links = button.closest('.index-page').find('a');

        var userEmailInput = $('#userEmail');
        var userPasswordInput = $('#userPassword');

        $.ajax({
            method: "POST",
            url: "../includes/user-login-account.php",
            data: { 
                user_email: userEmailInput.val(),
                user_password: userPasswordInput.val() 
            },
            dataType: "json",
            success: function (response) {
                if (response.status === 'success') {
                    modal.find('button, input, select').prop('disabled', true);
                    links.on('click', function(event) {
                        event.preventDefault();
                    });

                    var modalBody = modal.find('.modal-body');
                    
                    var loader = `
                        <div class="load-container">
                            <div class="outer-ring">
                            </div>
                        </div>
                        <p class="text-center mb-0 fw-semibold">Please wait for a moment..</p>
                    `;
                    modalBody.html(loader);

                    if (response.user_type === 'student') {
                        setTimeout(function() {
                            window.location.href = '../pages/student-page/student-index-page.php';
                        }, 2000);
                    } else {
                        setTimeout(function() {
                            window.location.href = '../pages/admin-page/admin-index-page.php';
                        }, 2000);
                    }
                } else {
                    if (errorContent.length) {
                        errorContent.text(response.message);
                    } else {
                        errorContent = $('<p class="mb-0 mt-3 text-danger text-center fw-bold">' + response.message + '</p>');
                        showPasswordDiv.append(errorContent);
                    }
                    errorContent.fadeIn(200).delay(1000).fadeOut(200, function () {
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
