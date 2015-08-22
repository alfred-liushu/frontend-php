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
      <?=lang('profile_form')?>
      <a role="button" class="btn btn-sm btn-default"
         href="<?=site_url('user_management/show_profile_page')?>">
        <?=lang('return_to').'-'.lang('profile_page')?>
      </a>
    </p>
    <hr/>
    <?php
      $init = $this->profile->query_profile($login_uuid);
      $currency_set = $this->value_set->get_charge_currency_set();
      $currency_select = array_combine($currency_set, array_map('lang', $currency_set));
    ?>
    <?=form_open('user_management/set_profile/' . $login_uuid, array('class' => 'form-horizontal', 'role' => 'form'))?>
    <div class="form-group">
      <?=form_label(lang('company'), 'company', array('class' => 'control-label col-sm-2'))?>
      <div class="col-sm-6">
        <?=form_input(array('name' => 'company', 'id' => 'company', 'class' => 'form-control'), set_value('company', $init['company']))?>
      </div>
    </div>
    <div class="form-group">
      <?=form_label(lang('currency'), 'currency', array('class' => 'control-label col-sm-2'))?>
      <div class="col-sm-4">
        <?=form_dropdown('currency', $currency_select, set_value('currency', $init['currency']), 'class="form-control" id="currency"')?>
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
