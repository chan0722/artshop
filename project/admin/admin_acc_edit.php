<html lang="en">
<head>
    <?php
        session_start(); 
        if(!isset($_SESSION['adID'])&&!isset($_SESSION['adName'])){
            header("Location: /project/admin/admin_login.php");
        }

        $servername = "127.0.0.1:3307";
        $username = "root";
        $password = "root";
        $db_name = "Chan_art";
        $q = $_GET["aid"];
        $conn = new mysqli($servername, $username, $password,$db_name);
        $sql = "SELECT * FROM `admin` where admin_id = '$q'";

        if ($result = mysqli_query($conn, $sql)) {
            if(mysqli_num_rows($result) == 0){
                
                header("Location: /project/admin/admin_acc.php");
                
            }

        }

        
    ?>
    <link rel="stylesheet" href="/project/css/project_sub.css">
    <link rel="stylesheet" href="/project/css/week12_css.css">
    <script>
        
        
        

        function load_page(){
            var box = document.getElementById('allinfo');
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    box.innerHTML=this.responseText;
                  
                }
            }   
            xmlhttp.open("GET", "function_admin.php?op=edit_admin_acc_load&&aid="+"<?php 
            if(!isset($_GET['aid'] )){
                header("Location: /project/admin/admin_acc.php");
            }else{
                echo $_GET['aid'];
            }
            ?>", true);
            xmlhttp.send();
            
        }

        window.onload = function(){
            load_page();
            
            setTimeout(function (){
                check();


                var c_em=<?php
                    if(isset($_GET['id'])){
                        if($_GET['id']=='f'){
                            echo json_encode("f");
                        }else{
                            echo json_encode("n");
                        }
                    }else{
                        echo json_encode("n");
                    }
                ?>;



                if(c_em == "f"){
                    document.getElementsByClassName('adidd')[0].style.display="unset";

                }
            },150);

        }


    function check(){
        var ps_go = true;
        var btn = document.getElementById('signup_btn');
        var ps = document.getElementById('ps').value;
        var ps_c = document.getElementById('ps_c').value;
        var ps_error_len = document.getElementsByClassName('ps_len')[0];
        var ps_error_c=document.getElementsByClassName('ps')[0];

        var ps_len = ps.length;
        if(ps!=""&&ps_len <8){
            ps_error_len.style.display = "unset";
            ps_go = false;
        }else{
            ps_error_len.style.display= "none";
        }

        if(ps=="" || ps_c==""){
            ps_go = false;
        }

        if(ps!=""&&ps != ps_c){
            ps_error_c.style.display= "unset";
           
            ps_go = false;
        }else{
            ps_error_c.style.display= "none";
        }

        if(ps_go){
            btn.disabled = false;
            btn.style.backgroundColor="black";
        }else{
            btn.style.backgroundColor="rgba(0,0,0,.26)";
            btn.disabled = true;
        }



    }
    </script>

</head>
<body>
<?php
    include("admin_header.php");
?>

<div id="edit_box">
    <br>
    <center>
    <h1>Edit admin Account</h1>
    </center>
    <br>
    <div class="get_c">
        <div id="form_s">
            <div id="allinfo">
                <form action="function_admin.php?op=edit_admin_acc&&aid=" method="post">
                    <label for="adid">Admin ID</label>
                    <br>
                    <p class="error adidd">This Admin id has used.</p>
                    <input type="text" name="adid" id="adid" required>
                    <br>

                    <label for="name">Name</label>
                    <br>
                    <input type="text" name="name" id="name" required>
                    <br>
                    
                    <label for="ps">Password</label>
                    <br>
                    <p class="error ps_len">Password need at least 8 characters.</p>
                    <input type="password" name="ps" id="ps" required oninput="check()">
                    <br>
                            
                    <label for="ps_c">Confirm password</label>
                    <br>
                    <p class="error ps">Confirm password is not same as Password.</p>
                    <input type="password" name="ps_c" id="ps_c" required oninput="check()">
                    <br>
                    <br>
                    <button id="signup_btn" type="save" disabled>Sign Up</button>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>