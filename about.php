<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:about.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>about</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="heading">
    <h3>about us</h3>
    <p> <a href="home.php"  style="color: rgb(43, 115, 43);">home</a> / about </p>
</section>

<section class="about">

    <div class="flex">

        <div class="image">
            <img src="images/plants1.jpg" alt="">
        </div>

        <div class="content">
            <h3>why choose us?</h3>
            <p>We stand out because of our dedication to quality, sustainability, and customer satisfaction. Our experienced horticulturists nurture each plant with care.</p>
            <a href="shop.php" class="btn">shop now</a>
        </div>

    </div>

    <div class="flex">

        <div class="content">
            <h3>what we provide?</h3>
            <p>At Flora, we offer a diverse selection of rare and exotic species, indoor plants, garden staples, and seasonal favorites.For more information</p>
            <a href="contact.php" class="btn">contact us</a>
        </div>

        <div class="image">
            <img src="images/plants3.jpg" alt="">
        </div>

    </div>

    <div class="flex">

        <div class="image">
            <img src="images/plants2.png" alt="">
        </div>

        <div class="content">
            <h3>who we are?</h3>
            <p>Welcome to Flora, your destination for a diverse range of healthy and beautiful plants. Established in 2022 in Bhimavaram, our nursery brings nature's beauty closer to you. </p>
            <a href="shop.php" class="btn">shop now</a>
        </div>

    </div>

</section>











<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>