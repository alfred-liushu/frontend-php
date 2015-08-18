<html>
<!--
Ad creative table page
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
  <title><?php echo lang('creative_page'); ?></title>
</head>

<body>
  <div id="show_table">
    <?php
      echo lang('creative_page');
      echo '<br/><br/>';

      $this->table->set_heading(lang('title'),lang('description'),lang('image'),lang('updated'));
      foreach ($this->ad_data->query_user_creative($login_uuid) as $row) {
        $this->table->add_row($row['title'],
                              $row['description'],
                              $row['image'],
                              $row['updated'],
                             '<a href="'.site_url('ad_data_collection/show_creative_form/'.$login_uuid.'/'.$row['uuid']).'">'.lang('edit').'</a>',
                             '<a href="'.site_url('ad_data_collection/remove_creative/'.$row['uuid']).'" onclick="return confirm(\''.lang('confirm_delete').'\');">'.lang('delete').'</a>',
                             '<a href="'.site_url('ad_data_collection/show_budget_page/'.$row['uuid']).'">'.lang('budget_page').'</a>');
      }
      echo $this->table->generate();
      $this->table->clear();

      echo '<br/>';
      echo '<a href="'.site_url('ad_data_collection/show_creative_form/'.$login_uuid).'">'.lang('add').'</a>';
      echo '<br/><br/>';
      echo '<a href="'.site_url().'">'.lang('profile_page').'</a>';
      echo '<br/><br/>';
      echo '<b id="logout"><a href="'.site_url('user_authentication/logout').'">'.lang('logout').'</a></b>';
    ?>
  </div>
</body>

</html>
