<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script src="<?php echo base_url(); ?>assets/dist/js/jquery.min.js"></script>
<!-- <link href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> -->


<?php

  // Total Diagnosa Yang Sering Keluar
    $totDiag = '';
    foreach ($totalDiagnosa->result() as $kolom) {
      $totDiag = $kolom->jumlah;
    }

    // Total Tindakan CP Sampai Saat Ini
    $totTind = '';
    foreach ($totalTindakan->result() as $kolom) {
      $totTind = $kolom->jmlCP;
    }

?>

<style type="text/css">

  .small-box h3 {
    font-size: 60px;
    font-weight: bold;
    margin: 0 0 10px 0;
    white-space: nowrap;
    padding: 0;
  }

  .header-title {
    background-color: #605ca8; 
    color: #fff;
    padding-left: 7px;
    padding-right: 7px;
    padding-top: 4px;
    padding-bottom: 4px;
    border-radius: 5px;
  }

  .header-title-import {
    background-color: #3D9970; 
    color: #fff;
    padding-left: 7px;
    padding-right: 7px;
    padding-top: 4px;
    padding-bottom: 4px;
    border-radius: 5px;
  }
  
</style>

<script type="text/javascript">

  function lihatDetailTindakan(nmcp, kdkel, dx) {

    $('#nama_cp').val(nmcp);
    $('#kdkel').val(kdkel);
    $('#dx').val(dx);
    $('#modal_detail_biaya_tindakan').modal('show');

    tabel_detail_tindakan_cp();

  }
  
  function tabel_detail_diagnosa(){
    $('#tabel_detail_diagnosa').DataTable().destroy();
    $('#tabel_detail_diagnosa').DataTable({
      "oLanguage": {
            "sEmptyTable": "Tidak ada data yang ditampilkan"
        },
        "bAutoWidth": false,
        "ordering": false,
        "info": false,
      "destroy": true,
      "processing" : true,
          "ajax": {
                "url": "<?php echo base_url() ?>dashboard/tabelDetailDiagnosa",
                "type": "POST",
                "data": {
                  // id_tindakan : $('#idTindakan').val(),
                  // kd_tindakan : $('#kdTindakan').val(),
                  },
                  },
      "columns"       : [

              // {"data" : "kosong"},
              {"data" : "no"},
              {"data" : "KODE"},
              {"data" : "DIAGNOSA"},
              
            ],
         //    responsive: {
            //       details: {
            //           type: 'column',
            //           target: 'tr'
            //        }
          // },
          columnDefs: [{
              className: 'control',
              orderable: false,
              width: 20,
              targets: 0
              }
        ],
    });

  }

  function tabel_detail_tindakan(){
    $('#tabel_detail_tindakan').DataTable().destroy();
    $('#tabel_detail_tindakan').DataTable({
      "oLanguage": {
            "sEmptyTable": "Tidak ada data yang ditampilkan"
        },
        "bAutoWidth": false,
        "ordering": false,
        "info": false,
      "destroy": true,
      "processing" : true,
          "ajax": {
                "url": "<?php echo base_url() ?>dashboard/tabelDetailTindakan",
                "type": "POST",
                "data": {
                  // id_tindakan : $('#idTindakan').val(),
                  // kd_tindakan : $('#kdTindakan').val(),
                  },
                  },
      "columns"       : [

              // {"data" : "kosong"},
              {"data" : "no"},
              {"data" : "NAMACP"},
              {"data" : "DIAGNOSA"},
              {"data" : "KELOMPOK"},
              {"data" : "NAMATIND"},
              {"data" : "PERAWATAN"},
              {"data" : "HARI_KE"},
              {"data" : "JUMLAH"},
              {"data" : "KELAS1"},
              {"data" : "KELAS2"},
              {"data" : "KELAS3"},
              
            ],
         //    responsive: {
            //       details: {
            //           type: 'column',
            //           target: 'tr'
            //        }
          // },
          columnDefs: [{
              className: 'control',
              orderable: false,
              width: 20,
              targets: 0
              }
        ],
    });

  }

  function tabel_detail_biaya(){
    $('#tabel_detail_biaya').DataTable().destroy();
    $('#tabel_detail_biaya').DataTable({
      "oLanguage": {
            "sEmptyTable": "Tidak ada data yang ditampilkan"
        },
        "bAutoWidth": false,
        "ordering": false,
        "info": false,
      "destroy": true,
      "processing" : true,
          "ajax": {
                "url": "<?php echo base_url() ?>dashboard/tabelDaftarInputCP",
                "type": "POST",
                "data": {
                  // nm_unit : $('#nm_unit').val(),
                  },
                  },
      "columns"       : [

              // {"data" : "kosong"},
              {"data" : "no"},
              {"data" : "NAMACP"},
              {"data" : "KELOMPOK"},
              {"data" : "DIAGNOSA"},
              {"data" : "HARI"},
              {"data" : "DETAIL"},
              
            ],
         //    responsive: {
            //       details: {
            //           type: 'column',
            //           target: 'tr'
            //        }
          // },
          columnDefs: [{
              className: 'control',
              orderable: false,
              width: 20,
              targets: 0
              }
        ],
    });

  }

  function tabel_detail_tindakan_cp(){
    $('#tabel_detail_tindakan_cp').DataTable().destroy();
    $('#tabel_detail_tindakan_cp').DataTable({
       "oLanguage": {
            "sEmptyTable": "Tidak ada data yang ditampilkan"
        },
        "bAutoWidth": false,
        "ordering": false,
        "info": false,
      "destroy": true,
      "processing" : true,
          "ajax": {
                "url": "<?php echo base_url() ?>hasil_input_cp/tabelDaftarDetalInputCP",
                "type": "POST",
                "data": {
                  nama_cp : $('#nama_cp').val(),
                  kdkel : $('#kdkel').val(),
                  dx : $('#dx').val(),
                  },
                  },
      "columns"       : [

              // {"data" : "kosong"},
              {"data" : "no"},
              {"data" : "TANGGAL"},
              {"data" : "NMTINDAKAN"},
              {"data" : "JUMLAH"},
              {"data" : "HARI"},
              {"data" : "KELAS1"},
              {"data" : "KELAS2"},
              {"data" : "KELAS3"},
              
            ],
         //    responsive: {
            //       details: {
            //           type: 'column',
            //           target: 'tr'
            //        }
          // },
          columnDefs: [{
              className: 'control',
              orderable: false,
              width: 20,
              targets: 0
              }
        ],
    });;

  }

