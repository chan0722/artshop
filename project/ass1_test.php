<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="/project/css/week12_css.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/typed.js/2.0.12/typed.min.js" referrerpolicy="no-referrer"></script>

        <script type="text/javascript">
            var products =[];
            var shoppercar = [];
            window.onload= function(){
               // var item3={ID:4,Name:'',Desc:'',price:'42399.00',image:""};
                var item1={ID:1,Name:'Leonardo Da Vinci, Mona Lisa, 1503–19',Desc:'Painted between 1503 and 1517, Da Vinci’s alluring portrait has been dogged by two questions since the day it was made',price:'12399.00',image:"https://media.timeout.com/images/103166731/1024/768/image.jpg"};
                var item2={ID:2,Name:'Johannes Vermeer, Girl with a Pearl Earring, 1665',Desc:'Johannes Vermeer’s 1665 study of a young woman is startlingly real and startlingly modern, almost as if it were a photograph.',price:'9899.00',image:"https://media.timeout.com/images/103166735/1024/768/image.jpg"};
                var item3={ID:3,Name:'Vincent van Gogh, The Starry Night, 1889',Desc:'Vincent Van Gogh’s most popular painting, The Starry Night was created by Van Gogh at the asylum in Saint-Rémy, where he’d committed himself in 1889.',price:'123999.00',image:"https://media.timeout.com/images/103166739/1024/768/image.jpg"};
                var item4={ID:4,Name:'Georges Seurat, A Sunday Afternoon on the Island of La Grande Jatte, 1884–1886',Desc:'Georges Seurat’s masterpiece, evoking the Paris of La Belle Epoque, is actually depicting a working-class suburban scene well outside the city’s center. ',price:'423999.00',image:"https://media.timeout.com/images/105293264/1024/768/image.jpg"};
                var item5={ID:5,Name:'Pablo Picasso, Les Demoiselles d’Avignon, 1907',Desc:'The ur-canvas of 20th-century art, Les Demoiselles d’Avignon ushered in the modern era by decisively breaking with the representational tradition of Western painting.',price:'42399.00',image:"https://media.timeout.com/images/103166750/1024/768/image.jpg"};
                var item6={ID:6,Name:'James Abbott McNeill Whistler, Arrangement in Grey and Black No. 1, 1871',Desc:'Whistler’s Mother, or Arrangement in Grey and Black No. 1, as it’s actually titled, speaks to the artist’s ambition to pursue art for art’s sake.',price:'66399.00',image:"https://media.timeout.com/images/103166741/1024/768/image.jpg"};
                var item7={ID:7,Name:' Sandro Botticelli, The Birth of Venus, 1484–1486',Desc:'Botticelli’s The Birth of Venus was the first full-length, non-religious nude since antiquity, and was made for Lorenzo de Medici.',price:'87399.00',image:"https://media.timeout.com/images/103166737/1024/768/image.jpg"};
                var item8={ID:8,Name:'Gustav Klimt, The Kiss, 1907–1908',Desc:'Opulently gilded and extravagantly patterned, The Kiss, Gustav Klimt’s fin-de-siècle portrayal of intimacy, is a mix of Symbolism and Vienna Jugendstil.',price:'52412.00',image:"https://media.timeout.com/images/103166743/1024/768/image.jpg"};
                var item9={ID:9,Name:'Jan van Eyck, The Arnolfini Portrait, 1434',Desc:'One of the most significant works produced during the Northern Renaissance, this composition is believed to be one of the first paintings executed in oils.',price:'72399.00',image:"https://media.timeout.com/images/103166745/1024/768/image.jpg"};
                var item10={ID:10,Name:'Édouard Manet, Le Déjeuner sur l’herbe, 1863',Desc:'Manet’s scene of picnicking Parisians caused a scandal when it debuted at the Salon des Refusés.',price:'32421.00',image:"https://media.timeout.com/images/105222677/1024/768/image.jpg"};
                var item11={ID:11,Name:'Piet Mondrian, Composition with Red Blue and Yellow, 1930',Desc:'A small painting (18 inches by 18 inches) that packs a big art-historical punch, Mondrian’s work represents a radical distillation of form.',price:'43924.00',image:"https://media.timeout.com/images/105222678/1024/768/image.jpg"};
                var item12={ID:12,Name:'Diego Rodríguez de Silva y Velázquez, Las Meninas, or The Family of King Philip IV',Desc:'A painting of a painting within a painting, Velázquez masterpiece consists of different themes rolled into one: A portrait of Spain’s royal family and retinue in Velázquez’s.',price:'84325.00',image:"https://media.timeout.com/images/105223155/1024/768/image.jpg"};
                var item13={ID:13,Name:'Eugène Delacroix, Liberty Leading the People, 1830',Desc:'Commemorating the July Revolution of 1830, which toppled King Charles X of France, Liberty Leading the People has become synonymous with the revolutionary spirit all over the world.',price:'63373.00',image:"https://media.timeout.com/images/105222682/1024/768/image.jpg"};
                var item14={ID:14,Name:'Claude Monet, Impression, Sunrise, 1874',Desc:'The defining figure of Impressionism, Monet virtually gave the movement its name with his painting of daybreak over the port of Le Havre.',price:'63373.00',image:"https://media.timeout.com/images/105222683/1024/768/image.jpg"};
                var item15={ID:15,Name:'Caspar David Friedrich, Wanderer above the Sea of Fog, 1819',Desc:'The worship of nature, or more precisely, the feeling of awe it inspired, was a signature of the Romantic style in art.',price:'3431.00',image:"https://media.timeout.com/images/105222684/1024/768/image.jpg"};
                products=[item1,item2,item3,item4,item5,item6,item7,item8,item9,item10,item11,item12,item13,item14,item15];
                
                hideDivcart();
                document.getElementsByClassName('home_div')[0].style.display="unset";
               /*  C_color(); */
                shop.onclick=function(){

                    hideDivcart();
                    renderProducts();
                    document.getElementsByClassName('proDisplay')[0].style.display="grid";
                }
                cart.onclick=function(){
                    hideDivcart();
                    renderShoppingCart();
                    document.getElementsByClassName('cartDisplay')[0].style.display="unset";
             
                }
                Home.onclick=function(){
                    hideDivcart();
                    document.getElementsByClassName('home_div')[0].style.display="unset";
                    
                }

                about.onclick=function(){
                    hideDivcart();
                    document.getElementsByClassName('about_div')[0].style.display="unset";
                }
                
                contact.onclick=function(){
                    hideDivcart();
                    document.getElementsByClassName('contact_div')[0].style.display="unset";
                }


                closee.onclick=function(){
                    document.getElementsByClassName('big')[0].style.display="none";
                }
               

               /*  bigmodal.onclick=function(){
                    document.getElementsByClassName('big')[0].style.display="none";
                } */
                var b_speed = 17000;
                var i =0;
                var img = document.getElementById("imgg");
                var speed =[3500,10,3500,3500];
                var all_img=['https://media.timeout.com/images/103166750/1024/768/image.jpg','https://media.timeout.com/images/103166741/1024/768/image.jpg','https://media.timeout.com/images/103166737/1024/768/image.jpg','https://media.timeout.com/images/105293264/1024/768/image.jpg'];
                setInterval(function(){
                   
                    if(i == 4){
                        i=0;
                    }
                    img.setAttribute("src",all_img[i]); 
                    i++;
                    
                   
                   
                },10000)
                setTimeout(function(){
                    var typed = new Typed(".typing",{
                    strings:["","Pablo Picasso ^6500","McNeill Whistler ^5500","Sandro Botticelli ^6500","Georges Seurat ^6500"],

                    typeSpeed:130,
                    BackSpeed:320,
                    loop:true
                    
                })
                },10000)
                
              
               
            }
           
          
            function b_buyNow(){
                hideDivcart();
                renderProducts();
                document.getElementsByClassName('proDisplay')[0].style.display="grid";
            }

            function C_color(){
                document.getElementById('test').style.backgroundColor="rgb(59, 79, 54)"
                document.getElementsByTagName('body')[0].style.backgroundColor="rgb(59, 79, 54)"
                /* var el1 =document.getElementById('navdiv');
                var el2 = el1.getElementsByTagName('nav');
                var el3 = el2.getElementsByTagName('ul');
                var el4 = el3.getElementsByTagName('li');
                var el5 = el4.getElementsByTagName('a');
                el5.style.color="#fff"; */
                for(var i = 0;i<5;i++){
                    var el1 =document.getElementsByName('navvv')[0];
                    var el2 =el1.getElementsByTagName('li')[i];
                    el2.getElementsByTagName('a')[0].style.color="#fff";
                }
                var el1 =document.getElementsByName('navvv')[1];
                el1.getElementsByTagName('p')[0].style.color="#fff";
               

            }

            function hideDivcart(){
                document.getElementsByClassName('home_div')[0].style.display="none";
                document.getElementsByClassName('proDisplay')[0].style.display="none";
                document.getElementsByClassName('cartDisplay')[0].style.display="none";
                document.getElementsByClassName('about_div')[0].style.display="none";
                document.getElementsByClassName('contact_div')[0].style.display="none";

                
            }

            function renderProducts(){
                var proDisplay = document.getElementsByClassName('proDisplay')[0];
                var itemRawHTML="";
                for(var j =0;j<1;j++){
                for(var i=0;i<products.length;i++){
                    itemRawHTML += '<div id="item'+products[i].ID+'"onclick="addItemTomadal('+products[i].ID+')">';
                        itemRawHTML+='<img  src="'+products[i].image+'"/>';
                        itemRawHTML+= '<div style ="font-weight: bold;">'+products[i].Name+'</div>';
                        itemRawHTML += '<br>';
                        itemRawHTML+= '<div>'+products[i].Desc+'</div>';
                        itemRawHTML += '<br>';
                        itemRawHTML+= '<div>RM'+products[i].price+'</div>';
                    itemRawHTML +='</div>';    
                }

                }
                proDisplay.innerHTML=itemRawHTML   ;
            }

            function renderShoppingCart(){
                var tableBody = document.querySelector('#tablecart tbody');
                var trRawHTML = " ";
                var total = 0;
                for(var i = 0; i <shoppercar.length;i++){
                    var thisCart = shoppercar[i];
                    var item = products.filter(x => x.ID == thisCart.id)[0];
                    
                    
                    trRawHTML += '<tr>';
                        trRawHTML += '<td><img  max-width="300" height="250" src="'+item.image+'">'+'<button id="delete" onclick="itemDelete('+thisCart.id+')" style="float:right">Delete</button>'+'</td>';
                        trRawHTML += '<td>'+item.Name+'</td>';
                        trRawHTML += '<td>Rm '+item.price+'</td>';
                        trRawHTML += '<td>'+thisCart.count+'</td>';
                        trRawHTML += '<td>Rm '+(parseFloat(thisCart.count) * parseFloat (item.price))+'</td>';
                        total += (parseFloat(thisCart.count) * parseFloat (item.price));
                    trRawHTML += '</tr>';
                }
                
                tableBody.innerHTML = trRawHTML;

                var tableF = document.querySelector('#tablecart tfoot');
                var tfhtml="";
                tfhtml += '<tr>';
                    tfhtml += ' <td colspan="4">Total </td>';
                    tfhtml += '<td>Rm '+total+'</td>';
                tfhtml += '</tr>';
                tableF.innerHTML = tfhtml;
            }


            function addTocart(itemID){

                var exrecord = shoppercar.filter(x => x.id == itemID)[0];
                var input = document.getElementById('qtp');
                if(exrecord == undefined){
                    
                    shoppercar.push({id:itemID,count:parseInt(input.value)})
                }else{
                    exrecord.count+=parseInt(input.value);
                }
                var modal = document.getElementById('bigmodal');
                modal.style.display = 'none';


                
            }
            function addItemTomadal(itemID){
                var modal=document.getElementById('bigmodal');
                var modalBody=document.querySelector(".modal .modal-body");

                modal.style.display="unset"

                var itemm = "";
                itemm += '<div style="text-align:center">'
                itemm+='<img  src="'+products[itemID-1].image+'"width="580px"/>';
                itemm+= '<div>RM'+products[itemID-1].price+'</div>';
                itemm += '<br/>';
                itemm += '<i onclick="countQTY(-1)" class="fa fa-minus-circle" style="font-size: 30px;"></i>';
                itemm += '<input value="1" id="qtp" disabled style="font-size: 30px; margin:10px; width:50px;text-align:center;"></input>';
                itemm += '<i onclick="countQTY(1)" class="fa fa-plus-circle" style="font-size: 30px;"></i>';
                itemm += '<br/>';
                itemm+='<div style="text-align:center">';
                itemm +='<br>';
                itemm += '<button id="b_button" onclick="addTocart('+products[itemID-1].ID+')">Add</button>';
                itemm += '</div>';
                modalBody.innerHTML=itemm;
            }



            function countQTY(number){
                var input = document.getElementById("qtp");
                var inputv = parseInt(input.value);
                if(inputv+number <1){

                }else{
                    input.value = inputv+parseInt(number);
                }
               
            }

            function itemDelete(itemID){
                for(var i=0;i<shoppercar.length;i++){
                    if(shoppercar[i].id == itemID){
                        shoppercar.splice(i,1);
                    }
                }
                document.getElementsByClassName('cartDisplay')[0].style.display="none";
                
                renderShoppingCart();
                document.getElementsByClassName('cartDisplay')[0].style.display="unset";
            }

        </script>

    </head>
    <body>
        <?php include('header.php') ?>
        <div class="proDisplay">
            
            <div id="item1">
                <img  src="https://www.muraldecal.com/en/img/asfs644-png/folder/products-detalle-png/stickers-homer-fuck.png">
                <div>Homer Fuck You Logo</div>
                <div>Fuck You !</div>
                <div>Rm 99,999.00</div>
            </div>

            <div id="item2">
                <img  src="https://www.muraldecal.com/en/img/asfs644-png/folder/products-detalle-png/stickers-homer-fuck.png">
                <div>Homer Fuck You Logo</div>
                <div>Fuck You !</div>
                <div>Rm 99,999.00</div>
            </div>

        </div>

        <div class="cartDisplay">
            <table id="tablecart" style="width: 100%;">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>QTY</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></th>
                    </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4"></td>
                        <td>total</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <div id="bigmodal" class="big">
            <div class="modal">
                <span id="closee">&times;</span>
                <div class="modal-body"> </div>
            </div>
        </div>

        <div class="about_div">
            <div id="about_body">
               
                <img src="https://artlogic-res.cloudinary.com/w_1100,h_1100,c_limit,f_auto,fl_lossy,q_auto:good/ws-philipmould/usr/artists/images/49/p-mould-portraits-05-em.jpg">
                <div id="all_text">
                    <br><br><br>
                    <div class="title">
                        <h1>ABOUT US</h1>
                    </div>
                    <div class="text">
                        <span>Philip Mould & Company have been specialising in British art and Old Master paintings for over 35 years. Our gallery, located on London's historic Pall Mall, is one of the largest commercial gallery spaces in St James and showcases 500 years of British art and portrait miniatures from the Tudor period through to the late 20th century. 
                            <p>Through his books and television work, Philip Mould is one of the best-known figures in the art world. His hit BBC1 programme Fake or Fortune? reaches up to five million viewers in the UK and greater numbers abroad, making it the most-watched arts programme on television.</p>
                        </span>
                        


                    </div>
                </div>  
                <br><br><br><br><br><br>
                <h2 style="margin-left: 3%;">The Team</h2>
                <br><br>
                <div id="team">
                    <div id="people1">
                        <img src="https://artlogic-res.cloudinary.com/w_800,h_800,c_limit,f_auto,fl_lossy,q_auto:good/ws-philipmould/usr/images/team/main_image/1/philip-2018-9.png" >
                      
                    </div>
                    <div id="people2">
                        <img src="https://artlogic-res.cloudinary.com/w_800,h_800,c_limit,f_auto,fl_lossy,q_auto:good/ws-philipmould/usr/images/team/main_image/2/lawrence-hendra-head-of-research.jpg" alt="">
                    </div>
                    <div id="people3">
                        <img src="https://artlogic-res.cloudinary.com/w_800,h_800,c_limit,f_auto,fl_lossy,q_auto:good/ws-philipmould/usr/images/team/main_image/3/pm-team-photos-catherine.jpg" alt="">
                    </div>

                    <div id="p1">
                        <h2>Philip Mould OBE</h2>
                        <br>
                        <h3>Director</h3>
                        <p>
                            Philip Mould began dealing in fine art in his early-teens and has since built up an international business specialising in 500 years of British art from the early-Tudor period to the 20th Century, as well as Historical Portraiture and Portrait Minaitures; subjects on which he is regularly consulted. </p>
                            
                           <p> Contact Philip Mould's Personal Assistant:</p>
                           <p> rosalind@philipmould.com</p>
                    </div>

                    <div id="p2">
                        <h2>Lawrence Hendra</h2>
                        <br>
                        <h3>Head of Research, Director</h3>
                        
                        <p>
                            Lawrence is Head of Research at Philip Mould & Co and over the years has identified a number of previously lost works by painters such as Peter Paul Rubens, Anthony Van Dyck and Peter Lely.</p>
                            
                           <p> Contact:</p>
                           <p> lawrence@philipmould.com</p>
                    </div>


                    <div id="p3">
                        <h2>Catherine Mould</h2>
                        <br>
                        <h3>Director</h3>
                        
                        <p>
                            Catherine Mould runs the events at the gallery, from gallery events to private evening hire.
                           <p> Contact:</p>
                           <p> catherine@philipmould.com</p>
                    </div>
                </div>
            </div>

        </div>

        <div class="contact_div">
            <div id="contact_body">
                <img src="https://artlogic-res.cloudinary.com/w_900,h_900,c_limit,f_auto,fl_lossy,q_auto:good/ws-philipmould/usr/artists/images/8/contact1.jpg" >
                <div id="contact_text">
                    <p class="bold">18-19 Pall Mall, London,</p>
                    <p class="bold">SW1Y 5LU</p>
                    <br><br>
                    <p class="bold">Opening Time</p>
                    <p class="n_text">Monday - Friday: 9:30 am - 6:00 pm.<br>
                        No booking required.</p>
                    <p class="bold">Contact</p>
                    <p class="n_text">18-19 Pall Mall, London, SW1Y 5LU
                        <br>
                        +44(0) 20 7499 6818
                        <br>
                        art@philipmould.com
                    </p>
                    <br><br><br><br><br>
                    <p id="sp_bold">Step free access available to all floors. <br> For further information please call +44(0) 20 7499 6818.</p>

                    
                </div>
            </div>
        </div>




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
        </div>
        
    </body>
</html>