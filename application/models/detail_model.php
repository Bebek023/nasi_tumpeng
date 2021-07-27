<?php

  class Detail_model extends CI_Model
  {
      public function delete($bowl)
      {
          $this->db->where('id_detail', $bowl['id_detail']);
          $this->db->delete('detail');
      }
      public function delete_pesanan($bowl)
      {
          $this->db->where('id_pesanan', $bowl['id_pesanan']);
          $this->db->delete('detail');
      }
      public function update($bowl)
      {
          $this->db->set('jumlah_pesan', $bowl['jumlah_pesan']);
          $this->db->where('id_detail', $bowl['id_detail']);
          $this->db->update('detail');
      }
  }
