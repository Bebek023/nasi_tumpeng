<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('menu_model');
    }
    public function index()
    {
        $get['data'] = $this->menu_model->data();
        $this->load->view('menu', $get);
    }
    public function ubah_stok()
    {
        $bowl['kd_menu'] = $this->input->post('kd_menu');
        $bowl['stok_menu'] = $this->input->post('stok_menu');
        $this->menu_model->update($bowl);
        redirect('menu/index');
    }
}
