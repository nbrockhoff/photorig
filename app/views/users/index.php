<?php require APPROOT . '/views/inc/header.php'; ?>  <title><?php echo SITENAME." | Welcome, ".$_SESSION['user_name']."!"; ?></title>
</head>
<body>
  <?php require APPROOT . '/views/inc/navbar.php'; ?>
  <div class="container">
  
    <div class="alert">
        <?php flash('login_message'); ?>
    </div>
    <div class="row">
        <div class="col-md-9">
            <h2>Your Cameras</h2>
        </div>
        <div class="col-md-3">
            <a href="<?php echo URLROOT; ?>/cameras" class="btn btn-primary pull-right">
                <i class="fa fa-pencil"></i>Add Camera to Your Gear

            </a>
        </div>
    </div>

    <div class="row">
            <?php foreach($data['user_cameras'] as $camera) : ?>
                <div class="col-md-4">
                    <div class="card card-body mb-3">
                        <h3 class="card-title text-center"><small><?php echo $camera->camera_brand; ?></small><br>
                            <?php echo $camera->camera_model; ?></h3>
                        <a href="<?php echo URLROOT; ?>/cameras/viewCamera/<?php echo $camera->camera_id; ?>" class="btn btn-dark">View Details</a>
                        <form class="mt-2 text-center" action="<?php echo URLROOT; ?>/users/removeUserCamera/<?php echo $camera->camera_id; ?>" method="post">
       <input type="submit" value="Remove from Your Gear" class="btn btn-warning">
   </form>
                    </div>
                </div>

                <?php endforeach; ?>
        </div>
    <div class="row">
        <div class="col-md-9">
            <h2>Your Lenses</h2>
        </div>
        <div class="col-md-3">
            <a href="<?php echo URLROOT; ?>/lenses" class="btn btn-primary pull-right">
                <i class="fa fa-pencil"></i>Add Lenses to Your Gear

            </a>
        </div>
    </div>
    <div class="row">
            <?php foreach($data['user_lenses'] as $lens) : ?>
                <div class="col-md-4">
                    <div class="card card-body mb-3">
                        <h3><small><?php echo $lens->lens_brand; ?></small>
   <br><?php echo $lens->lens_series; ?> <?php echo $lens->lens_min_focal_length; ?>mm <?php echo $lens->lens_type; ?> <br><em>f/</em><?php echo $lens->lens_min_aperture; ?></h3>
                        <a href="<?php echo URLROOT; ?>/lenses/viewLens/<?php echo $lens->lens_id; ?>" class="btn btn-dark">View Details</a>
                        <form class="mt-2 text-center" action="<?php echo URLROOT; ?>/users/removeUserLens/<?php echo $lens->lens_id; ?>" method="post">
       <input type="submit" value="Remove from Your Gear" class="btn btn-warning">
   </form>
                    </div>
                </div>
                <?php endforeach; ?>
    </div>

    <?php require APPROOT . '/views/inc/footer.php'; ?>