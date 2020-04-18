<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TodoModel extends CI_Model
{

    public function get_items()
    {
                    $this->db->where('item_deleted', '0');
                    $query = $this->db->get('items');
                    return $query->result_array();
    }
    
    public function get_item($id)
    {
                    $this->db->where('item_id', $id);
                    $query = $this->db->get('items');
                    return $query->row_array();
    }
    
    public function add_item($item)
    {
        if ($this->db->insert('items', $item)) {
            $data['success']=true;
            $data['message']='item Added Successfully';
            return $data;
        } else {
            $data['success']=false;
            $data['message']='Error Adding item';
            return $data;
        }
    }
    public function update_item($item_id, $item)
    {
                    
        $this->db->where('item_id', $item_id);
        if ($this->db->update('items', $item)) {
            $data['success']=true;
            $data['message']='item Updated Successfully';
            return $data;
        } else {
            $data['success']=false;
            $data['message']='Error Updating Data';
            return $data;
        }
    }
    public function delete_item($id)
    {
        $item['item_deleted']=1;
        $this->db->where('item_id', $id);
        if ($this->db->update('items', $item)) {
            $data['success']=true;
            $data['message']='item deleted Successfully';
            return $data;
        } else {
            $data['success']=false;
            $data['message']='Error Updating Data';
            return $data;
        }
    }
}
