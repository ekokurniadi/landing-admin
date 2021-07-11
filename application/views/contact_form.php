
 <div class="main-content">
<section class="section">
  <div class="section-header">
    <h1> Contact </h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></div>
      <div class="breadcrumb-item"><a href="#"> Contact </a></div>
    </div>
  </div>

  <div class="section-body">
  <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
        <div class="card-header">
            <h4>Form Contact </h4>
        </div>
        <form action="<?php echo $action; ?>" method="post" class="form-horizontal">
	      
              <div class="form-group">
                <label class="col-sm-2 control-label" for="location">Location <?php echo form_error('location') ?></label>
                <div class="col-sm-12">
                    <textarea class="form-control" rows="3" name="location" id="location" placeholder="Location"><?php echo $location; ?></textarea>
                </div>
              </div>
	   
              <div class="form-group">
                <label class="col-sm-2 control-label" for="varchar">Email <?php echo form_error('email') ?></label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" />
                </div>
              </div>
	   
              <div class="form-group">
                <label class="col-sm-2 control-label" for="varchar">Phone <?php echo form_error('phone') ?></label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone" value="<?php echo $phone; ?>" />
                </div>
              </div>
	   
     
        <div class="card-footer text-left">
        <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><span class="fa fa-edit"></span><?php echo $button ?></button> 
	    <a href="<?php echo site_url('contact') ?>" class="btn btn-icon icon-left btn-success">Cancel</a>
	
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
