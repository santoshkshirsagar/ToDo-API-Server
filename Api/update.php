<?php
defined('BASEPATH') or exit('No direct script access allowed');

if ($this->api->get_request_method()!='PUT') {
    $error = array('success' => false, "msg" => "Invalid request Method");
    $this->api->response($this->api->json($error), 400);
}
if (isset($this->api->_request['id']) && isset($this->api->_request['title'])) {
    $this->load->model('TodoModel');
    $itemData['item_title']=$this->api->_request['title'];
    
    if (isset($this->api->_request['status'])) {
        $itemData['item_status']=$this->api->_request['status'];
    }
    
    $itemId=$this->api->_request['id'];
    $data=$this->TodoModel->update_item($itemId, $itemData);
} else {
    $data['success']=false;
    $data['items']='Missing Parameters';
}

$this->api->response($this->api->json($data), 200);
