<?php

  class Meja_model extends CI_Model
  {
      public function data()
      {
          $query = $this->db->query("select * from meja");
          return $query->result();
      }
      public function meja_isi()
      {
          $query = $this->db->query("select * from meja where status='Kosong'");
          return $query->result();
      }
      public function update($bowl)
      {
          $this->db->set('status', $bowl['status']);
          $this->db->where('no_meja', $bowl['no_meja']);
          $this->db->update('meja');
      }
  }
