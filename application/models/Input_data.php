<?php

Class Input_data extends QG_Model {

  public function insert_creative($data) {
    return $this->insert_with_auto_id('input_creative', $data);
  }

  public function insert_budget($data) {
    return $this->insert_with_auto_id('input_budget', $data);
  }

  public function query_user_creative($user_login_uuid) {
    return $this->query_by_id('input_creative', 'user_login_uuid', $user_login_uuid, 
                                           'title,text,image,updated');
  }

  public function query_creative_budget($user_creative_uuid) {
    return $this->query_by_id('input_budget', 'input_creative_uuid', input_creative_uuid,
                                           'country_code,language_code,currency_code,monthly_budget,start_time,end_time,auto_continue,updated');
  }

}

?>
