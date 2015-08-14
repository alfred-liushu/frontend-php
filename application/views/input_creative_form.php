<html>

<?php
  if (!isset($this->session->userdata['logged_in'])) {
    header("location: " . base_url());
  }
?>

<head>
  <title><?php echo '输入广告信息'?></title>
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
    <div id="creative_info">
      <?php
        echo '<h2>';
        echo '输入广告信息';
        echo '</h2><hr/>';

        echo "<div class='error_msg'>";
        if (isset($error_message)) {
          echo $error_message;
        }
        echo validation_errors();
        echo "</div>";
        echo form_open('input_collection/input_creative');

        echo form_label('广告名称');
        echo form_input(array('name'=>'title', 'placeholder'=>'您的广告'));
        echo"<br/><br/>";
        echo form_label('产品说明');
        echo form_input(array('name'=>'text', 'placeholder'=>'该产品……'));
        echo"<br/><br/>";
        echo form_label('图片地址');
        echo form_input(array('name'=>'image', 'placeholder'=>'图片URL'));
        echo"<br/><br/>";

        echo form_submit('submit', '确定');
        echo form_close();
      ?>
    </div>
  </div>
</body>

</html>
