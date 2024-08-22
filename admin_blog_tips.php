<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
}

if(isset($_POST['add_blog_tip'])){

   $title = mysqli_real_escape_string($conn, $_POST['title']);
   $subtitle = mysqli_real_escape_string($conn, $_POST['subtitle']);
   $description = mysqli_real_escape_string($conn, $_POST['description']);
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   $select_blog_tip_title = mysqli_query($conn, "SELECT title FROM `blog_tips` WHERE title = '$title'") or die('query failed');

   if(mysqli_num_rows($select_blog_tip_title) > 0){
      $message[] = 'Blog tip title already exists!';
   }else{
      $insert_blog_tip = mysqli_query($conn, "INSERT INTO `blog_tips`(title, subtitle, description, image) VALUES('$title', '$subtitle', '$description', '$image')") or die('query failed');

      if($insert_blog_tip){
         if($image_size > 2000000){
            $message[] = 'Image size is too large!';
         }else{
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'Blog tip added successfully!';
         }
      }
   }

}

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $select_delete_image = mysqli_query($conn, "SELECT image FROM `blog_tips` WHERE id = '$delete_id'") or die('query failed');
   $fetch_delete_image = mysqli_fetch_assoc($select_delete_image);
   unlink('uploaded_img/'.$fetch_delete_image['image']);
   mysqli_query($conn, "DELETE FROM `blog_tips` WHERE id = '$delete_id'") or die('query failed');
   header('location:admin_blog_tips.php');

}

if(isset($_POST['update_blog_tip'])){
   $update_id = $_POST['update_id'];
   $update_title = mysqli_real_escape_string($conn, $_POST['update_title']);
   $update_subtitle = mysqli_real_escape_string($conn, $_POST['update_subtitle']);
   $update_description = mysqli_real_escape_string($conn, $_POST['update_description']);
   $update_image = $_FILES['update_image']['name'];
   $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
   $update_image_folder = 'uploaded_img/'.$update_image;

   if(!empty($update_image)){
      $update_query = "UPDATE `blog_tips` SET title = '$update_title', subtitle = '$update_subtitle', description = '$update_description', image = '$update_image' WHERE id = '$update_id'";
      mysqli_query($conn, $update_query) or die('query failed');
      move_uploaded_file($update_image_tmp_name, $update_image_folder);
   }else{
      $update_query = "UPDATE `blog_tips` SET title = '$update_title', subtitle = '$update_subtitle', description = '$update_description' WHERE id = '$update_id'";
      mysqli_query($conn, $update_query) or die('query failed');
   }

   header('location:admin_blog_tips.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Admin Blog Tips</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom admin css file link  -->
   <link rel="stylesheet" href="css/admin_style.css">
   <link rel="stylesheet" href="css/style.css"> <!-- Include the user-facing CSS file for consistency -->

</head>
<body>
   
<?php @include 'admin_header.php'; ?>

<section class="add-blog-tips">

   <form action="" method="POST" enctype="multipart/form-data">
      <h3>Add New Blog Tip</h3>
      <input type="text" class="box" required placeholder="Enter blog tip title" name="title">
      <input type="text" class="box" placeholder="Enter blog tip subtitle (optional)" name="subtitle">
      <textarea name="description" class="box" required placeholder="Enter blog tip description" cols="30" rows="10"></textarea>
      <input type="file" accept="image/jpg, image/jpeg, image/png" required class="box" name="image">
      <input type="submit" value="Add Blog Tip" name="add_blog_tip" class="btn">
   </form>

</section>

<section class="blog-tips"> <!-- Use the same section class as the user-facing page -->

   <h1 class="title">Manage Blog Tips</h1>

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
               <div style="display:flex; flex-direction:row;">
               <a href="admin_update_blog_tip.php?update=<?php echo $fetch_blog_tips['id']; ?>" class="option-btn" style="width: 20%;">Update</a>
               <a href="admin_blog_tips.php?delete=<?php echo $fetch_blog_tips['id']; ?>" class="delete-btn" onclick="return confirm('Delete this blog tip?');" style="width: 20%;">Delete</a>
               </div>
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

<?php
// If update request is detected, show the update form pre-filled with the blog tip data
if(isset($_GET['update'])){
   $update_id = $_GET['update'];
   $select_blog_tip = mysqli_query($conn, "SELECT * FROM `blog_tips` WHERE id = '$update_id'") or die('query failed');
   if(mysqli_num_rows($select_blog_tip) > 0){
      $fetch_blog_tip = mysqli_fetch_assoc($select_blog_tip);
?>

<section class="edit-blog-tips">
   <form action="" method="POST" enctype="multipart/form-data">
      <input type="hidden" name="update_id" value="<?php echo $fetch_blog_tip['id']; ?>">
      <input type="text" name="update_title" value="<?php echo $fetch_blog_tip['title']; ?>" class="box" required placeholder="Enter blog tip title">
      <input type="text" name="update_subtitle" value="<?php echo $fetch_blog_tip['subtitle']; ?>" class="box" placeholder="Enter blog tip subtitle (optional)">
      <textarea name="update_description" class="box" required placeholder="Enter blog tip description" cols="30" rows="10"><?php echo $fetch_blog_tip['description']; ?></textarea>
      <input type="file" name="update_image" accept="image/jpg, image/jpeg, image/png" class="box">
      <input type="submit" value="Update Blog Tip" name="update_blog_tip" class="btn">
   </form>
</section>

<?php
   }
}
?>

<script src="js/admin_script.js"></script>

</body>
</html>
