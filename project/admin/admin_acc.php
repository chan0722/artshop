<html lang="en">
<head>
<?php
    session_start(); 
    if(!isset($_SESSION['adID'])&&!isset($_SESSION['adName'])){
        header("Location: /project/admin/admin_login.php");
    }  
?>
    <script>
        var user_id = 0;
        function delete_cus_acc(uid){
            user_id = uid;
            document.getElementsByClassName('done_box')[0].style.display="unset";
            
        }

        function delete_admin_acc(aid){
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    
                    if(this.responseText === "done"){
                        load_admin_table();
                    }
                    
                }
            }   
            xmlhttp.open("GET", "function_admin.php?op=delete_admin_acc&&aid="+aid, true);
            xmlhttp.send();
        }

        function edit_cus_acc(uid){
            window.location.href="cus_edit.php?uid="+uid;
        }

        function close_box(){
            document.getElementsByClassName('done_box')[0].style.display="none";
        }

        function c_delete(){
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if(this.responseText === "done"){
                        close_box();
                        load_cus_table();
                    }
                    
                }
            }   
            xmlhttp.open("GET", "function_admin.php?op=delete_cus&&uid="+user_id, true);
            xmlhttp.send();
        }

        

        function load_cus_table(){
            var box = document.getElementById('cus_box_info');
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    box.innerHTML=this.responseText;
                    
                }
            }   
            xmlhttp.open("GET", "function_admin.php?op=load_cus_table", true);
            xmlhttp.send();
        }

        function admin_edit_btn(id){
            window.location.href="admin_acc_edit.php?aid="+id;
        }

        function load_admin_table(){
            var box = document.getElementById('admin_box_info');
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    box.innerHTML=this.responseText;
                    
                }
            }   
            xmlhttp.open("GET", "function_admin.php?op=load_admin_table", true);
            xmlhttp.send();
        }

        function search_cus_acc(){
            var t = document.getElementById('search_cus_bar').value;
            if(t == ""){
                load_cus_table();
            }else{
                var box = document.getElementById('cus_box_info');
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        box.innerHTML=this.responseText;
                        
                    }
                }   
                xmlhttp.open("GET", "function_admin.php?op=search_cus_acc&&em="+t, true);
                xmlhttp.send();
            }
            
        }


        function search_admin_acc(){
            var t = document.getElementById('search_admin_bar').value;
            if(t == ""){
                load_admin_table();
            }else{
                var box = document.getElementById('admin_box_info');
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        box.innerHTML=this.responseText;
                        
                    }
                }   
                xmlhttp.open("GET", "function_admin.php?op=search_admin_acc&&id="+t, true);
                xmlhttp.send();
            }
            
        }

        function add_admin(){
            window.location.href="add_admin_acc.php";
        }


        window.onload=function(){
            load_cus_table();
            load_admin_table();
        }

        
    </script>

    <link rel="stylesheet" href="/project/css/week12_css.css">
    <link rel="stylesheet" href="/project/css/project_sub.css">
</head>
<body>
<?php include ('admin_header.php') ?>   
<br><br>
<h2 class="acc_h">Customer Account</h2>
<input type="text" class="s_input" id="search_cus_bar" placeholder="Search By Email" required>
<button class="s_btn" onclick="search_cus_acc()">search</button>
<div class="get_c" id="cus_box_info">
<!--     <div id="Cus_acc_box">
        <table>
            <thead>
                <tr>
                    <td>Name</td>
                    <td>Phone Number</td>
                    <td>Age</td>
                    <td>Email</td>
                    <td></td>
                </tr>
            </thead>

            <tbody>
                
                <tr>
                    <td>Chanyongcheng</td>
                    <td>69696969</td>
                    <td>21</td>
                    <td>xman2338@gmail.com</td>
                    <td class="acc_btn"><button class="edit_btn_acc">edit</button> <button class="delete_btn_acc">delete</button></td>
                </tr>
               
            </tbody>
        </table>
    </div> -->
</div>

<br><br>
<h2 class="acc_h">Admin Account</h2>

<input type="text" class="s_input" id="search_admin_bar" required placeholder="Search By Admin ID">
<button class="s_btn" onclick="search_admin_acc()" >search</button>
<button class="all_add_product" onclick="add_admin()">+ Add Admin</button>
<div class="get_c" id="admin_box_info">
    <!-- <div id="admin_acc_box">
        <table>
            <thead>
                <tr>
                    <td>Name</td>
                    <td>Phone Number</td>
                    <td>Age</td>
                    <td>Email</td>
                    <td></td>
                </tr>
            </thead>

            <tbody>
                
                <tr>
                    <td>Chanyongcheng</td>
                    <td>69696969</td>
                    <td>21</td>
                    <td>xman2338@gmail.com</td>
                    <td class="acc_btn"><button class="edit_btn_acc">edit</button> <button class="delete_btn_acc">delete</button></td>
                </tr>
               
            </tbody>
        </table>
    </div> -->
</div>

<div class="done_box">
        <div class="done_info">
            <p>Are you sure you want to delete this Account ?</p>
            <button id="btn_yes" onclick="c_delete()">Yes</button>
            <button id="btn_no" onclick="close_box()">No</button>
        </div>
    </div>
</body>
</html>