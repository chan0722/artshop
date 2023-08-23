<html lang="en">
<head>
    <link rel="stylesheet" href="/project/css/project_sub.css">
    <link rel="stylesheet" href="/project/css/week12_css.css">

    <script>
        window.onload= function(){
            var fail_login = document.getElementById('login_F');
            <?php
                if(isset($_GET['q'])){
                    $login = $_GET['q'];
                    if($login=="F"){
                        $set = "unset";
                    }else{
                        $set = "none";
                    }
                }else{
                    $set = "none";
                }
                    
            ?>

            fail_login.style.display = <?php echo json_encode($set); ?>;
        }
    </script>

</head>
<body>
    <?php include ('header.php');
    session_start(); 
    if(isset($_SESSION['id'])&&isset($_SESSION['name'])){
        header("Location: /project/home.php");
    }
    ?>
    <br><br>

    <div id="login_box">
        <div id="form_box">
            <h1>Log in</h1>
            <div id="login_form">
                <div id="login_F">
                    <p id="error_mgs">Your account and/or password is incorrect,<br> please try again</p>
                </div>
                <form action="function.php?op=login" method="post">
                    <label for="email">Email</label>
                    <br>
                    <input type="email" name="email" id="email" required>
                    <br>
                    <label for="password">Password</label>
                    <br>
                    <input type="password" name="password" id="password" required>
                    <br><br>
                    <button type="submit" id="login_btn">Login</button>
                </form>
                <p id="signup">Don't have an account yet? &nbsp;<a href="signup.php">Sign Up</a></p>
            </div>
        </div>

    </div>


</body>
</html>