</script>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
      <li class="active">Detail</li>
    </ol>
  </section>

  
  <section class="content">
  
    <div class="row">
      <div class="col-lg-6 col-xs-12">
  
        <div class="small-box bg-aqua">
          <div class="inner">
            <h3 style="text-align: center;"><?php echo $totDiag; ?>
              <span style="font-size: 25px;"> Diagnosa</span>
            </h3>

            <p style="font-size: 17px;"><b><i>Jumlah Diagnosa di Bulan Ini</i></b></p>
          </div>
          <div class="icon">
            <i class="fa fa-stethoscope"></i>
          </div>
          <a href="#" id="btn_diagnosa" name="btn_diagnosa" class="small-box-footer" data-toggle="modal" data-target="#modal_detail_diagnosa">Detail <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
  
      <div class="col-lg-6 col-xs-12">
  
        <div class="small-box bg-maroon">
          <div class="inner">
            <h3 style="text-align: center;"><?php echo $totTind; ?>
              <span style="font-size: 25px;"> Tindakan</span>
            </h3>

            <p style="font-size: 17px;"><b><i>Total Tindakan Sampai Saat Ini</i></b></p>
          </div>
          <div class="icon">
            <i class="fa fa-heartbeat"></i>
          </div>
          <a href="#" class="small-box-footer" id="btn_tindakan" name="btn_tindakan" data-toggle="modal" data-target="#modal_detail_tindakan">Detail <i class="fa fa-arrow-circle-right"></i></a>
        </div>
      </div>
    </div>

    <div class="row">
      <section class="col-xs-12 connectedSortable">

        <!-- solid sales graph -->
        <div class="box box-purple">
          <div class="box-header">
              <h3 class="box-title header-title"><i class="ion ion-clipboard"></i> Daftar Tindakan CP Sampai Saat Ini</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn bg-purple btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn bg-purple btn-sm" data-widget="remove"><i class="fa fa-times"></i>
              </button>
            </div>
          </div>
          <div class="box-body border-radius-none">
            <div class="table-responsive"><br><br>
              <!-- <input type="hidden" name="kode_cp" id="kode_cp"> -->
              <table class="table table-bordered" id="tabel_detail_biaya" name="tabel_detail_biaya" width="100%" cellspacing="0">
                <thead class="header-tabel">
                  <tr>
                    <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="5%"><center>NO.</center></th>
                    <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="25%">NAMA CP</th>
                    <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="20%">NAMA KELOMPOK</th>
                    <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="35%">DIAGNOSA</th>
                    <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="10%"><center>PERAWATAN</center></th>
                    <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="5%"><center></center></th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </section>
    </div>

    <div class="row">
      <section class="col-xs-12 connectedSortable">

        <!-- solid sales graph -->
        <div class="box box-olive">
          <div class="box-header">
              <h3 class="box-title header-title-import"><i class="fa fa-table"></i> Daftar Perbandingan Yang Telah Diimport</h3>
            <div class="box-tools pull-right">
              <button type="button" class="btn bg-olive btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
              </button>
              <button type="button" class="btn bg-olive btn-sm" data-widget="remove"><i class="fa fa-times"></i>
              </button>
            </div>
          </div>
          <div class="box-body border-radius-none"><br>
            <form method="post" action="<?php echo base_url(); ?>dashboard/upload" enctype="multipart/form-data">
              <p><label>Pilih File Excel</label>
              <input type="file" name="file" id="file" required accept=".xls, .xlsx, .csv" /></p>
              <br>
              <button type="submit" id="submit" name="submit" class="btn bg-olive btn-sm" /><i class="fa fa-file-excel-o"></i> Import</button>
              <button type="button" id="download_excel" name="download_excel" class="btn bg-orange btn-sm" /><i class="fa fa-file-excel-o"></i> Download Format Excel</button>
            </form>
            <div class="table-responsive"><br><br>
              <table class="table table-bordered" id="tabel_import" name="tabel_import" width="100%" cellspacing="0">
                <thead class="header-tabel">
                  <tr>
                    <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="5%"><center>NO.</center></th>
                    <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="25%">NAMA CP</th>
                    <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="20%">NAMA KELOMPOK</th>
                    <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="35%">DIAGNOSA</th>
                    <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="10%"><center>PERAWATAN</center></th>
                    <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="5%"><center></center></th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </section>
    </div>

  </section>
