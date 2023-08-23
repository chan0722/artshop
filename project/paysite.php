<html lang="en">
<head>
    <link rel="stylesheet" href="/project/css/week12_css.css">
    <link rel="stylesheet" href="/project/css/project_sub.css">
    <?php
        session_start();
        if(!isset($_SESSION['id'])||!isset($_SESSION['name'])||!isset($_SESSION['pay'])){
            header("Location: /project/home.php");
        }

    ?>

    <script>
        window.onload = function(){
            load_pay_list()
        }

        function order(total){
            var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                      
                        if(this.responseText == "done"){
                            document.getElementsByClassName("done_box")[0].style.display = "unset";
                            setTimeout(function() {
                                document.getElementsByClassName("done_box")[0].style.display = "none";
                                <?php unset($_SESSION['pay']); ?>
                                window.location.href="/project/home.php";
                            }, 1500);
                            
                        }
                    }
                }   
                xmlhttp.open("GET", "function.php?op=order&&uid="+<?php if(isset($_SESSION['id'])){
                    echo json_encode($_SESSION["id"]);}
                    else {
                    echo json_encode("\"\"");
                    }?>+"&&total="+total , true);
                xmlhttp.send();
        }


        function load_pay_list(){
            
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById('pay_box').innerHTML= this.responseText;
                }
            }   
            xmlhttp.open("GET", "function.php?idd="+<?php if(isset($_SESSION['id'])){
                    echo json_encode($_SESSION["id"]);}
                    else {
                    echo json_encode("\"\"");
                    }?>+"&&op=pay_list", true);
            xmlhttp.send();
        }
    </script>
</head>
<body>
    <?php include('header.php')?>
    <br><br>
    <div id="pay_box">
        <!-- <div id="cus_info">
            <p id="pay_name_info">Name :<br> chanyongcheng</p>
           
            <br>
            <p id="pay_email_info">Email : <br> xman2338@gmail</p>
            <br>
            <p id="pay_phone_info">Phone Number : <br> 0183957566</p>
            <div id="addr_box">
            <p id="pay_addr_info">address :<br> 22a jalan pju 10/23
                sadsadsd
                sdsadsadsadsadsadsadsadsasadsadsadsdsadsa
            </p>
            </div>
            
        </div>
        <div class="line"></div>

        <div id="pay_item">
            <table>
                <tbody>
                    <tr>
                        <td class="pay_img_box"><img class="pay_img" src="https://media.timeout.com/images/105223155/1024/768/image.jpg"></td>
                        <td class="detali">
                            <p class="pay_name">Piet Mondrian, Composition with Red Blue and Yellow, 1930</p>
                            <p class="pay_qty">Qty 1 &times; RM1211212</p>
                            <p class="pay_total">Total: 13112222313</p>
                        </td>
                        
                    </tr>
                    <tr>
                        <td class="pay_img_box"><img class="pay_img" src="https://media.timeout.com/images/105223155/1024/768/image.jpg"></td>
                        <td class="detali">
                            <p class="pay_name">Piet Mondrian, Composition with Red Blue and Yellow, 1930</p>
                            <p class="pay_qty">Qty 1 &times; RM1211212</p>
                            <p class="pay_total">Total: 1322222211313</p>
                        </td>
                        
                    </tr>
                    <tr>
                        <td class="pay_img_box"><img class="pay_img" src="https://media.timeout.com/images/103166739/1024/768/image.jpg"></td>
                        <td class="detali">
                            <p class="pay_name">Piet Mondrian, Composition with Red Blue and Yjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjellow, 1930</p>
                            <p class="pay_qty">Qty 1 &times; RM1211212</p>
                            <p class="pay_total">Total: 1322211313</p>
                        </td>
                        
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="line"></div>
        <div id="place_order">
            <button id="place_order_btn">Place Order</button>
            <p>Total: RM12122122222</p>
        </div> -->
       
    </div>

    <div class="done_box">
        <div class="done_info">
            <p>Order placed </p>
        </div>
    </div>
    
</body>
</html>