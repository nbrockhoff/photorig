<?php require APPROOT . '/views/inc/header.php'; ?>
  <title><?php echo SITENAME." | View Lens"; ?></title>
</head>
<body>
  <?php require APPROOT . '/views/inc/navbar.php'; ?>
  <div class="container">

   <a href="<?php echo URLROOT; ?>/lenses" class="btn btn-light"><i class="fa fa-backward"></i> Back to All Lenses</a>
   <h2><em><?php echo $data['lens']->lens_brand; ?></em></h2>
   <h1><?php echo $data['lens']->lens_min_focal_length; ?><?php echo ($data['lens']->lens_type == "Zoom")? " - ".$data['lens']->lens_max_focal_length: '';?>mm  <?php echo "<em>f/</em>".$data['lens']->lens_max_aperture; ?> <?php echo $data['lens']->lens_series; ?>  <?php echo $data['lens']->lens_type; ?> Lens</h1>
   <h3>Compatible with <?php echo $data['lens']->lens_lens_mount; ?> lens mounts.</h3>
   
   <?php if($_SESSION['user_level'] >= 1) : ?>
   <hr>
   <a href="<?php echo URLROOT; ?>/users/addUserLens/<?php echo $data[lens]->lens_id; ?>" class="btn btn-info">
                <i class="fa fa-plus-square"></i> Add to Your Gear
</a>
 
    <form class="pull-right ml-1" action="<?php echo URLROOT; ?>/users/removeUserLens/<?php echo $data['lens']->lens_id; ?>" method="post">
       <input type="submit" value="Remove from Your Gear" class="btn btn-warning">
   </form>
  
  <?php if($_SESSION['user_level'] == 2) : ?>
   <a href="<?php echo URLROOT; ?>/lenses/editLens/<?php echo $data['lens']->lens_id; ?>" class="btn btn-dark">Edit Lens Specs</a>
   
   <form class="pull-right" action="<?php echo URLROOT; ?>/lenses/deleteLens/<?php echo $data['lens']->lens_id; ?>" method="post">
       <input type="submit" value="Delete" class="btn btn-danger">
   </form>
          <?php endif; ?>

   <?php endif; ?>
    <?php require APPROOT . '/views/inc/footer.php'; ?>
