
 <div class="main-content">
<section class="section">
  <div class="section-header">
    <h1> Hero </h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></div>
      <div class="breadcrumb-item"><a href="#"> Hero </a></div>
    </div>
  </div>

  <div class="section-body">
  <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
        <div class="card-header">
            <h4>Form Hero </h4>
        </div>
        <form class="form-horizontal">
	   
              <div class="form-group">
                <label class="col-sm-2 control-label" for="varchar">Heading <?php echo form_error('heading') ?></label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="heading" id="heading" placeholder="Heading" value="<?php echo $heading; ?>" readonly />
                </div>
              </div>
	      
            <div class="card-body">
              <div class="form-group">
                <label class="col-sm-2 control-label" for="sub_heading">Sub Heading <?php echo form_error('sub_heading') ?></label>
                <div class="col-sm-12">
                    <textarea class="form-control" rows="3" name="sub_heading" id="sub_heading" placeholder="Sub Heading"><?php echo $sub_heading; ?></textarea>
                </div>
              </div>
	   
              <div class="form-group">
                <label class="col-sm-2 control-label" for="varchar">Image <?php echo form_error('image') ?></label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="image" id="image" placeholder="Image" value="<?php echo $image; ?>" readonly />
                </div>
              </div>
	   
     
        <div class="card-footer text-left">
        <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <a href="<?php echo site_url('hero') ?>" class="btn btn-icon icon-left btn-success">Cancel</a>
	
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
