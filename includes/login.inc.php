<?php

session_start();

if(isset($_POST['submit'])) {
    include 'dbh.inc.php';
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

    // Error handlers
    if(empty($uid) || empty($pwd)) {
        //Check if inputs are empty
        header("Location: ../index.php?login=empty");
        exit();    
    } else {
        // Run a query to check if uid exists
        $sql = "SELECT * FROM users WHERE user_uid = '$uid' OR user_email = '$uid'";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);
        if($resultCheck < 1) {
            // If uid doesn't exist, throw an error without being too descriptive. Hence, error.
            header("Location: ../index.php?login=error");
            exit();                    
        } else  {
            if($row = mysqli_fetch_assoc($result)) {
                //Dehashing the password
                $hashedPwdCheck = password_verify($pwd, $row['user_pwd']);
                if($hashedPwdCheck = false) {
                    //Hashed password returns true or false, if false. Vague error
                    header("Location: ../index.php?login=error");
                    exit();                                                
                } else if ($hashedPwdCheck = true) {
                    // Running an else if statement to be sure it's the correct password
                    //Log in the user here
                    $_SESSION['u_id'] = $row['user_id'];
                    $_SESSION['u_first'] = $row['user_first'];
                    $_SESSION['u_last'] = $row['user_last'];
                    $_SESSION['u_email'] = $row['user_email'];
                    $_SESSION['u_uid'] = $row['user_uid'];
                    header("Location: ../index.php?login=success");
                    exit();                                                
                }
            }
        }
    }    
} else {
    // if error when logging in
    header("Location: ../index.php?login=error");
    exit();
}