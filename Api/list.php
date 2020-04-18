<?php
defined('BASEPATH') or exit('No direct script access allowed');

if ($this->api->get_request_method()!='GET') {
    $error = array('success' => false, "msg" => "Invalid request Method");
    $this->api->response($this->api->json($error), 400);
}

$this->load->model('TodoModel');
$data['items']=$this->TodoModel->get_items();

$data['success']=true;
$this->api->response($this->api->json($data), 200);
