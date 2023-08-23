<html lang="en">
<head>
    <link rel="stylesheet" href="/project/css/week12_css.css">
    <link rel="stylesheet" href="/project/css/project_sub.css">
    <script>

        <?php
            session_start();
            if(!isset($_SESSION['new_name'])){
                header("Location: /project/home.php");
            }

        ?>


        window.onload=function(){
            var div =document.getElementById('succ_info');
            div.innerHTML = <?php
                $p="";
                
                $name=$_SESSION['new_name'];
                $name =  strtoupper($name);
                $p.= "<p>Welcome, $name <br><br>Your registration is successful.You can login now!</p>";

                session_destroy();
                $p.="<br>";
                $p.="you will back to login page in 5 sec.";
                echo json_encode($p);
            ?>;
            setTimeout(function() {
                window.location.href = "/project/login.php";
            }, 5000);




        }
    </script>



</head>
<body>


    <?php include('header.php')?>

    <div id="succ_box">
        <div id="succ_info">

        </div>
    </div>



</body>
</html>