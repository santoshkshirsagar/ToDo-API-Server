<?php
defined('BASEPATH') or exit('No direct script access allowed');

if ($this->api->get_request_method()!='PUT') {
    $error = array('success' => false, "msg" => "Invalid request Method");
    $this->api->response($this->api->json($error), 400);
}
if (isset($this->api->_request['id'])) {
    $this->load->model('TodoModel');
    $itemId=$this->api->_request['id'];
    $data=$this->TodoModel->delete_item($itemId);
} else {
    $data['success']=false;
    $data['items']='Missing Parameters';
}
$this->api->response($this->api->json($data), 200);
