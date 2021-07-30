<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Meja extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('meja_model');
    }
    public function index()
    {
        $get['data'] = $this->meja_model->data();
        $this->load->view('meja', $get);
    }
    public function ubah_meja()
    {
        $bowl['status'] = $this->input->post('status');
        $bowl['no_meja'] = $this->input->post('no_meja');
        $this->meja_model->update($bowl);
        redirect('meja/index');
    }
}
