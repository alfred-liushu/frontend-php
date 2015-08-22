<!--
Profile page
@author	liushu@qinggukeji.com
//-->

<div class="container-fluid master">
  <div class="jumbotron">
    <?php
      $login_uuid = $this->session->userdata['logged_in']['login_uuid'];
      $profile = $this->profile->query_profile($login_uuid);
      $owner = empty($profile['company']) ? $this->session->userdata['logged_in']['email'] : $profile['company'];
    ?>
    <p><?=$owner . '-' . lang('profile_page')?></p>
    <?php
      $this->table->set_template(array('table_open' => '<table class="table table-striped table-bordered">'));

      $this->table->set_heading(lang('company'),
                                lang('currency'),
                                lang('balance'),
                                '');
      $edit_btn = '<a role="button" class="btn btn-xs btn-primary" href="' .
        site_url('user_management/show_profile_form/' . $login_uuid) .
        '">' . lang('edit') . '</a>';
      $this->table->add_row($profile['company'],
                            $profile['currency'],
                            number_format($profile['balance'], 2),
                            $edit_btn);

      echo $this->table->generate();
      $this->table->clear();
    ?>
  </div>
</div>
