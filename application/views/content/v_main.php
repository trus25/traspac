<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
  <!-- /.content-wrapper -->

   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Home
      </h1>
      <ol class="breadcrumb">
        <li><a href="<?php echo base_url();?>"><i class="fa fa-dashboard"></i> Home</a></li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <!-- /.row -->
      <div class="row">
      	<div class="col-xs-2">
      	</div>
        <div class="col-xs-4">
          <div class="box box-solid box-success">
            <div class="box-header skin-green-light">
              <h3 class="box-title">Sistem Informasi Manajemen Aparatur Sipil Negara</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
             <div class="container">
			      		<div class="row">
							<div class="card">
							  <div class="card-body">
							  	<div class="container ml-3">
								  	<div class="row">
								    	<img src="<?php echo config_item('assets_path');?>img/profile.png" class="img-circle" style="width: 25%" alt="User Image">
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="row mb-2">
										    	<td><h2 class="card-text" style="float:left;"><?php echo $name; ?></h2></td>
										   	</div>
										   	<div class="row mb-2">
										    	<td><h6 class="card-text" style="float:left;"><?php echo $id; ?></h6></td>
										    </div>
										    <div class="row mb-2">
										    	<td><h4 class="card-text" style="float:left;"><?php echo $role; ?></h4></td>
										    </div>
										</div>
									</div>
								</div>
							  </div>
							  	<div class="card-footer">
							  	</div>
							</div>
						</div>
			    </div>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
        	<div class="box box-solid box-success">
            <div class="box-header skin-green-light">
              <h3 class="box-title"> </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
							<div class="card" style="height: auto;">
							  <div class="card-body">
											<h2 class="text-secondary">Daftar Pelayanan</h2>
											<ul class="list-group">
											    <a class="list-group-item list-group-item-action" style="border:none;" href="<?php echo base_url('cuti');?>"><h6 class="card-text"><i class="fa fa-book fa-lg"></i> Pengajuan Cuti Online</h6></a>
										    	<a class="list-group-item list-group-item-action" style="border:none;" href="<?php echo base_url('verifikasi');?>"><h6 class="card-text"><i class="fa fa-check fa-lg"></i> Verifikasi Cuti</h6></a>
										    </ul>
							  </div>
							</div>
            </div>
            <!-- /.box-body -->
        </div>
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>