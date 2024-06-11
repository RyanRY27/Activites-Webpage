
<?php
require "../private/autoload.php";
$user_log = check_login($con);

// Fetch user data from the database
$username = "";
$email = "";
$password = "";

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];

    // Assuming $con is a PDO object, adjust this based on your actual PDO connection
    $query = "SELECT email, password FROM users WHERE username = :username";
    $stmt = $con->prepare($query);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);

    if ($stmt->execute()) {
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($userData) {
            $email = $userData['email'];
            $password = $userData['password'];
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" >
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha384-3B6NwesSXE7YJlcLI9RpRqGf2p/EgVH8BgoKTaUrmKNDkHPStTQ3EyoYjCGXaOTS" crossorigin="anonymous">

  <title>Dashboard</title>
  <script>
    function changeContent(pageUrl) {
      var contentFrame = document.getElementById('frame_target');
      contentFrame.src = pageUrl;
    }
  </script>
  <script>
    function changeContent(pageUrl) {
      var contentFrame = document.getElementById('frame_target');
      contentFrame.src = pageUrl;
    }

    document.addEventListener("DOMContentLoaded", function () {
      // Get all the nav links
      var navLinks = document.querySelectorAll(".nav-link");

      // Add click event listener to each nav link
      navLinks.forEach(function (navLink) {
        navLink.addEventListener("click", function () {
          // Remove 'active' class from all nav links
          navLinks.forEach(function (link) {
            link.classList.remove("active");
          });

          // Add 'active' class to the clicked nav link
          this.classList.add("active");
        });
      });
    });
  </script>
 <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap">

 <style>
    body {
      font-family: 'Bebas Neue', sans-serif; 
      margin: 0;
      padding: 0;
      background-color: #1e2129; 
      color: white; 
    }

    #frame_target {
      border: 0;
      width: 100%;
      height: 100%;
    }

    #sidebar {
      flex: 20%;
      background-color: #292c34; 
      padding: 10px;
    }
    p {
    	color: white;
    }
    h2 {
      margin-bottom: 20px; 
      font-size: 36px; 
    }

    .nav-pills .nav-link {
      color: white; 
      margin-bottom: 10px; 
      font-family: 'Bebas Neue', sans-serif; 
      font-size: 24px; 
    }

 .nav-pills .nav-link.active,
.nav-pills .nav-link:hover {
  color: #fff;
  background-color: #343a40; /* Set the same color as your active state */
}
    .nav-pills .nav-link:hover {
  background-color: #343a40; 
}

    #content {
      flex: 80%;
      background-color: #343a40; 
      padding: 10px;
    }
        #frame_target {
      border: 0;
      width: 100%;
      height: 100%;
      background-color: whitesmoke;
    }
    form{
    height: 620px;
    width: 400px;
    background-color: #292c34;
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

  </style>
</head>
<body>
	<div style="display: flex; flex-direction: column; height: 100vh;">
    <nav class="navbar navbar-expand-lg bg-body-tertiary" style="min-inline-size:500px; height: 90px;">
      <div class="container-fluid">
        <a class="navbar-brand ms-3" href="index.php" style="color: white; font-size: 25px;">TECHNOLOGICAL UNIVERSITY OF THE PHILIPPINES</a>
        <ul class="navbar-nav ms-auto me-5 pe-2">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color: white; font-size: 25px;">
              Hi, <?=$_SESSION['username']?> <i class="fas fa-user-alt ms-2"></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end">
              <li><a class="dropdown-item" href="profile.php">Profile</a></li>
              <li><a class="dropdown-item" href="profile_edit.php">Profile Settings</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
    <form method="post" class="needs-validation" novalidate>
    <h3>Account Profile</h3>
<div class="form-floating mb-3 mt-5 <?= isset($errors['username']) && $errors['username'] !== '' ? 'border-danger' : '' ?>">
        <input type="text" class="form-control" id="floatingInput" placeholder="username" name="username" value="<?= isset($username) ? htmlspecialchars($username) : '' ?>" disabled>
        <label style="color: black;" for="floatingInput">Username</label>
    </div>

    <div class="form-floating mb-3">
        <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email" value="<?= isset($email) ? htmlspecialchars($email) : '' ?>" disabled>
        <label style="color: black;" for="floatingInput">Email address</label>
    </div>

    <div class="form-floating mb-2 <?= isset($errors['general']) && $errors['general'] !== '' ? 'border-danger' : '' ?>">
        <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" value="<?= isset($password) ? htmlspecialchars($password) : '' ?>" disabled>
        <label style="color: black;" for="floatingPassword">Password</label>
    </div>
    <a href="profile_edit.php">
    <button type="button">Edit</button>
</a>
</form>
</body>
</html>