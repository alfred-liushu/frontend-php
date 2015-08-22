<!--
Result data display page
@author	liushu@qinggukeji.com
//-->

<div class="container">
  <div class="jumbotron">
    <div class="container" id="click-result">
    <p><?=lang('click_stat')?></p>
    <?php
      $data = array(
        'selection' => '#click-result',
        'data' => array('ad1'=>379, 'ad2'=>1035, 'ad3'=>1298, 'ad4'=>984, 'ad5'=>231, 'ad6'=>463),
      );
      $this->load->view('bar_chart', $data);
    ?>
    </div>
    <div class="container" id="cost-result">
    <p><?=lang('cost_stat')?></p>
    <?php
      $data = array(
        'selection' => '#cost-result',
        'data' => array('ad1'=>190.23, 'ad2'=>312.90, 'ad3'=>475.47, 'ad4'=>378.25, 'ad5'=>80.06, 'ad6'=>239.83),
      );
      $this->load->view('bar_chart', $data);
    ?>
    </div>
  </div>
</div>
