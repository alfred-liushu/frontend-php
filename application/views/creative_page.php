<!--
Ad creative table page
@author	liushu@qinggukeji.com
//-->

<div class="container-fluid master">
  <div class="jumbotron">
    <?php
      $login_uuid = $this->session->userdata['logged_in']['login_uuid'];
      $profile = $this->profile->query_profile($login_uuid);
      $owner = empty($profile['company']) ? $this->session->userdata['logged_in']['email'] : $profile['company'];
    ?>
    <p><?=$owner . '-' . lang('creative_page')?></p>
    <?php
      $this->table->set_template(array('table_open' => '<table class="table table-striped table-bordered">'));

      $this->table->set_heading(lang('title'),
                                lang('description'),
                                lang('image'),
                                lang('updated'),
                                '',
                                '',
                                '');
      foreach ($this->ad_data->query_user_creative($login_uuid) as $row) {
        $budget_btn = '<a role="button" class="btn btn-xs btn-primary" href="' .
          site_url('ad_data_collection/show_budget_page/' . $row['uuid']) .
          '">' . lang('budget_page') . '</a>';
        $edit_btn = '<a role="button" class="btn btn-xs btn-primary" href="' .
          site_url('ad_data_collection/show_creative_form/' . $login_uuid . '/' . $row['uuid']) .
          '">' . lang('edit') . '</a>';
        $delete_btn = '<a role="button" class="btn btn-xs btn-danger" ' .
          'data-toggle="confirm_delete" data-href="' .
          site_url('ad_data_collection/remove_creative/' . $row['uuid']) .
          '">' . lang('delete') . '</a>';

        $this->table->add_row($row['title'],
                              $row['description'],
                              $row['image'],
                              $row['updated'],
                              $budget_btn,
                              $edit_btn,
                              $delete_btn);
      }
      echo $this->table->generate();
      $this->table->clear();
    ?>
    <a role="button" class="btn btn-sm btn-primary btn-block" 
       href="<?=site_url('ad_data_collection/show_creative_form/' . $login_uuid)?>">
      <?=lang('add')?>
    </a>
  </div>
</div>

<?php
  $this->load->view('confirm', array('suffix' => 'delete', 'message' => lang('confirm_delete')));
?>
