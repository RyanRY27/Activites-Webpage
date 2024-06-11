<?php 
require "../private/autoload.php";

if (isset($_SESSION['url_add']))
{
	unset($_SESSION['url_add']);
}

if (isset($_SESSION['username']))
{
	unset($_SESSION['username']);
}

    session_start();
    session_destroy();
    unset($_SESSION['facebook_access_token']);
    unset($_SESSION['fb_id']);
    unset($_SESSION['fb_name']) ;
    unset($_SESSION['fb_email']);
    unset($_SESSION['fb_pic']);
    

header("Location: index.php");
die;