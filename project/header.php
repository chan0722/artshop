
        <div id="test">
        <div id="navdiv">
         
            <nav>
                <p>Chan Art</p>
                <ul name="navvv">
                    <li><a href="home.php" id="Home" >Home</a></li>
                    <li><a href="shop.php" id="shop" >Shop</a></li>
                    <li><a href="Cart.php" id="cart" >Cart</a></li>
                    <li><a href="about.php" id="about">About Us</a></li>
                    <li><a href="contact.php" id="contact">Contact</a></li>
                    <?php 
                        if(!isset($_SESSION['id'])){
                            echo '<li><a href="login.php" id="login">Login</a></li>';
                        }else{
                            echo '<li><a href="my_order.php" id="myorder">My Order</a></li>';
                            echo '<li><a href="logout.php" id="logout">Logout</a></li>';
                        }
                     ?>

                </ul>
            </nav>
        </div>
        
        </div>
        <br>
        <br><br><br><br>