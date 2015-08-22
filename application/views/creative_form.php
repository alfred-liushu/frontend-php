<!--
Form to set ad creative
@author	liushu@qinggukeji.com
//-->

<div class="container-fluid master">
  <div class="jumbotron">
    <?php
      if (isset($error)) echo '<div class="alert alert-danger">' . $error . validation_errors() . '</div>';
    ?>
    <p>
      <?=lang('creative_form')?>
      <a role="button" class="btn btn-sm btn-default"
         href="<?=site_url('ad_data_collection/show_creative_page')?>">
        <?=lang('return_to').'-'.lang('creative_page')?>
      </a>
    </p>
    <hr/>
    <?php
      $init = $this->ad_data->query_creative($creative_uuid);
    ?>
    <?=form_open('ad_data_collection/set_creative/' . $login_uuid . '/' . $creative_uuid, array('class' => 'form-horizontal', 'role' => 'form'))?>
    <div class="form-group">
      <?=form_label(lang('title'), 'title', array('class' => 'control-label col-sm-2'))?>
      <div class="col-sm-4">
        <?=form_input(array('name' => 'title', 'id' => 'title', 'class' => 'form-control'), set_value('title', $init['title']))?>
      </div>
    </div>
    <div class="form-group">
      <?=form_label(lang('description'), 'description', array('class' => 'control-label col-sm-2'))?>
      <div class="col-sm-6">
        <?=form_textarea(array('name' => 'description', 'id' => 'description', 'class' => 'form-control'), set_value('description', $init['description']))?>
      </div>
    </div>
    <div class="form-group">
      <?=form_label(lang('image'), 'image', array('class' => 'control-label col-sm-2'))?>
      <div class="col-sm-6">
        <?=form_input(array('name' => 'image', 'id' => 'image', 'class' => 'form-control'), set_value('image', $init['image']))?>
      </div>
    </div>
    <div class="form-group"> 
      <div class="col-sm-offset-2 col-sm-10">
        <?=form_submit(array('class' => 'btn btn-primary'), lang('submit'))?>
      </div>
    </div>
    <?=form_close()?>
  </div>
</div>
