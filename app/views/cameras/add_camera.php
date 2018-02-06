<?php require APPROOT . '/views/inc/header.php'; ?>
<title><?php echo SITENAME." | Add Camera"; ?></title>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$( function() {
$( "#camera_brand" ).selectmenu();
$( "#camera_crop" ).selectmenu();
$( "#camera_lens_mount" ).selectmenu();
} );
</script>
</head>
<body>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<div class="container">
    <a href="<?php echo URLROOT; ?>/cameras" class="btn btn-light"><i class="fa fa-backward"></i> Back to All Cameras</a>
    <div class="card card-body bg-light mt-5">
        <h2>Add New Camera Body</h2>
        <p>Please fill out this form to add a new camera body to the database</p>
        <div class="demo">
            <form action="<?php echo URLROOT; ?>/cameras/addCamera" method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="camera_brand">Camera Brand:</label>
                            <select name="camera_brand" id="camera_brand" class="form-control form-control-lg <?php echo (!empty($data['camera_brand_err'])) ? 'is-invalid' : ''; ?>">
                                <option disabled <?php echo (empty($data['camera_brand']))? 'selected':''?> >Please pick one</option>
                                <option value="Canon" <?php echo (!empty($data['camera_brand']) === 'Canon' ) ? 'selected': ''; ?>>Canon</option>
                                <option value="Nikon" <?php echo (!empty($data['camera_brand']) === 'Nikon') ? 'selected' : ''; ?>>Nikon</option>
                            </select>
                            <div class="invalid-feedback"><?php echo $data['camera_brand_err']; ?></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="camera_model">Camera Model:</label>
                            <input type="text" name="camera_model" class="form-control form-control-lg <?php echo (!empty($data['camera_model_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['camera_model']; ?>">
                            <div class="invalid-feedback"><?php echo $data['camera_model_err']; ?></div>
                        </div>
                    </div>
                    <div class="col md-4">
                        <div class="form-group">
                            <label for="camera_resolution">Maximum Resolution: </label>
                            <input type="text" name="camera_resolution" class="form-control form-control-lg <?php echo (!empty($data['camera_resolution_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['camera_resolution']; ?>" placeholder="in megapixels">
                            <div class="invalid-feedback"><?php echo $data['camera_resolution_err']; ?></div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="camera_crop">Sensor Size: </label>
                            <select type="text" name="camera_crop" id="camera_crop" class="form-control form-control-lg <?php echo (!empty($data['camera_crop_err'])) ? 'is-invalid' : ''; ?>" >
                                <option disabled <?php echo (empty($data['camera_crop']))? 'selected':'';?> >Please pick one</option>
                                <optgroup label="Canon">
                                    <option value="1.0">Full Frame</option>
                                    <option value="1.6">Canon APS-C Crop (1.6x)</option>
                                </optgroup>
                                <optgroup label="Nikon">
                                    <option value="1.0">Full Frame</option>
                                    <option value="1.5">Nikon APS-C Crop (1.5)</option>
                                </optgroup>
                            </select>
                            <div class="invalid-feedback"><?php echo $data['camera_crop_err']; ?></div>
                        </div>
                        
                    </div>
                    <div class="col md-4">
                        <div class="form-group">
                            <label for="camera_lens_mount">Lens Mount: </label>
                            <select name="camera_lens_mount" id="camera_lens_mount" class="form-control form-control-lg <?php echo (!empty($data['camera_lens_mount_err'])) ? 'is-invalid' : ''; ?>" >
                                <option disabled <?php echo (empty($data['camera_lens_mount']))? 'selected':'';?> >Please pick one</option>
                                <optgroup label="Canon">
                                    <option value="EF">For Full Frame</option>
                                    <option value="EF-S">For Crop Sensors</option>
                                </optgroup>
                                <optgroup label="Nikon">
                                    <option value="FX">For Full Frame</option>
                                    <option value="DX">For Crop Sensors</option>
                                </optgroup>
                            </select>
                            <div class="invalid-feedback"><?php echo $data['camera_lens_mount_err']; ?></div>
                        </div>
                    </div>
                    <div class="col md-4">
                        <input type="submit" value="Add Camera to Database" class="mt-5 btn btn-success btn-block">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>