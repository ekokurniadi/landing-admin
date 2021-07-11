
 <div class="main-content">
<section class="section">
  <div class="section-header">
    <h1> Testimoni </h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></div>
      <div class="breadcrumb-item"><a href="#"> Testimoni </a></div>
    </div>
  </div>

  <div class="section-body">
  <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
        <div class="card-header">
            <h4>Form Testimoni </h4>
        </div>
        <form class="form-horizontal">
	   
              <div class="form-group">
                <label class="col-sm-2 control-label" for="varchar">User Profile <?php echo form_error('user_profile') ?></label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="user_profile" id="user_profile" placeholder="User Profile" value="<?php echo $user_profile; ?>" readonly />
                </div>
              </div>
	   
              <div class="form-group">
                <label class="col-sm-2 control-label" for="varchar">Name <?php echo form_error('name') ?></label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="name" id="name" placeholder="Name" value="<?php echo $name; ?>" readonly />
                </div>
              </div>
	   
              <div class="form-group">
                <label class="col-sm-2 control-label" for="varchar">Job <?php echo form_error('job') ?></label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="job" id="job" placeholder="Job" value="<?php echo $job; ?>" readonly />
                </div>
              </div>
	      
            <div class="card-body">
              <div class="form-group">
                <label class="col-sm-2 control-label" for="testimoni">Testimoni <?php echo form_error('testimoni') ?></label>
                <div class="col-sm-12">
                    <textarea class="form-control" rows="3" name="testimoni" id="testimoni" placeholder="Testimoni"><?php echo $testimoni; ?></textarea>
                </div>
              </div>
	   
     
        <div class="card-footer text-left">
        <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <a href="<?php echo site_url('testimoni') ?>" class="btn btn-icon icon-left btn-success">Cancel</a>
	
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
