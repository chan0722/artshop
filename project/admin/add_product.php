<html lang="en">
<head>
    <?php
        session_start(); 
        if(!isset($_SESSION['adID'])&&!isset($_SESSION['adName'])){
            header("Location: /project/admin/admin_login.php");
        }


        
    ?>
    <link rel="stylesheet" href="/project/css/project_sub.css">
    <link rel="stylesheet" href="/project/css/week12_css.css">
    <script>
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

        

        window.onload=function(){ 
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

           
        }
    </script>

</head>
<body>
<?php
    include("admin_header.php");
?>

<div id="edit_box">
    <center>
        <h1>Add New Product</h1>
    </center>
    <br>
    <div class="get_c">
        <div id="edit_info_box">
            <form action="function_admin.php?op=add_product" method="post" enctype="multipart/form-data">
                <label for="product_name">Product Name</label>
                <br>
                <input type="text" name="product_name" class="product_name" required>
                <br>
                <label for="product_description">Description</label>
                <br>
                <textarea rows="5" cols="5" name="product_description" class="product_description" required></textarea>
                <br>
                <label for="product_price">Price</label>
                
                <br>
                <p class="error price_error">Please enter a valid number.</p>
                <input oninput="check_num()" type="text" name="product_price" class="product_price" required>
                <br>
                <label for="product_qty">Quantity</label>
                <br>
                <input type="number" name="product_qty" class="product_qty" required>
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
                <input type="text" name="URL" class="URL"  required>
                <input type="file" name="file" class="upload">
                <br>
                
                <button type="submit" class="save">Save</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>