</div>

<!-- Modal Detail Diagnosa-->
<div class="modal fade" id="modal_detail_diagnosa" role="dialog">
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Detail Diagnosa Yang sering Keluar</h4>
      </div>
      <div class="modal-body" style="margin-bottom: 30px;">
        <div class="table-responsive">
          <br>
          <input type="hidden" name="kode_cp" id="kode_cp">
          <table class="table table-bordered" id="tabel_detail_diagnosa" name="tabel_detail_diagnosa" width="100%" cellspacing="0">
            <thead class="header-tabel">
              <tr>
                <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="5%"><center>NO.</center></th>
                <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="10%"><center>KODE</center></th>
                <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="85%">NAMA DIAGNOSA</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer" style="padding-top: 15px; padding-right: 15px;">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class='fa fa-fw fa-lg fa-close'></i>Tutup</button>
      </div>
    </div>
    
  </div>
</div>

<!-- Modal Detail Tindakan-->
<div class="modal fade" id="modal_detail_tindakan" role="dialog">
  <div class="modal-dialog modal-lg">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Detail Tindakan CP Sampai Saat Ini</h4>
      </div>
      <div class="modal-body" style="margin-bottom: 30px;">
        <div class="table-responsive">
          <br>
          <input type="hidden" name="kode_cp" id="kode_cp">
          <table class="table table-bordered" id="tabel_detail_tindakan" name="tabel_detail_tindakan" width="100%" cellspacing="0">
            <thead class="header-tabel">
              <tr>
                <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="5%"><center>NO.</center></th>
                <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="15%">NAMA CP</th>
                <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="25%">NAMA DIAGNOSA</th>
                <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="15%">NAMA KELOMPOK</th>
                <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="15%">NAMA TINDAKAN</th>
                <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="10%"><center>PERAWATAN</center></th>
                <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="8%"><center>HARI KE</center></th>
                <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="5%"><center>JML</center></th>
                <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="10%">KELAS 1</th>
                <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="10%">KELAS 2</th>
                <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="10%">KELAS 3</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer" style="padding-top: 15px; padding-right: 15px;">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class='fa fa-fw fa-lg fa-close'></i>Tutup</button>
      </div>
    </div>
    
  </div>
