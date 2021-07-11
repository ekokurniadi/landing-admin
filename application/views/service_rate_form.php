
 <div class="main-content">
<section class="section">
  <div class="section-header">
    <h1> Service Rate </h1>
    <div class="section-header-breadcrumb">
      <div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>dashboard"><i class="fa fa-dashboard"></i> Home</a></div>
      <div class="breadcrumb-item"><a href="#"> Service Rate </a></div>
    </div>
  </div>

  <div class="section-body">
  <div class="row">
      <div class="col-12 col-md-12 col-lg-12">
        <div class="card">
        <div class="card-header">
            <h4>Form Service Rate </h4>
        </div>
        <?php $select = ['icofont-simple-smile','icofont-document-folder','icofont-live-support','icofont-users-alt-5'];?>
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
                <label class="col-sm-2 control-label" for="varchar">Title <?php echo form_error('title') ?></label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="title" id="title" placeholder="Title" value="<?php echo $title; ?>" />
                </div>
              </div>
	   
              <div class="form-group">
                <label class="col-sm-2 control-label" for="int">Value <?php echo form_error('value') ?></label>
                <div class="col-sm-12">
                  <input type="text" class="form-control" name="value" id="value" placeholder="Value" value="<?php echo $value; ?>" />
                </div>
              </div>
	   
     
        <div class="card-footer text-left">
        <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><span class="fa fa-edit"></span><?php echo $button ?></button> 
	    <a href="<?php echo site_url('service_rate') ?>" class="btn btn-icon icon-left btn-success">Cancel</a>
	
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
