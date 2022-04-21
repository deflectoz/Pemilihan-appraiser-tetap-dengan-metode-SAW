<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Kriteria extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->page->setTitle('SPK SAW | Kriteria');
        $this->page->setTitleContent('Halaman Kriteria');
        $this->load->model('MKriteria');
        $this->load->model('MSubKriteria');
        $this->page->setLoadJs('assets/js/kriteria');
        if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
    }


    private function getValidationInsert()
    {
        $validation = array(
            array('field' => 'kriteria', 'label' => '', 'rules' => 'trim|required'),
            array('field' => 'sifat', 'label' => '', 'rules' => 'trim|required'),
            array('field' => 'bobot', 'label' => '', 'rules' => 'required|integer'),
            array('field' => 'itemKriteria[]', 'label' => '', 'rules' => 'trim|required')
        );

        return $validation;
    }

    private function getValidationUpdateKriteria()
    {
        $validation = array(
            array('field' => 'kdKriteria', 'label' => '', 'rules' => 'required|integer'),
            array('field' => 'kriteria', 'label' => '', 'rules' => 'trim|required'),
            array('field' => 'sifat', 'label' => '', 'rules' => 'trim|required'),
            array('field' => 'bobot', 'label' => '', 'rules' => 'required|integer')
        );

        return $validation;
    }

    private function getValidationUpdateSubKriteria()
    {
        $validation = array(
            array('field' => 'kdKriteria', 'label' => '', 'rules' => 'required|integer'),
            array('field' => 'itemKriteria1', 'label' => '', 'rules' => 'trim|required'),
            array('field' => 'itemKriteria2', 'label' => '', 'rules' => 'trim|required'),
            array('field' => 'itemKriteria3', 'label' => '', 'rules' => 'trim'),
            array('field' => 'itemKriteria4', 'label' => '', 'rules' => 'trim'),
            array('field' => 'itemKriteria5', 'label' => '', 'rules' => 'trim')
        );

        return $validation;
    }

    public function index()
    {
        $data['kriteria'] = $this->MKriteria->getAll();
        loadPage('kriteria/index',$data);
    }

    public function tambah()
    {
        if (count($_POST)) {
            $this->form_validation->set_rules($this->getValidationInsert());
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                $this->session->set_flashdata('errors', $errors);
                redirect(current_url());
            } else {
                $this->MKriteria->kriteria = $this->input->post('kriteria', true);
                $this->MKriteria->sifat = $this->input->post('sifat', true);
                $this->MKriteria->bobot = $this->input->post('bobot', true);
                if ($this->MKriteria->insert() == true) {
                    $kdKriteria = $this->MKriteria->getLastID()->kdKriteria;
                    $success = false;
                    $nm = $this->input->post('itemKriteria');
                    $res = array();
                    foreach($nm as $key => $val){
                        $res[] = array(
                            array('subKriteria' => $_POST['itemKriteria'][$key],
                            'value' => $_POST['value'][$key])
                        );
                    }

                    foreach ($res as $item) {
                        $this->MSubKriteria->kdKriteria = $kdKriteria;
                        $this->MSubKriteria->subKriteria = $item[0]['subKriteria'];
                        $this->MSubKriteria->value = $item[0]['value'];
                    // print("<pre>".print_r($item[0]['subKriteria'],true)."</pre>");
                    // exit;

                        if ($this->MSubKriteria->insert() == true) {
                            $success = true;
                        }
                    }
                    if($success == true){
                        $this->session->set_flashdata('message','Berhasil menambah data :)');
                        redirect('kriteria');
                    }

                }

            }

        }
        loadPage('kriteria/tambah');
    }


    public function updateKriteria()
    {
        if(count($_POST)){
            $this->form_validation->set_rules($this->getValidationUpdateKriteria());
            if ($this->form_validation->run() == false) {
                $errors = $this->form_validation->error_array();
                $errors['valid'] = false;
                echo json_encode($errors);
            }else{
                $this->MKriteria->kriteria = $this->input->post('kriteria', true);
                $this->MKriteria->sifat = $this->input->post('sifat', true);
                $this->MKriteria->bobot = $this->input->post('bobot', true);
                $where = array('kdKriteria' => $this->input->post('kdKriteria'));
                $update = $this->MKriteria->update($where);
                if($update){
                    $this->session->set_flashdata('message','Berhasil mengubah data :)');
                    echo json_encode(array("status" => TRUE));
                }else{
                    echo json_encode(array("status" => FALSE));
                }
            }
        }

    }

    public function updateSubKriteria()
    {
        
        
        if(count($_POST)){
            //$this->form_validation->set_rules($this->getValidationUpdateSubKriteria());
            //if ($this->form_validation->run() == false) {
                //$errors = $this->form_validation->error_array();
                //$errors['valid'] = false;
                //echo json_encode($errors);
            //}else{
            //}
            $status = false;
            $post = $_POST;
            $searchstring = '_';
            $arraydata = array();
            foreach($post as $key => $value){
                if(preg_match("/{$searchstring}/i", $key)){
                    $pecah = explode('_', $key);
                    $arraydata[$pecah[1]][$pecah[0]] = $value;
                    $arraydata[$pecah[1]]['kdKriteria'] = $this->input->post('kdKriteria',true);
                    unset($post[$key]);
                }
            }

            foreach($arraydata as $key => $value){
                $data = array(
                    'kdSubKriteria' => $value['kdSubKriteria'],
                    'subKriteria' => $value['subKriteria'],
                    'value' => $value['value'],
                    'kdKriteria' => $value['kdKriteria']
                );

                $where = array(
                    'kdSubKriteria' => $value['kdSubKriteria']
                );

                $update = $this->MSubKriteria->update_new($where, $data);
                if($update){
                    $status = true;
                }
            }

            if($status == true){
                $this->session->set_flashdata('message','Berhasil mengubah data :)');
            }else{
                echo 'Gagal';
            }
            echo json_encode(array("status" => $status));
        }
    }

    public function delete($id)
    {
        if($this->MSubKriteria->delete($id) == true){
            if($this->MKriteria->delete($id) == true){
                $this->session->set_flashdata('message','Berhasil menghapus data :)');
                echo json_encode(array("status" => 'true'));
            }
        }
    }

    public function getById($kode)
    {
        $this->MKriteria->kdKriteria = $kode;
        $data = $this->MKriteria->getById();
        echo json_encode($data);
    }

    public function getSubById($kode)
    {
        $this->MSubKriteria->kdKriteria = $kode;
        $data = $this->MSubKriteria->getById();
        echo json_encode(array('param' => $data, 'kode' => $kode));
    }

    public function detail($kode)
    {
        $this->MKriteria->kdKriteria = $kode;
        $data['kriteria'] = $this->MKriteria->getById();
        $this->MSubKriteria->kdKriteria = $kode;
        $data['subkriteria']= $this->MSubKriteria->getById();

        echo json_encode($data);

    }
}