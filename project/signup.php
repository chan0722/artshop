<html lang="en">
<head>
    <link rel="stylesheet" href="/project/css/project_sub.css">
    <link rel="stylesheet" href="/project/css/week12_css.css">
    <script>

    window.onload = function(){
        check();

        var c_ph=    <?php
            if(isset($_GET['ph'])){
                if($_GET['ph']=='f'){
                    echo json_encode("f");
                }else{
                    echo json_encode("n");
                }
            }else{
                echo json_encode("n");
            }
        ?>;

        var c_em=    <?php
            if(isset($_GET['em'])){
                if($_GET['em']=='f'){
                    echo json_encode("f");
                }else{
                    echo json_encode("n");
                }
            }else{
                echo json_encode("n");
            }
        ?>;


        if(c_ph == "f"){
            document.getElementsByClassName('ph')[0].style.display="unset";

        }

        if(c_em == "f"){
            document.getElementsByClassName('email')[0].style.display="unset";

        }

    }

    function check(){
        var ps_go = true;
        var age_go = true;
        var age = document.getElementById('age').value;
        var btn = document.getElementById('signup_btn');
        var age_error = document.getElementsByClassName('age_e')[0];

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

        if(parseInt(age) >100 || age == ""||parseInt(age) <=0){
            if(age != ""){
                age_error.style.display="unset";
            }else{
                age_error.style.display="none";
            }
            age_go=false;
        }else{
            age_error.style.display="none";
            btn.disabled = false;
        }

        if(ps_go&&age_go){
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
    <?php session_start(); include('header.php');
     if(isset($_SESSION['id'])&&isset($_SESSION['name'])){
        header("Location: /project/home.php");
    } ?>
    <div id="signup_box">
        <div id="signup_form">
            <h1>Sign Up</h1>
            <div id="form_s">
                <div id="allinfo">
                    <form action="function.php?op=signup" method="post">
                        <label for="f_name">First Name</label>
                        <br>
                        <input type="text" name="f_name" id="f_name" required>
                        <br>
                        <label for="l_name">Last Name </label>
                        <br>
                        <input type="text" name="l_name" id="l_name" required>
                        <br>
                        <label for="age">Age</label>
                        <br>
                        <p class="error age_e">Invalid age.</p>
                        <input type="number" name="age" id="age" required oninput="check()">
                        <br>
                        <label for="ph">Phone Number </label>
                        <br>
                        <p class="error ph">This Phone Number Has used.</p>
                        <input type="number" name="ph" id="ph" required>
                        <br>
                        <label for="addr">Address </label>
                        <br>
                        <textarea name="addr" id="addr" cols="30" rows="10"></textarea>
                        
                        <br>
                        <label for="gender">Gender</label>
                        <br>
                        <select name="gender" id="gender" required>
                            <option></option>
                            <option <?php if (isset($_POST['gender']) && ($_POST['gender']=="Male")) echo "selected"; ?>>Male</option>
                            <option <?php if (isset($_POST['gender']) && ($_POST['gender']=="Female")) echo "selected"; ?>>Female</option>
                            <option <?php if (isset($_POST['gender']) && ($_POST['gender']=="Rather not say")) echo "selected"; ?>>Rather not say</option>
                            
                        </select>
                        <br> 
                        <label for="email">Email</label>
                        <br>
                        <p class="error email">This Email Has used.</p>
                        <input type="email" name="email" id="email" required>
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
                        <button id="signup_btn" type="submit" disabled>Sign Up</button>
                    </form>
                </div>


                
            </div>
        </div>

    </div>    



</body>
</html>