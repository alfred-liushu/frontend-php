<!--
Form to set ad budget
@author	liushu@qinggukeji.com
//-->

<div class="container-fluid master">
  <div class="jumbotron">
    <?php
      if (isset($error)) echo '<div class="alert alert-danger">' . $error . validation_errors() . '</div>';
    ?>
    <p>
      <?=lang('budget_form')?>
      <a role="button" class="btn btn-sm btn-default"
         href="<?=site_url('ad_data_collection/show_budget_page/' . $creative_uuid)?>">
        <?=lang('return_to').'-'.lang('budget_page')?>
      </a>
    </p>
    <hr/>
    <?php
      $init = $this->ad_data->query_budget($budget_uuid);
      $country_set = $this->value_set->get_country_set();
      $country_select = array_combine($country_set, array_map('lang', $country_set));
      $currency_set = $this->value_set->get_charge_currency_set();
      $currency_select = array_combine($currency_set, array_map('lang', $currency_set));
    ?>
    <?=form_open('ad_data_collection/set_budget/' . $creative_uuid . '/' . $budget_uuid, array('class' => 'form-horizontal', 'role' => 'form'))?>
    <div class="form-group">
      <?=form_label(lang('country'), 'country', array('class' => 'control-label col-sm-2'))?>
      <div class="col-sm-4">
        <?=form_dropdown('country', $country_select, set_value('country', $init['country']), 'class="form-control" id="country"')?>
      </div>
    </div>
    <div class="form-group">
      <?=form_label(lang('currency'), 'currency', array('class' => 'control-label col-sm-2'))?>
      <div class="col-sm-4">
        <?=form_dropdown('currency', $currency_select, set_value('currency', $init['currency']), 'class="form-control" id="currency"')?>
      </div>
    </div>
    <div class="form-group">
      <?=form_label(lang('monthly_budget'), 'monthly_budget', array('class' => 'control-label col-sm-2'))?>
      <div class="col-sm-4">
        <?=form_input(array('name' => 'monthly_budget', 'id' => 'monthly_budget', 'class' => 'form-control'), set_value('monthly_budget', $init['monthly_budget']))?>
      </div>
    </div>
    <div class="form-group">
      <?=form_label(lang('start_time'), 'start_time', array('class' => 'control-label col-sm-2'))?>
      <div class="col-sm-6">
        <?=form_input(array('name' => 'start_time', 'id' => 'start_time', 'class' => 'form-control'), set_value('start_time', $init['start_time']))?>
      </div>
    </div>
    <div class="form-group">
      <?=form_label(lang('end_time'), 'end_time', array('class' => 'control-label col-sm-2'))?>
      <div class="col-sm-6">
        <?=form_input(array('name' => 'end_time', 'id' => 'end_time', 'class' => 'form-control'), set_value('end_time', $init['end_time']))?>
      </div>
    </div>
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <div class="checkbox">
          <?=form_label(form_checkbox('auto_continue', true, set_value('auto_continue', $init['auto_continue'])) . lang('auto_continue'))?>
        </div>
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

<?php
  $this->load->view('date_range', array('suffix' => 'time'));
?>

