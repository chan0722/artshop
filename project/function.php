<?php


$servername = "127.0.0.1:3307";
$username = "root";
$password = "root";
$db_name = "Chan_art";

$op = $_GET["op"];

if($op == "mode"){
    $q = $_GET["q"];
    $conn = new mysqli($servername, $username, $password,$db_name);

    // Check connection
    if ($conn->connect_error) {
    echo ("Connection failed: " . $conn->connect_error);
    }

    $q = (int) $q;

    $sql = "SELECT * FROM Product where id = $q";
        
    $itemm ="";
    if ($result = mysqli_query($conn, $sql)) {
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            $itemm .= '<div style="text-align:center">';
            $itemm .= '<p>Qty: '.$row['qty'].'</p>';
            $itemm.='<img  src="'.$row['Img'].'"width="580px"/>';
            $itemm.= '<div>RM '.number_format($row['Price'],2).'</div>';
            $itemm .= '<br/>';
            $itemm .= '<i onclick="countQTY(-1,'.$row['id'].')" class="fa fa-minus-circle" style="font-size: 30px;"></i>';
            $itemm .= '<input value="1" id="qtp" disabled style="font-size: 30px; margin:10px; width:50px;text-align:center;"></input>';
            $itemm .= '<i onclick="countQTY(1,'.$row['id'].')" class="fa fa-plus-circle" style="font-size: 30px;"></i>';
            $itemm .= '<br/>';
            $itemm.='<div style="text-align:center">';
            $itemm .='<br>';
            $itemm .= '<button id="b_button" onclick="addTocart('.$row['id'].')">Add</button>';
            $itemm .= '</div>';

            echo $itemm;
        }else {
            echo "NO data" . $conn->error;
        }
    }else {
        echo "NO data" . $conn->error;
    }
    

}

if($op == "searchItem"){
    $t = $_GET["q"];
    $conn = new mysqli($servername, $username, $password,$db_name);

    // Check connection
    if ($conn->connect_error) {
        echo ("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM Product  WHERE Product_Name like '%$t%'";
    $r="";
    if($result = mysqli_query($conn, $sql)){
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
            if($r==""){
                echo '<p class="mgs" >0 items found for "'.$t.'"</p>';
            }else{
                echo $r;
            }
           
            mysqli_free_result($result);
        }else{
            echo '<p class="mgs" >0 items found for "'.$t.'"</p>';
        }
    }
}


if($op=="getqty"){
    $q = $_GET["q"];
    $id = (int) $q;
    $conn = new mysqli($servername, $username, $password,$db_name);
    $sql = "SELECT qty FROM Product where id = $id";

    if ($result = mysqli_query($conn, $sql)) {
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            echo json_encode($row['qty']);
        }

    }else{
        echo json_encode(-1);
    }


}

