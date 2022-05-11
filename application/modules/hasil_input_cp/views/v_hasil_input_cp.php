<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<script src="<?php echo base_url(); ?>assets/dist/js/jquery.min.js"></script>


<style type="text/css">
  
  .ket2 {
    color:#fff;
    background-color: #00c0ef;
    border-radius: 30px;
    font-size: 13px;
    margin-right: 5px;
    width: 15%;
    margin-bottom: 4px;
    padding: 3px;
    padding-left: 15px;
    padding-right: 10px;
  }

  .modal-footer {
    padding: 15px;
    margin-right: 15px;
    text-align: right;
    border-top: 1px solid #e5e5e5;
  }

</style>

<script type="text/javascript">

  function lihatDetailTindakan(nmcp, kdkel, dx) {

    $('#nama_cp').val(nmcp);
    $('#kdkel').val(kdkel);
    $('#dx').val(dx);
    $('#modal_detail_input_cp').modal('show');

    tabel_detail_input_cp();

  }
  
  function tabel_hasil_input_cp(){
    $('#tabel_hasil_input_cp').DataTable().destroy();
    $('#tabel_hasil_input_cp').DataTable({
      "oLanguage": {
            "sEmptyTable": "Tidak ada data yang ditampilkan"
        },
        "bAutoWidth": false,
        "ordering": false,
        "info": false,
      "destroy": true,
      "processing" : true,
          "ajax": {
                "url": "<?php echo base_url() ?>hasil_input_cp/tabelDaftarInputCP",
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

  function tabel_detail_input_cp(){
    $('#tabel_detail_input_cp').DataTable().destroy();
    $('#tabel_detail_input_cp').DataTable({
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
    });

  }

</script>

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Informasi
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-hospital-o"></i> Informasi Tidakan</a></li>
      <li class="active">Detail</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-purple">
          <div class="box-header">
            <h3 class="box-title">
              Daftar Tindakan CP
            </h3>
            <div class="pull-right box-tools">
              <button type="button" class="btn bg-purple btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fa fa-minus"></i></button>
              <button type="button" class="btn bg-purple btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body pad">
            <form class="form-horizontal form-label-left col-xs-12">
              <div class="table-responsive">
                <br><br>
                <table class="table table-bordered" id="tabel_hasil_input_cp" name="tabel_hasil_input_cp" width="100%" cellspacing="0">
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
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>

<!-- Modal Detai. Input CP-->
<div class="modal fade" id="modal_detail_input_cp" role="dialog">
  <div class="modal-dialog modal-lg">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Detail Hasil Input CP</h4>
      </div>
      <div class="modal-body" style="margin-bottom: 30px;">
        <div class="table-responsive">
          <br>
          <input type="hidden" name="nama_cp" id="nama_cp">
          <input type="hidden" name="kdkel" id="kdkel">
          <input type="hidden" name="dx" id="dx">
          <table class="table table-bordered" id="tabel_detail_input_cp" name="tabel_detail_input_cp" width="100%" cellspacing="0">
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

    tabel_hasil_input_cp();

    $('#modal_tambah_user').on('hidden.bs.modal', function () {
      
      $('#namaUser').val('');
      $('#username').val('');

    });

  })

</script>