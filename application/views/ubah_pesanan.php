<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id" dir="ltr">

<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'css/smenu.css'; ?>">
  <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item">
          <a class="nav-link" href="<?php echo site_url(); ?>/menu">Menu</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo site_url(); ?>/meja">Meja</a>
        </li>
        <li class="nav-item  active">
          <a class="nav-link" href="<?php echo site_url(); ?>/pesanan">Pesanan <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo site_url(); ?>/pembayaran">Pembayaran</a>
        </li>
      </ul>
      <?php echo $this->session->userdata('nama_pegawai') ?>
      -
      <?php echo $this->session->userdata('jabatan') ?>
      <?php echo form_open("login/logout") ?>
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Logout</button>
      <?php echo form_close() ?>
    </div>
  </nav>

  <div class="section">
    <div class="container">
      Nama : <?php echo $nama_pelanggan ?>
      <br>
      No meja : <?php echo $no ?>
      <table class="table">
        <thead align="center">
          <tr>
            <th scope="col">nama menu</td>
            <th scope="col">jumlah pesan</td>
            <th scope="col">harga satuan</td>
            <th scope="col">total harga</td>
            <th scope="col" colspan="2">
              </td>
          </tr>
        </thead>
        <?php foreach ($data as $value) : ?>
          <tr align="center">
            <td scope="row"><?php echo $value->nama_menu ?></td>
            <td><?php echo $value->jumlah_pesan ?></td>
            <td><?php echo $value->harga_menu ?></td>
            <td><?php echo $value->total_harga ?></td>
            <td>
              <!-- Button trigger modal -->
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalHapus<?php echo $value->id_detail ?>">
                Hapus
              </button>
              <!-- Modal -->
              <div class="modal fade" id="modalHapus<?php echo $value->id_detail ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <?php $hid = array('id_detail' => $value->id_detail);
                    echo form_open('detail/hapus_detail', '', $hid); ?>
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Hapus menu pesanan</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <label class="col-form-label">Hapus menu dari pesanan?</label>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-danger">Hapus</button>
                    </div>
                    <?php echo form_close(); ?>
                  </div>
                </div>
              </div>


              <!-- Button trigger modal -->
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalUbah<?php echo $value->id_detail ?>">
                Ubah Jumlah Pesan
              </button>
              <!-- Modal -->
              <div class="modal fade" id="modalUbah<?php echo $value->id_detail ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <?php $hid = array('id_detail' => $value->id_detail);
                    echo form_open('detail/ubah_detail', '', $hid); ?>
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Ubah jumlah pesan</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <label class="col-form-label">Ubah pesanan <?php echo $value->nama_menu ?> menjadi : </label>
                      <br>
                      <input type="number" name="jumlah_pesan" value="<?php echo $value->jumlah_pesan ?>" placeholder="<?php echo $value->jumlah_pesan ?>">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-primary">Ubah</button>
                    </div>
                    <?php echo form_close(); ?>
                  </div>
                </div>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      </table>
    </div>
  </div>
</body>

</html>