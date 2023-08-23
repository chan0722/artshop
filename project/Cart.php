<html lang="en">
<head>
    <link rel="stylesheet" href="/project/css/week12_css.css">
    <link rel="stylesheet" href="/project/css/project_sub.css">

    <script>
        window.onload=function(){
            var load = <?php
                session_start();
                if(isset($_SESSION['id'])){
                    echo json_encode("t");
                }else{
                    echo json_encode("f");
                }
            ?>;

            if(load == "t"){
                load_cart();
                var total;
                setTimeout(function(){
                    total = document.getElementById('all_total').innerText;
                    if(total == "RM 0.00"){
                        var pay= document.getElementById('pay');
                        pay.style.display="none";s
                    }
                },100)
                
                
            }else{
                document.getElementsByClassName('cartDisplay')[0].innerHTML = '<p class="mgs" >Pls Login First.</p>';
            }
        }

        function pay_now(uid){
            <?php $_SESSION['pay'] = "T"; ?>
            window.location.href = "/project/paysite.php?uid="+uid;
            
        }

        function delete_btn(itemID){
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if(this.responseText=="done"){
                        window.location.href = "/project/cart.php";
                    }
                }
            }   
            xmlhttp.open("GET", "function.php?q="+<?php if(isset($_SESSION['id'])){
                    echo json_encode($_SESSION["id"]);}
                    else {
                    echo json_encode("\"\"");
                    }?>+"&&op=delete_cart_item&&item="+itemID , true);
            xmlhttp.send();
        }


        function load_cart(){
            var box = document.getElementsByClassName('cartDisplay')[0];
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    box.innerHTML = this.responseText;
                }
            }   
            xmlhttp.open("GET", "function.php?q="+<?php if(isset($_SESSION['id'])){
                    echo json_encode($_SESSION["id"]);}
                    else {
                    echo json_encode("\"\"");
                    }?>+"&&op=loadcart" , true);
            xmlhttp.send();
        }
    </script>

</head>
<body>
    <?php  include ("header.php"); ?>
    <br><br> 
    <br><br>
    <div class="cartDisplay">
            
    </div>
</body>
</html>