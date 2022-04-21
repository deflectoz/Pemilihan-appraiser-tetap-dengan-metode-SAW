<?php

/**
 * Created by PhpStorm.
 * User: sankester
 * Date: 11/05/2017
 * Time: 15:53
 */
class MNilai extends CI_Model{

    public $kdCalon;
    public $kdKriteria;
    public $nilai;

    public function __construct(){
        parent::__construct();
    }

    private function getTable()
    {
        return 'nilai';
    }

    private function getData()
    {
        $data = array(
            'kdCalon' => $this->kdCalon,
            'kdKriteria' => $this->kdKriteria,
            'nilai' => $this->nilai
        );

        return $data;
    }

    public function insert()
    {
        $status = $this->db->insert($this->getTable(), $this->getData());
        return $status;
    }

    public function getNilaiByCalon($id)
    {
        $query = $this->db->query(
            'select u.kdCalon, u.calon, k.kdKriteria, n.nilai from calon u, nilai n, kriteria k, subkriteria sk where u.kdCalon = n.kdCalon AND k.kdKriteria = n.kdKriteria and k.kdKriteria = sk.kdKriteria and u.kdCalon = '.$id.' GROUP by k.kdKriteria; '
        );
        if($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $nilai[] = $row;
            }

            return $nilai;
        }
    }
    public function getValByCalon($id)
    {
        $query = $this->db->query(
            ('SELECT nilai FROM nilai WHERE kdCalon = '.$id.'')
        );
        if($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $nilai[] = $row;
            }

            return $nilai;
        }
    }

    public function getNilaiCalon()
    {
        $query = $this->db->query(
            'select u.kdCalon, u.calon, k.kdKriteria, k.kriteria ,n.nilai from calon u, nilai n, kriteria k where u.kdCalon = n.kdCalon AND k.kdKriteria = n.kdKriteria '
        );
        if($query->num_rows() > 0){
            foreach ($query->result() as $row) {
                $nilai[] = $row;
            }

            return $nilai;
        }
    }

    public function update()
    {
        $data = array('nilai' => $this->nilai);
        $this->db->where('kdCalon', $this->kdCalon);
        $this->db->where('kdKriteria', $this->kdKriteria);
        $this->db->update($this->getTable(), $data);
        return $this->db->affected_rows();
    }

    public function delete($id)
    {
        $this->db->where('kdCalon', $id);
        return $this->db->delete($this->getTable());
    }
}