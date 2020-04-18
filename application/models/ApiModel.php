<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ApiModel extends CI_Model
{
    
    public function get_user_token($username)
    {
                    $this->db->where('user_name', $username);
                    $this->db->limit(1);
                    $query = $this->db->get('users');
        if ($query->num_rows()>0) {
            $user=$query->row_array();
            return $user;
        } else {
            return false;
        }
    }
    
    public function add_login_attempt($username)
    {
                    $this->db->where('user_name', $username);
                    $this->db->set('user_login_attempts', 'user_login_attempts+1', false);
        if ($this->db->update('users')) {
            return true;
        } else {
            return false;
        }
    }
    
    public function update_token($username)
    {
                    
                    $user['user_login_ip']=$_SERVER['REMOTE_ADDR'];
                    $user['user_login_time']=date('Y-m-d h:i:s', time());
                    $user['user_token']=md5(uniqid(rand(), true));
                    $user['user_login_attempts']=0;
                    
                    $this->db->where('user_name', $username);
        if ($this->db->update('users', $user)) {
            $data['success']=true;
            $data['user_token']=$user['user_token'];
            return $data;
        } else {
            $data['success']=false;
            $data['message']='Error Updating Data';
            return $data;
        }
    }
    
    function update_attendance($username)
    {
                    $time=date('H:i:s', time());
                    $today=date('Y-m-d', time());
                    $this->db->where('attendance_user', $username);
                    $this->db->where('attendance_date', $today);
                    $this->db->limit(1);
                    $query = $this->db->get('attendance');
        if ($query->num_rows()>0) {
            $atd=$query->row_array();
            if ($atd['attendance_login']=='00:00:00') {
                $this->db->set('attendance_login', $time);
            }
            $this->db->set('attendance_logout', $time);
            $this->db->set('attendance_hours', 'TIMEDIFF("'.$time.'",attendance_login)', false);
            $this->db->where('attendance_user', $username);
            $this->db->where('attendance_date', $today);
            $this->db->limit(1);
            if ($this->db->update('attendance')) {
                //echo $this->db->last_query();
                return true;
            }
        } else {
            $attendance['attendance_user']=$username;
            $attendance['attendance_login']=$time;
            $attendance['attendance_logout']=$time;
            $attendance['attendance_date']=date('Y-m-d', time());
            if ($this->db->insert('attendance', $attendance)) {
                return true;
            }
        }
                    return false;
    }
    
    public function reset_token($username = '')
    {
        if ($username!='') {
            $this->db->where('user_name', $username);
        }
                    $user['user_token']='';
                    $user['user_login_attempts']=0;
        if ($this->db->update('users', $user)) {
            $data['success']=true;
            $data['user_token']=$user['user_token'];
            $data['message']=$this->db->affected_rows(). " user login reset done successfully";
            return $data;
        } else {
            $data['success']=false;
            $data['message']='Error reseting login';
            return $data;
        }
    }
    
    public function check_user_token($token)
    {
                    $this->db->where('user_token', $token);
                    $query = $this->db->get('users');
        if ($query->num_rows()>0) {
            $user=$query->row_array();
            return $user;
        } else {
            return false;
        }
    }
}
