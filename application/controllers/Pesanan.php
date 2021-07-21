<?php

class Pesanan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('pesanan_model');
        $this->load->model('menu_model');
        $this->load->model('meja_model');
        $this->load->model('pelanggan_model');
    }
    public function index()
    {
        $get['x'] = 0;
        $get['data'] = $this->pesanan_model->data();
        $result = $this->pesanan_model->data_count();
        foreach ($result as $value) {
            $get['x']++;
            $get['data'.$get['x']] = $this->pesanan_model->data_per_pesanan($value->id_pesanan);
        }
        // var_dump($get['data0']);
        $this->load->view('pesanan', $get);
    }
    public function view_tambah_pesanan()
    {
        if (null !== $this->input->get('id')) {
            $get['id'] = $this->input->get('id');
        }
        $get['data'] = $this->menu_model->data();
        $this->load->view('pesanan_tambah', $get);
    }
    public function view_pilih_menu()
    {
        if (null == $this->input->get('id')) {
            $menu['meja'] = $this->meja_model->data();
        }
        $kd = $this->input->get('kd');
        $menu['data'] = $this->menu_model->get_menu($kd);
        $this->load->view('detail_pesanan_tambah', $menu);
    }
    public function tambah_detail_pesanan()
    {
        $bowl['kd_menu'] = $this->input->post('kd_menu');
        $bowl['id_pegawai'] = $this->input->post('id_pegawai');
        $bowl['stok_menu'] =  $this->input->post('stok_skrg') - $this->input->post('stok');
        $bowl['stok_pesan'] = $this->input->post('stok');
        if (null !== $this->input->post('id_pesanan')) {
            $id_pesanan = $this->input->post('id_pesanan');
            $res = $this->pesanan_model->data_menu_ganda($id_pesanan, $bowl);
            if ($res) {
                $bowl['stok_pesan'] = $bowl['stok_pesan'] + $res;
                $this->pesanan_model->update_jumlah_pesan($bowl, $id_pesanan);
            } else {
                $this->pesanan_model->tambah_detail($bowl, $id_pesanan);
            }
        } else {
            $bowl['no_meja'] = $this->input->post('meja');
            $bowl['nama_pelanggan'] = $this->input->post('nama_pelanggan');
            $id_pelanggan = $this->pelanggan_model->tambah($bowl);
            $id_pesanan = $this->pesanan_model->tambah($bowl, $id_pelanggan);
            $this->pesanan_model->tambah_detail($bowl, $id_pesanan);
        }
        $this->menu_model->update($bowl);
        redirect('pesanan/view_tambah_pesanan');
    }
}