if($op == "login"){
    $passwor = $_POST['password'];
    $emai = $_POST['email'];


    $conn = new mysqli($servername, $username, $password,$db_name);

    // Check connection
    if ($conn->connect_error) {
    echo ("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT Cus_id,F_name FROM Customer where `password` = '$passwor' and email = '$emai'";

    if ($result = mysqli_query($conn, $sql)) {
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            session_start();
            $_SESSION['id']= $row['Cus_id'];
            $_SESSION['name'] = $row['F_name'];
            header("Location: /project/home.php");
        }else{
            header("Location: /project/login.php?q=F");
        }

    }
}

if($op == "signup"){
    $f_name = $_POST["f_name"];
    $l_name = $_POST["l_name"];
    $age = $_POST["age"];
    $ph = $_POST["ph"];
    $addr = $_POST["addr"];
    $gender = $_POST["gender"];
    $emai = $_POST['email'];
    $ps = $_POST['ps'];


    $conn = new mysqli($servername, $username, $password,$db_name);
    $ph_st="t";
    $em_st="t";
    // Check connection
    if ($conn->connect_error) {
    echo ("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT phone_num , email FROM Customer where `phone_num` = '$ph' or email = '$emai'";

    if ($result = mysqli_query($conn, $sql)) {
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            if($row['phone_num']==$ph){
                $ph_st="f";
            }

            if($row['email']==$emai){
                $em_st="f";
            }

            header("Location: /project/signup.php?ph=$ph_st&&em=$em_st");
        }else{
            if($gender=="Male"){
                $gender = "M";
            }else if($gender=="Female"){
                $gender = "F";
            }else{
                $gender = "";
            }

            $ph = (int) $ph;
            $sql = "INSERT INTO customer (F_name, L_name, `address`, gender, phone_num,age,`password`,email)
            VALUES ('$f_name','$l_name','$addr','$gender',$ph,$age,'$ps','$emai')";

            if ($conn->query($sql) === TRUE) {
                session_start();
                $_SESSION['new_name']="$f_name $l_name";
                header("Location: /project/signup_succ.php");
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }
}


if($op=="addcart"){
    $uid = (int)$_GET['uid'];
    $item_id =(int) $_GET['q'];
    $qty =(int) $_GET['qty'];
    $conn = new mysqli($servername, $username, $password,$db_name);
    if ($conn->connect_error) {
        echo ("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT qty FROM cart where p_id = '$item_id' and c_id = '$uid'";

    
    if ($result = mysqli_query($conn, $sql)) {
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            $qty_old =(int) $row['qty'];
            $qty =$qty + $qty_old;
            $sql = "UPDATE `cart` SET `qty`=$qty WHERE p_id =$item_id and c_id = $uid";
            if ($conn->query($sql) === TRUE) {
                echo "done";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }else{
            $sql = "INSERT INTO cart (p_id,c_id,qty) VALUE($item_id,$uid,$qty)";
            if ($conn->query($sql) === TRUE) {
                echo "done";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }

    
}

if($op == "loadcart"){
    $conn = new mysqli($servername, $username, $password,$db_name);
    if ($conn->connect_error) {
        echo ("Connection failed: " . $conn->connect_error);
    }

    $uid = (int)$_GET['q'];
    $h="";
    $all_total=0;
    $sql = "SELECT product.qty as p_qty,cart.qty,id,product_name,Price,img FROM cart LEFT JOIN product ON cart.p_id = product.id WHERE cart.c_id = $uid";
    if ($result = mysqli_query($conn, $sql)) {
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                $p_qty = $row['p_qty'];
                if($p_qty != 0){
                    $total = ((float)$row['Price']) * ((int)$row['qty']);
                    $all_total = $all_total + $total;
                    $h .= '<div class="list" id="'.$row['id'].'">';
                    $h .= '<img class="cart_img" src="'.$row['img'].'">';
                    $h .= '<button class="delete_btn" onclick="delete_btn('.$row['id'].')">Delete</button>';
                    $h .= '<p class="p_name">'.$row['product_name'].'</p>';
                    $h .= '<p class="p_price">Qty '.$row['qty'].' &times; RM '.number_format($row['Price'],2).'</p>';
                    $h .= '<p class="p_total">Total : RM '.number_format($total,2).'</p>';
                    $h .= '</div>';
                }else{
                    $h .= '<div class="list" id="'.$row['id'].'">';
                    $h .= '<img class="cart_img" src="'.$row['img'].'">';
                    $h .= '<button class="delete_btn" onclick="delete_btn('.$row['id'].')">Delete</button>';
                    $h .= '<p class="p_name">'.$row['product_name'].'</p>';
                    $h .= '<p style="color:red;padding-left: 430px">This Product is out of stock.</p>';
                    $h .= '<p class="p_total">Total : RM 0</p>';
                    $h .= '</div>';
                }
            }
            $h .= '<p id="total_text" > Total: </p>';
            $h .= '<p id="all_total">RM '.number_format($all_total,2).'</p>';
            $h .= '<button id="pay" onclick="pay_now('.$uid.')" >Pay Now </button>';
        }else{
            $h .= '<p class="mgs"> your cart is empty </p>';
        }
    }

    echo ($h);

}

if($op == "delete_cart_item"){
    $uid = $_GET['q'];
    $itemid= $_GET['item'];
    $conn = new mysqli($servername, $username, $password,$db_name);
    if ($conn->connect_error) {
        echo ("Connection failed: " . $conn->connect_error);
    }

    $sql = "DELETE FROM `cart` WHERE p_id = $itemid and c_id = $uid";
    if ($conn->query($sql) === TRUE) {
        echo "done";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

}

if($op == "pay_list"){
    $uid = (int)$_GET['idd'];
    $htm='<div id="cus_info">';
    $conn = new mysqli($servername, $username, $password,$db_name);
    if ($conn->connect_error) {
        echo ("Connection failed: " . $conn->connect_error);
    }

    $sql="SELECT F_Name,L_Name,address,phone_num,email FROM `customer` WHERE Cus_id = $uid";
    if ($result = mysqli_query($conn, $sql)) {
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            $t_name = $row['F_Name'] . $row['L_Name'];
            $htm .='<p id="pay_name_info">Name :<br> '.$t_name.'</p>';
           
            $htm .='<br>';
            $htm .='<p id="pay_email_info">Email : <br> '.$row['email'].'</p>';
            $htm.='<br>';
            $htm .='<p id="pay_phone_info">Phone Number : <br> 0'.$row['phone_num'].'</p>';
            $htm .='<div id="addr_box">';
            $htm .='<p id="pay_addr_info">address :<br> '.$row['address'];
            $htm .='</p>';
            $htm .='</div>';
            
            $htm .='</div>';
            $htm .='<div class="line"></div>';
        }
    }
    $all_total=0;
    $htm .='<div id="pay_item">';
    $htm .='<table>';
    $htm .='<tbody>';
    $sql = "SELECT cart.c_id,product.qty as p_qty,cart.qty,id,product_name,Price,img FROM cart LEFT JOIN product ON cart.p_id = product.id WHERE cart.c_id = $uid";
    if ($result = mysqli_query($conn, $sql)) {
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                $p_qty = $row['p_qty'];
                if($p_qty !=0 && !($p_qty < $row['qty'])){
                    $total = ((float)$row['Price']) * ((int)$row['qty']);
                    $all_total = $total + $all_total;
                    $htm .='<tr>';
                    $htm .='<td class="pay_img_box"><img class="pay_img" src="'.$row['img'].'"></td>';
                    $htm .='<td class="detali">';
                    $htm .='<p class="pay_name">'.$row['product_name'].'</p>';
                    $htm .='<p class="pay_qty">Qty '.$row['qty'].' &times; RM '.number_format((float) $row['Price'],2).'</p>';
                    $htm .='<p class="pay_total">Total: RM '.number_format($total,2).'</p>';
                    $htm .='</td>';
                    $htm .='</tr>';
                }else if($p_qty < $row['qty'] && $p_qty !=0 ){
                    
                    $sql = "UPDATE `cart` SET `qty`=$p_qty WHERE c_id= $uid and p_id = ".$row['id'];
                    if ($conn->query($sql) !== TRUE) {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                    $total = ((float)$row['Price']) * ((int)$p_qty);
                    $all_total = $total + $all_total;
                    $htm .='<tr>';
                    $htm .='<td class="pay_img_box"><img class="pay_img" src="'.$row['img'].'"></td>';
                    $htm .='<td class="detali">';
                    $htm .='<p class="pay_name">'.$row['product_name'].'</p>';
                    $htm .='<p class="pay_qty">Qty '.$p_qty.' &times; RM '.number_format((float) $row['Price'],2).'</p>';
                    $htm .='<p class="pay_total">Total: RM '.number_format($total,2).'</p>';
                    $htm .='</td>';
                    $htm .='</tr>';
                }
                
            }
        }

    }

    $htm .='</tbody>';
    $htm .='</table>';
    $htm .='</div>';
    $htm .='<div class="line"></div>';
    $htm .='<div id="place_order">';
    $htm .='<button id="place_order_btn" onclick="order('.$all_total.')">Place Order</button>';
    $htm .='<p>Total: RM '.number_format($all_total,2).'</p>';
    $htm .='</div>';
    

    echo($htm);
}


if($op == "order"){
    $uid = (int) $_GET['uid'];
    $total = (float)$_GET['total'];
    $conn = new mysqli($servername, $username, $password,$db_name);
    if ($conn->connect_error) {
        echo ("Connection failed: " . $conn->connect_error);
    }

    $cart_product = array();

    $sql="SELECT  product.Price,product.qty AS p_qty , p_id,cart.qty FROM `cart` LEFT JOIN product ON p_id = product.id WHERE c_id = $uid";


    /* get data from cart and product table*/
    if ($result = mysqli_query($conn, $sql)) {
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                $p_qty = $row['p_qty'];
                if($p_qty != 0){
                    $cart_product[] = array($row['p_id'],$row['qty'],$row['Price']);
                }
            }
        }
    }


    /* update product qty (product table)*/
    foreach($cart_product as $p){
        $sql = "SELECT qty FROM product WHERE id = ".$p[0];
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        $qty =  ((int) $row['qty'])- ((int) $p[1]);
        $sql = "UPDATE `product` SET `qty`=$qty WHERE id = ".$p[0];
        if ($conn->query($sql) === TRUE) {

        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
        
    }
    $d = date('Y-m-d');
    $orderNo;
    /* get new orderNo*/
    $sql = "SELECT orderNo FROM order_info ORDER BY orderNo DESC LIMIT 1";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        $orderNo = ((int) $row['orderNo']);
        $orderNo = $orderNo+1;
    } else {
        $orderNo = 1;
    }

    $sql="INSERT INTO Order_info (orderNo,cus_id,amount,order_date) VALUES ($orderNo,$uid,$total,'$d')";
    
    if ($conn->query($sql) === TRUE) {
        foreach($cart_product as $p){
            $total = ((float) $p[2]) * ((int) $p[1]);
            $sql = "INSERT INTO order_item (orderNo,p_id,qty,total) VALUES($orderNo,".(int)$p[0].",".(int)$p[1].",".$total.")";
            if ($conn->query($sql) === TRUE) {
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
        
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    foreach($cart_product as $p){
        $p_id =(int) $p[0];
        $sql = "DELETE FROM `cart` WHERE p_id= $p_id and c_id = $uid";
        if ($conn->query($sql) === TRUE) {
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    echo "done";


}

if($op == "get_order_list"){
    $htm="";
    $conn = new mysqli($servername, $username, $password,$db_name);
    if ($conn->connect_error) {
        echo ("Connection failed: " . $conn->connect_error);
    }
    session_start();
    $uid = $_SESSION['id'];
    $order_info = array();
    $sql = "SELECT * FROM order_info where cus_id = $uid";
    if ($result = mysqli_query($conn, $sql)) {
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                $temp = array("orderNo"=>$row["orderNo"],"cus_id"=>$row["cus_id"],"amount"=>(float)$row["amount"],"date" => $row['order_date']);
                $order_info[] = $temp;
            }
            

        }
    }

    foreach ($order_info as $r_info){
        $sql = "SELECT * FROM customer where Cus_id=".$r_info["cus_id"];
        if ($result = mysqli_query($conn, $sql)) {
            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_array($result);
                $htm.='<div class="order_list">';
                $htm.='<h2>Order ID : '.$r_info['orderNo'].'</h2>';
                $htm.='<div class="order_info">';
                $htm.='<div class="order_admin_cus_info">';
                $htm.='<p class="order_name_info">Name :<br> '.$row['F_Name'].$row['L_Name'].'</p>';
           
                $htm.='<br>';
                $htm.='<p class="order_email_info">Email : <br> '.$row['email'].' </p>';
                $htm.='<br>';
                $htm.='<p class="order_phone_info">Phone Number : <br> '."0".$row['phone_num'].' </p>';
                $htm.='<div class="order_addr_box">';
                $htm.='<p class="order_addr_info">address :<br> '.$row['address'].' </p>';
                $htm.='</div>';
                $htm.='</div>';

            }
        }

        $order_list=array();
        $sql = "SELECT * FROM order_item where orderNo=".$r_info["orderNo"];
        if ($result = mysqli_query($conn, $sql)) {
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                    $temp = array("p_id"=>$row["p_id"],"qty"=>$row["qty"],"total"=>(float)$row["total"]);
                    $order_list[] = $temp;
                }
            }
        }

        $htm.='<div class="line"></div>';
        $htm.='<p class="status">Date Order : '.$r_info['date'].'</p>';
        $htm.='<div class="item">';
        $htm.='<table>';
        $htm.='<tbody>';

        foreach ($order_list as $r_list){
            $sql = "SELECT * FROM product where id=".$r_list["p_id"];
            if ($result = mysqli_query($conn, $sql)) {
                if(mysqli_num_rows($result) > 0){
                    $row = mysqli_fetch_array($result);
                    $htm.='<tr>';
                    $htm.='<td class="pay_img_box"><img class="pay_img" src="'.$row['Img'].'"></td>';
                    $htm.='<td class="detali">';
                    $htm.='<p class="pay_name">'.$row['Product_Name'].'</p>';
                    $htm.='<p class="pay_qty">Qty '.$r_list['qty'].'</p>';
                    $htm.='<p class="pay_total">Total: '.number_format($r_list['total'],2).'</p>';
                    $htm.='</td>';
                    $htm.='</tr>';
                }else{
                    echo "erorr 2";
                }
            }else{
                echo "erorr 1";
            }
        }

        $htm.='</tbody>';
        $htm.='</table>';
        $htm.='</div>';
        $htm.='<div class="line"></div>';
        $htm.='<div>';
        $htm.='<p class="total_price">Total: RM '.number_format($r_info['amount'],2).'</p>';
        $htm.='</div>';
        $htm.='</div>';
        $htm.='</div>';




    }
    if($htm == ""){
        echo '<p class="mgs">You Have No Any Order Yet...</p>';
    }else{
        echo $htm;
    }
    
}


$conn->close();































?>