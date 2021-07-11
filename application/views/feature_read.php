
 <div class="main-content">
<section class="section">
  <div class="section-header">
    <h1> Feature </h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></div>
      <div class="breadcrumb-item"><a href="#"> Feature </a></div>
    </div>
  </div>

  <div class="section-body">
  <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
        <div class="card-header">
            <h4>Form Feature </h4>
        </div>
        <form class="form-horizontal">
	   
              <div class="form-group">
                <label class="col-sm-2 control-label" for="varchar">Icon <?php echo form_error('icon') ?></label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="icon" id="icon" placeholder="Icon" value="<?php echo $icon; ?>" readonly />
                </div>
              </div>
	   
              <div class="form-group">
                <label class="col-sm-2 control-label" for="varchar">Feature <?php echo form_error('feature') ?></label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="feature" id="feature" placeholder="Feature" value="<?php echo $feature; ?>" readonly />
                </div>
              </div>
	   
     
        <div class="card-footer text-left">
        <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <a href="<?php echo site_url('feature') ?>" class="btn btn-icon icon-left btn-success">Cancel</a>
	
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
