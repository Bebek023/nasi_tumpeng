<?php

  class Pesanan_model extends CI_Model
  {
      public function data()
      {
          $query = $this->db->query("select pemesanan.id_pesanan, no_meja, p.nama_pelanggan, pemesanan.status_pesanan from pemesanan inner join pelanggan p on pemesanan.id_pelanggan=p.id_pelanggan where pemesanan.id_pesanan not in(select pembayaran.id_pesanan from pembayaran)");
          return $query->result();
      }
      public function data_count()
      {
          $query = $this->db->query("select pemesanan.id_pesanan from pemesanan where pemesanan.id_pesanan not in(select pembayaran.id_pesanan from pembayaran) order by waktu_pesanan desc");
          return $query->result();
      }
      public function data_per_pesanan($id)
      {
          $query = $this->db->query("select m.nama_menu, d.jumlah_pesan from detail d inner join menu m on d.kd_menu=m.kd_menu where d.id_pesanan=". $id);
          return $query->result();
      }
      public function tambah($bowl, $id_pelanggan)
      {
          $this->db->query("insert into pemesanan(waktu_pesanan, id_pelanggan, no_meja, status_pesanan) values(now(), ".$id_pelanggan.", ".$bowl['no_meja'].", 'Belum selesai');");
          $insert_id = $this->db->insert_id();
          return $insert_id;
      }
      public function tambah_detail($bowl, $id_pesanan)
      {
          $query = $this->db->query("insert into detail(id_pesanan, kd_menu, id_pegawai, jumlah_pesan) values(".$id_pesanan. ", '".$bowl['kd_menu']."', ".$bowl['id_pegawai'].", ".$bowl['stok_pesan'].");");
      }
      public function data_menu_ganda($id_pesanan, $bowl)
      {
          $query = $this->db->query("select jumlah_pesan from detail where id_pesanan=".$id_pesanan." and kd_menu='".$bowl['kd_menu']."'");
          return $query->row();
      }
      public function update_jumlah_pesan($bowl, $id_pesanan)
      {
          $array = array('jumlah_pesan' => $bowl['stok_pesan']);
          $arr = array('id_pesanan' => $id_pesanan, 'kd_menu' => $bowl['kd_menu']);
          $this->db->set($array);
          $this->db->where($arr);
          $this->db->update('detail');
      }
  }
