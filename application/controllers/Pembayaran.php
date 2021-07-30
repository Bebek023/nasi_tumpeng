<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pembayaran extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('pembayaran_model');
        $this->load->model('pesanan_model');
        $this->load->model('pelanggan_model');
    }
    public function index()
    {
        $get['data'] = $this->pembayaran_model->data();
        $this->load->view('bayar', $get);
    }
    public function view_tambah_bayar()
    {
        $get['id'] = $this->input->get('id');
        $get['bayar'] = $this->input->get('bayar');
        $get['data'] = $this->pesanan_model->data_per_pesanan($get['id']);
        $subtotal = 0;
        foreach ($get['data'] as $value) {
            $subtotal += $value->total_harga;
        }
        $get['subtotal'] = $subtotal;
        $temp = $this->pelanggan_model->get_nama_no($get);
        foreach ($temp as $value) {
            // var_dump($value);
            $get['nama_pelanggan'] = $value->nama_pelanggan;
            $get['no'] = $value->no_meja;
        }
        // echo $get['id'];
        // echo $get['nama_pelanggan'];
        // var_dump($get['data']);
        // echo $get['subtotal'];
        $this->load->view('bayar_tambah', $get);
    }
    public function tambah_bayar()
    {
        $id = $this->input->get('id');
        $sub = $this->input->get('sub');
        $this->pembayaran_model->tambah($id, $sub);
        redirect('pesanan');
    }
}
