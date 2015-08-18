<html>
<!--
Form to set ad creative
@author	liushu@qinggukeji.com
//-->

<?php
  if (!isset($this->session->userdata['logged_in'])) {
    header('location: '.site_url());
  }
?>

<head>
  <title><?php echo lang('creative_form'); ?></title>
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
    <div id="creative_info">
      <?php
        echo '<h2>'.lang('creative_form').'</h2><hr/>';

        echo '<div class="error_msg">';
        if (isset($error_message)) {
          echo $error_message;
        }
        echo validation_errors();
        echo '</div>';

        echo form_open('ad_data_collection/set_creative/'.$login_uuid.'/'.$creative_uuid);
        $init = $this->ad_data->query_creative($creative_uuid);

        echo form_label(lang('title'));
        echo form_input('title', set_value('title', $init['title']));
        echo '<br/><br/>';
        echo form_label(lang('description'));
        echo form_input('description', set_value('description', $init['description']));
        echo '<br/><br/>';
        echo form_label(lang('image'));
        echo form_input('image', set_value('image', $init['image']));
        echo '<br/><br/>';

        echo form_submit('submit', lang('confirm'));
        echo form_close();
      ?>
    </div>
  </div>
</body>

</html>
