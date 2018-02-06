<?php require APPROOT . '/views/inc/header.php'; ?>
  <title><?php echo SITENAME." | Lenses"; ?></title>
  <style>
  .card {
    max-width: 95%;
  }
</style>
</head>
<body>
  <?php require APPROOT . '/views/inc/navbar.php'; ?>
  <div class="container">

<div class="alert"><?php flash('lens_message'); ?></div>
    <div class="row">
        <div class="col-md-9">
            <h1>Lenses</h1>
            <div class="row" id="lenses-table">
                <?php foreach($data['lenses'] as $lens) : ?>
                    <div class="col-md-6 mr-0">
                        <div class="card card-body mb-3">
                            <h3 class="card-title text-center"><small><?php echo $lens->lens_brand; ?></small></h3>
   <h3><?php echo $lens->lens_min_focal_length; ?><?php echo ($lens->lens_type == "Zoom")? " - ".$lens->lens_max_focal_length: '';?>mm  <?php echo "<em>f/</em>".$lens->lens_max_aperture; ?> <?php echo $lens->lens_series; ?></h3>
                            <a href="<?php echo URLROOT; ?>/lenses/viewLens/<?php echo $lens->lens_id; ?>" class="btn btn-dark mb-2">View Details</a>
                            
                            
                        </div>
                    </div>
                    <?php endforeach; ?>
            </div>
        </div>
         <?php if($_SESSION['user_level'] == 2) : ?>
        <div class="col-md-3">
            <a href="<?php echo URLROOT; ?>/lenses/addLens" class="btn btn-primary pull-right">
                <i class="fa fa-pencil"></i>Add Lens to Database

            </a>
        </div>
        <?php endif; ?>
    </div>
    <?php require APPROOT . '/views/inc/footer.php'; ?>