</div>

<!-- Modal Detail Biaya Tindakan-->
<div class="modal fade" id="modal_detail_biaya_tindakan" role="dialog">
  <div class="modal-dialog modal-lg">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Detail Biaya Tindakan CP Sampai Saat Ini</h4>
      </div>
      <div class="modal-body" style="margin-bottom: 30px;">
        <div class="table-responsive">
          <br>
          <!-- <input type="hidden" name="kode_cp_det_tind" id="kode_cp_det_tind"> -->
          <input type="hidden" name="nama_cp" id="nama_cp">
          <input type="hidden" name="kdkel" id="kdkel">
          <input type="hidden" name="dx" id="dx">
          <table class="table table-bordered" id="tabel_detail_tindakan_cp" name="tabel_detail_tindakan_cp" width="100%" cellspacing="0">
            <thead class="header-tabel">
              <tr>
                <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="5%"><center>NO.</center></th>
                <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="15%"><center>UPDATE TGL</center></th>
                <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="35%">NAMA TINDAKAN</th>
                <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="7%"><center>JUMLAH</center></th>
                <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="8%"><center>HARI KE</center></th>
                <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="10%"><center>BIAYA KLS 1</center></th>
                <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="10%"><center>BIAYA KLS 2</center></th>
                <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="10%"><center>BIAYA KLS 3</center></th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
      <div class="modal-footer" style="padding-top: 15px; padding-right: 15px;">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class='fa fa-fw fa-lg fa-close'></i>Tutup</button>
      </div>
    </div>
    
  </div>
</div>

<script type="text/javascript">
  
  $(document).ready(function() {

    tabel_detail_biaya();

    $('#btn_diagnosa').click(function() {
      tabel_detail_diagnosa();
    })

    $('#btn_tindakan').click(function() {
      tabel_detail_tindakan();
    })

    $('#btn_biaya_tind').click(function() {
      tabel_detail_biaya();
    })

    $('#download_excel').click(function() {
      window.location = "<?php echo base_url()?>assets/excel/format.xlsx";
    })

    $('#submit').click(function(){

      // alert('ok');
      // result;

      // event.preventDefault();

      jQuery.ajax({

        url:"<?php echo base_url()?>dashboard/import",
        type:"POST",
        data:new FormData(this),
        contentType:false,
        cache:false,
        processData:false,
        success:function(data){
          swal("BERHASIL!", "Data Berhasil Disimpan", "success");

          $('#file').val('');


        }

      })

    });

  })

</script>