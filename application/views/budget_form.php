<html>
<!--
Form to set ad budget
@author	liushu@qinggukeji.com
//-->

<?php
  if (!isset($this->session->userdata['logged_in'])) {
    header('location: '.site_url());
  }
?>

<head>
  <title><?php echo lang('budget_form'); ?></title>
</head>

<body>
  <?php
    if (isset($message)) {
      echo '<div class="message">';
      echo $message;
      echo '</div>';
    }
  ?>
  <div id="main">
    <div id="budget_info">
      <?php
        echo '<h2>'.lang('budget_form').'</h2><hr/>';

        echo '<div class="error_msg">';
        if (isset($error_message)) {
          echo $error_message;
        }
        echo validation_errors();
        echo '</div>';

        echo form_open('ad_data_collection/set_budget/'.$creative_uuid.'/'.$budget_uuid);
        $init = $this->ad_data->query_budget($budget_uuid);

        $country_set = $this->value_set->get_country_set();
        echo form_label(lang('country'));
        echo form_dropdown('country', array_combine($country_set, array_map('lang', $country_set)), set_value('country', $init['country']));
        echo '<br/><br/>';
        $currency_set = $this->value_set->get_charge_currency_set();
        echo form_label(lang('currency'));
        echo form_dropdown('currency', array_combine($currency_set, array_map('lang', $currency_set)), set_value('currency', $init['currency']));
        echo '<br/><br/>';
        echo form_label(lang('monthly_budget'));
        echo form_input('monthly_budget', set_value('monthly_budget', $init['monthly_budget']));
        echo '<br/><br/>';
        echo form_label(lang('start_time'));
        echo form_input('start_time', set_value('start_time', $init['start_time']));
        echo '<br/><br/>';
        echo form_label(lang('end_time'));
        echo form_input('end_time', set_value('end_time', $init['end_time']));
        echo '<br/><br/>';
        echo form_label(lang('auto_continue'));
        echo form_checkbox('auto_continue', true, set_value('auto_continue', $init['auto_continue']));
        echo '<br/><br/>';

        echo form_submit('submit', lang('confirm'));
        echo form_close();
      ?>
    </div>
  </div>
</body>

</html>
