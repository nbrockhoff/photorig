
<?php require APPROOT . '/views/inc/header.php'; ?>
  <title><?php echo SITENAME." | Cameras"; ?></title>
</head>
<body>
  <?php require APPROOT . '/views/inc/navbar.php'; ?>
  <div class="container">

<div class="alert"><?php flash('camera_message'); ?></div>
    <div class="row">
        <div class="col-md-9">
            <h1>Cameras</h1>
            <div class="row" id="cameras-table">
                <?php foreach($data['cameras'] as $camera) : ?>
                    <div class="col-md-4">
                        <div class="card card-body mb-3">
                            <h3 class="card-title text-center"><small><?php echo $camera->camera_brand; ?></small><br>
                    <?php echo $camera->camera_model; ?></h3>
                            
                            <a href="<?php echo URLROOT; ?>/cameras/viewCamera/<?php echo $camera->camera_id; ?>" class="btn btn-dark mb-2">View Details</a>
                            
                            
                          
                            
                       
                        </div>
                    </div>
                    <?php endforeach; ?>
            </div>
        </div>
         <?php if($_SESSION['user_level'] == 2) : ?>
        <div class="col-md-3">
            <a href="<?php echo URLROOT; ?>/cameras/addCamera" class="btn btn-primary pull-right">
                <i class="fa fa-pencil"></i> Add Camera to Database

            </a>
        </div>
        <?php endif; ?>
    </div>
    <?php require APPROOT . '/views/inc/footer.php'; ?>
