<!DOCTYPE html>
<html lang="id" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/smenu.css'; ?>">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </head>
  <body>
  <nav class="navbar navbar-expand-lg navbar navbar-light" style="background-color: #dadce0">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Menu <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="<?php echo site_url(); ?>/meja">Meja</a>
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
        <h3>List Menu</h3>
        <div class="box">
          <?php foreach ($data as $value): ?>
            <div class="col-4">
            <button class="stok" type="button" data-toggle="modal" data-target="#modalStok<?php echo $value->kd_menu ?>">
            <img src="<?php echo base_url(). '/fotomenu/' . $value->foto_menu; ?>">
            </button>
              <p class="nama"><?php echo $value->nama_menu ?></p>
              <p class="harga"><?php echo $value->harga_menu ?></p>
              <p class="stok"><?php echo $value->stok_menu ?></p>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="modalStok<?php echo $value->kd_menu ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                  <?php $hid = array('kd_menu' => $value->kd_menu);
                  echo form_open('menu/ubah_stok', '', $hid); ?>
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $value->nama_menu ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                  <div class="form-group">
                    <label for="nama-pelanggan" class="col-form-label">Stok saat ini :</label>
                    <input type="text" class="form-control" value="<?php echo $value->stok_menu ?>" disabled>
                  </div>
                  <div class="form-group">
                    <label for="nama-pelanggan" class="col-form-label">Ubah stok menjadi :</label>
                    <input type="text" class="form-control" id="stok-menu" name="stok_menu">
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
      </div>  
    </div>
    <br>
  </body>
</html>
