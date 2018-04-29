<?php

// Checking for button click. If submit isset.
if( isset($_POST['submit'])) {
    include_once 'dbh.inc.php';

    //Map out fields based on their names into variables
    $first = mysqli_real_escape_string($conn, $_POST['first']);
    $last = mysqli_real_escape_string($conn, $_POST['last']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

    // error handlers
    //Check for empty fields
    if ( empty($first) || empty($last) || empty($email) || empty($uid) || empty($pwd) ) {
        //Return HTTP header if fields are empty
        header("Location: ../index.php?signup=empty");
        exit();        
    } else {
        //Check if input characters are valid
        if (!preg_match("/^[a-zA-Z]*$/", $first) || !preg_match ("/^[a-zA-Z]*$/", $last)) {
            //Return HTTP header if characters aren't accurate
            header("Location: ../index.php?signup=empty");
            exit();       
        } else {
            //Check if email is valid
            if( ! filter_var($email, FILTER_VALIDATE_EMAIL)) {
                //Return HTTP header if email is not valid
                header("Location: ../index.php?signup=email");
                exit();       
            } else {
                // If email is valid, run a query to the database that checks if UID is taken
                $sql = "SELECT * FROM users WHERE user_uid = '$uid' ";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);

                if($resultCheck > 0) {
                    //Return HTTP header if the UID is taken
                    header("Location: ../index.php?signup=usertaken");
                    exit();                           
                } else {
                    //Hashing the password
                    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
                    //Insert the user into the database
                    $sql = "INSERT INTO users (user_first, user_last, user_email, user_uid, user_pwd) VALUES ('$first', '$last', '$email', '$uid', '$hashedPwd');";
                    $result = mysqli_query($conn, $sql);
                    //Return HTTP header if the signup was successful
                    header("Location: ../index.php?signup=success");
                    exit();
                }
            }
        }
    }

} else {
    //Return HTTP header redirecting them to the signup page
    header("Location: ../index.php");
    exit();
}