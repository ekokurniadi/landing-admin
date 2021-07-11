
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
        <?php $select = ['ri-store-line','ri-bar-chart-box-line','ri-calendar-todo-line','ri-paint-brush-line','ri-database-2-line','ri-gradienter-line','ri-file-list-3-line','ri-price-tag-2-line','ri-anchor-line','ri-disc-line','ri-base-station-line','ri-fingerprint-line']?>
        <form action="<?php echo $action; ?>" method="post" class="form-horizontal">
	   
              <div class="form-group">
                <label class="col-sm-2 control-label" for="varchar">Icon <?php echo form_error('icon') ?></label>
                <div class="col-sm-12">
                <select name="icon" id="icon" class="form-control">
                    <option value="<?=$icon?>">Choose</option>
                      
                    <?php foreach($select as $keys=>$values){?>
                      <option value="<?=$values?>"><?=$values?></option>
                    <?php }?>
                  </select>
                </div>
              </div>
	   
              <div class="form-group">
                <label class="col-sm-2 control-label" for="varchar">Feature <?php echo form_error('feature') ?></label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="feature" id="feature" placeholder="Feature" value="<?php echo $feature; ?>" />
                </div>
              </div>
	   
     
        <div class="card-footer text-left">
        <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><span class="fa fa-edit"></span><?php echo $button ?></button> 
	    <a href="<?php echo site_url('feature') ?>" class="btn btn-icon icon-left btn-success">Cancel</a>
	
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
