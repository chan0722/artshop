<html lang="en">
<head>
    <link rel="stylesheet" href="/project/css/project_sub.css">
    
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
<?php
    session_start(); 
    if(isset($_SESSION['adID'])&&isset($_SESSION['adName'])){
        header("Location: admin_product.php");
    }
?>
    <br><br><br><br><br>
<div id="login_box">
    <div id="form_box">
        <h1>Admin Login</h1>
        <div id="login_form_admin">
            <div id="login_F">
                <p id="error_mgs">Your account and/or password is incorrect,<br> please try again</p>
            </div>
            <form action="function_admin.php?op=admin_login" method="post">
                <label for="adminID">Admin ID</label>
                <br>
                <input type="adminID" name="adminID" id="adminID" required>
                <br>
                <label for="password">Password</label>
                <br>
                <input type="password" name="password" id="password" required>
                <br><br>
                <button type="submit" id="login_btn">Login</button>
            </form>
            
        </div>
    </div>

</div>

    
</body>
</html>