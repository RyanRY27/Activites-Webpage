<?php

require "../private/autoload.php";

$errors = [];
$email = "";
$username = "";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = isset($_POST['email']) ? $_POST['email'] : "";
    $username = isset($_POST['username']) ? trim($_POST['username']) : "";
    $password = isset($_POST['password']) ? esc($_POST['password']) : "";

    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Please enter a valid email.";
    }

    $date = date("Y-m-d H:i:s");
    $url_add = random_string(60);

    if (empty($username) || !preg_match("/^[a-zA-Z0-9 ]+$/", $username)) {
        $errors['username'] = "Please enter a valid username.";
    } else {
        // Check email existence
        $query = "SELECT * FROM users WHERE email = :email LIMIT 1";
        $arr = ['email' => $email];
        $stm = $con->prepare($query);
        $check = $stm->execute($arr);

        if ($check) {
            $data = $stm->fetchAll(PDO::FETCH_OBJ);
            if (is_array($data) && count($data) > 0) {
                $errors['email'] = "Email already in use.";
            }
        }

        // Check username existence
        $query = "SELECT * FROM users WHERE username = :username LIMIT 1";
        $arr = ['username' => $username];
        $stm = $con->prepare($query);
        $check = $stm->execute($arr);

        if ($check) {
            $data = $stm->fetchAll(PDO::FETCH_OBJ);
            if (is_array($data) && count($data) > 0) {
                $errors['username'] = "Username already in use.";
            }
        }
    }

    if (empty($errors)) {
        $name = ""; 
        $arr = [
            'url_add' => $url_add,
            'username' => $username,
            'password' => $password,
            'name' => $name,
            'email' => $email,
            'date' => $date
        ];

        $query = "INSERT INTO users (url_add, username, password, name, email, date) VALUES (:url_add, :username, :password, :name, :email, :date)";
        $stm = $con->prepare($query);
        $stm->execute($arr);

        header("Location: login.php");
        die;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>

    <title>Sign Up</title>
 
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
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
    height: 620px;
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
    <h3>Sign Up Here</h3>

<div class="form-floating mb-3 mt-5 <?= isset($errors['username']) && $errors['username'] !== '' ? 'border-danger' : '' ?>">
    <input type="text" class="form-control <?= isset($errors['username']) && $errors['username'] !== '' ? 'border-danger' : '' ?>" id="floatingInput" placeholder="username" name="username" value="<?= isset($username) ? htmlspecialchars($username) : '' ?>" required>
    <label style="color: black;" for="floatingInput">Username</label>
    <?php if (isset($errors['username']) && $errors['username'] !== '') : ?>
        <small class="text-danger"><?= $errors['username'] ?></small>
    <?php endif; ?>
</div>

<div class="form-floating mb-3 <?= isset($errors['email']) && $errors['email'] !== '' ? 'border-danger' : '' ?>">
    <input type="email" class="form-control <?= isset($errors['email']) && $errors['email'] !== '' ? 'border-danger' : '' ?>" id="floatingInput" placeholder="name@example.com" name="email" value="<?= isset($email) ? htmlspecialchars($email) : '' ?>" required>
    <label style="color: black;" for="floatingInput">Email address</label>
    <?php if (isset($errors['email']) && $errors['email'] !== '') : ?>
        <small class="text-danger"><?= $errors['email'] ?></small>
    <?php endif; ?>
</div>

<div class="form-floating mb-2 <?= isset($errors['general']) && $errors['general'] !== '' ? 'border-danger' : '' ?>">
    <input type="password" class="form-control <?= isset($errors['general']) && $errors['general'] !== '' ? 'border-danger' : '' ?>" id="floatingPassword" placeholder="Password" name="password" required>
    <label style="color: black;" for="floatingPassword">Password</label>
</div>

<?php if (isset($errors['general']) && $errors['general'] !== '') : ?>
    <div class="text-danger"><?= $errors['general'] ?></div>
<?php endif; ?>
    <button type="submit" value="Log In">Sign Up</button>
    <div><br>
        <span>Already have an account? <a href="login.php">Login Here!</a></span>
    </div>
</form>
</body>
</html>
