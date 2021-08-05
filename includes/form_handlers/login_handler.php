<?php

if (isset($_POST["login_button"])) {
    $email = filter_var($_POST["log_email"], FILTER_SANITIZE_EMAIL);

    $_SESSION['log_email'] = $email;
    $password = md5($_POST["log_password"]);

    $ckDBQuery = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND password='$password'");
    $ckQuery = mysqli_num_rows($ckDBQuery);

    if ($ckQuery == 1) {
        $row = mysqli_fetch_array($ckDBQuery);
        $username = $row['username'];

        $userClosedAccount = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND user_closed='yes' ");

        if (mysqli_num_rows($userClosedAccount) === 1) {
            $reopenAccount = mysqli_query($con, "UPDATE users SET user_closed='no' WHERE email='$email' ");
        }

        $_SESSION['username'] = $username;
        header('location:index.php');
        exit();
    } else {
        array_push($error_array, 'Email or password is incorrect!');
    }
}