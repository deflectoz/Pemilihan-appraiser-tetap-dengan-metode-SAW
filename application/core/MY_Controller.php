<?php

/**
 * Created by PhpStorm.
 * User: sankester
 * Date: 11/05/2017
 * Time: 17:23
 */
class MY_Controller extends CI_Controller
{

    public $data = array();
    public function __construct()
    {
        parent::__construct();
        //Bootstrap 3
        // $this->page->setLoadCss('assets/bootstrap/css/bootstrap.min');
        // $this->page->setLoadJs('assets/jquery/jquery-3.2.1.min');
        // $this->page->setLoadJs('assets/bootstrap/js/bootstrap.min');
        //Bootstrap 4
        //CSS
        $this->page->setLoadCss('assets/bootstrap4/css/bootstrap.min');
        $this->page->setLoadCss('assets/bootstrap4/css/paper-dashboard');
        //JS
        $this->page->setLoadJs('assets/bootstrap4/js/core/jquery.min');
        $this->page->setLoadJs('assets/bootstrap4/js/core/popper.min');
        $this->page->setLoadJs('assets/bootstrap4/js/core/bootstrap.min');
        $this->page->setLoadJs('assets/bootstrap4/js/plugins/perfect-scrollbar.jquery.min');
        $this->page->setLoadJs('assets/bootstrap4/js/paper-dashboard.min');
        //Bootstrap 4


    }


}