<?php require APPROOT . '/views/inc/header.php'; ?>
<title><?php echo SITENAME." | Add Lens"; ?></title>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$( function() {
$( "#lens_brand" ).selectmenu();
$( "#lens_series" ).selectmenu();
$( "input[type='radio']" ).checkboxradio({
      icon: false
    });
$( "#lens_lens_mount" ).selectmenu();
} );
</script>
<style>

  #lens_type{
    transform: translateY(115%);
    margin-bottom: 0.1rem;
  }
.ui-checkboxradio-radio-label{
    margin-top: 1.6rem;
}
  .ui-widget {
    line-height: 2.1rem;
    font-size: 1.2rem;
  }
  strong {
    color: #ff0000;
  }
</style>
</head>
<body>
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<div class="container">
    <a href="<?php echo URLROOT; ?>/lenses" class="btn btn-light"><i class="fa fa-backward"></i> Back to All Lenses</a>
    <div class="card card-body bg-light mt-5">
        <h2>Add New Lens</h2>
        <p>Please fill out this form to add a new lens to the database</p>
        <form action="<?php echo URLROOT; ?>/lenses/addLens" method="post">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="lens_brand">Lens Brand:</label>
                        <select name="lens_brand" id="lens_brand" class="form-control form-control-lg <?php echo (!empty($data['lens_brand_err'])) ? 'is-invalid' : ''; ?>">
                            <option disabled <?php echo (empty($data['lens_brand']))? 'selected':'';?> >Please pick one</option>
                            <option value="Canon" <?php echo (!empty($data['lens_brand'])) ? (($data['lens_brand'] == 'Canon') ? 'selected="selected"' : ''):''; ?>>Canon</option>
                            <option value="Nikon" <?php echo (!empty($data['lens_brand'])) ? (($data['lens_brand'] == 'Nikon') ? 'selected="selected"' : ''):''; ?>>Nikon</option>
                            <option value="Sigma" <?php echo (!empty($data['lens_brand'])) ? (($data['lens_brand'] == 'Sigma') ? 'selected="selected"' : ''):''; ?>>Sigma</option>
                        </select>
                        <div class="invalid-feedback"><?php echo $data['lens_brand_err']; ?></div></div>
                    </div>
                    <div class="col-md-6">
                    <div class="form-group">
                        <label for="lens_series">Lens Series:</label>
                        <select name="lens_series" id="lens_series" class="form-control form-control-lg <?php echo (!empty($data['lens_series_err'])) ? 'is-invalid' : ''; ?>">
                            <option disabled <?php echo (empty($data['lens_series']))? 'selected':'';?> >Please pick one</option>
                            <optgroup label="Canon">
                                <option value="Standard" <?php echo (!empty($data['lens_series'])) ? (($data['lens_series'] == 'Standard') ? 'selected="selected"' : ''):''; ?>>Standard</option>
                                <option value="L" <?php echo (!empty($data['lens_series'])) ? (($data['lens_series'] == 'L') ? 'selected="selected"' : ''):''; ?>>L</option>
                            </optgroup>
                            <optgroup label="Nikon">
                                <option value="NIKKOR" <?php echo (!empty($data['lens_series'])) ? (($data['lens_series'] == 'NIKKOR') ? 'selected="selected"' : ''):''; ?>>NIKKOR</option>
                            </optgroup>
                            <optgroup label="Sigma">
                                <option value="Art" <?php echo (!empty($data['lens_series'])) ? (($data['lens_series'] == 'Art') ? 'selected="selected"' : ''):''; ?>>Art</option>
                                <option value="Contemporary" <?php echo (!empty($data['lens_series'])) ? (($data['lens_series'] == 'Contemporary') ? 'selected="selected"' : ''):''; ?>>Contemporary</option>
                                <option value="Sports" <?php echo (!empty($data['lens_series'])) ? (($data['lens_series'] == 'Sports') ? 'selected="selected"' : ''):''; ?>>Sports</option>
                            </optgroup>
                        </select>
                        <div class="invalid-feedback"><?php echo $data['lens_series_err']; ?></div></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <p id="lens_type">Lens Type: <?php echo (!empty($data['lens_type_err']))? "<strong>". $data['lens_type_err']."</strong>" :  '' ;?>
                        </p>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="lens_type" id="lens_type-prime" value="Prime" class="form-control"  <?php echo (isset($data['lens_type'])?(($data['lens_type']=="Prime")? "checked" :"" ): ""); ?>  >
                            <label class="form-check-label <?php echo (isset($data['lens_type'])?(($data['lens_type']=="lens_type-prime")? "ui-checkboxradio-checked ui-state-active" :"" ): ""); ?>" for="lens_type-prime">Prime</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="lens_type" id="lens_type-zoom" value="Zoom" class="form-control"  <?php echo (isset($data['lens_type'])?(($data['lens_type']=="Zoom")? "checked" :"" ): ""); ?>  >
                            <label class="form-check-label <?php echo (isset($data['lens_type'])?(($data['lens_type']=="lens_type-prime")? "ui-checkboxradio-checked ui-state-active" :"" ): ""); ?>" for="lens_type-zoom">Zoom</label>
                        </div>
                    </div>
                <div class="col-md-6">
                        <div class="form-group">
                        <label for="lens_lens_mount">Lens Mount Compatibility:</label>
                        <select name="lens_lens_mount" id="lens_lens_mount" class="form-control form-control-lg <?php echo (!empty($data['lens_lens_mount_err'])) ? 'is-invalid' : ''; ?>">
                            <option disabled <?php echo (empty($data['lens_lens_mount']))? 'selected':'';?> >Please pick one</option>
                            <optgroup label="Canon">
                                <option value="EF" <?php echo (!empty($data['lens_lens_mount'])) ? (($data['lens_lens_mount'] == 'EF') ? 'selected="selected"' : ''):''; ?>>Full Frame</option>
                                <option value="EF-S" <?php echo (!empty($data['lens_lens_mount'])) ? (($data['lens_lens_mount'] == 'EF-S') ? 'selected="selected"' : ''):''; ?>>APS-C</option>
                            </optgroup>
                            <optgroup label="Nikon">
                                <option value="FX" <?php echo (!empty($data['lens_lens_mount'])) ? (($data['lens_lens_mount'] == 'FX') ? 'selected="selected"' : ''):''; ?>>Full Frame</option>
                                <option value="DX" <?php echo (!empty($data['lens_lens_mount'])) ? (($data['lens_lens_mount'] == 'DX') ? 'selected="selected"' : ''):''; ?>>APS-C</option>
                            </optgroup>
                        </select>
                        <div class="invalid-feedback"><?php echo $data['lens_lens_mount_err']; ?></div></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="form-group">
                            <label for="lens_max_aperture">Maximum Lens Aperture: </label>
                            <input type="text" name="lens_max_aperture" class="form-control form-control-lg <?php echo (!empty($data['lens_max_aperture_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['lens_max_aperture']; ?>" placeholder="f/">
                            <span class="invalid-feedback" ><?php echo $data['lens_max_aperture_err']; ?></span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="form-group">
                            <label for="lens_min_aperture">Minimum Lens Aperture: </label>
                            <input type="text" name="lens_min_aperture" class="form-control form-control-lg <?php echo (!empty($data['lens_min_aperture_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['lens_min_aperture']; ?>"  placeholder="f/">
                            <span class="invalid-feedback"><?php echo $data['lens_min_aperture_err']; ?></span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="form-group">
                            <label for="lens_min_aperture">Minimum Focal Length: </label>
                            <input type="text" name="lens_min_focal_length" class="form-control form-control-lg <?php echo (!empty($data['lens_min_focal_length_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['lens_min_focal_length']; ?>" placeholder="mm">
                            <span class="invalid-feedback"><?php echo $data['lens_min_focal_length_err']; ?></span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="form-group">
                            <label for="lens_max_aperture">Maximum Focal Length: </label>
                            <input type="text" name="lens_max_focal_length" class="form-control form-control-lg <?php echo (!empty($data['lens_max_focal_length_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['lens_max_focal_length']; ?>"  placeholder="mm">
                            <span class="invalid-feedback"><?php echo $data['lens_max_focal_length_err']; ?></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                        <input type="submit" value="Add Lens to Database" class="btn btn-success btn-block">
                </div>
            </form>
        </div>
        <?php require APPROOT . '/views/inc/footer.php'; ?>