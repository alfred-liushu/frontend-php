<html>
<!--
Ad budget table page
@author	liushu@qinggukeji.com
//-->

<?php
  if (isset($this->session->userdata['logged_in'])) {
    $login_uuid = $this->session->userdata['logged_in']['login_uuid'];
  } else {
    header('location: '.site_url());
  }
?>

<head>
  <title><?php echo lang('budget_page'); ?></title>
</head>

<body>
  <div id="show_table">
    <?php
      echo lang('budget_page');
      echo '<br/><br/>';

      $this->table->set_heading(lang('country'),lang('currency'),lang('monthly_budget'),lang('start_time'),lang('end_time'),lang('auto_continue'),lang('updated'));
      foreach ($this->ad_data->query_creative_budget($creative_uuid) as $row) {
        $this->table->add_row(lang($row['country']),
                              lang($row['currency']),
                              $row['monthly_budget'],
                              $row['start_time'],
                              $row['end_time'],
                              $row['auto_continue'],
                              $row['updated'],
                             '<a href="'.site_url('ad_data_collection/show_budget_form/'.$creative_uuid.'/'.$row['uuid']).'">'.lang('edit').'</a>',
                             '<a href="'.site_url('ad_data_collection/remove_budget/'.$creative_uuid.'/'.$row['uuid']).'" onclick="return confirm(\''.lang('confirm_delete').'\');">'.lang('delete').'</a>');
      }
      echo $this->table->generate();
      $this->table->clear();

      echo '<br/>';
      echo '<a href="'.site_url('ad_data_collection/show_budget_form/'.$creative_uuid).'">'.lang('add').'</a>';
      echo '<br/><br/>';
      echo '<a href="'.site_url('ad_data_collection/show_creative_page').'">'.lang('creative_page').'</a>';
      echo '<br/><br/>';
      echo '<a href="'.site_url().'">'.lang('profile_page').'</a>';
      echo '<br/><br/>';
      echo '<b id="logout"><a href="'.site_url('user_authentication/logout').'">'.lang('logout').'</a></b>';
    ?>
  </div>
</body>

</html>
