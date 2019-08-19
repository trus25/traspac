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
                <form role="form" action="<?php echo base_url('cuti/add') ?>" method="POST" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-md-8 form-horizontal">
                      <div class="form-group">
                        <label class="col-md-3 control-label" style="text-align: left; color:#20d420;font-size: 120%;">Sisa Cuti</label>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label" style="text-align: left;color:#c9c9c9;">Saldo Cuti 2019</label>
                        <label class="col-md-3 control-label" style="text-align: left;color:#c9c9c9;"><?php echo $jatah; ?></label>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label" style="text-align: left;">Jenis Cuti</label>
                        <div class="col-md-9">
                          <select class="form-control" name="jenis">
                            <option value="Cuti Alasan Penting">Cuti Alasan Penting</option>
                            <option value="Cuti Tahunan">Cuti Tahunan</option>
                            <option value="Cuti Sakit">Cuti Sakit</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label" style="text-align: left;">Tanggal Cuti</label>
                        <div class="col-md-3">
                          <input type="date" class="form-control bradius" id="dari" name="dari" required="">
                        </div>
                        <div class="col-md-3">
                          <input type="date" class="form-control bradius" id="sampai" name="sampai" required="">
                        </div>
                      </div>
                      <div class="form-group">
                          <label class="col-md-3 control-label" style="text-align: left;">Lama Cuti</label>
                          <div class="col-md-3"><input type="text" class="form-control bradius" id="lama" name="lama" required=""></div>
                          <label class="col-md-3 control-label" style="text-align: left;">Hari Kerja</label>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label" style="text-align: left;">Tempat Cuti</label>
                        <div class="col-md-9">
                          <select class="form-control" name="tempat">
                            <option value="Dalam Negri">Dalam Negri</option>
                            <option value="Luar Negri">Luar Negri</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                          <label class="col-md-3 control-label" style="text-align: left;">Keperluan</label>
                          <div class="col-md-9"><textarea type="text" rows="5" class="form-control bradius" name="keperluan" required=""></textarea></div>
                      </div>
                      <div class="form-group">
                          <label class="col-md-3 control-label" style="text-align: left;">Alamat dan Nomor Telepon yang dapat dihubungi</label>
                          <div class="col-md-9"><textarea type="text" rows="5" class="form-control bradius" name="kontak" required=""></textarea></div>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label" style="text-align: left;">Upload dokumen: </label>
                        <input class="form-control-file col-md-9" type="file" name="berkas"/>
                      </div>

                      <input type="hidden" id="count" name="count" value="0">
                    </div>
                    <div class="col-md-4 form-horizontal">
                      <div>
                        <label style="font-size: 120%;color:#20d420;text-align: left;">Keterangan Pegawai</label>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label" style="text-align: left;">Nama</label>
                        <label class="col-md-6 control-label" style="text-align: left;"><?php echo $name;?></label>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label" style="text-align: left;">NIP</label>
                        <label class="col-md-6 control-label" style="text-align: left;"><?php echo $id;?></label>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label" style="text-align: left;">Jabatan</label>
                        <label class="col-md-6 control-label" style="text-align: left;"><?php echo $role;?></label>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label" style="text-align: left;">Golongan</label>
                        <label class="col-md-6 control-label" style="text-align: left;"><?php echo $golongan;?></label>
                      </div>
                      <div class="form-group">
                        <label class="col-md-3 control-label" style="text-align: left;">Unit Kerja</label>
                        <label class="col-md-6 control-label" style="text-align: left;"><?php echo $unit;?></label>
                      </div>
                      <div class="form-group">
                        <label class="col-md-9 control-label" style="font-size: 120%;color:#20d420;text-align: left;">Pejabat yang menyetujui</label>
                        <div class="col-md-3">
                          <input type="button" class="btn btn-default btn-xs form-control" style="border-radius:16px;" value="Pilih Atasan" data-toggle="modal" data-target="#modal">
                        </div>
                      </div>
                      <div id="show">
                            <input type="hidden" class="form-control bradius" value="" name="id_atasan" required="">
                        <div class="form-group">
                          <label class="col-md-3 control-label" style="text-align: left;">Nama</label>
                          <label class="col-md-6 control-label" name="atasan_nama" style="text-align: left;"></label>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label" style="text-align: left;">NIP</label>
                          <label class="col-md-6 control-label" name="atasan_nip" style="text-align: left;"></label>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label" style="text-align: left;">Jabatan</label>
                          <label class="col-md-6 control-label" name="atasan_jabatan" style="text-align: left;"></label>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label" style="text-align: left;">Golongan</label>
                          <label class="col-md-6 control-label" name="atasan_golongan" style="text-align: left;"></label>
                        </div>
                        <div class="form-group">
                          <label class="col-md-3 control-label" style="text-align: left;">Unit Kerja</label>
                          <label class="col-md-6 control-label" name="atasan_unit" style="text-align: left;"></label>
                        </div>
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
              <input type="Submit" class="btn btn-primary btn-md" style="float:Right;" value="Submit" />
                </form>
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

  <!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" style="text-align: center;"id="exampleModalLongTitle">Harap Pilih Atasan</h3>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-body table-responsive no-padding">
              <table class="table table-hover" id="daftar-atasan">
                <?php foreach ($list as $ls) {?>
                  <tr id="<?php echo $ls->p_id; ?>">
                    <td style="text-align: center;"><h4><b><?php echo $ls->p_nama?></b></h4></td>
                    <td style="text-align: center;"><h4><b><?php echo $ls->r_nama?></b></h4></td>
                  </tr>
                <?php } ?>
              </tbody></table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" id="ok" class="btn btn-success">Pilih</button>
      </div>
    </div>
  </div>
</div>`