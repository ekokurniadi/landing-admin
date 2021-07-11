
 <div class="main-content">
<section class="section">
  <div class="section-header">
    <h1> Pricing </h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></div>
      <div class="breadcrumb-item"><a href="#"> Pricing </a></div>
    </div>
  </div>

  <div class="section-body">
  <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
        <div class="card-header">
            <h4>Form Pricing </h4>
        </div>
        <form class="form-horizontal">
	   
              <div class="form-group">
                <label class="col-sm-2 control-label" for="varchar">Category <?php echo form_error('category') ?></label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="category" id="category" placeholder="Category" value="<?php echo $category; ?>" readonly />
                </div>
              </div>
	   
              <div class="form-group">
                <label class="col-sm-2 control-label" for="double">Price <?php echo form_error('price') ?></label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="price" id="price" placeholder="Price" value="<?php echo $price; ?>" readonly />
                </div>
              </div>
	   
              <div class="form-group">
                <label class="col-sm-2 control-label" for="varchar">Detail <?php echo form_error('detail') ?></label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="detail" id="detail" placeholder="Detail" value="<?php echo $detail; ?>" readonly />
                </div>
              </div>
	   
     
        <div class="card-footer text-left">
        <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <a href="<?php echo site_url('pricing') ?>" class="btn btn-icon icon-left btn-success">Cancel</a>
	
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
