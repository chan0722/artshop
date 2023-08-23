<html lang="en">
<head>
    <?php
        session_start(); 
        if(!isset($_SESSION['id'])&&!isset($_SESSION['name'])){
            header("Location: /project/home.php");
        }
    ?>
    <link rel="stylesheet" href="/project/css/week12_css.css">
    <link rel="stylesheet" href="/project/css/project_sub.css">

    <script>
        function searchOrder(){
            var box = document.getElementById("all_order_list");
            var xmlhttp = new XMLHttpRequest();
            var w = document.getElementById('search_order_bar').value;
            if(w != ""){
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        box.innerHTML= this.responseText;
                    }
                }
                xmlhttp.open("GET", "function_admin.php?op=searchOrder&&w="+w, true);
                xmlhttp.send();
            }else{
                load_all_order();
            }
            
        }


        function load_all_order(){
            var box = document.getElementById("all_order_list");
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    box.innerHTML= this.responseText;
                }
            }   
            xmlhttp.open("GET", "function.php?op=get_order_list", true);
            xmlhttp.send();
        }

        window.onload=function(){
            load_all_order();

            

        }
    </script>






</head>
<body>
<?php
    include("header.php");
?>
<br>
<br><br>
<div id="all_order_list">

<!--     <div class="order_list">
        <h2>Order ID : 1</h2>
        <div class="order_info">
            <div class="order_admin_cus_info">
                <p class="order_name_info">Name :<br> chanyongcheng</p>
           
                <br>
                <p class="order_email_info">Email : <br> xman2338@gmail</p>
                <br>
                <p class="order_phone_info">Phone Number : <br> 0183957566</p>
                <div class="order_addr_box">
                    <p class="order_addr_info">address :<br> 22a jalan pju 10/23
                        sadsadsd
                        sdsadsadsadsadsadsadsadsasadsadsadsdsadsa
                    </p>
                </div>
            </div>

            <div class="line"></div>

            <div class="item">
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
        </div>
    </div>







    <div class="order_list">
        <h2>Order ID : 2</h2>
        <div class="order_info">
            <div class="order_admin_cus_info">
                <p class="order_name_info">Name :<br> chanyongcheng</p>
           
                <br>
                <p class="order_email_info">Email : <br> xman2338@gmail</p>
                <br>
                <p class="order_phone_info">Phone Number : <br> 0183957566</p>
                <div class="order_addr_box">
                    <p class="order_addr_info">address :<br> 22a jalan pju 10/23
                        sadsadsd
                        sdsadsadsadsadsadsadsadsasadsadsadsdsadsa
                    </p>
                </div>
            </div>

            <div class="line"></div>
            <p class="status">Status : shpiing</p>
            <div class="item">
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
            <div>
                <p class="total_price">Total: RM12122122222</p>
            </div>
        </div>
    </div> -->



</div>
    
</body>
</html>