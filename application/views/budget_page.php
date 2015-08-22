<!--
Ad budget table page
@author	liushu@qinggukeji.com
//-->

<div class="container-fluid master">
  <div class="jumbotron">
    <?php
      $owner = $this->ad_data->query_creative($creative_uuid)['title'];
    ?>
    <p>
      <?=$owner . '-' . lang('budget_page')?>
      <a role="button" class="btn btn-sm btn-default"
         href="<?=site_url('ad_data_collection/show_creative_page')?>">
        <?=lang('return_to').'-'.lang('creative_page')?>
      </a>
    </p>
    <?php
      $this->table->set_template(array('table_open' => '<table class="table table-striped table-bordered">'));

      $this->table->set_heading(lang('country'),
                                lang('currency'),
                                lang('monthly_budget'),
                                lang('start_time'),
                                lang('end_time'),
                                lang('auto_continue'),
                                lang('updated'),
                                '',
                                '');
      foreach ($this->ad_data->query_creative_budget($creative_uuid) as $row) {
        $edit_btn = '<a role="button" class="btn btn-xs btn-primary" href="' .
          site_url('ad_data_collection/show_budget_form/' . $creative_uuid . '/' . $row['uuid']) .
          '">' . lang('edit') . '</a>';
        $delete_btn = '<a role="button" class="btn btn-xs btn-danger" ' .
          'data-toggle="confirm_delete" data-href="' .
          site_url('ad_data_collection/remove_budget/' . $creative_uuid . '/' . $row['uuid']) .
          '">' . lang('delete') . '</a>';

        $this->table->add_row(lang($row['country']),
                              lang($row['currency']),
                              $row['monthly_budget'],
                              $row['start_time'],
                              $row['end_time'],
                              $row['auto_continue'] ? lang('yes') : lang('no'),
                              $row['updated'],
                              $edit_btn,
                              $delete_btn);
      }
      echo $this->table->generate();
      $this->table->clear();
    ?>
    <a role="button" class="btn btn-sm btn-primary btn-block"
       href="<?=site_url('ad_data_collection/show_budget_form/' . $creative_uuid)?>">
      <?=lang('add')?>
    </a>
  </div>
</div>

<?php
  $this->load->view('confirm', array('suffix' => 'delete', 'message' => lang('confirm_delete')));
?>
