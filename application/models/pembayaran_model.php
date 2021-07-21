<?php

  class Pembayaran_model extends CI_Model
  {
      public function data()
      {
          $query = $this->db->query("select * from pembayaran");
          return $query->result();
      }
      public function tambah($id, $sub)
      {
          $this->db->query("insert into pembayaran(id_pesanan, waktu_pembayaran, subtotal) values(".$id.", now(), ".$sub.")");
      }
  }
