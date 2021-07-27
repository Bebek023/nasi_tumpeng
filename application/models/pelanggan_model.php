<?php

  class Pelanggan_model extends CI_Model
  {
      public function tambah($bowl)
      {
          $this->db->query("insert into pelanggan(nama_pelanggan) values('".$bowl['nama_pelanggan']."');");
          $insert_id = $this->db->insert_id();
          return $insert_id;
      }
      public function get_nama_no($bowl)
      {
          $query = $this->db->query("select nama_pelanggan, no_meja, pemesanan.id_pelanggan from pelanggan inner join pemesanan on pelanggan.id_pelanggan=pemesanan.id_pelanggan where pemesanan.id_pesanan=".$bowl['id']);
          return $query->result();
      }
  }
