<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="id" dir="ltr">

<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'css/smeja.css'; ?>">
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
        <li class="nav-item active">
          <a class="nav-link" href="#">Meja <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?php echo site_url(); ?>/pesanan">Pesanan</a>
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
      <h3 align="center">List Meja</h3>
      <div class="box">
        <?php foreach ($data as $value) : ?>
          <div class="meja">
            <!-- Button trigger modal -->
            <?php
            if (($this->session->userdata('jabatan')) == 'Pelayan') { ?>
              <?php
              if ($value->status == 'Kosong') { ?>
                <button type="button" class=" btn-primary btn-lg tombol" data-toggle="modal" data-target="#modalMeja<?php echo $value->no_meja ?>">
                  <p class="nmeja"><?php echo $value->no_meja ?></p>
                  <p class="status"><?php echo $value->status ?></p>
                </button>
              <?php } else { ?>
                <button type="button" class=" btn-danger btn-lg tombol" data-toggle="modal" data-target="#modalMeja<?php echo $value->no_meja ?>">
                  <p class="nmeja"><?php echo $value->no_meja ?></p>
                  <p class="status"><?php echo $value->status ?></p>
                </button>
              <?php } ?>
            <?php } else { ?>
              <?php
              if ($value->status == 'Kosong') { ?>
                <button type="button" class=" btn-primary btn-lg tombol disabled" data-target="<?php echo $value->no_meja ?>">
                  <p class="nmeja"><?php echo $value->no_meja ?></p>
                  <p class="status"><?php echo $value->status ?></p>
                </button>
              <?php } else { ?>
                <button type="button" class=" btn-danger btn-lg tombol disabled" data-target="<?php echo $value->no_meja ?>">
                  <p class="nmeja"><?php echo $value->no_meja ?></p>
                  <p class="status"><?php echo $value->status ?></p>
                </button>
              <?php } ?>
            <?php } ?>
          </div>
          <!-- Modal -->
          <div class="modal fade" id="modalMeja<?php echo $value->no_meja ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <?php $hid = array('no_meja' => $value->no_meja);
                echo form_open('meja/ubah_meja', '', $hid); ?>
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Meja <?php echo $value->no_meja ?></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <label class="col-form-label">Ubah status meja menjadi</label>
                    <?php if ($value->status == "Kosong") { ?>
                      <label class="col-form-label">Terisi</label>
                      <input type="hidden" name="status" value="Terisi">
                    <?php } elseif ($value->status == "Terisi") { ?>
                      <label class="col-form-label">Kosong</label>
                      <input type="hidden" name="status" value="Kosong">
                    <?php } ?>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-primary">Ubah</button>
                </div>
                <?php echo form_close(); ?>
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