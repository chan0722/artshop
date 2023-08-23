<html lang="en">
<head>
<script src="https://kit.fontawesome.com/10eb8ddb32.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/project/css/project_sub.css">
    <link rel="stylesheet" href="/project/css/week12_css.css">
    
    <script>
        var id;

        function searchItem(){
            var proDisplay = document.getElementById('all_p_list');
            var w = document.getElementById('search_product_bar').value;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    proDisplay.innerHTML = this.responseText;
                }
            }   
            xmlhttp.open("GET", "function_admin.php?q="+w+"&&op=search_all_product" , true);
            xmlhttp.send();
        }

        function add_product(){
            window.location.href="/project/admin/add_product.php";
        }

        function edit_btn(pid){
            window.location.href="/project/admin/edit_product.php?pid="+pid;
        }

        function close_box(){
            document.getElementsByClassName('done_box')[0].style.display="none";
        }

        function delete_btn(pid){
            document.getElementsByClassName('done_box')[0].style.display="unset";
            id = pid;
        }

        function c_delete(){
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    close_box();
                    load_all_product();
                }
            }   
            xmlhttp.open("GET", "function_admin.php?op=delete_product&&pid="+id , true);
            xmlhttp.send();
        }




        function load_out_of_stock(){
            var box = document.getElementById('all_p_list');
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    box.innerHTML=this.responseText;
                }
            }   
            xmlhttp.open("GET", "function_admin.php?op=load_out_of_stock" , true);
            xmlhttp.send();
        }

        function load_all_product(){
            var box = document.getElementById('all_p_list');
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    box.innerHTML=this.responseText;
                }
            }   
            xmlhttp.open("GET", "function_admin.php?op=load_all_product" , true);
            xmlhttp.send();
        }

        window.onload=function(){
            load_all_product();
            var checkbox = document.getElementById('No_stock');
            checkbox.addEventListener('change', function() {
                if (checkbox.checked) {
                    load_out_of_stock();
        
                } else {
                    load_all_product();
                
                }
            });
        }
    </script>


</head>
<body>
<?php
    include("admin_header.php");
    session_start(); 
    if(!isset($_SESSION['adID'])&&!isset($_SESSION['adName'])){
        header("Location: /project/admin/admin_login.php");
    }

?>
    <div id="product_display">
        <input type="text" id="search_product_bar" required placeholder="Product Name">
        <button id="search_product" onclick="searchItem()">search</button>
        <h1 class="p_title">All Product</h1>
        <input type="checkbox" name="No_stock" id="No_stock">
        <label for="No_stock" id="text_outOfStock">Out Of Stock</label>
        <button class="all_add_product" onclick="add_product()">+ Add Product</button>
        
        <div id="all_p_list">
            <!-- <div class="list">
                <img class="all_p_img" src="/project/img/2.jpg">
                <button class="edit_btn" onclick="delete_btn(2)">Edit</button>
                <button class="delete_btn" onclick="delete_btn(2)">Delete</button>
                <p class="all_p_name">Johannes Vermeer, Girl with a Pearl Earring, 1665</p>
                <p class="all_p_desc"> Description : The ur-canvas of 20th-century art, Les Demoiselles d’Avignon ushered in the modern era by decisively breaking with the representational tradition of W</p>
                <p class="p_price">Price: RM 111111111 </p>
                <p class="out_of_stock">This Item is out of stock ! </p>
            </div> -->
        </div>
    </div>
    <div class="done_box">
        <div class="done_info">
            <p>Are you sure you want to delete this item ?</p>
            <button id="btn_yes" onclick="c_delete()">Yes</button>
            <button id="btn_no" onclick="close_box()">No</button>
        </div>
    </div>


</body>
</html>