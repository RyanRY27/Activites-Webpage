<?php
    require "../private/autoload.php";
    $errors = array();

    if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_SESSION['token']) && isset($_POST['token']) && $_SESSION['token'] == $_POST['token']) {
        $email = $_POST['email'];
        $password = esc($_POST['password']);

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "Please enter a valid email";
        }

        if (empty($errors)) {
            $arr['password'] = $password;
            $arr['email'] = $email;

            $query = "SELECT * FROM users WHERE email = :email AND password = :password LIMIT 1";
            $stm = $con->prepare($query);
            $check = $stm->execute($arr);

            if ($check) {
                $data = $stm->fetchAll(PDO::FETCH_OBJ);
                if (is_array($data) && count($data) > 0) {
                    $data = $data[0];
                    $_SESSION['username'] = $data->username;
                    $_SESSION['url_add'] = $data->url_add;
                    header("Location: index.php");
                    die;
                }
            }

            $errors['general'] = "Wrong email or password";
        }
    }

    $_SESSION['token'] = random_string(60);
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <title>Log In</title>
 
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
	 <script src="https://apis.google.com/js/platform.js" async defer></script>
<script>
    (() => {
        'use strict';

        
        const forms = document.querySelectorAll('.needs-validation');

        // Loop over them and prevent submission
        Array.from(forms).forEach(form => {
            form.addEventListener('submit', event => {
                if (!form.checkValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }

                form.classList.add('was-validated');
            }, false);
        });
    })();
 <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>

    <script>
window.fbAsyncInit = function() {
    FB.init({
        appId: '1181705126278738',
        autoLogAppEvents: true,
        xfbml: true,
        version: 'v18.0'
    });

    FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
    });
};

function checkLoginState() {
    FB.getLoginStatus(function(response) {
        statusChangeCallback(response);
    });
}

function handleError(error) {
    console.error('Facebook SDK initialization error:', error);
}

function statusChangeCallback(response) {
    console.log('Facebook login status change:', response);
    if (response.status === 'connected') {
        // User is logged in, you can proceed with your logic
    } else {
        // User is not logged in, handle accordingly
    }
}

// Load the SDK asynchronously
(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "https://connect.facebook.net/en_US/sdk.js";
    js.onerror = handleError;
    fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));



    </script>

    <!--Stylesheet-->
    <style media="screen">
      *,
*:before,
*:after{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
}
body{
    background-color: #080710;
}
.background{
    width: 430px;
    height: 520px;
    position: absolute;
    transform: translate(-50%,-50%);
    left: 50%;
    top: 50%;
}
.background .shape{
    height: 200px;
    width: 200px;
    position: absolute;
    border-radius: 50%;
}
.shape:first-child{
    background: linear-gradient(
        #1845ad,
        #23a2f6
    );
    left: -80px;
    top: -80px;
}
.shape:last-child{
    background: linear-gradient(
        to right,
        #ff512f,
        #f09819
    );
    right: -30px;
    bottom: -80px;
}
form{
    height: 540px;
    width: 400px;
    background-color: rgba(255,255,255,0.13);
    position: absolute;
    transform: translate(-50%,-50%);
    top: 50%;
    left: 50%;
    border-radius: 10px;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255,255,255,0.1);
    box-shadow: 0 0 40px rgba(8,7,16,0.6);
    padding: 50px 35px;
}
form *{
    font-family: 'Poppins',sans-serif;
    color: #ffffff;
    letter-spacing: 0.5px;
    outline: none;
    border: none;
}
form h3{
    font-size: 32px;
    font-weight: 500;
    line-height: 42px;
    text-align: center;
}


input{
    display: block;
    height: 50px;
    width: 100%;
    background-color: rgba(255,255,255,0.07);
    border-radius: 3px;
    padding: 0 10px;
    margin-top: 8px;
    font-size: 14px;
    font-weight: 300;
}
::placeholder{
    color: #e5e5e5;
}
button{
    margin-top: 50px;
    width: 100%;
    background-color: #ffffff;
    color: #080710;
    padding: 15px 0;
    font-size: 18px;
    font-weight: 600;
    border-radius: 5px;
    cursor: pointer;
}
.social{
  margin-top: 30px;
  display: flex;
}
.social div{
  background: red;
  width: 150px;
  border-radius: 3px;
  padding: 5px 10px 10px 5px;
  background-color: rgba(255,255,255,0.27);
  color: #eaf0fb;
  text-align: center;
}
.social div:hover{
  background-color: rgba(255,255,255,0.47);
}
.social .fb{
  margin-left: 25px;
}
.social i{
  margin-right: 4px;
}

    </style>
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form method="post" class="needs-validation" novalidate>
        <h3>Login Here</h3>
<div class="form-floating mb-4 mt-5 <?= (isset($errors['email']) && $errors['email'] !== '') || (isset($errors['general']) && $errors['general'] !== '') ? 'border-danger' : '' ?>">
    <input type="email" class="form-control <?= isset($errors['email']) && $errors['email'] !== '' ? 'border-danger' : '' ?>" id="floatingInput" placeholder="name@example.com" name="email" value="<?= isset($email) ? htmlspecialchars($email) : '' ?>" required> 
    <label style="color: black;" for="floatingInput">Email address</label>
    <?php if (isset($errors['email']) && $errors['email'] !== '') : ?>
        <small class="text-danger"><?= $errors['email'] ?></small>
    <?php endif; ?>
</div>

<div class="form-floating mb-4 <?= isset($errors['general']) && $errors['general'] !== '' ? 'border-danger' : '' ?>">
    <input type="password" class="form-control <?= isset($errors['general']) && $errors['general'] !== '' ? 'border-danger' : '' ?>" id="floatingPassword" placeholder="Password" name="password" required>
    <label style="color: black;" for="floatingPassword">Password</label>
</div>

<?php if (isset($errors['general']) && $errors['general'] !== '') : ?>
    <div class="text-danger"><?= $errors['general'] ?></div>
<?php endif; ?>



		<input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">   
		 <!-- Add the Facebook login button -->
        <div class="fb-login-button" data-width="" data-size="large" data-button-type="login_with" data-layout="default" data-auto-logout-link="true" data-use-continue-as="false"></div>


        <!-- Add the Google Sign-In button -->
        <div class="g-signin2" data-onsuccess="onSignIn"></div>
 
		<button type="submit" value="Log In">Log In</button>      
		<div><br>
		    <span>Don't have an account? <a href="signup.php">Sign up here </a></span>
		</div>

		<!-- Load the JS SDK asynchronously -->
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>

    </form>
</body>
</html>
