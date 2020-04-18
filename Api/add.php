<?php
defined('BASEPATH') or exit('No direct script access allowed');

if ($this->api->get_request_method()!='POST') {
    $error = array('success' => false, "msg" => "Invalid request Method");
    $this->api->response($this->api->json($error), 400);
}
if (isset($this->api->_request['title'])) {
    $this->load->model('TodoModel');
    $itemData['item_title']=$this->api->_request['title'];
    $data=$this->TodoModel->add_item($itemData);
} else {
    $data['success']=false;
    $data['items']='Missing Parameters';
}

$this->api->response($this->api->json($data), 200);
