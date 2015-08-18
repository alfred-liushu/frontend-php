<html>
<!--
Form for registration & login
@author	liushu@qinggukeji.com
//-->

<?php
  if (isset($this->session->userdata['logged_in'])) {
    header('location: '.site_url('user_authentication/login'));
  }
?>

<head>
  <title><?php echo lang(isset($register) ? 'register' : 'login') ?></title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('css/style.css'); ?>">
  <link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway" rel="stylesheet" type="text/css">
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
    <div id="login">
      <?php
        echo '<h2>';
        echo lang(isset($register) ? 'register' : 'login');
        echo '</h2><hr/>';

        echo '<div class="error_msg">';
        if (isset($error_message)) {
          echo $error_message;
        }
        echo validation_errors();
        echo '</div>';

        echo form_open(isset($register) ? 'user_authentication/register' : 'user_authentication/login');

        echo form_label(lang('email'));
        echo form_input(array('type'=>'Email', 'name'=>'email', 'value'=> set_value('email'), 'placeholder'=>'yourname@email.com'));
        echo '<br/><br/>';
        echo form_label(lang('password'));
        echo form_password(array('name'=>'password', 'placeholder'=>'************'));
        echo '<br/><br/>';
        if (isset($register)) {
          echo form_label(lang('company'));
          echo form_input('company', set_value('company'));
          echo '<br/><br/>';
        }
        echo form_submit('submit', lang(isset($register) ? 'register' : 'login'));
        echo form_close();

        if (isset($register)) {
          echo '<a href="'.site_url('user_authentication/index').'">'.lang('login').'</a>';
        } else {
          echo '<a href="'.site_url('user_authentication/show_registration').'">'.lang('register').'</a>';
        }
      ?>
    </div>
  </div>
</body>

</html>
