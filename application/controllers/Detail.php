<?php

class Detail extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('detail_model');
    }
    public function index()
    {
    }
    public function hapus_detail()
    {
        $bowl['id_detail'] = $this->input->post('id_detail');
        $this->detail_model->delete($bowl);
        redirect('pesanan');
    }
    public function ubah_detail()
    {
        $bowl['id_detail'] = $this->input->post('id_detail');
        $bowl['jumlah_pesan'] = $this->input->post('jumlah_pesan');
        $this->detail_model->update($bowl);
        redirect('pesanan');
    }
}
