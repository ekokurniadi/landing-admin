
 <div class="main-content">
<section class="section">
  <div class="section-header">
    <h1> Frequently Asked Questions </h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></div>
      <div class="breadcrumb-item"><a href="#"> Frequently Asked Questions </a></div>
    </div>
  </div>

  <div class="section-body">
  <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
        <div class="card-header">
            <h4>Form Frequently Asked Questions </h4>
        </div>
        <form class="form-horizontal">
	   
              <div class="form-group">
                <label class="col-sm-2 control-label" for="varchar">Judul <?php echo form_error('judul') ?></label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="judul" id="judul" placeholder="Judul" value="<?php echo $judul; ?>" readonly />
                </div>
              </div>
	      
            <div class="card-body">
              <div class="form-group">
                <label class="col-sm-2 control-label" for="question">Question <?php echo form_error('question') ?></label>
                <div class="col-sm-12">
                    <textarea class="form-control" rows="3" name="question" id="question" placeholder="Question"><?php echo $question; ?></textarea>
                </div>
              </div>
	   
     
        <div class="card-footer text-left">
        <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <a href="<?php echo site_url('frequently_asked_questions') ?>" class="btn btn-icon icon-left btn-success">Cancel</a>
	
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
