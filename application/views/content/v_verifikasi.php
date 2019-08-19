<?php
defined('BASEPATH') OR exit('No direct script access allowed');
  function format_tanggal($tanggal){
  $bulan = array (1 =>   'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
      );
  $split = explode('-', $tanggal);
  return $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
  }

  function format_tanggal_pgj($tanggal){
  $split = explode('-', $tanggal);
  return $split[0] . '/' . $split[1] . '/' . $split[2];
  }

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
                <form class="navbar-form navbar-left row" role="search">
                  <div class="col-md-1"></div>
                  <div class="col-md-11">
                    <div class="form-group">
                      <div class="row">
                        <div class="col-md-3">
                          <input type="text" class="form-control" name="min" id="min" placeholder="Dari...">
                        </div>
                        <div class="col-md-3">
                          <input type="text" class="form-control" name="max" id="max" placeholder="Sampai...">
                        </div>
                        <div class="col-md-3">
                          <select class="form-control" id="jenis_cuti" name="jenis_cuti" placeholder="test">
                            <option></option>
                            <option value="Cuti Alasan Penting">Cuti Alasan Penting</option>
                            <option value="Cuti Tahunan">Cuti Tahunan</option>
                            <option value="Cuti Sakit">Cuti Sakit</option>
                          </select>
                        </div>
                        <div class="col-md-3">
                          <select class="form-control" id="status_cuti" name="status_cuti">
                            <option></option>
                            <option value="Usulan Baru">Usulan Baru</option>
                            <option value="Disetujui Atasan">Disetujui Atasan</option>
                            <option value="Ditolak Atasan">Ditolak Atasan</option>
                          </select>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>
            </div>
              <!-- /.box-header -->
            <div class="box-body">
              <table id="verif" class="table table-bordered table-striped table-hover" style="width: 100%;">
                <thead>
                  <tr>
                    <th style="text-align: center">No.</th>
                    <th style="text-align: center">Nama</th>
                    <th style="text-align: center">Jabatan</th>
                    <th style="text-align: center">Tgl Cuti</th>
                    <th style="text-align: center">Lama Cuti</th>
                    <th style="text-align: center">Tempat Cuti</th>
                    <th style="text-align: center">Jenis Cuti</th>
                    <th style="text-align: center">Status</th>
                    <th style="text-align: center">Tgl Pengajuan</th>
                    <th style="text-align: center">Tgl Pengajuan</th>
                    <th style="text-align: center">Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  foreach ($cuti as $ct) { ?>
                    <tr>
                      <td style="text-align: center"></td>
                      <td style="text-align: center"><?php echo $ct->p_nama; ?></td>
                      <td style="text-align: center"><?php echo $ct->r_nama; ?></td>
                      <td style="text-align: center"><?php echo format_tanggal($ct->c_dari); ?> - <?php echo format_tanggal($ct->c_sampai); ?> </td>
                      <td style="text-align: center"><?php echo $ct->c_lama; ?></td>
                      <td style="text-align: center"><?php echo $ct->c_tempat; ?></td>
                      <td style="text-align: center"><?php echo $ct->c_jenis; ?></td>
                      <td style="text-align: center"><?php if($ct->c_status == 'new'){
                        echo 'Usulan Baru';
                      }else if($ct->c_status == 'acc'){
                        echo 'Disetujui Atasan';
                      }else if($ct->c_status == 'rjct'){
                        echo 'Ditolak Atasan';
                      }?></td>
                      <td style="text-align: center"><?php echo format_tanggal_pgj($ct->c_tanggal); ?></td>
                      <td style="text-align: center"><?php echo format_tanggal($ct->c_tanggal); ?></td>
                      <td style="text-align: center">
                        <a href="" class="btn btn-info btn-circle" title="Setuju"><i class="fa fa-check"></i></a>
                        <a href="" class="btn btn-warning btn-circle" title="Tolak"><i class="fa fa-times"></i></a>
                        <a href="" class="btn btn-default btn-circle">Lihat Detail</i></a>
                      </td>
                    </tr>
                  <?php } ?>
                </tbody>
              </table>
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