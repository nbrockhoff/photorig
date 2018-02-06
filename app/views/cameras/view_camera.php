<?php require APPROOT . '/views/inc/header.php'; ?>
  <title><?php echo SITENAME." | View Camera"; ?></title>
</head>
<body>
  <?php require APPROOT . '/views/inc/navbar.php'; ?>
  <div class="container">

   <a href="<?php echo URLROOT; ?>/cameras" class="btn btn-light"><i class="fa fa-backward"></i> Back to All Cameras</a>
   <h1><small><?php echo $data['camera']->camera_brand; ?></small>
   <br><?php echo $data['camera']->camera_model; ?></h1>
   <h3><?php echo $data['camera']->camera_resolution; ?> Megapixels</h3>
   <h4><?php echo $data['camera']->camera_crop; ?>x Crop Sensor</h4>
   <h5>Compatible with <?php echo $data['camera']->camera_lens_mount; ?>-mount lenses.</h5>
   
   
   <?php if($_SESSION['user_level'] >= 1) : ?>

   <hr>
   <form class="pull-left mr-1" action="<?php echo URLROOT; ?>/users/addUserCamera/<?php echo $data['camera']->camera_id; ?>" method="post">
       <input type="submit" value="Add To Your Gear" class="btn btn-info">
   </form>
    
     <form class="pull-right ml-1" action="<?php echo URLROOT; ?>/cameras/removeUserCamera/<?php echo $data['camera']->camera_id; ?>" method="post">
       <input type="submit" value="Remove from Your Gear" class="btn btn-warning">
   </form>
   
    <?php if($_SESSION['user_level'] == 2) : ?>
   
   <a href="<?php echo URLROOT; ?>/cameras/editCamera/<?php echo $data['camera']->camera_id; ?>" class="btn btn-dark">Edit Camera Specs</a>
   
   <form class="pull-right" action="<?php echo URLROOT; ?>/cameras/deleteCamera/<?php echo $data['camera']->camera_id; ?>" method="post">
       <input type="submit" value="Delete from Database" class="btn btn-danger">
   </form>
   
       <?php endif; ?>
   <?php endif; ?>
    <?php require APPROOT . '/views/inc/footer.php'; ?>
