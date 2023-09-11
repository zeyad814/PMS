<?php

include 'config.php';
include './handlers.php';
session_start();
foreach ($_POST as $key => $value) {
     $$key = htmlentities(htmlspecialchars(trim($value)));
}

if(isset($submit)){

  $product=new DB();
  $product->insertData('products',['name','price','image'],[$name,$price,$image]);
  if ($product) {
    header('location:index.php');
  }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>

   
<div class="form-container">

   <form action="" method="post">
      <h3>ADD PRODUCT</h3>
      <input type="text" name="name" required placeholder="enter porduct name" class="box">
      <input type="number" name="price" required placeholder="enter price" class="box">
      <input type="file" name="image" required placeholder="enter image" class="box">
      <input type="submit" name="submit" class="btn" value="ADD PRODUCT">

   </form>

</div>

</body>
</html>