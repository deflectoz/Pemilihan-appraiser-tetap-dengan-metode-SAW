<?php
/**
 * Created by PhpStorm.
 * User: sankester
 * Date: 11/05/2017
 * Time: 15:42
 */

if (!defined('BASEPATH')) exit('No direct script access allowed');


class Calon extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->page->setTitle('SPK SAW | Nama Calon Appraiser');
        $this->page->setTitleContent('Halaman Nama Calon Appraiser');
        $this->load->model('MKriteria');
        $this->load->model('MSubKriteria');
        $this->load->model('MCalon');
        $this->load->model('MNilai');
        $this->page->setLoadJs('assets/js/universitas');
        if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
    }

    public function index()
    {
        $data['calon'] = $this->MCalon->getAll();
        loadPage('calon/index', $data);
    }

    public function tambah($id = null)
    {

        if ($id == null) {
            if (count($_POST)) {
                $this->form_validation->set_rules('calon', '', 'trim|required');
                if ($this->form_validation->run() == false) {
                    $errors = $this->form_validation->error_array();
                    $this->session->set_flashdata('errors', $errors);
                    redirect(current_url());
                } else {

                    $calon = $this->input->post('calon');
                    $nilai = $this->input->post('nilai');

                    $this->MCalon->calon = $calon;
                    if ($this->MCalon->insert() == true) {
                        $success = false;
                        $kdCalon = $this->MCalon->getLastID()->kdCalon;
                        foreach ($nilai as $item => $value) {
                            $this->MNilai->kdCalon = $kdCalon;
                            $this->MNilai->kdKriteria = $item;
                            $this->MNilai->nilai = $value;
                            if ($this->MNilai->insert()) {
                                $success = true;
                            }
                        }
                        if ($success == true) {
                            $this->session->set_flashdata('message', 'Berhasil menambah data :)');
                            redirect('calon');
                        } else {
                            echo 'gagal';
                        }
                    }
                }
                //-----
            }else{
                $data['dataView'] = $this->getDataInsert();
                loadPage('calon/tambah', $data);
            }
        }else{
            if(count($_POST)){
                $kdCalon = $this->uri->segment(3, 0);
                dump($kdCalon);
                if($kdCalon > 0){
                    $calon = $this->input->post('calon');
                    $nilai = $this->input->post('nilai');
                    $where = array('kdCalon' => $kdCalon);
                    $this->MCalon->calon = $calon;
                    dump($calon);
                    if($this->MCalon->update($where) == true){
                        $success = false;
                        foreach ($nilai as $item => $value) {
                            $this->MNilai->kdCalon = $kdCalon;
                            $this->MNilai->kdKriteria = $item;
                            $this->MNilai->nilai = $value;
                            if ($this->MNilai->update()) {
                                $success = true;
                            }
                        }
                        if ($success == true) {
                            $this->session->set_flashdata('message', 'Berhasil mengubah data :)');
                            redirect('calon');
                        } else {
                            echo 'gagal';
                        }
                    }
                }
            }
            $data['dataView'] = $this->getDataInsert();
            $data['nilaiCalon'] = $this->MNilai->getNilaiByCalon($id);
            loadPage('calon/tambah', $data);
        }

    }

    private function getDataInsert()
    {
        $dataView = array();
        $kriteria = $this->MKriteria->getAll();
        foreach ($kriteria as $item) {
            $this->MSubKriteria->kdKriteria = $item->kdKriteria;
            $dataView[$item->kdKriteria] = array(
                'nama' => $item->kriteria,
                'data' => $this->MSubKriteria->getById()
            );
        }

        return $dataView;
    }

    public function delete($id)
    {
        if($this->MNilai->delete($id) == true){
            if($this->MCalon->delete($id) == true){
                $this->session->set_flashdata('message','Berhasil menghapus data :)');
                echo json_encode(array("status" => 'true'));
            }
        }
    }
}