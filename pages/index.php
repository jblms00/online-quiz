<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS and Bootstrap -->
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <title>What Can I?</title>
</head>

<body class="index-page">
    <nav>
        <a class="navbar-brand" href="#">What Can I?</a>
        <ul class="nav-links">
            <li class="link">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                    data-bs-target="#modalLogin">Login</button>
            </li>
        </ul>
    </nav>
    <section class="container">
        <div class="content-container">
            <h1>
                Best Skills<br>
                <span class="heading-1">Determiner Platform</span><br>
                <span class="heading-2">in the World</span>
            </h1>
            <p>
                Unlock your full learning potential with our intuitive skills assessment platform.
                Seamlessly blending technology and education, we provide an immersive educational
                Environment that gives suggestions and recommendations that suits their skills.
            </p>
        </div>
        <div class="image-container">
            <img src="../css/assets/download.jpg" alt="Image">
            <img src="../css/assets/images.jpg" alt="Image">
            <div class="image-content">
                <ul class="p-0">
                    <li>Determine your Area of Expertise</li>
                    <li>Free Assessment Test</li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Login Modal -->
    <div class="modal fade" id="modalLogin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-login">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="userEmail" placeholder="name@example.com"
                            autocomplete="off">
                        <label for="userEmail">Email address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="userPassword" placeholder="Password"
                            autocomplete="off">
                        <label for="userPassword">Password</label>
                        <div class="show-password ms-1 mt-2" data-aos="fade-down">
                            <input type="checkbox" class="toggle-password" id="showPassword">
                            <label for="showPassword">Show Password</label>
                        </div>
                    </div>
                    <div class="form-floating form-login">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success btn-login">Sign in</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>


<script src="../js/jquery-3.6.1.min.js"></script>
<script src="../js/popper.min.js"></script>
<script src="../js/bootstrap.bundle.min.js"></script>
<script src="../js/login.js"></script>

</html>