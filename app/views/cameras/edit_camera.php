<?php require APPROOT . '/views/inc/header.php'; ?>
<title><?php echo SITENAME." | Edit Camera"; ?></title>
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
        <h2>Edit Camera Body</h2>
        <div class="demo">
            <form action="<?php echo URLROOT; ?>/cameras/editCamera/<?php echo $data['camera_id']; ?>" method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="camera_brand">Camera Brand:</label>
                            <select name="camera_brand" id="camera_brand" class="form-control form-control-lg <?php echo (!empty($data['camera_brand_err'])) ? 'is-invalid' : ''; ?>">
                                <option disabled>Please pick one</option>
                                <option value="Canon" <?php echo (!empty($data['camera_brand'])) ? (($data['camera_brand'] == 'Canon') ? 'selected="selected"' : ''):''; ?>>Canon</option>
                                <option value="Nikon" <?php echo (!empty($data['camera_brand'])) ? (($data['camera_brand'] == 'Nikon') ? 'selected="selected"' : ''):''; ?>>Nikon</option>
                            </select>
                            <div class="invalid-feedback"><?php echo $data['camera_brand_err']; ?></div></div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="camera_model">Camera Model: </label>
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
                                    <option value="1.0" <?php echo 
                                    (!empty($data['camera_brand'])) ?
                                        (($data['camera_brand'] == 'Canon') ?
                                             (($data['camera_crop'] == '1.0')? 'selected="selected"': '')
                                        :'') 
                                    :''; ?>
                                    >Full Frame</option>
                                    <option value="1.6" <?php echo (!empty($data['camera_crop'])) ? (($data['camera_crop'] == '1.6') ? 'selected="selected"' : ''):''; ?>>Canon APS-C</option>
                                </optgroup>
                                <optgroup label="Nikon">
                                    <option value="1.0" <?php echo 
                                    (!empty($data['camera_brand'])) ?
                                        (($data['camera_brand'] == 'Nikon') ?
                                             (($data['camera_crop'] == '1.0')? 'selected="selected"': '')
                                        :'') 
                                    :''; ?>
                                    >Full Frame</option>
                                    <option value="1.5" <?php echo (!empty($data['camera_crop'])) ? (($data['camera_crop'] == '1.5') ? 'selected="selected"' : ''):''; ?>>Nikon APS-C</option>
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
                                    <option value="EF" <?php echo (!empty($data['camera_lens_mount'])) ? (($data['camera_lens_mount'] == 'EF') ? 'selected="selected"' : ''):''; ?>>For Full Frame</option>
                                    <option value="EF-S" <?php echo (!empty($data['camera_lens_mount'])) ? (($data['camera_lens_mount'] == 'EF-S') ? 'selected="selected"' : ''):''; ?>>For Crop Sensors</option>
                                </optgroup>
                                <optgroup label="Nikon">
                                    <option value="FX" <?php echo (!empty($data['camera_lens_mount'])) ? (($data['camera_lens_mount'] == 'FX') ? 'selected="selected"' : ''):''; ?>>For Full Frame</option>
                                    <option value="DX" <?php echo (!empty($data['camera_lens_mount'])) ? (($data['camera_lens_mount'] == 'DX') ? 'selected="selected"' : ''):''; ?>>For Crop Sensors</option>
                                </optgroup>
                            </select>
                            <div class="invalid-feedback"><?php echo $data['camera_lens_mount_err']; ?></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <input type="submit" value="Update Camera" class="btn btn-success btn-block mt-5">
                    </div>
                </div>
            </form>
        </div>
        <?php require APPROOT . '/views/inc/footer.php'; ?>