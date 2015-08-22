<!--
Common form for registration & login
@author	liushu@qinggukeji.com
//-->

<div class="container-fluid master">
  <div class="jumbotron">
    <?php
      $process_array = array(
        'register' => 'user_authentication/register',
        'login' => 'user_authentication/login',
      );
      $show_array = array(
        'register' => 'user_authentication/show_registration',
        'login' => 'user_authentication/show_login',
      );
      $page_array = array(
        'register' => 'registration_form',
        'login' => 'login_form',
      );
      $cur_state = isset($register) ? 'register' : 'login';
      $other_state = isset($register) ? 'login' : 'register';
    ?>
    <?php
      if (isset($success)) echo '<div class="alert alert-success">' . $success . '</div>';
      if (isset($error)) echo '<div class="alert alert-danger">' . $error . validation_errors() . '</div>';
    ?>
    <p><?=lang($page_array[$cur_state])?></p>
    <?=form_open($process_array[$cur_state], array('class' => 'form-horizontal', 'role' => 'form'))?>
    <div class="form-group">
    </div>
    <div class="form-group">
      <?=form_label(lang('email'), 'email', array('class' => 'control-label col-sm-2'))?>
      <div class="col-sm-10">
        <?=form_input(array('type' => 'email', 'name' => 'email', 'id' => 'email', 'class' => 'form-control', 'placeholder' => 'yourname@email.com'), set_value('email'))?>
      </div>
    </div>
    <div class="form-group">
      <?=form_label(lang('password'), 'password', array('class' => 'control-label col-sm-2'))?>
      <div class="col-sm-10">
        <?=form_password(array('name' => 'password', 'id' => 'password', 'class' => 'form-control', 'placeholder' => '************'))?>
      </div>
    </div>
    <div class="form-group"> 
      <div class="col-sm-offset-2 col-sm-10">
        <?=form_submit(array('class' => 'btn btn-primary'), lang($cur_state))?>
        <a role="button" class="btn btn-default" href="<?=site_url($show_array[$other_state])?>">
          <?=lang($page_array[$other_state])?>
        </a>
      </div>
    </div>
    <?=form_close()?>
  </div>
</div>
