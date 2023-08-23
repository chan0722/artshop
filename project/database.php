<?php

$servername = "127.0.0.1:3307";
$username = "root";
$password = "root";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$db_name = "Chan_art";

$sql = "CREATE DATABASE IF NOT EXISTS $db_name";
if ($conn->query($sql) === TRUE) {
  
} else {
  echo "Error creating database: " . $conn->error;
}

$conn->close();

$conn = new mysqli($servername, $username, $password,$db_name);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


$sql = "CREATE TABLE IF NOT EXISTS Product (
    id INT(6) AUTO_INCREMENT PRIMARY KEY,
    Product_Name VARCHAR(70) NOT NULL,
    `Description` VARCHAR(150) NOT NULL,
    Price decimal(15,2) NOT NULL,
    Img varchar(1000),
    qty int
    )";
    
if ($conn->query($sql) === TRUE) {
    
} else {
    echo "Error creating table: " . $conn->error;
}

$sql = "INSERT INTO Product (ID, Product_Name, Description, Price, Img,qty)
VALUES
(1, 'Leonardo Da Vinci, Mona Lisa, 1503-19', 'Painted between 1503 and 1517, Da Vinci’s alluring portrait has been dogged by two questions since the day it was made', 12399.00, 'https://media.timeout.com/images/103166731/1024/768/image.jpg',10),
(2, 'Johannes Vermeer, Girl with a Pearl Earring, 1665', 'Johannes Vermeer’s 1665 study of a young woman is startlingly real and startlingly modern, almost as if it were a photograph.', 9899.00, 'https://media.timeout.com/images/103166735/1024/768/image.jpg',10),
(3, 'Vincent van Gogh, The Starry Night, 1889', 'Vincent Van Gogh’s most popular painting, The Starry Night was created by Van Gogh at the asylum in Saint-Rémy, where he’d committed himself in 1889.', 123999.00, 'https://media.timeout.com/images/103166739/1024/768/image.jpg',10),
(4, 'Georges Seurat, A Sunday Afternoon on the Island of La Grande Jatte, 1884–1886', 'Georges Seurat’s masterpiece, evoking the Paris of La Belle Epoque, is actually depicting a working-class suburban scene well outside the city’s center. ', 423999.00, 'https://media.timeout.com/images/105293264/1024/768/image.jpg',10),
(5, 'Pablo Picasso, Les Demoiselles d’Avignon, 1907', 'The ur-canvas of 20th-century art, Les Demoiselles d’Avignon ushered in the modern era by decisively breaking with the representational tradition of Western painting.', 42399.00, 'https://media.timeout.com/images/103166750/1024/768/image.jpg',10),
(6, 'James Abbott McNeill Whistler, Arrangement in Grey and Black No. 1, 1871', 'Whistler’s Mother, or Arrangement in Grey and Black No. 1, as it’s actually titled, speaks to the artist’s ambition to pursue art for art’s sake.', 66399.00, 'https://media.timeout.com/images/103166741/1024/768/image.jpg',10),
(7, 'Sandro Botticelli, The Birth of Venus, 1484–1486', 'Botticelli’s The Birth of Venus was the first full-length, non-religious nude since antiquity, and was made for Lorenzo de Medici.', 87399.00, 'https://media.timeout.com/images/103166737/1024/768/image.jpg',10),
(8, 'Gustav Klimt, The Kiss, 1907–1908', 'Opulently gilded and extravagantly patterned, The Kiss, Gustav Klimt’s fin-de-siècle portrayal of intimacy, is a mix of Symbolism and Vienna Jugendstil.', 52412.00, 'https://media.timeout.com/images/103166743/1024/768/image.jpg',10),
(9, 'Jan van Eyck, The Arnolfini Portrait, 1434', 'One of the most significant works produced during the Northern Renaissance, this composition is believed to be one of the first paintings executed in oils.', 72399.00, 'https://media.timeout.com/images/103166736/1024/768/image.jpg',10),
(10, 'Edvard Munch, The Scream, 1893', 'Depicting a tormented figure against a blood-red sky, The Scream has become a symbol of human anxiety and alienation.', 32399.00, 'https://media.timeout.com/images/103166748/1024/768/image.jpg',10),
(11, 'Piet Mondrian, Composition with Red Blue and Yellow, 1930', 'A small painting (18 inches by 18 inches) that packs a big art-historical punch, Mondrian’s work represents a radical distillation of form.', 43924.00, 'https://media.timeout.com/images/105222678/1024/768/image.jpg',10),
(12, 'Diego Rodríguez de Silva y Velázquez, Las Meninas, or The Family of King Philip IV', 'A painting of a painting within a painting, Velázquez masterpiece consists of different themes rolled into one: A portrait of Spain’s royal family and retinue in Velázquez’s.', 84325.00, 'https://media.timeout.com/images/105223155/1024/768/image.jpg',10),
(13, 'Eugène Delacroix, Liberty Leading the People, 1830', 'Commemorating the July Revolution of 1830, which toppled King Charles X of France, Liberty Leading the People has become synonymous with the revolutionary spirit all over the world.',63373.00, 'https://media.timeout.com/images/105222682/1024/768/image.jpg',10),
(14, 'Claude Monet, Impression, Sunrise, 1874', 'The defining figure of Impressionism, Monet virtually gave the movement its name with his painting of daybreak over the port of Le Havre.', 63373.00, 'https://media.timeout.com/images/105222683/1024/768/image.jpg',10),
(15, 'Caspar David Friedrich, Wanderer above the Sea of Fog, 1819', 'The worship of nature, or more precisely, the feeling of awe it inspired, was a signature of the Romantic style in art.', 3431.00, 'https://media.timeout.com/images/105222684/1024/768/image.jpg',10);";

