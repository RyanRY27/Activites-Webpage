<?php

	require "../private/autoload.php";
	$user_log = check_login($con);

	$username = "";	
	if (isset($_SESSION['username']))
	{
		$username = $_SESSION['username'];
	}

	$activePage = isset($_GET['page']) ? $_GET['page'] : 'main';
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
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
      background-color: #343a40;
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

    <div style="flex: 85%; display: flex;">
      <div id="sidebar">
        <h2 style="margin-top: 20px;">My Laboratory Exercises</h2>
        <ul class="nav nav-pills flex-column">
           <li class="nav-item">  
            <a class="nav-link <?php echo ($activePage === 'main') ? 'active' : ''; ?>"
              href="javascript:void(0);" onclick="changeContent('lab4old/frame_target.html')">Main</a>
          </li>
        
             <li class="nav-item">
            <a class="nav-link <?php echo ($activePage === 'lab1') ? 'active' : ''; ?>"
              href="javascript:void(0);" onclick="changeContent('lab1/lab1.html')">Lab1RMJD</a>
          </li>
         
             <li class="nav-item">
            <a class="nav-link <?php echo ($activePage === 'lab2') ? 'active' : ''; ?>"
              href="javascript:void(0);" onclick="changeContent('lab2/lab2.html')">Lab2RMJD</a>
          </li>
        
             <li class="nav-item">
            <a class="nav-link <?php echo ($activePage === 'lab3') ? 'active' : ''; ?>"
              href="javascript:void(0);" onclick="changeContent('lab3/lab3.html')">Lab3RMJD</a>
          </li>
   
             <li class="nav-item">
            <a class="nav-link <?php echo ($activePage === 'lab5.1') ? 'active' : ''; ?>"
              href="javascript:void(0);" onclick="changeContent('lab5/lab5.html')">Lab5.1RMJD</a>
          </li>
         
             <li class="nav-item">
            <a class="nav-link <?php echo ($activePage === 'lab5.2') ? 'active' : ''; ?>"
              href="javascript:void(0);" onclick="changeContent('lab5.2/5.2.html')">Lab5.2RMJD</a>
          </li>
        
             <li class="nav-item">
            <a class="nav-link <?php echo ($activePage === 'lab6') ? 'active' : ''; ?>"
              href="javascript:void(0);" onclick="changeContent('lab6Practical/lab6.html')">Lab6aRMJD</a>
          </li>
  
             <li class="nav-item">
            <a class="nav-link <?php echo ($activePage === 'lab6b') ? 'active' : ''; ?>"
              href="javascript:void(0);" onclick="changeContent('lab6Practical/lab6b.html')">Lab6bRMJD</a>
          </li>
   
             <li class="nav-item">
            <a class="nav-link <?php echo ($activePage === 'sched') ? 'active' : ''; ?>"
              href="javascript:void(0);" onclick="changeContent('sched/sched.html')">Schedule</a>
          </li>
          
        </ul>
      </div>

      <div id="content">
        <iframe id="frame_target" name="frame_target" src="lab4old/frame_target.html"></iframe>
      </div>
    </div>
  </div>
</body>

</html>
