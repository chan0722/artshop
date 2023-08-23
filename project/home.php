<html lang="en">
<head>
    <link rel="stylesheet" href="/project/css/week12_css.css">
    <script>
        function b_buyNow(){
            window.location.href = "/project/shop.php";
        }
    </script>
</head>
<body>
    <?php session_start(); include ('header.php');include ('database.php') ?>
    <br><br>

    <div class="home_div">
            <div id="home_body">
               <div id="all">
                <img id="imgg" src="https://media.timeout.com/images/105293264/1024/768/image.jpg" alt="">

                    <div id="home_text">
                        <div id="typing_div">
                        <h1><span class="typing">Georges Seurat</span></h1>
                        </div>
                        <p>Art Work For Sale</p>
                        <br>
                        <button id="buyNow" onclick="b_buyNow()">Buy Now</button>
                    </div>
                </div>
                <div id="home_art_work" >
                    <div id="homeText">
                        <h2>Browse Artwoks</h2>
                    </div>
                    <div id="p_1">
                        <img src="https://artlogic-res.cloudinary.com/w_600,c_limit,f_auto,fl_lossy,q_auto:good/artlogicstorage/philipmouldgallery/images/view/0af18a9a61ff45d5bea80bdc54bd87b6j.jpg" alt="">
                    </div>
                    <div id="p_2">
                        <img src="https://artlogic-res.cloudinary.com/w_600,c_limit,f_auto,fl_lossy,q_auto:good/artlogicstorage/philipmouldgallery/images/view/1af42abdc2c1878fcbf14849a1d8de2cp.png" alt="">
                    </div>
                    <div id="p_3">
                        <img src="https://artlogic-res.cloudinary.com/w_600,c_limit,f_auto,fl_lossy,q_auto:good/artlogicstorage/philipmouldgallery/images/view/b01773e3ccc4c029848966efbc827ec5j.jpg" alt="">
                    </div>
                    <div id="p_4">
                        <img src="https://artlogic-res.cloudinary.com/w_600,c_limit,f_auto,fl_lossy,q_auto:good/artlogicstorage/philipmouldgallery/images/view/6fc683b8410be6c37523232029e2ebc5j.jpg" alt="">
                    </div>

                    <div class="p_d">
                        <h3>Old Masters </h3>
                    </div>
                    <div class="p_d">
                        <h3>Modern British</h3>
                    </div>
                    <div class="p_d">
                        <h3>Portrait Miniatures</h3>
                    </div>
                    <div class="p_d">
                        <h3>Bloomsbury</h3>
                    </div>

                </div>

                <div id="home_more">

                    <div id="home1">
                        <img src="https://artlogic-res.cloudinary.com/w_900,h_900,c_limit,f_auto,fl_lossy,q_auto:good/ws-philipmould/usr/images/images/filepath/22/exterior-1.jpg" >
                        <div id="home1_t">
                            <p>Visit our Pall Mall Gallery</p>
                        </div>
                        <div id="home1_text">
                            <p>
                                Spread across three floors, our gallery is a testament to the development of fine art in Britain over the past 500 years. The gallery is known for diligent research and connoisseurship and regularly stages major exhibitions with accompanying catalogues.

                                For assisted access to the gallery, please do contact us prior to your visit. 
                            </p>
                        </div>
                    </div>


                    <div id="home2">
                        <img src="https://artlogic-res.cloudinary.com/w_900,h_900,c_limit,f_auto,fl_lossy,q_auto:good/ws-philipmould/usr/images/images/filepath/23/fontana-lady-with-dog-mid-clean-high-res.jpg" alt="">
                        <div id="home2_t">
                            <p id="big">Beneath the Surface</p>
                            <p id="sub">Rediscovering lost artworks</p>
                        </div>
                        <div id="home2_text">
                            <p>
                                The gallery has a reputation for scholarship and research and over the last three decades has made a number of important art historical discoveries. Director Lawrence Hendra and consultant Emma Rutherford are contributors to scholarly articles, museum exhibitions and arts television programmes. The gallery regularly works with private collectors and public institutions from around the world, helping source and secure works for their collections. 
                            </p>
                        </div>
                    </div>

                </div>


            </div>

</body>
</html>