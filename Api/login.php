<?php
defined('BASEPATH') or exit('No direct script access allowed');

if ($this->api->get_request_method()!='POST') {
    $error = array('success' => false, "msg" => "Invalid request Method");
    $this->api->response($this->api->json($error), 400);
}

if (isset($this->api->_request['username'])) {
    $username = $this->api->_request['username'];
} else {
    $error = array('success' => false, "msg" => "Username required");
    $this->api->response($this->api->json($error), 401);
}

if (isset($this->api->_request['password'])) {
    $password = $this->api->_request['password'];
} else {
    $error = array('success' => false, "msg" => "Password required");

    $this->api->response($this->api->json($error), 401);
}
$user=$this->ApiModel->get_user_token($username);
                
                
if ($user==false) {
    $data['success']=false;
    $data['message']='Invalid Username or Password';
} else {
    if ($user['user_login_attempts']>=3) {
        $data['success']=false;
        $data['message']='Login attempts exceeded';
        $this->api->response($this->api->json($data), 401);
    } else {
        $this->ApiModel->add_login_attempt($username);
    }
    
        

    //if($user['user_password']==md5($password)){
    if (password_verify($password, $user['user_password'])) {
        if ($user['user_token']=='') {
            if ($this->ApiModel->update_attendance($username)) {
                $response=$this->ApiModel->update_token($username);
                if ($response['success']) {
                    $data['success']=true;
                    $data['user_name']=$username;
                    $data['user_token']=$response['user_token'];
                    $data['user_role']=$user['user_role'];
                                    
                    $activity['user_id']=$user['user_id'];
                    $activity['activity_type']='Login';
                    $this->ActivitiesModel->add_activity($activity);

                } else {
                    $data['success']=false;
                    $data['message']='Cannot update token';
                }
            }
        } else {
            $data['success']=false;
            $data['message']='Already Logged In';
        }
    } else {
        $data['success']=false;
        $data['message']='Invalid Username or Password';
    }
}
               //$data['ip']=$_SERVER['REMOTE_ADDR'];
               //$data['server_ip']=$_SERVER['SERVER_ADDR'];
               $this->api->response($this->api->json($data), 200);
