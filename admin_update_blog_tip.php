<?php

@include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location:login.php');
}

if (isset($_POST['update_blog_tip'])) {
    $update_id = $_POST['update_id'];
    $update_title = mysqli_real_escape_string($conn, $_POST['update_title']);
    $update_subtitle = mysqli_real_escape_string($conn, $_POST['update_subtitle']);
    $update_description = mysqli_real_escape_string($conn, $_POST['update_description']);
    $update_image = $_FILES['update_image']['name'];
    $update_image_size = $_FILES['update_image']['size'];
    $update_image_tmp_name = $_FILES['update_image']['tmp_name'];
    $update_image_folder = 'uploaded_img/' . $update_image;
    $old_image = $_POST['update_old_image'];

    $update_query = "UPDATE `blog_tips` SET title = '$update_title', subtitle = '$update_subtitle', description = '$update_description' WHERE id = '$update_id'";

    if (!empty($update_image)) {
        if ($update_image_size > 2000000) {
            $message[] = 'Image size is too large!';
        } else {
            $update_query = "UPDATE `blog_tips` SET title = '$update_title', subtitle = '$update_subtitle', description = '$update_description', image = '$update_image' WHERE id = '$update_id'";
            move_uploaded_file($update_image_tmp_name, $update_image_folder);
            unlink('uploaded_img/' . $old_image);
        }
    }

    mysqli_query($conn, $update_query) or die('query failed');

    $message[] = 'Blog tip updated successfully!';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Blog Tip</title>

    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- custom admin css file link -->
    <link rel="stylesheet" href="css/admin_style.css">
</head>
<body>

<?php @include 'admin_header.php'; ?>

<section class="update-product">
   <h3 class="title">Update Blog Tip</h3>

   <?php
   if(isset($_GET['update'])){
      $update_id = $_GET['update'];
      $select_blog_tip = mysqli_query($conn, "SELECT * FROM `blog_tips` WHERE id = '$update_id'") or die('query failed');
      if(mysqli_num_rows($select_blog_tip) > 0){
         $fetch_blog_tip = mysqli_fetch_assoc($select_blog_tip);
   ?>

   <form action="" method="post" enctype="multipart/form-data">
      <img src="uploaded_img/<?php echo $fetch_blog_tip['image']; ?>" class="image" alt="">
      <input type="hidden" value="<?php echo $fetch_blog_tip['id']; ?>" name="update_id">
      <input type="hidden" value="<?php echo $fetch_blog_tip['image']; ?>" name="update_old_image">
      <input type="text" class="box" value="<?php echo $fetch_blog_tip['title']; ?>" required placeholder="Enter blog tip title" name="update_title">
      <input type="text" class="box" value="<?php echo $fetch_blog_tip['subtitle']; ?>" placeholder="Enter blog tip subtitle (optional)" name="update_subtitle">
      <textarea name="update_description" class="box" required placeholder="Enter blog tip description" cols="30" rows="10"><?php echo $fetch_blog_tip['description']; ?></textarea>
      <input type="file" accept="image/jpg, image/jpeg, image/png" class="box" name="update_image">
      <input type="submit" value="Update Blog Tip" name="update_blog_tip" class="btn">
      <a href="admin_blog_tips.php" class="option-btn">Go Back</a>
   </form>

   <?php
      } else {
         echo '<p class="empty">No blog tip selected for update</p>';
      }
   }
   ?>

</section>

<script src="js/admin_script.js"></script>

</body>
</html>