/* if ($conn->query($sql) === TRUE) {
  
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
} */


    


$sql = "CREATE TABLE IF NOT EXISTS Customer (
  Cus_id INT AUTO_INCREMENT PRIMARY KEY,
  F_Name VARCHAR(20) NOT NULL,
  L_Name VARCHAR(20) NOT NULL,
  `address` varchar(100) NOT NULL,
  gender varchar(1),
  phone_num int NOT NULL Unique,
  age int,
  `password` varchar(15),
  email varchar(30) Unique
  )";
  
if ($conn->query($sql) === TRUE) {
  
} else {
  echo "Error creating table: " . $conn->error;
}

$sql ="CREATE TABLE IF NOT EXISTS Cart (
  p_id int NOT NULL,
  c_id int NOT NULL,
  qty int NOT NULL,
  foreign key (p_id) references Product(id),
  CONSTRAINT c_id FOREIGN KEY (c_id)
  REFERENCES customer (Cus_id)
  ON DELETE CASCADE
  )";

if ($conn->query($sql) === TRUE) {
  
} else {
  echo "Error creating table: " . $conn->error;
}


$sql ="CREATE TABLE IF NOT EXISTS order_info (
  orderNo int PRIMARY KEY,
  cus_id int NOT NULL,
  amount decimal(15,2),
  order_date date,
  CONSTRAINT cus_id FOREIGN KEY (cus_id)
  REFERENCES customer (Cus_id)
  ON DELETE CASCADE
  )";


if ($conn->query($sql) === TRUE) {
  
} else {
  echo "Error creating table: " . $conn->error;
}

$sql ="CREATE TABLE IF NOT EXISTS order_item (
  orderNo int NOT NULL,
  p_id int NOT NULL,
  qty int NOT NULL,
  total decimal(15,2) NOT NULL,
  foreign key (p_id) references Product(id),
  CONSTRAINT orderNo FOREIGN KEY (orderNo)
  REFERENCES order_info (orderNo)
  ON DELETE CASCADE
  )";



if ($conn->query($sql) === TRUE) {
  
} else {
  echo "Error creating table: " . $conn->error;
}


$sql ="CREATE TABLE IF NOT EXISTS `admin` (
  admin_id varchar(5) PRIMARY KEY,
  `password` varchar(50) NOT NULL,
  `name` varchar(20) NOT NULL
  )";





if ($conn->query($sql) === TRUE) {
  
} else {
  echo "Error creating table: " . $conn->error;
}


$sql = "SELECT * FROM `admin`";
if ($result = mysqli_query($conn, $sql)) {
  if(mysqli_num_rows($result) == 0){
    $sql = "INSERT INTO `admin`(`admin_id`, `password`, `name`) VALUES ('AD1','admin','chan')";



    if ($conn->query($sql) === FALSE) {
      echo $conn->error;
    } 
  }
}














?>