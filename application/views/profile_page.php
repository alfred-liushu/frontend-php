<html>
<!--
Main page
@author	liushu@qinggukeji.com
//-->

<?php
  if (isset($this->session->userdata['logged_in'])) {
    $login_uuid = $this->session->userdata['logged_in']['login_uuid'];
  } else {
    header('location: '.site_url('user_authentication/show_login'));
  }
?>

<head>
  <title><?php echo lang('profile_page'); ?></title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style.css'); ?>">
  <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway" rel="stylesheet" type="text/css">
</head>

<body>
  <div id="profile">
    <?php
      $profile = $this->profile->query_profile($login_uuid);
      echo lang('welcome').'<b id="welcome"><i>'.$profile['company'].'</i> !</b>';
      echo '<br/>';
      echo lang('currency').': '.lang($profile['currency']);
      echo '<br/>';
      echo lang('balance').': '.$profile['balance'];
      echo '<br/><br/>';

      echo '<a href="'.site_url('ad_data_collection/show_creative_page').'">'.lang('creative_page').'</a>';
      echo '<br/><br/>';
      echo '<a href="'.site_url('result_display/show_result').'">'.lang('result_page').'</a>';
      echo '<br/><br/>';
      echo '<b id="logout"><a href="'.site_url('user_authentication/logout').'">'.lang('logout').'</a></b>';
    ?>
  </div>
</body>

</html>
