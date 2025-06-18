<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/add_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

<?php include 'components/user_header.php'; ?>



<section class="hero">

   <div class="swiper hero-slider">

      <div class="swiper-wrapper">

         <div class="swiper-slide slide">
            <div class="content">
               <span>order online</span>
               <h3>Delicious Pizza</h3>
               <a href="menu.php" class="btn">see menus</a>
            </div>
            <div class="image">
               <img src="https://media.istockphoto.com/id/182148711/photo/pizza-from-the-top-deluxe.webp?a=1&b=1&s=612x612&w=0&k=20&c=3H3VXpjdjZsRaFsHILCcGRKy8FhOSa3Sznn1W0myf7I=" alt="">
            </div>
         </div>

         <div class="swiper-slide slide">
            <div class="content">
               <span>order online</span>
               <h3>chezzy hamburger</h3>
               <a href="menu.php" class="btn">see menus</a>
            </div>
            <div class="image">
               <img src="https://media.istockphoto.com/id/1139809224/photo/hamburger-isolated-on-white.webp?a=1&b=1&s=612x612&w=0&k=20&c=HaFHhgiWfi0h2DHKd0VyKip6-f7BS60WJy-osr3J4c4=" alt="">
            </div>
         </div>

         <div class="swiper-slide slide">
            <div class="content">
               <span>order online</span>
               <h3>rosted chicken</h3>
               <a href="menu.php" class="btn">see menus</a>
            </div>
            <div class="image">
               <img src="https://media.istockphoto.com/id/162978332/photo/sliced-grilled-and-seasoned-chicken-breast.webp?a=1&b=1&s=612x612&w=0&k=20&c=Q-0xIZFWNOcsoEOVbahd9M_jX35V1XJPQt9xLBvDZzY=" alt="">
            </div>
         </div>

         <div class="swiper-slide slide">
            <div class="content">
               <span>order online</span>
               <h3>Thali</h3>
               <a href="menu.php" class="btn">see menus</a>
            </div>
            <div class="image">
               <img src="https://media.istockphoto.com/id/1372205267/photo/traditional-indian-food-thali-served-in-plate-top-view.webp?a=1&b=1&s=612x612&w=0&k=20&c=tXRaji7mMo0WeR1ox-2CW6_IrsjbT9DUOQmJkYJixPg=" alt="">
            </div>
      </div>

      <div class="swiper-pagination"></div>

   </div>

</section>

<section class="category">

   <h1 class="title">food category</h1>

   <div class="box-container">

      <a href="category.php?category=fast food" class="box">
         <img src="images/fast.png" alt="">
         <h3>fast food</h3>
      </a>

      <a href="category.php?category=veg " class="box">
         <img src="images/veg.png" alt="">
         <h3>veg</h3>
      </a>

      <a href="category.php?category=non vegs" class="box">
         <img src="images/nonveg.png" alt="">
         <h3>non veg</h3>
      </a>

      <a href="category.php?category=main dish" class="box">
         <img src="images/main.png" alt="">
         <h3>main dishes</h3>
      </a>

      <a href="category.php?category=drinks" class="box">
         <img src="images/drink.png" alt="">
         <h3>drinks</h3>
      </a>

      <a href="category.php?category=desserts" class="box">
         <img src="images/dessert.png" alt="">
         <h3>desserts</h3>
      </a>

      <a href="category.php?category=baby food" class="box">
         <img src="images/baby.png" alt="">
         <h3>baby food</h3>
      </a>

      <a href="category.php?category=Indian thali" class="box">
         <img src="images/thali.png" alt="">
         <h3>Thali</h3>
      </a>
   </div>

</section>




<section class="products">

   <h1 class="title">latest dishes and drinks</h1>

   <div class="box-container">

      <?php
         $select_products = $conn->prepare("SELECT * FROM `products` LIMIT 6");
         $select_products->execute();
         if($select_products->rowCount() > 0){
            while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){
      ?>
      <form action="" method="post" class="box">
         <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
         <input type="hidden" name="name" value="<?= $fetch_products['name']; ?>">
         <input type="hidden" name="price" value="<?= $fetch_products['price']; ?>">
         <input type="hidden" name="image" value="<?= $fetch_products['image']; ?>">
         <a href="quick_view.php?pid=<?= $fetch_products['id']; ?>" class="fas fa-eye"></a>
         <button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button>
         <img src="uploaded_img/<?= $fetch_products['image']; ?>" alt="">
         <a href="category.php?category=<?= $fetch_products['category']; ?>" class="cat"><?= $fetch_products['category']; ?></a>
         <div class="name"><?= $fetch_products['name']; ?></div>
         <div class="flex">
            <div class="price"><span>RS: </span><?= $fetch_products['price']; ?></div>
            <input type="number" name="qty" class="qty" min="1" max="99" value="1" maxlength="2">
         </div>
      </form>
      <?php
            }
         }else{
            echo '<p class="empty">no products added yet!</p>';
         }
      ?>

   </div>

   <div class="more-btn">
      <a href="menu.php" class="btn">view all</a>
   </div>

</section>


















<?php include 'components/footer.php'; ?>


<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<!-- custom js file link  -->
<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".hero-slider", {
   loop:true,
   grabCursor: true,
   effect: "flip",
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
});

</script>

</body>
</html>