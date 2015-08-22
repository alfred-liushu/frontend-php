<!--
Universal header
@author	liushu@qinggukeji.com
//-->

<?php
  $controller = $this->router->class;
  if ($controller != 'user_authentication'
      && !isset($this->session->userdata['logged_in'])) {
    header('location: '.site_url('user_authentication/show_login'));
  }
  $owner = '';
  if (isset($this->session->userdata['logged_in'])) {
    $login_uuid = $this->session->userdata['logged_in']['login_uuid'];
    $owner = $this->profile->query_profile($login_uuid)['company'];
    if (empty($owner)) $owner = $this->session->userdata['logged_in']['email'];
  }
?>

<nav class="navbar navbar-default">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?=site_url()?>"><?=lang('project_name')?></a>
    </div>
    <?php
      if (isset($this->session->userdata['logged_in'])) {
        echo '<div id="navbar" class="collapse navbar-collapse">';
        echo '<ul class="nav navbar-nav">';
        $tab_array = array(
          'user_management' => site_url(),
          'ad_data_collection' => site_url('ad_data_collection/show_creative_page'),
          'result_display' => site_url('result_display/show_result'),
        );
        foreach ($tab_array as $tab => $url) echo '<li ' . ($tab==$controller ? 'class="active"' : '') . '><a href="' . $url . '">' . lang($tab) . '</a></li>';
        echo '</ul>';
        echo '<ul class="nav navbar-nav navbar-right">';
        echo '<li><p class="navbar-text">' . lang('start_welcome') . $owner . '</p></li>';
        echo '<li><a href="' . site_url('user_authentication/logout') . '">' .lang('logout') . '</a></li>';
        echo '</ul>';
        echo '</div>';
      }
    ?>
  </div>
</nav>
