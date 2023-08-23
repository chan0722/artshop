<html lang="en">
<head>
    <link rel="stylesheet" href="/project/css/week12_css.css">
    <link rel="stylesheet" href="/project/css/project_sub.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script>




        function addTocart(itemID){

            
            var input = document.getElementById('qtp').value;
            var s =
            <?php
                session_start();
                if(!isset($_SESSION['id'])){
                    echo json_encode("F");
                }else{
                    echo json_encode("T");
                }
            ?>;

            if(s == "F"){
                // 跳转到另一个页面
                window.location.href = "/project/login.php";
                
            }else{
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        if(this.responseText == "done"){
                            document.getElementsByClassName("done_box")[0].style.display = "unset";
                            setTimeout(function() {
                                document.getElementsByClassName("done_box")[0].style.display = "none";
                            }, 1500);
                        }
                    }
                }   
                xmlhttp.open("GET", "function.php?q="+itemID+"&&op=addcart&&uid="+<?php if(isset($_SESSION['id'])){
                    echo json_encode($_SESSION["id"]);}
                    else {
                    echo json_encode("\"\"");
                    }?>+"&&qty="+input , true);
                xmlhttp.send();
            }
            

            
            var modal = document.getElementById('bigmodal');
            modal.style.display = 'none';
        }

        function renderProducts(){
            var proDisplay = document.getElementsByClassName('proDisplay')[0];
            var itemRawHTML="";
            <?php 
                $link = mysqli_connect("127.0.0.1:3307", "root", "root", "Chan_art");
                 
                // Check connection
                if($link === false){
                    die("ERROR: Could not connect. " . mysqli_connect_error());
                }
                 
                
                $sql = "SELECT * FROM Product";
                $r="";
                if($result = mysqli_query($link, $sql)){
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_array($result)){
                            if($row['qty'] !=0 && $row['qty']!= -1){
                                $r.= '<div id="item'.$row['id'].'"onclick="addItemTomadal('.$row['id'].')">';
                                $r.='<img  src="'.$row['Img'].'"/>';
                                $r.= '<div style ="font-weight: bold;">'.$row['Product_Name'].'</div>';
                                $r.= '<br>';
                                $r.= '<div>'.$row['Description'].'</div>';
                                $r.= '<br>';
                                $r.= '<div>RM '.number_format($row['Price'],2).'</div>';
                                $r.='</div>';    

                            }
                            



                           
                        }
                       
        
                        mysqli_free_result($result);
                    }
                }
            ?>

            var itemRawHTML=<?php echo json_encode($r);?>;

            proDisplay.innerHTML=itemRawHTML;

            
        }







        function addItemTomadal(itemID){
            var modal=document.getElementById('bigmodal');
            var modalBody=document.querySelector(".modal .modal-body");

            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    modalBody.innerHTML = this.responseText;
                }
            }   
            xmlhttp.open("GET", "function.php?q="+itemID+"&&op=mode" , true);
            xmlhttp.send();

            modal.style.display="unset"

         
        }


        function countQTY(number,id){
            var input = document.getElementById("qtp");
            var inputv = parseInt(input.value);
            if(inputv+number <1){

            }else{
                var qty;
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        qty = this.responseText;
                        qty = parseInt(qty.replace("\"",""));

                        if(number == 1 && inputv+1 <= qty){
                            input.value = inputv+1;
                        }else if(number == -1){
                            input.value = inputv-1;
                        }
                    }
                }   
                xmlhttp.open("GET", "function.php?q="+id+"&&op=getqty" , true);
                xmlhttp.send();
                
                //input.value = parseInt(qty.replace("\"",""));
            }
               
        }

        function searchItem(){
            var proDisplay = document.getElementsByClassName('proDisplay')[0];
            var w = document.getElementById('search_product_bar').value;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    proDisplay.innerHTML = this.responseText;
                }
            }   
            xmlhttp.open("GET", "function.php?q="+w+"&&op=searchItem" , true);
            xmlhttp.send();
        }

        window.onload= function(){

        renderProducts();
        document.getElementsByClassName('proDisplay')[0].style.display="grid";

            closee.onclick=function(){
                document.getElementsByClassName('big')[0].style.display="none";
            }
        }
    </script>
</head>
<body>
    <?php include ('header.php') ?>
    <br><br>
    <input type="text" id="search_product_bar" required>
    <button id="search_product" onclick="searchItem()"placeholder="Product Name">search</button>
    <div class="proDisplay">
            

    </div>
    
    <div class="done_box">
        <div class="done_info">
            <p>Added To Cart</p>
        </div>
    </div>
    
    <div id="bigmodal" class="big">
        <div class="modal">
            <span id="closee">&times;</span>
            <div class="modal-body"> </div>
        </div>
    </div>
</body>
</html>