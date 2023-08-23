<?php

$servername = "127.0.0.1:3307";
$username = "root";
$password = "root";
$db_name = "Chan_art";

session_start();

$op = $_GET["op"];

if($op == "admin_login"){
    $passwor = $_POST['password'];
    $adminID = $_POST['adminID'];


    $conn = new mysqli($servername, $username, $password,$db_name);

    // Check connection
    if ($conn->connect_error) {
    echo ("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT admin_id,`name` FROM `admin` where `password` = '$passwor' and admin_id = '$adminID'";

    if ($result = mysqli_query($conn, $sql)) {
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            $_SESSION['adID']= $row['admin_id'];
            $_SESSION['adName'] = $row['name'];
            header("Location: /project/admin/admin_product.php");
        }else{
            header("Location: /project/admin/admin_login.php?q=F");
        }

    }
}

if($op == "load_all_product"){
    $htm="";
    $conn = new mysqli($servername, $username, $password,$db_name);

    // Check connection
    if ($conn->connect_error) {
        echo ("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM product ";
    if ($result = mysqli_query($conn, $sql)) {
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                if($row['qty']!=0 && $row['qty']!=-1){
                    $htm.='<div class="list">';
                    $htm.='<img class="all_p_img" src="'.$row['Img'].'">';
                    $htm.='<button class="edit_btn" onclick="edit_btn('.$row['id'].')">Edit</button>';
                    $htm.='<button class="delete_btn" onclick="delete_btn('.$row['id'].')">Delete</button>';
                    $htm.='<p class="all_p_name">'.$row['Product_Name'].'</p>';
                    $htm.='<p class="all_p_desc"> Description : '.$row['Description'].'</p>';
                    $htm.='<p class="p_price">Price : RM  '.$row['Price'].'</p>';
                    $htm .= '<p class="all_p_qty"> Qty : '.$row['qty'].'</p>';
                    $htm.='</div>';
                }else if($row['qty']==0){
                    $htm.='<div class="list">';
                    $htm.='<img class="all_p_img" src="'.$row['Img'].'">';
                    $htm.='<button class="edit_btn" onclick="edit_btn('.$row['id'].')">Edit</button>';
                    $htm.='<button class="delete_btn" onclick="delete_btn('.$row['id'].')">Delete</button>';
                    $htm.='<p class="all_p_name">'.$row['Product_Name'].'</p>';
                    $htm.='<p class="all_p_desc"> Description : '.$row['Description'].'</p>';
                    $htm.='<p class="p_price">Price : RM  '.$row['Price'].'</p>';
                    $htm .='<p class="out_of_stock">This Item is out of stock ! </p>';
                    $htm.='</div>';
                }
                
            }

            echo $htm;

        }else{
            echo '<p class="mgs" >No Product in the system...</p>';
        }
    }



}

if($op=="search_all_product"){
    $t = $_GET['q'];
    $htm="";
    $conn = new mysqli($servername, $username, $password,$db_name);

    // Check connection
    if ($conn->connect_error) {
        echo ("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM product where Product_Name like '%$t%' ";
    if ($result = mysqli_query($conn, $sql)) {
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                if($row['qty']!=0 && $row['qty']!=-1){
                    $htm.='<div class="list">';
                    $htm.='<img class="all_p_img" src="'.$row['Img'].'">';
                    $htm.='<button class="edit_btn" onclick="edit_btn('.$row['id'].')">Edit</button>';
                    $htm.='<button class="delete_btn" onclick="delete_btn('.$row['id'].')">Delete</button>';
                    $htm.='<p class="all_p_name">'.$row['Product_Name'].'</p>';
                    $htm.='<p class="all_p_desc"> Description : '.$row['Description'].'</p>';
                    $htm.='<p class="p_price">Price : RM  '.$row['Price'].'</p>';
                    $htm .= '<p class="all_p_qty"> Qty : '.$row['qty'].'</p>';
                    $htm.='</div>';
                }else if($row['qty']==0){
                    $htm.='<div class="list">';
                    $htm.='<img class="all_p_img" src="'.$row['Img'].'">';
                    $htm.='<button class="edit_btn" onclick="edit_btn('.$row['id'].')">Edit</button>';
                    $htm.='<button class="delete_btn" onclick="delete_btn('.$row['id'].')">Delete</button>';
                    $htm.='<p class="all_p_name">'.$row['Product_Name'].'</p>';
                    $htm.='<p class="all_p_desc"> Description : '.$row['Description'].'</p>';
                    $htm.='<p class="p_price">Price : RM  '.$row['Price'].'</p>';
                    $htm .='<p class="out_of_stock">This Item is out of stock ! </p>';
                    $htm.='</div>';
                }
                
            }

            if($htm == ""){
                echo '<p class="mgs" >0 items found for "'.$t.'"</p>';
            }else{
                echo $htm;
            }

        }else{
            echo '<p class="mgs" >0 items found for "'.$t.'"</p>';
        }
    }

}


if($op == "load_out_of_stock"){
    $htm="";
    $conn = new mysqli($servername, $username, $password,$db_name);

    if ($conn->connect_error) {
        echo ("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM product where qty = 0";
    if ($result = mysqli_query($conn, $sql)) {
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                $htm.='<div class="list">';
                $htm.='<img class="all_p_img" src="'.$row['Img'].'">';
                $htm.='<button class="edit_btn" onclick="edit_btn('.$row['id'].')">Edit</button>';
                $htm.='<button class="delete_btn" onclick="delete_btn('.$row['id'].')">Delete</button>';
                $htm.='<p class="all_p_name">'.$row['Product_Name'].'</p>';
                $htm.='<p class="all_p_desc"> Description : '.$row['Description'].'</p>';
                $htm.='<p class="p_price">Price : RM  '.$row['Price'].'</p>';
                $htm .='<p class="out_of_stock">This Item is out of stock ! </p>';
                $htm.='</div>';
                
            }

            echo $htm;

        }else{
            echo '<p class="mgs" >No Product is out of stock.</p>';
        }
    }

}

if($op == "delete_product"){
    $pid = $_GET['pid'];
    $conn = new mysqli($servername, $username, $password,$db_name);


    if ($conn->connect_error) {
        echo ("Connection failed: " . $conn->connect_error);
    }
    $sql = "UPDATE `product` SET qty = -1 WHERE id = $pid";
    if ($conn->query($sql) === TRUE) {
    
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $sql = "DELETE FROM `cart` WHERE p_id = $pid";
    if ($conn->query($sql) === TRUE) {
        echo "done";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


}


if($op=="edit_product_page_load"){
    $htm='';
    $pid = $_GET['pid'];
    $conn = new mysqli($servername, $username, $password,$db_name);
    if ($conn->connect_error) {
        echo ("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT `Product_Name`, `Description`, `Price`, `Img`, `qty` FROM `product` WHERE id = $pid";
    if ($result = mysqli_query($conn, $sql)) {
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            $img_t = $row['Img'];

            if (filter_var($img_t, FILTER_VALIDATE_URL) !== false) {
                $htm.='<center>';
                $htm.='<img id="edit_img" src="'.$row['Img'].'">';
                $htm.='</center>';
                $htm.='<br>';
                $htm.='<div class="get_c">';
                $htm.='<div id="edit_info_box">';
                $htm.='<form action="function_admin.php?op=edit_product&&pid='.$pid.'" method="post" enctype="multipart/form-data">';
                $htm.='<label for="product_name">Product Name</label>';
                $htm.='<br>';
                $htm.='<input type="text" name="product_name" class="product_name" value="'.$row['Product_Name'].'" required>';
                $htm.='<br>';
                $htm.='<label for="product_description">Description</label>';
                $htm.='<br>';
                $htm.='<textarea rows="5" cols="5" name="product_description" class="product_description" required>'.$row['Description'].'</textarea>';
                $htm.='<br>';
                $htm.='<label for="product_price">Price</label>';
                
                $htm.='<br>';
                $htm.='<p class="error price_error">Please enter a valid number.</p>';
                $htm.='<input oninput="check_num()" type="text" name="product_price" class="product_price" value="'.$row['Price'].'" required>';
                $htm.='<br>';
                $htm.='<label for="product_qty">Quantity</label>';
                $htm.='<br>';
                $htm.='<input type="number" name="product_qty" class="product_qty" value="'.$row['qty'].'" required>';
                $htm.='<br>';

                $htm.='<label>Image</label>';
                $htm.='<br>';
                $htm.='<br>';
                $htm.='<input type="radio" id="option1" name="options" value="URL" checked>';
                $htm.='<label for="option1">URL</label>';
                
                $htm.='<input type="radio" id="option2" name="options" value="Upload">';
                $htm.='<label for="option2">Upload</label><br>';
                $htm.='<br>';
                $htm.='<p class="error not_img">This Not a Image.</p>';
                $htm.='<input type="text" name="URL" class="URL" value="'.$row['Img'].'" required>';
                $htm.='<input type="file" name="file" class="upload">';
                $htm.='<br>';
                
                $htm.='<button type="submit" class="save">Save</button>';
                $htm.='</form>';
                $htm.='</div>';
                $htm.='</div>';
                echo $htm;
            } else {
                $htm.='<br>';
                $htm.='<button onclick="download_btn('.$pid.')" class="download_btn">Download Img</button>';
                $htm.='<center>';
                $htm.='<img id="edit_img" src="'.$row['Img'].'">';
                $htm.='</center>';
                $htm.='<br>';
                $htm.='<div class="get_c">';
                $htm.='<div id="edit_info_box">';
                $htm.='<form action="function_admin.php?op=edit_product&&pid='.$pid.'" method="post" enctype="multipart/form-data">';
                $htm.='<label for="product_name">Product Name</label>';
                $htm.='<br>';
                $htm.='<input type="text" name="product_name" class="product_name" value="'.$row['Product_Name'].'" required>';
                $htm.='<br>';
                $htm.='<label for="product_description">Description</label>';
                $htm.='<br>';
                $htm.='<textarea rows="5" cols="5" name="product_description" class="product_description" required>'.$row['Description'].'</textarea>';
                $htm.='<br>';
                $htm.='<label for="product_price">Price</label>';
                
                $htm.='<br>';
                $htm.='<p class="error price_error">Please enter a valid number.</p>';
                $htm.='<input oninput="check_num()" type="text" name="product_price" class="product_price" value="'.$row['Price'].'" required>';
                $htm.='<br>';
                $htm.='<label for="product_qty">Quantity</label>';
                $htm.='<br>';
                $htm.='<input type="number" name="product_qty" class="product_qty" value="'.$row['qty'].'" required>';
                $htm.='<br>';

                $htm.='<label>Image</label>';
                $htm.='<br>';
                $htm.='<br>';
                $htm.='<input type="radio" id="option1" name="options" value="URL" checked>';
                $htm.='<label for="option1">URL</label>';
                
                $htm.='<input type="radio" id="option2" name="options" value="Upload">';
                $htm.='<label for="option2">Upload</label><br>';
                $htm.='<br>';
                $htm.='<p class="error not_img">This Not a Image.</p>';
                $htm.='<input type="text" name="URL" class="URL" value="'.$row['Img'].'" required>';
                $htm.='<input type="file" name="file" class="upload">';
                $htm.='<br>';
                
                $htm.='<button type="submit" class="save">Save</button>';
                $htm.='</form>';
                $htm.='</div>';
                $htm.='</div>';
                echo $htm;
            }

                
        }else{
            
            echo"f_pid";
        }
    }

}

if($op == "edit_product"){
    $radio = $_POST['options'];
    $pid = $_GET['pid'];
    $p_name = $_POST['product_name'];
    $p_desc = $_POST['product_description'];
    $p_price = (float) $_POST['product_price'];
    $p_qty = (int) $_POST['product_qty'];
    if($radio == "Upload"){
        $f = $_FILES['file'];
        $check = getimagesize($f['tmp_name']);
        if($check === false){
            header("Location: /project/admin/edit_product.php?pid=$pid&&file=f");
        }else{
            $img_type=explode(".", $f['name']);
            move_uploaded_file($f['tmp_name'],"C:/xampp/htdocs/project/img/$pid.".$img_type[1]);
            $img_loc = "/project/img/$pid.".$img_type[1];
            $conn = new mysqli($servername, $username, $password,$db_name);
            if ($conn->connect_error) {
                echo ("Connection failed: " . $conn->connect_error);
            }

            $sql = "UPDATE `product` SET `Product_Name`='$p_name',`Description`='$p_desc',`Price`=$p_price,`Img`='$img_loc',`qty`=$p_qty WHERE id = $pid";
            if ($conn->query($sql) === TRUE) {
                header("Location: /project/admin/admin_product.php");
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }


        }
    }else{
        $URL = $_POST['URL'];
        $conn = new mysqli($servername, $username, $password,$db_name);
        if ($conn->connect_error) {
            echo ("Connection failed: " . $conn->connect_error);
        }

        $sql = "UPDATE `product` SET `Product_Name`='$p_name',`Description`='$p_desc',`Price`=$p_price,`Img`='$URL',`qty`=$p_qty WHERE id = $pid";
        if ($conn->query($sql) === TRUE) {
            header("Location: /project/admin/admin_product.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

    }

    

}

if($op == "add_product"){
    $radio = $_POST['options'];
    $p_name = $_POST['product_name'];
    $p_desc = $_POST['product_description'];
    $p_price = (float) $_POST['product_price'];
    $p_qty = (int) $_POST['product_qty'];
    if($radio == "Upload"){
        $f = $_FILES['file'];
        $check = getimagesize($f['tmp_name']);
        if($check === false){
            header("Location: /project/admin/edit_product.php?pid=$pid&&file=f");
        }else{
            $conn = new mysqli($servername, $username, $password,$db_name);
            if ($conn->connect_error) {
                echo ("Connection failed: " . $conn->connect_error);
            }
            $sql="INSERT INTO `product`(`Product_Name`, `Description`, `Price`, `qty`) VALUES ('$p_name','$p_desc',$p_price,$p_qty)";

            if ($conn->query($sql) === FALSE) {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            $pid;

            $sql = "SELECT id FROM product ORDER BY id DESC LIMIT 1;";
            if ($result = mysqli_query($conn, $sql)) {
                if(mysqli_num_rows($result) > 0){
                    $row = mysqli_fetch_array($result);
                    $pid = $row['id'];
                }
            }




            $img_type=explode(".", $f['name']);
            move_uploaded_file($f['tmp_name'],"C:/xampp/htdocs/project/img/$pid.".$img_type[1]);
            $img_loc = "/project/img/$pid.".$img_type[1];
            

            $sql = "UPDATE `product` SET `Img`='$img_loc' WHERE id = $pid";
            if ($conn->query($sql) === TRUE) {
                header("Location: /project/admin/admin_product.php");
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }


        }
    }else{
        $URL = $_POST['URL'];
        $conn = new mysqli($servername, $username, $password,$db_name);
        if ($conn->connect_error) {
            echo ("Connection failed: " . $conn->connect_error);
        }

        $sql="INSERT INTO `product`(`Product_Name`, `Description`, `Price`, `qty`,`Img`) VALUES ('$p_name','$p_desc',$p_price,$p_qty,'$URL')";

        if ($conn->query($sql) === TRUE) {
            header("Location: /project/admin/admin_product.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

    }
}


if($op == "logout"){
    unset($_SESSION['adID']);
    unset($_SESSION['adName']);
    header("Location: /project/admin/admin_login.php");
}

if($op == "download_img"){
    $pid = $_GET['pid'];
    $conn = new mysqli($servername, $username, $password,$db_name);
    if ($conn->connect_error) {
        echo ("Connection failed: " . $conn->connect_error);
    }
    $img_path;
    $sql = "SELECT `Img` FROM `product` WHERE id = $pid";
    if ($result = mysqli_query($conn, $sql)) {
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            $img_path = "C:/xampp/htdocs/".$row['Img'];
            
            if (file_exists($img_path)) {
                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename="'.basename($img_path).'"');
                header('Content-Transfer-Encoding: binary');
                header('Expires: 0');
                header('Cache-Control: must-revalidate');
                header('Pragma: public');
                header('Content-Length: ' . filesize($img_path));
                ob_clean();
                flush();
                readfile($img_path);
                header("Location: /project/admin/edit_product.php?pid=$pid");
            } else {
                echo "File not found.";
            }
        }

    }
}


if($op == "get_all_order_list"){
    $htm="";
    $conn = new mysqli($servername, $username, $password,$db_name);
    if ($conn->connect_error) {
        echo ("Connection failed: " . $conn->connect_error);
    }

    $order_info = array();
    $sql = "SELECT * FROM order_info";
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
    echo $htm;


}


if($op == "searchOrder"){
    $htm="";
    $w = $_GET['w'];
    $conn = new mysqli($servername, $username, $password,$db_name);
    if ($conn->connect_error) {
        echo ("Connection failed: " . $conn->connect_error);
    }

    $order_info = array();
    $sql = "SELECT * FROM order_info where orderNo =".$w;
    if ($result = mysqli_query($conn, $sql)) {
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_array($result)){
                $temp = array("orderNo"=>$row["orderNo"],"cus_id"=>$row["cus_id"],"amount"=>(float)$row["amount"]);
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
        $htm.='<p class="status">Status : shiping</p>';
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
        echo '<p class="mgs" >0 order found for "'.$w.'"</p>';
    }else{
        echo $htm;
    }
    
}

if($op == "load_cus_table"){
    $htm="";
    $conn = new mysqli($servername, $username, $password,$db_name);
    if ($conn->connect_error) {
        echo ("Connection failed: " . $conn->connect_error);
    }


    $sql = "SELECT * FROM `customer`";
    if ($result = mysqli_query($conn, $sql)) {
        if(mysqli_num_rows($result) > 0){
            $htm.='<div id="Cus_acc_box">';
            $htm.='<table>';
            $htm.='<thead>';
            $htm.='<tr>';
            $htm.='<td>Name</td>';
            $htm.='<td>Phone Number</td>';
            $htm.='<td>Age</td>';
            $htm.='<td>Email</td>';
            $htm.='<td></td>';
            $htm.='</tr>';
            $htm.='</thead>';
            $htm.='<tbody>';

            while($row = mysqli_fetch_array($result)){
                $htm.='<tr>';
                $htm.='<td>'.$row['F_Name'].$row['L_Name'].'</td>';
                $htm.='<td>0'.$row['phone_num'].'</td>';
                $htm.='<td>'.$row['age'].'</td>';
                $htm.='<td>'.$row['email'].'</td>';
                $htm.='<td class="acc_btn"><button class="edit_btn_acc" onclick = "edit_cus_acc('.$row['Cus_id'].')">edit</button> <button class="delete_btn_acc" onclick = "delete_cus_acc('.$row['Cus_id'].')">delete</button></td>';
                $htm.='</tr>';
            }

            $htm.='</tbody>';
            $htm.='</table>';
            $htm.='</div>';
            echo $htm;
        }else{
            echo '<p class="mgs" >Don\'t have Customer account yet.</p>';
        }
    }

}

if($op == "load_admin_table"){
    $htm="";
    $conn = new mysqli($servername, $username, $password,$db_name);
    if ($conn->connect_error) {
        echo ("Connection failed: " . $conn->connect_error);
    }


    $sql = "SELECT * FROM `admin`";
    if ($result = mysqli_query($conn, $sql)) {
        if(mysqli_num_rows($result) > 0){
            $htm.='<div id="admin_acc_box">';
            $htm.='<table>';
            $htm.='<thead>';
            $htm.='<tr>';
            $htm.='<td>Admin ID</td>';
            $htm.='<td>Name</td>';
            $htm.='<td></td>';
            $htm.='</tr>';
            $htm.='</thead>';
            $htm.='<tbody>';

            while($row = mysqli_fetch_array($result)){
                $htm.='<tr>';
                $htm.='<td>'.$row['admin_id'].'</td>';
                $htm.='<td>'.$row['name'].'</td>';
                $htm.='<td class="acc_btn"><button class="edit_btn_acc" onclick = "admin_edit_btn( \''.$row['admin_id'].'\' )">edit</button> <button class="delete_btn_acc" onclick = "delete_admin_acc(\''.$row['admin_id'].'\' )">delete</button></td>';
                $htm.='</tr>';
            }

            $htm.='</tbody>';
            $htm.='</table>';
            $htm.='</div>';
            echo $htm;
        }else{
            echo '<p class="mgs" >Don\'t have admin account yet.</p>';
        }
    }

}

if($op == "delete_cus"){
    $uid = $_GET['uid'];
    $conn = new mysqli($servername, $username, $password,$db_name);
    if ($conn->connect_error) {
        echo ("Connection failed: " . $conn->connect_error);
    }

    $sql = "DELETE FROM `customer` WHERE Cus_id =".$uid;
    
    if ($conn->query($sql) === FALSE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
    } else {
        echo "done";
    }
}


if($op == "edit_cus_page_load"){
    $uid = $_GET['uid'];
    $conn = new mysqli($servername, $username, $password,$db_name);
    if ($conn->connect_error) {
        echo ("Connection failed: " . $conn->connect_error);
    }
    $htm="";

    $sql = "SELECT * FROM customer where Cus_id=".$uid;
        if ($result = mysqli_query($conn, $sql)) {
            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_array($result);
                $htm.='<form action="function_admin.php?op=edit_cus_page&&uid='.$uid.'" method="post">';
                $htm.='<label for="f_name">First Name</label>';
                $htm.='<br>';
                $htm.='<input type="text" name="f_name" id="f_name" required value="'.$row['F_Name'].'">';
                $htm.='<br>';
                $htm.='<label for="l_name">Last Name </label>';
                $htm.='<br>';
                $htm.='<input type="text" name="l_name" id="l_name" required value="'.$row['L_Name'].'">';
                $htm.='<br>';
                $htm.='<label for="age">Age</label>';
                $htm.='<br>';
                $htm.='<p class="error age_e">Invalid age.</p>';
                $htm.='<input type="number" name="age" id="age" required oninput="check()" value="'.$row['age'].'">';
                $htm.='<br>';
                $htm.='<label for="ph">Phone Number </label>';
                $htm.='<br>';
                $htm.='<p class="error ph">This Phone Number Has used.</p>';
                $htm.='<input type="number" name="ph" id="ph" required value="'.$row['phone_num'].'">';
                $htm.='<br>';
                $htm.='<label for="addr">Address </label>';
                $htm.='<br>';
                $htm.='<textarea name="addr" id="addr" cols="30" rows="10">'.$row['address'].'</textarea>';
                
                $htm.='<br>';
                $htm.='<label for="gender">Gender</label>';
                $htm.='<br>';
                $htm.='<select name="gender" id="gender" required>';
                $htm.='<option></option>';
                if($row['gender']=="M"){
                    $htm.='<option selected >Male</option>';
                    $htm.='<option >Female</option>';
                    $htm.='<option >Rather not say</option>';
                }else if($row['gender']=="F"){
                    $htm.='<option >Male</option>';
                    $htm.='<option selected>Female</option>';
                    $htm.='<option >Rather not say</option>';
                }else{
                    $htm.='<option >Male</option>';
                    $htm.='<option >Female</option>';
                    $htm.='<option selected>Rather not say</option>';
                }
                
                                
                $htm.='</select>';
                $htm.='<br> ';
                $htm.='<label for="email">Email</label>';
                $htm.='<br>';
                $htm.='<p class="error email">This Email Has used.</p>';
                $htm.='<input type="email" name="email" id="email" required value="'.$row['email'].'">';
                $htm.='<br>';
                $htm.='<label for="ps">Password</label>';
                $htm.='<br>';
                $htm.='<p class="error ps_len">Password need at least 8 characters.</p>';
                $htm.='<input type="password" name="ps" id="ps" required oninput="check()">';
                $htm.='<br>';
                            
                $htm.='<label for="ps_c">Confirm password</label>';
                $htm.='<br>';
                $htm.='<p class="error ps">Confirm password is not same as Password.</p>';
                $htm.='<input type="password" name="ps_c" id="ps_c" required oninput="check()">';
                $htm.='<br>';
                $htm.='<br>';
                $htm.='<button id="signup_btn" type="submit" disabled>save</button>';
                $htm.='</form>';
                echo $htm;
            }
        }

}


if($op == "search_cus_acc"){
    $em = $_GET['em'];
    $htm="";
    $conn = new mysqli($servername, $username, $password,$db_name);
    if ($conn->connect_error) {
        echo ("Connection failed: " . $conn->connect_error);
    }


    $sql = "SELECT * FROM `customer` where email = '$em'";
    if ($result = mysqli_query($conn, $sql)) {
        if(mysqli_num_rows($result) > 0){
            $htm.='<div id="Cus_acc_box">';
            $htm.='<table>';
            $htm.='<thead>';
            $htm.='<tr>';
            $htm.='<td>Name</td>';
            $htm.='<td>Phone Number</td>';
            $htm.='<td>Age</td>';
            $htm.='<td>Email</td>';
            $htm.='<td></td>';
            $htm.='</tr>';
            $htm.='</thead>';
            $htm.='<tbody>';

            while($row = mysqli_fetch_array($result)){
                $htm.='<tr>';
                $htm.='<td>'.$row['F_Name'].$row['L_Name'].'</td>';
                $htm.='<td>0'.$row['phone_num'].'</td>';
                $htm.='<td>'.$row['age'].'</td>';
                $htm.='<td>'.$row['email'].'</td>';
                $htm.='<td class="acc_btn"><button class="edit_btn_acc" onclick = "edit_cus_acc('.$row['Cus_id'].')">edit</button> <button class="delete_btn_acc" onclick = "delete_cus_acc('.$row['Cus_id'].')">delete</button></td>';
                $htm.='</tr>';
            }

            $htm.='</tbody>';
            $htm.='</table>';
            $htm.='</div>';
            echo $htm;
        }else{
            echo '<p class="mgs" >0 result For \''.$em.'\'</p>';
        }
    }
}

if($op == "edit_cus_page"){
    $uid = $_GET['uid'];
    $conn = new mysqli($servername, $username, $password,$db_name);
    if ($conn->connect_error) {
        echo ("Connection failed: " . $conn->connect_error);
    }

    $f_name = $_POST["f_name"];
    $l_name = $_POST["l_name"];
    $age = $_POST["age"];
    $ph = $_POST["ph"];
    $addr = $_POST["addr"];
    $gender = $_POST["gender"];
    $emai = $_POST['email'];
    $ps = $_POST['ps'];
    if($gender=="Male"){
        $gender = "M";
    }else if($gender=="Female"){
        $gender = "F";
    }else{
        $gender = "";
    }
    $sql = "SELECT * FROM customer where Cus_id=".$uid;
    if ($result = mysqli_query($conn, $sql)) {
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            if($row['email'] == $emai && $row['phone_num']==$ph){
                $sql="UPDATE `customer` SET `F_Name`='$f_name',`L_Name`='$l_name',`address`='$addr',`gender`='$gender',`phone_num`=$ph,`age`=$age,`password`='$ps',`email`='$emai' WHERE Cus_id=".$uid;
                if ($conn->query($sql) === TRUE) {
                    header("Location: /project/admin/admin_acc.php");
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }else{
                $em="t";
                $p = "t";

                $sql ="SELECT email FROM customer where email = '$emai' and Cus_id != $uid";
                if ($result = mysqli_query($conn, $sql)) {
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_array($result)){
                            if($row['email']==$emai){
                                $em="f";
                            }

                
                        }
                       
                    }
                }

                $sql ="SELECT phone_num FROM customer where phone_num = $ph and Cus_id != $uid";
                if ($result = mysqli_query($conn, $sql)) {
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_array($result)){
                            if($row['phone_num']==$ph){
                                $p="f";
                            }

                
                        }
                       
                    }
                }

                if($em=="t" && $p=="t"){
                    $sql="UPDATE `customer` SET `F_Name`='$f_name',`L_Name`='$l_name',`address`='$addr',`gender`='$gender',`phone_num`=$ph,`age`=$age,`password`='$ps',`email`='$emai' WHERE Cus_id=".$uid;
                    if ($conn->query($sql) === TRUE) {
                        header("Location: /project/admin/admin_acc.php");
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }else{
                    header("Location: /project/admin/cus_edit.php?uid=$uid&&em=$em&&ph=$p");
                }


                
            }
        }
    }

}





if($op == "edit_admin_acc_load"){
    $aid = $_GET['aid'];
    $conn = new mysqli($servername, $username, $password,$db_name);
    if ($conn->connect_error) {
        echo ("Connection failed: " . $conn->connect_error);
    }
    $htm="";

    $sql = "SELECT * FROM `admin` where admin_id='$aid'";
        if ($result = mysqli_query($conn, $sql)) {
            if(mysqli_num_rows($result) > 0){
                $row = mysqli_fetch_array($result);
                $htm.='<form action="function_admin.php?op=edit_admin_acc&&aid='.$aid.'" method="post">';
                $htm.='<label for="adid">Admin ID</label>';
                $htm.='<br>';
                $htm.='<p class="error adidd">This Admin id has used.</p>';
                $htm.='<input type="text" name="adid" id="adid" required value="'.$row['admin_id'].'">';
                $htm.='<br>';
                $htm.='<label for="name">Name</label>';
                $htm.='<br>';
                $htm.='<input type="text" name="name" id="name" required value="'.$row['name'].'">';
                $htm.='<br>';
                $htm.='<label for="ps">Password</label>';
                $htm.='<br>';
                $htm.='<p class="error ps_len">Password need at least 8 characters.</p>';
                $htm.='<input type="password" name="ps" id="ps" required oninput="check()">';
                $htm.='<br>';
                $htm.='<label for="ps_c">Confirm password</label>';
                $htm.='<br>';
                $htm.='<p class="error ps">Confirm password is not same as Password.</p>';
                $htm.='<input type="password" name="ps_c" id="ps_c" required oninput="check()">';
                $htm.='<br>';
                $htm.='<br>';
                $htm.='<button id="signup_btn" type="save" disabled>Sign Up</button>';
                $htm.='</form>';
                echo $htm;
            }
        }
}

if($op == "edit_admin_acc"){
    $aid = $_GET['aid'];
    $f_aid = $_POST['adid'];
    $name = $_POST['name'];
    $ps = $_POST['ps'];
    $conn = new mysqli($servername, $username, $password,$db_name);
    if ($conn->connect_error) {
        echo ("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM `admin` where admin_id='$aid'";
    if ($result = mysqli_query($conn, $sql)) {
        if(mysqli_num_rows($result) > 0){
            $row = mysqli_fetch_array($result);
            if($row['admin_id'] == $f_aid){
                $sql="UPDATE `admin` SET `name`='$name',`password`='$ps' WHERE admin_id='$aid'";
                if ($conn->query($sql) === TRUE) {
                    header("Location: /project/admin/admin_acc.php");
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }else{
                $id="t";
               

                $sql ="SELECT admin_id FROM `admin` where admin_id = '$f_aid'";
                if ($result = mysqli_query($conn, $sql)) {
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_array($result)){
                            if($row['admin_id']==$f_aid){
                                $id="f";
                            }

                
                        }
                       
                    }
                }

                

                if($id=="t"){
                    $sql="UPDATE `admin` SET `admin_id` = '$f_aid',`name`='$name',`password`='$ps' WHERE admin_id='$aid'";
                    if ($conn->query($sql) === TRUE) {
                        header("Location: /project/admin/admin_acc.php");
                    } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                    }
                }else{
                    header("Location: /project/admin/admin_acc_edit.php?id=$id&&aid=$aid");
                }


                
            }
        }
    }


}


if($op == "new_admin_acc"){
    $aid = $_POST['adid'];
    $name = $_POST['name'];
    $ps = $_POST['ps'];
    $conn = new mysqli($servername, $username, $password,$db_name);
    if ($conn->connect_error) {
        echo ("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM `admin` where admin_id='$aid'";
    if ($result = mysqli_query($conn, $sql)) {
        if(mysqli_num_rows($result) == 0){
            $sql="INSERT INTO `admin`(`admin_id`, `password`, `name`) VALUES ('$aid','$ps','$name')";
            if ($conn->query($sql) === TRUE) {
                header("Location: /project/admin/admin_acc.php");
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }else{
            
            header("Location: /project/admin/add_admin_acc.php?id=f");

            
        }
    }
}

if($op == "delete_admin_acc"){
    $aid = $_GET['aid'];
    $conn = new mysqli($servername, $username, $password,$db_name);
    if ($conn->connect_error) {
        echo ("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM `admin`";
    if ($result = mysqli_query($conn, $sql)) {
        if(mysqli_num_rows($result) == 1){
            header("Location: /project/admin/admin_acc.php");
        }else{
            $sql = "DELETE FROM `admin` WHERE admin_id ='$aid'";
    
            if ($conn->query($sql) === FALSE) {
                echo "Error: " . $sql . "<br>" . $conn->error;
            } else {
                echo "done";
            }
        }
    }

}

if($op == "search_admin_acc"){
    $aid = $_GET['id'];
    $htm="";
    $conn = new mysqli($servername, $username, $password,$db_name);
    if ($conn->connect_error) {
        echo ("Connection failed: " . $conn->connect_error);
    }


    $sql = "SELECT * FROM `admin` where admin_id = '$aid'";
    if ($result = mysqli_query($conn, $sql)) {
        if(mysqli_num_rows($result) > 0){
            $htm.='<div id="admin_acc_box">';
            $htm.='<table>';
            $htm.='<thead>';
            $htm.='<tr>';
            $htm.='<td>Admin ID</td>';
            $htm.='<td>Name</td>';
            $htm.='<td></td>';
            $htm.='</tr>';
            $htm.='</thead>';
            $htm.='<tbody>';

            while($row = mysqli_fetch_array($result)){
                $htm.='<tr>';
                $htm.='<td>'.$row['admin_id'].'</td>';
                $htm.='<td>'.$row['name'].'</td>';
                $htm.='<td class="acc_btn"><button class="edit_btn_acc" onclick = "admin_edit_btn( \''.$row['admin_id'].'\' )">edit</button> <button class="delete_btn_acc" onclick = "delete_admin_acc(\''.$row['admin_id'].'\' )">delete</button></td>';
                $htm.='</tr>';
            }

            $htm.='</tbody>';
            $htm.='</table>';
            $htm.='</div>';
            echo $htm;
        }else{
            echo '<p class="mgs" >0 result For \''.$aid.'\'</p>';
        }
    }
}

$conn->close();





?>