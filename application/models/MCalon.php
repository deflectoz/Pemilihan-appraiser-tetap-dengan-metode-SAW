<?php
/**
 * Created by PhpStorm.
 * User: sankester
 * Date: 11/05/2017
 * Time: 15:51
 */

class MCalon extends CI_Model{

    public $kdCalon;
    public $calon;

    public function __construct(){
        parent::__construct();
    }

    private function getTable(){
        return 'calon';
    }

    private function getData(){
        $data = array(
            'calon' => $this->calon
        );

        return $data;
    }

    public function getAll()
    {
        $calon = array();
        $query = $this->db->get($this->getTable());
        if($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $calon[] = $row;
            }
        }
        return $calon;
    }


    public function insert()
    {
        $this->db->insert($this->getTable(), $this->getData());
        return $this->db->insert_id();
    }

    public function update($where)
    {
        $status = $this->db->update($this->getTable(), $this->getData(), $where);
        return $status;

    }

    public function delete($id)
    {
        $this->db->where('kdCalon', $id);
        return $this->db->delete($this->getTable());
    }

    public function getLastID(){
        $this->db->select('kdCalon');
        $this->db->order_by('kdCalon', 'DESC');
        $this->db->limit(1);
        $query = $this->db->get($this->getTable());
        return $query->row();
    }


}