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
        $q = $_GET["pid"];
        $id = (int) $q;
        $conn = new mysqli($servername, $username, $password,$db_name);
        $sql = "SELECT qty FROM Product where id = $id";

        if ($result = mysqli_query($conn, $sql)) {
            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_array($result);
                if($row['qty'] == -1){
                    header("Location: /project/admin/admin_product.php");
                }
            }

        }

        
    ?>
    <link rel="stylesheet" href="/project/css/project_sub.css">
    <link rel="stylesheet" href="/project/css/week12_css.css">
    <script>
        function download_btn(pid){

            window.location.href = "function_admin.php?op=download_img&&pid="+pid;

            
        }
        



        function check_num(){
            var price = document.getElementsByClassName('product_price')[0].value;
            var parsedValue = parseFloat(price);
            if(isNaN(parsedValue)){
                document.getElementsByClassName('price_error')[0].style.display="unset";
                document.getElementsByClassName('save')[0].disabled = true;
            }else{
                if(parsedValue <= 0){
                    document.getElementsByClassName('price_error')[0].style.display="unset";
                    document.getElementsByClassName('save')[0].disabled = true;
                }else{
                    document.getElementsByClassName('price_error')[0].style.display="none";
                    document.getElementsByClassName('save')[0].disabled = false;
                }
                
            }
            

        }

        function load_page(){
            var box = document.getElementById('edit_box');
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if(this.responseText == "f_pid"){
                        window.location.href="/project/admin/admin_product.php";
                    }else{
                        box.innerHTML=this.responseText;
                    }
                }
            }   
            xmlhttp.open("GET", "function_admin.php?op=edit_product_page_load&&pid="+<?php 
            if(!isset($_GET['pid'] )){
                header("Location: /project/admin/admin_product.php");
            }else{
                echo $_GET['pid'];
            }
            ?>, true);
            xmlhttp.send();
            
        }

        window.onload=function(){
            load_page();
            

            setTimeout(function(){

                var imgv=<?php 
                if(isset($_GET['file'])){
                    echo json_encode("t");
                }else{
                    echo json_encode("");
                }
                ?>;
            
                if(imgv === "t"){
                    document.getElementsByClassName('not_img')[0].style.display="unset";
                }
                    var numberInput = document.getElementsByClassName("product_qty")[0];
                    numberInput.addEventListener("input", function() {
                        if (numberInput.value < 0) {
                            numberInput.value = "";
                        }
                    });



                var radioButtons = document.getElementsByName("options");

                
                for (var i = 0; i < radioButtons.length; i++) {
                    radioButtons[i].addEventListener("change", function() {
                    
                        var selectedOption = document.querySelector('input[name="options"]:checked');
                        if (selectedOption) {
                            if(selectedOption.value == "URL"){
                                document.getElementsByClassName('upload')[0].style.display="none";
                                document.getElementsByClassName('URL')[0].style.display="unset";
                                document.getElementsByClassName('upload')[0].required=false;
                                document.getElementsByClassName('URL')[0].required=true;
                            }else{
                                document.getElementsByClassName('upload')[0].style.display="unset";
                                document.getElementsByClassName('URL')[0].style.display="none";
                                document.getElementsByClassName('upload')[0].required=true;
                                document.getElementsByClassName('URL')[0].required=false;
                            }
                        }
                    });
                }
            },1000);

           
        }
    </script>

</head>
<body>
<?php
    include("admin_header.php");
?>

<div id="edit_box">
 <!--    <br>
    <button onclick="download_btn()" class="download_btn">Download Img</button>
    <center>
        <img id="edit_img" src="/project/img/1.jpg">
    </center>
    <br>
    <div class="get_c">
        <div id="edit_info_box">
            <form action="function_admin.php?op=edit_product&&pid=<?php /* echo $_GET['pid']  */?>" method="post" enctype="multipart/form-data">
                <label for="product_name">Product Name</label>
                <br>
                <input type="text" name="product_name" class="product_name" value="sadsadsadsadsadsadssadsasasdsasadsadsassa" required>
                <br>
                <label for="product_description">Description</label>
                <br>
                <textarea rows="5" cols="5" name="product_description" class="product_description" required>fdssssssssssssssss</textarea>
                <br>
                <label for="product_price">Price</label>
                
                <br>
                <p class="error price_error">Please enter a valid number.</p>
                <input oninput="check_num()" type="text" name="product_price" class="product_price" value="sadsadsadsadsadsadssadsasasdsasadsadsassa" required>
                <br>
                <label for="product_qty">Quantity</label>
                <br>
                <input type="number" name="product_qty" class="product_qty" value="1" required>
                <br>

                <label>Image</label>
                <br>
                <br>
                <input type="radio" id="option1" name="options" value="URL" checked>
                <label for="option1">URL</label>
                
                <input type="radio" id="option2" name="options" value="Upload">
                <label for="option2">Upload</label><br>
                <br>
                <p class="error not_img">This Not a Image.</p>
                <input type="text" name="URL" class="URL" value="adsad" required>
                <input type="file" name="file" class="upload">
                <br>
                
                <button type="submit" class="save">Save</button>
            </form>
        </div>
    </div> -->
</div>
</body>
</html>