
 <div class="main-content">
<section class="section">
  <div class="section-header">
    <h1> Team </h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></div>
      <div class="breadcrumb-item"><a href="#"> Team </a></div>
    </div>
  </div>

  <div class="section-body">
  <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
        <div class="card-header">
            <h4>Form Team </h4>
        </div>
        <form action="<?php echo $action; ?>" method="post" class="form-horizontal" enctype="multipart/form-data">
	   
              <div class="form-group">
                <label class="col-sm-2 control-label" for="varchar">Image <?php echo form_error('image') ?></label>
                <div class="col-sm-12">
                  <input type="file" class="form-control" name="image" id="image" placeholder="Image" value="<?php echo $image; ?>" />
                </div>
              </div>
	   
              <div class="form-group">
                <label class="col-sm-2 control-label" for="varchar">Name <?php echo form_error('name') ?></label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $name; ?>" />
                </div>
              </div>
	   
              <div class="form-group">
                <label class="col-sm-2 control-label" for="varchar">Job <?php echo form_error('job') ?></label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="job" id="job" placeholder="Job" value="<?php echo $job; ?>" />
                </div>
              </div>
	   
              <div class="form-group">
                <label class="col-sm-2 control-label" for="varchar">Twitter <?php echo form_error('twitter') ?></label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="twitter" id="twitter" placeholder="Twitter" value="<?php echo $twitter; ?>" />
                </div>
              </div>
	   
              <div class="form-group">
                <label class="col-sm-2 control-label" for="varchar">Facebook <?php echo form_error('facebook') ?></label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="facebook" id="facebook" placeholder="Facebook" value="<?php echo $facebook; ?>" />
                </div>
              </div>
	   
              <div class="form-group">
                <label class="col-sm-2 control-label" for="varchar">Instagram <?php echo form_error('instagram') ?></label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="instagram" id="instagram" placeholder="Instagram" value="<?php echo $instagram; ?>" />
                </div>
              </div>
	   
              <div class="form-group">
                <label class="col-sm-2 control-label" for="varchar">Linkedin <?php echo form_error('linkedin') ?></label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="linkedin" id="linkedin" placeholder="Linkedin" value="<?php echo $linkedin; ?>" />
                </div>
              </div>
	   
     
        <div class="card-footer text-left">
        <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><span class="fa fa-edit"></span><?php echo $button ?></button> 
	    <a href="<?php echo site_url('team') ?>" class="btn btn-icon icon-left btn-success">Cancel</a>
	
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
