<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Pengajuan Cuti
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Pengajuan Cuti</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    <?php if ($this->session->flashdata('gagal_tambah')) { ?>
    <div class="form-group">
      <div class="alert alert-danger alert-primary alert-block">
      <?php echo $this->session->flashdata('gagal_tambah') ?>
      </div>
    </div>
    <?php } ?>
    <?php if ($this->session->flashdata('berhasil_tambah')) { ?>
    <div class="form-group">
      <div class="alert alert-success alert-primary alert-block">
      <?php echo $this->session->flashdata('berhasil_tambah') ?>
      </div>
    </div>
    <?php } ?>
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header" style="background: #374961;">
              <h3 class="box-title" style="color:white;">Form Input Dokumen</h3>
              <a href="<?php echo base_url('main');?>"><button type="button" class="btn btn-md btn-primary" style="float: right;">Kembali</button></a>
                <!-- Modal Dokumen -->
            </div>
            <div id="menu" class="box-header" style="background:  #001F3E">
                <ul class="nav navbar-nav">
                    <li><a href="<?php echo base_url('cuti/add') ?>" style="color:white;">Form Pengajuan</a></li>
                    <li><a href="<?php echo base_url('cuti') ?>" style="color:white;">Daftar Pengajuan</a></li>
                </ul>
            </div>
              <!-- /.box-header -->
            <div id="pengajuan">
              <div class="box-body">
                  <div class="row">
                    <div class="col-md-6 form-horizontal">
                      <div class="form-group">
                        <label class="col-md-3 control-label" style="text-align: left; color:#20d420;font-size: 120%;">Detail Pengajuan Cuti</label>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label" style="text-align: left;">Jenis Cuti</label>
                        <label class="col-md-6 control-label" style="text-align: left;"><?php echo $cuti->c_jenis;?></label>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label" style="text-align: left;">Tanggal Cuti</label>
                        <label class="col-md-6 control-label" style="text-align: left;"><?php echo $cuti->c_dari;?> - <?php echo $cuti->c_sampai;?></label>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label" style="text-align: left;">Lama Cuti</label>
                        <label class="col-md-6 control-label" style="text-align: left;"><?php echo $cuti->c_lama;?></label>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label" style="text-align: left;">Tempat Cuti</label>
                        <label class="col-md-6 control-label" style="text-align: left;"><?php echo $cuti->c_tempat;?></label>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label" style="text-align: left;">Keperluan</label>
                        <label class="col-md-6 control-label" style="text-align: left;"><?php echo $cuti->c_keperluan;?></label>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label" style="text-align: left;">Alamat dan Nomor Telpon yang dapat dihubungi</label>
                        <label class="col-md-6 control-label" style="text-align: left;"><?php echo $cuti->c_kontak;?></label>
                      </div>
                      <a href="<?php echo base_url().'cuti/pdf/'.$cuti->c_id; ?>" target="_blank" class="btn btn-default"><i class="fa fa-print"></i> Print Detail</a>
                    </div>
                    <div class="col-md-6 form-horizontal">
                      <div>
                        <label style="font-size: 120%;color:#20d420;text-align: left;">Keterangan Pegawai</label>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label" style="text-align: left;">Nama</label>
                        <label class="col-md-6 control-label" style="text-align: left;"><?php echo $pengaju->p_nama;?></label>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label" style="text-align: left;">NIP</label>
                        <label class="col-md-6 control-label" style="text-align: left;"><?php echo $pengaju->p_id;?></label>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label" style="text-align: left;">Jabatan</label>
                        <label class="col-md-6 control-label" style="text-align: left;"><?php echo $pengaju->r_nama;?></label>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label" style="text-align: left;">Golongan</label>
                        <label class="col-md-6 control-label" style="text-align: left;"><?php echo $pengaju->g_tingkat;?></label>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label" style="text-align: left;">Unit Kerja</label>
                        <label class="col-md-6 control-label" style="text-align: left;"><?php echo $pengaju->p_unitkerja;?></label>
                      </div>
                      <div class="form-group">
                        <label class="col-md-9 control-label" style="font-size: 120%;color:#20d420;text-align: left;">Pejabat yang menyetujui</label>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label" style="text-align: left;">Nama</label>
                        <label class="col-md-6 control-label" name="atasan_nama" style="text-align: left;"><?php echo $verifikator->p_nama;?></label>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label" style="text-align: left;">NIP</label>
                        <label class="col-md-6 control-label" name="atasan_nip" style="text-align: left;"><?php echo $verifikator->p_id;?></label>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label" style="text-align: left;">Jabatan</label>
                        <label class="col-md-6 control-label" name="atasan_jabatan" style="text-align: left;"><?php echo $verifikator->r_nama;?></label>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label" style="text-align: left;">Golongan</label>
                        <label class="col-md-6 control-label" name="atasan_golongan" style="text-align: left;"><?php echo $verifikator->g_tingkat;?></label>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label" style="text-align: left;">Unit Kerja</label>
                        <label class="col-md-6 control-label" name="atasan_unit" style="text-align: left;"><?php echo $verifikator->p_unitkerja;?></label>
                      </div>
                      <div>
                        <br>
                        <label style="font-size: 100%;color:#20d420;">Informasi Kelengkapan Syarat Cuti</label>
                      </div>
                      <div class="form-group">
                        <label class="col-md-12 control-label" style="text-align: left;color:#c9c9c9;">1. Waktu pengajuan cuti maksimal saat hari H cuti dilaksanakan</label>
                    </div>
                  </div>
                  <!-- /.row -->
                  <br>
                  <br>
                  <!-- /.row -->
              </div>
              <!-- /.box-body -->
            </div>
            <!-- /.box -->
          </div>
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>