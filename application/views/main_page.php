<html>

<?php
  if (isset($this->session->userdata['logged_in'])) {
    $email = $this->session->userdata['logged_in']['email'];
    $user_login_uuid = $this->session->userdata['logged_in']['user_login_uuid'];
  } else {
    header("location: " . base_url());
  }
?>

<head>
  <title>用户信息</title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/style.css">
  <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro|Open+Sans+Condensed:300|Raleway' rel='stylesheet' type='text/css'>
</head>

<body>
  <div id="profile">
    <?php
      echo "欢迎您， <b id='welcome'><i>" . $this->security->xss_clean($email) . "</i> !</b>";
      echo "<br/><br/>";
      echo "广告信息";
      echo $this->table->generate($this->input_data->query_user_creative($user_login_uuid));
      echo "<br/>";
      echo '<a href=' . base_url() . 'index.php/input_collection/input_creative>添加广告</a>';
      echo '<b id="logout"><a href="' . base_url() . 'index.php/user_authentication/logout">退出登陆</a></b>';
    ?>
  </div>
</body>

</html>
