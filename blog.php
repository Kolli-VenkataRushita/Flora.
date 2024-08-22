<?php

@include 'config.php';

session_start();

$user_id = $_SESSION['user_id'];

if(!isset($user_id)){
   header('location:login.php');
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Blog Tips</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php @include 'header.php'; ?>

<section class="heading">
    <h3>Blog Tips</h3>
    <p> <a href="home.php" style="color: rgb(43, 115, 43);">home</a> / blog tips </p>
</section>

<section class="blog-tips">

   <div class="box-container">

      <?php
         $select_blog_tips = mysqli_query($conn, "SELECT * FROM `blog_tips`") or die('query failed');
         if(mysqli_num_rows($select_blog_tips) > 0){
            while($fetch_blog_tips = mysqli_fetch_assoc($select_blog_tips)){
      ?>
      <div class="box">
         <div class="media">
            <div class="media-left media-top">
               <img src="uploaded_img/<?php echo $fetch_blog_tips['image']; ?>" class="media-object" alt="">
            </div>
            <div class="media-body">
               <h4 class="media-heading"><?php echo $fetch_blog_tips['title']; ?></h4>
               <p class="subtitle"><?php echo $fetch_blog_tips['subtitle']; ?></p>
               <p class="description"><?php echo $fetch_blog_tips['description']; ?></p>
            </div>
         </div>
      </div>
      <?php
         }
      }else{
         echo '<p class="empty">No blog tips added yet!</p>';
      }
      ?>

   </div>

</section>

<?php @include 'footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
