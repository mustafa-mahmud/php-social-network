<?php

$fname = '';
$lname = '';
$em = '';
$em2 = '';
$pass = '';
$pass2 = '';
$date = '';
$error_array = [];

if (isset($_POST['reg_button'])) {

  //first name
  $fname = strip_tags($_POST['reg_fname']);
  $fname = str_replace(' ', '', $fname);
  $fname = ucfirst(strtolower($fname));
  $_SESSION['reg_fname'] = $fname;

  //last name
  $lname = strip_tags($_POST['reg_lname']);
  $lname = str_replace(' ', '', $lname);
  $lname = ucfirst(strtolower($lname));
  $_SESSION['reg_lname'] = $lname;

  //email
  $em = strip_tags($_POST['reg_email']);
  $em = str_replace(' ', '', $em);
  $em = ucfirst(strtolower($em));
  $_SESSION['reg_email'] = $em;

  //email 2
  $em2 = strip_tags($_POST['reg_email2']);
  $em2 = str_replace(' ', '', $em2);
  $em2 = ucfirst(strtolower($em2));
  $_SESSION['reg_email2'] = $em2;

  //password
  $pass = strip_tags($_POST['reg_password']);

  //password2
  $pass2 = strip_tags($_POST['reg_password2']);

  $date = date('Y-m-d');

  //email varification
  if ($em == $em2) {
    if (filter_var($em, FILTER_VALIDATE_EMAIL)) {
      $em = filter_var($em, FILTER_VALIDATE_EMAIL);

      //ck if email already exists
      $e_check = mysqli_query($con, "SELECT email FROM users WHERE email='$em'");

      //count the number
      $num_rows = mysqli_num_rows($e_check);

      if ($num_rows > 0) {
        array_push($error_array, 'Email already in use<br/>');
      }

    } else {
      array_push($error_array, 'Invalid email format<br/>');
    }
  } else {
    array_push($error_array, 'Email doesn\'t match<br/>');
  }

  //fname verification
  if (strlen($fname) > 25 || strlen($fname) < 2) {
    array_push($error_array, 'Your first name bust be between 2 and 25 characters<br/>');
  }

  //fname verification
  if (strlen($lname) > 25 || strlen($lname) < 2) {
    array_push($error_array, 'Your last name bust be between 2 and 25 characters<br/>');
  }

  //password verification
  if ($pass != $pass2) {
    array_push($error_array, 'Your password does not match<br/>');
  } else {
    if (preg_match('/[^A-Za-z0-9]/', $pass)) {
      array_push($error_array, 'Only alphabet or numbers allowed.<br/>');
    }
  }

  if (strlen($pass) > 30 || strlen($pass) < 5) {
    array_push($error_array, 'Your password must be between 5 and 30<br/>');
  }

  if (empty($error_array)) {
    $pass = md5($pass);
    $username = strtolower($fname . '_' . $lname);

    $ck_username = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
    $i = 0;

    while (mysqli_num_rows($ck_username) != 0) {
      $i++;
      $username = $username . '_' . $i;
      $ck_username = mysqli_query($con, "SELECT username FROM users WHERE username='$username'");
    }

    //Profile picture
    $rand = rand(1, 2);
    if ($rand == 1) {
      $profilePic = 'assets/images/profile_pics/defaults/male.png';
    } elseif ($rand == 2) {
      $profilePic = 'assets/images/profile-pics/defaults/female.png';
    }

    $query = mysqli_query($con, "INSERT INTO users VALUES('','$fname','$lname','$username','$em','$pass','$date','$profilePic','0','0','no',',')");

    array_push($error_array, '<span style="color:green;">Your Registered Successfully.</span>');

    //clear $_SESSION variables
    $_SESSION['reg_fname'] = $_SESSION['reg_lname'] = $_SESSION['reg_email'] = $_SESSION['reg_email2'] = '';

  }

}