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
        <li class="nav-item active">
          <a class="nav-link" href="#">Pesanan <span class="sr-only">(current)</span></a>
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

      <?php
      $jabatan = $this->session->userdata('jabatan');
      if ($jabatan == 'Pelayan') { ?>
        <a class="btn btn-primary" href="<?php echo site_url() ?>/pesanan/view_tambah_pesanan" role="button">Tambah Pesanan Baru</a>
      <?php } elseif ($jabatan == 'Koki' || $jabatan == 'Kasir') { ?>
        <a class="btn btn-primary disabled" href="<?php echo site_url() ?>/pesanan/view_tambah_pesanan" role="button">Tambah Pesanan Baru</a>
      <?php } ?>
      <div id="accordion">
        <?php foreach ($data as $value) : ?>
          <div class="card">
            <div class="card-header" id="heading<?php echo $value->id_pesanan ?>">
              <h5 class="mb-0">
                <button class="btn btn-link " data-toggle="collapse" data-target="#collapse<?php echo $value->id_pesanan ?>" aria-expanded="false" aria-controls="collapse<?php echo $value->id_pesanan ?>">
                  Meja <?php echo $value->no_meja ?> - <?php echo $value->nama_pelanggan ?> - <?php echo $value->status_pesanan ?>
                </button>
              </h5>
            </div>
            <div id="collapse<?php echo $value->id_pesanan ?>" class="collapse" aria-labelledby="heading<?php echo $value->id_pesanan ?>" data-parent="#accordion">
              <div class="card-body">
                <table class="table table-sm">
                  <thead>
                    <tr>
                      <th scope="col">Nama menu</td>
                      <th scope="col">jumlah pesan</td>
                    </tr>
                  </thead>
                  <?php
                  foreach (${'data' . $x} as $val) : ?>
                    <tr>
                      <td scope="row"><?php echo $val->nama_menu ?></td>
                      <td><?php echo $val->jumlah_pesan ?></td>
                    </tr>
                  <?php
                  endforeach;
                  $x--;
                  ?>
                  <?php if ($jabatan == 'Pelayan') { ?>
                    <a class="btn btn-primary " href="<?php echo site_url() ?>/pesanan/view_tambah_pesanan?id=<?php echo $value->id_pesanan ?>" role="button">Tambah pesanan</a>
                    <a class="btn btn-primary " href="<?php echo site_url() ?>/pesanan/ubah_pesanan?id=<?php echo $value->id_pesanan ?>" role="button">Ubah pesanan</a>
                    <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#modalHapus<?php echo $value->id_pesanan ?>">
                      Hapus
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="modalHapus<?php echo $value->id_pesanan ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <?php $hid = array('id_pesanan' => $value->id_pesanan, 'no_meja' => $value->no_meja);
                          echo form_open('pesanan/hapus_pesanan', '', $hid); ?>
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">Hapus pesanan</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <label class="col-form-label">Hapus pesanan?</label>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                          </div>
                          <?php echo form_close(); ?>
                        </div>
                      </div>
                    </div>
                  <?php } elseif ($jabatan == 'Koki' || $jabatan == 'Kasir') { ?>
                    <a class="btn btn-primary disabled" href="<?php echo site_url() ?>/pesanan/view_tambah_pesanan?id=<?php echo $value->id_pesanan ?>" role="button">Tambah pesanan</a>
                    <a class="btn btn-primary disabled" href="<?php echo site_url() ?>/pesanan/ubah_pesanan?id=<?php echo $value->id_pesanan ?>" role="button">Ubah pesanan</a>
                    <button type="button" class="btn btn-primary disabled" data-toggle="modal" data-target="#modalHapus<?php echo $value->id_pesanan ?>">
                      Hapus
                    </button>
                  <?php } ?>

                  <?php if ($jabatan == 'Koki') { ?>
                    <a class="btn btn-primary" href="<?php echo site_url() ?>/pesanan/selesai_pesanan?id=<?php echo $value->id_pesanan ?>" role="button">Selesaikan pesanan</a>
                  <?php } elseif ($jabatan == 'Pelayan' || $jabatan == 'Kasir') { ?>
                    <a class="btn btn-primary disabled" href="<?php echo site_url() ?>/pesanan/selesai_pesanan?id=<?php echo $value->id_pesanan ?>" role="button">Selesaikan pesanan</a>
                  <?php } ?>
                  <?php if ($jabatan == 'Kasir') { ?>
                    <a class="btn btn-primary " href="<?php echo site_url() ?>/pembayaran/view_tambah_bayar?id=<?php echo $value->id_pesanan ?>&bayar=1" role="button">Bayar</a>
                  <?php } elseif ($jabatan == 'Koki' || $jabatan == 'Pelayan') { ?>
                    <a class="btn btn-primary disabled" href="<?php echo site_url() ?>/pembayaran/view_tambah_bayar?id=<?php echo $value->id_pesanan ?>&bayar=1" role="button">Bayar</a>
                  <?php } ?>
                </table>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
      <br>


    </div>
  </div>
</body>

</html>