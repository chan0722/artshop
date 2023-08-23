<html lang="en">
<head>
    <link rel="stylesheet" href="/project/css/week12_css.css">
    <link rel="stylesheet" href="/project/css/project_sub.css">
    <script>

        <?php
            session_start();
            if(!isset($_SESSION['id'])&&!isset($_SESSION['name'])){
                header("Location: /project/home.php");
            }

        ?>


        window.onload=function(){
            var div =document.getElementById('logout_info');
            div.innerHTML = <?php
                $p="";
                
                $name=$_SESSION['name'];
                $name =  strtoupper($name);
                $p.= "<p>Good Bye,$name <br><br>Please come again.Thank you!</p>";

                session_destroy();
                $p.="<br>";
                $p.="you will back to home page in 5 sec.";
                echo json_encode($p);
            ?>;
            setTimeout(function() {
                window.location.href = "/project/home.php";
            }, 5000);




        }
    </script>



</head>
<body>


    <?php include('header.php')?>

    <div id="logout_box">
        <div id="logout_info">

        </div>
    </div>



</body>
</html>