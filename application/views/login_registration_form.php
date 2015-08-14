<html>

<?php
  if (isset($this->session->userdata['logged_in'])) {
    header("location: " . base_url() . "index.php/user_authentication/login");
  }
?>

<head>
  <title><?php echo isset($register) ? '注册' : '登陆' ?></title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
  <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
</head>

<body>
  <?php
    if (isset($message)) {
      echo "<div class='message'>";
      echo $message;
      echo "</div>";
    }
  ?>
  <div id="main">
    <div id="login">
      <?php
        echo '<h2>';
        echo isset($register) ? '注册新账号' : '登陆已有账号';
        echo '</h2><hr/>';

        echo "<div class='error_msg'>";
        if (isset($error_message)) {
          echo $error_message;
        }
        echo validation_errors();
        echo "</div>";
        echo form_open(isset($register) ? 'user_authentication/register' : 'user_authentication/login');

        echo form_label('邮箱（即账号名）');
        echo form_input(array('type'=>'Email', 'name'=>'email', 'placeholder'=>'yourname@email.com'));
        echo"<br/><br/>";
        echo form_label('密码');
        echo form_password(array('name'=>'password', 'placeholder'=>'************'));
        echo"<br/><br/>";
        if (isset($register)) {
          echo form_label('公司名称');
          echo form_input(array('name'=>'company', 'placeholder'=>'您的公司名称'));
          echo"<br/><br/>";
        }
        echo form_submit('submit', isset($register) ? '注册' : '登陆');
        echo form_close();

        if (isset($register)) {
          echo '<a href=' . base_url() . '>登陆已有账号</a>';
        } else {
          echo '<a href=' . base_url() . 'index.php/user_authentication/show_registration>注册新账号</a>';
        }
      ?>
    </div>
  </div>
</body>

</html>
