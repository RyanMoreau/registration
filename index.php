<?php 
    include_once 'header.php';
?>
<div class="form-wrapper">
    <div class="tabs">
        <ul id="tabs-nav">
            <li>
                <a href="#register">
                    <i class="fas fa-user-circle"></i>
                </a>
            </li>
            <li>
                <a href="#logging">
                    <?php
                        if(isset($_SESSION['u_id'])) {
                            echo '<i class="fas fa-unlock"></i>';
                        } else {
                            echo '<i class="fas fa-lock"></i>';
                        }
                    ?>    
                </a>
            </li>
        </ul> <!-- END tabs-nav -->
        <div id="tabs-content">
            <div id="register" class="tab-content">
                <h2>Register</h2>
                    <?php
                        if(isset($_SESSION['u_id'])) {
                            echo '<p>You are already registered!</p>';
                        } else {
                            echo '
                            <form class="register-form" method="POST" action="includes/signup.inc.php">
                                <input type="text" name="first" placeholder="First Name">
                                <input type="text" name="last" placeholder="Last Name">
                                <input type="text" name="email" placeholder="Email">
                                <input type="text" name="uid" placeholder="Username">
                                <input type="password" name="pwd" placeholder="Password">
                                <button type="submit" name="submit">Signup</button>
                            </form>';
                        }
                    ?>
            </div>
            <div id="logging" class="tab-content">
                <h2>Your Account</h2>
                    <?php 
                        if(isset($_SESSION['u_id'])) {
                            echo "<div class='account-tab'>
                            <p>Hey {$_SESSION['u_first']} {$_SESSION['u_last']}! Or should we call you {$_SESSION['u_uid']} 😉<br>
                            Your email({$_SESSION['u_email']}) will be our little secret.</p>
                            <form action='includes/logout.inc.php' method='post'>
                                <button type='submit' name='submit'>Log Out</button>
                            </form>
                            </div>";                        
                        } else {
                        echo "<div class='account-tab'> 
                        <form method='post' action='includes/login.inc.php'>
                            <input type='text' name='uid' placeholder='Username or Email'>
                            <input type='password' name='pwd' placeholder='Password'>
                            <button type='submit' name='submit'>Login</button>
                        </form>
                        </div>";
                    }
                    ?>    
            </div>
        </div> <!-- END tabs-content -->
    </div> <!-- END tabs -->
</div> <!-- END wrapper -->
<?php 
    include_once 'footer.php';
?>