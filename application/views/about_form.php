<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1> About </h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></div>
        <div class="breadcrumb-item"><a href="#"> About </a></div>
      </div>
    </div>

    <div class="section-body">
      <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
          <div class="card">
            <div class="card-header">
              <h4>Form About </h4>
            </div>
            <form action="<?php echo $action; ?>" method="post" class="form-horizontal" enctype="multipart/form-data">

              <div class="form-group">
                <label class="col-sm-2 control-label" for="varchar">Heading <?php echo form_error('heading') ?></label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="heading" id="heading" placeholder="Heading" value="<?php echo $heading; ?>" />
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label" for="sub_heading">Sub Heading <?php echo form_error('sub_heading') ?></label>
                <div class="col-sm-12">
                  <textarea class="form-control" rows="3" name="sub_heading" id="sub_heading" placeholder="Sub Heading"><?php echo $sub_heading; ?></textarea>
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label" for="varchar">Image <?php echo form_error('image') ?></label>
                <div class="col-sm-12">
                  <input type="file" class="form-control" name="image" id="image" placeholder="Image" value="<?php echo $image; ?>" />
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label" for="varchar">Video <?php echo form_error('video') ?></label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="video" id="video" placeholder="video" value="<?php echo $video; ?>" />
                </div>
              </div>


              <div class="card-footer text-left">
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <button type="submit" class="btn btn-primary"><span class="fa fa-edit"></span><?php echo $button ?></button>
                <a href="<?php echo site_url('about') ?>" class="btn btn-icon icon-left btn-success">Cancel</a>

              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>