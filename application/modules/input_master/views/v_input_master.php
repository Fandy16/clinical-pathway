<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
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

  .modal-tambah-tindakan {
    width: 700px;
  }

</style>

<script type="text/javascript">
  
  function tabel_master_tindakan(){
    $('#tabel_master_tindakan').DataTable().destroy();
    $('#tabel_master_tindakan').DataTable({
      "oLanguage": {
            "sEmptyTable": "Tidak ada data yang ditampilkan"
        },
        "bAutoWidth": false,
        "ordering": false,
        "info": false,
      "destroy": true,
      "processing" : true,
          "ajax": {
                "url": "<?php echo base_url() ?>input_master/tabelDaftarMasterTindakan",
                "type": "POST",
                "data": {
                  // nm_unit : $('#nm_unit').val(),
                  },
                  },
      "columns"       : [

              // {"data" : "kosong"},
              {"data" : "no"},
              {"data" : "NAMAKEL"},
              {"data" : "NAMATIND"},
              {"data" : "DETAIL"},
              {"data" : "EDIT"},
              {"data" : "HAPUS"},
              
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

  function tabel_detail_master_tindakan(){
    $('#tabel_detail_master_tindakan').DataTable().destroy();
    $('#tabel_detail_master_tindakan').DataTable({
      "oLanguage": {
            "sEmptyTable": "Tidak ada data yang ditampilkan"
        },
        "bAutoWidth": false,
        "ordering": false,
        "info": false,
      "destroy": true,
      "processing" : true,
          "ajax": {
                "url": "<?php echo base_url() ?>input_master/tabelDaftarMasterTindakanDetail",
                "type": "POST",
                "data": {
                  id_tindakan : $('#idTindakan').val(),
                  kd_tindakan : $('#kdTindakan').val(),
                  },
                  },
      "columns"       : [

              // {"data" : "kosong"},
              {"data" : "no"},
              {"data" : "NAMATIND"},
              {"data" : "KELAS"},
              {"data" : "BIAYA"},
              
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

  function tabel_master_kelompok(){
    $('#tabel_master_kelompok').DataTable().destroy();
    $('#tabel_master_kelompok').DataTable({
      "oLanguage": {
            "sEmptyTable": "Tidak ada data yang ditampilkan"
        },
        "bAutoWidth": false,
        "ordering": false,
        "info": false,
      "destroy": true,
      "processing" : true,
          "ajax": {
                "url": "<?php echo base_url() ?>input_master/tabelDaftarMasterKelompok",
                "type": "POST",
                "data": {
                  // nm_unit : $('#nm_unit').val(),
                  },
                  },
      "columns"       : [

              // {"data" : "kosong"},
              {"data" : "no"},
              {"data" : "NAMAKEL"},
              {"data" : "TANGGAL"}, 
              {"data" : "EDIT"},
              {"data" : "HAPUS"},
              
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

  function pilihNamaKelompok() {

      jQuery.ajax({
          type: "POST",
          url: "<?php echo base_url() ?>input_master/pilih_nama_kelompok", 
          type: "POST",
          data:  {
              // namaDiag : $("#pilihDiagnosa").val(),
          },
          // dataType: 'json',
          success: function (data) {
            $('#nmKelompok').html(data);

          },
          error: function (xhr,status,error) {
            // swal({
            //   title: "Data tidak ditemukan!",
            //   text: "Silahkan cek nomor yang Anda input",
            //   icon: "error",
            // });
          }
      });

  }

  function detailHasilInputan(id_tindakan, kd_tindakan, nmKelompok) {

    $('#idTindakan').val(id_tindakan);
    $('#kdTindakan').val(kd_tindakan);
    $('#namaKelompok').val(nmKelompok);

    tabel_detail_master_tindakan();

    $('#modal_detail_master_tindakan').modal('show');
  }

  function simpan_input_master_tindakan(){

    if ($("#nmKelompok").val() == '') {
      swal("BELUM LENGKAP!", "Kolom Nama Kelompok Belum di isi!", "warning");
      $("#nmKelompok").focus();
      return;
    } else if ($("#namaTindakan").val() == '') {
      swal("BELUM LENGKAP!", "Kolom Tindakan Belum di isi!", "warning");
      $("#namaTindakan").focus();
      return;
    } else if ($("#biayaKelas1").val() == '' || $("#biayaKelas1").val() == '0') {
      swal("BELUM LENGKAP!", "Kolom Biaya Kelas I Belum di isi!", "warning");
      $("#biayaKelas1").focus();
      return;
    } else if ($("#biayaKelas2").val() == '' || $("#biayaKelas2").val() == '0') {
      swal("BELUM LENGKAP!", "Kolom Biaya Kelas II Belum di isi!", "warning");
      $("#biayaKelas2").focus();
      return;
    } else if ($("#biayaKelas3").val() == '' || $("#biayaKelas3").val() == '0') {
      swal("BELUM LENGKAP!", "Kolom Biaya Kelas III Belum di isi!", "warning");
      $("#biayaKelas3").focus();
      return;
    }
    
    jQuery.ajax({
       type: "POST",
       url: "<?php echo base_url() ?>input_master/simpanMasterTindakanBaru", // the method we are calling
       data:  {
            nmKelompok: $('#nmKelompok').val(),
            namaTindakan: $('#namaTindakan').val(),
          },
       dataType: 'text',
       success: function (data) {

        $('#kode_tind').val(data);

        $('#modal_tambah_master_tindakan').modal('hide');
        $('#namaTindakan').val('');

        pilihNamaKelompok();
        simpan_input_master_tindakanby();

       },
       error: function (xhr,status,error) {
           swal(xhr.responseText);
       }
    });

  }

  function simpan_input_master_tindakanby(){

     jQuery.ajax({
           type: "POST",
           url: "<?php echo base_url() ?>input_master/simpanMasterTindakanByBaru", // the method we are calling
           data:  {
                kode_tind: $('#kode_tind').val(),
                biayaKelas1: $('#biayaKelas1').val(),
                biayaKelas2: $('#biayaKelas2').val(),
                biayaKelas3: $('#biayaKelas3').val(),
              },
           dataType: 'text',
           success: function (data) {

            $('#biayaKelas1').val('');
            $('#biayaKelas2').val('');
            $('#biayaKelas3').val('');

            tabel_master_tindakan();

            swal("BERHASIL!", "Data Berhasil Disimpan", "success");

           },
           error: function (xhr,status,error) {
               swal(xhr.responseText);
           }
    });
  }

  function simpan_input_master_kelompok_baru(){

    if ($("#namaKelBaru").val() == '' || $("#namaKelBaru").val() == ' ' || $("#namaKelBaru").val() == '.' || $("#namaKelBaru").val() == '0' || $("#namaKelBaru").val() == '-') {
      swal("BELUM LENGKAP!", "Kolom Nama Kelompok Belum di isi!", "warning");
      $("#namaKelBaru").focus();
      return;
    } 

    jQuery.ajax({
           type: "POST",
           url: "<?php echo base_url() ?>input_master/simpanMasterKelompokBaru", // the method we are calling pilihkelompok
           data:  {
                namaKelBaru: $('#namaKelBaru').val(),
              },
           dataType: 'text',
           success: function (data) {

            swal("BERHASIL!", "Data Berhasil Disimpan", "success");

            $('#modal_tambah_master_kelompok_baru').modal('hide');
            $('#namaKelBaru').val('');
            tabel_master_kelompok();

           },
           error: function (xhr,status,error) {
               swal(xhr.responseText);
           }
      });
    
  }

  function editMasterKelompok(kdKelBaru, nmKelBaru){

    $('#kd_kel_edit').val(kdKelBaru);
    $('#namaKelEdit').val(nmKelBaru);

    $('#modal_ubah_master_kelompok_baru').modal('show');

  }

  function simpan_update_master_kelompokedit(){

    if ($("#namaKelEdit").val() == '' || $("#namaKelEdit").val() == ' ' || $("#namaKelEdit").val() == '.' || $("#namaKelEdit").val() == '0' || $("#namaKelEdit").val() == '-') {
      swal("BELUM LENGKAP!", "Kolom Nama Kelompok Belum di isi!", "warning");
      $("#namaKelEdit").focus();
      return;
    } 

    jQuery.ajax({
           type: "POST",
           url: "<?php echo base_url() ?>input_master/updateMasterKelompokedit", // the method we are calling pilihkelompok
           data:  {
                kd_kelompok_edit: $('#kd_kel_edit').val(),
                nmKelompokEdit: $('#namaKelEdit').val(),
              },
           dataType: 'text',
           success: function (data) {

            swal("BERHASIL!", "Data Berhasil Diubah", "success");

            tabel_master_kelompok();

            $('#modal_ubah_master_kelompok_baru').modal("hide");

           },
           error: function (xhr,status,error) {
               swal(xhr.responseText);
           }
      });
     
  }


  function editHasilInputan(idTindakan, kdTindakan, nmTindakan, kdKelompok, nmKelompok) {

    $('#id_tindakan_edit').val(idTindakan);
    $('#kd_tindakan_edit').val(kdTindakan);
    $('#kd_kelompok_edit').val(kdKelompok);
    $('#namaTindakanEdit').val(nmTindakan);
    $('#nmKelompokEdit').val(nmKelompok);

    jQuery.ajax({
           type: "POST",
           url: "<?php echo base_url() ?>input_master/lihatBiayaKelas1Edit", // the method we are calling
           data:  {
                idTindakan: idTindakan,
                kdTindakan: kdTindakan,
              },
           dataType: 'text',
           success: function (data) {

            $('#biayaKelasEdit1').val(data);

           },
           error: function (xhr,status,error) {
               swal(xhr.responseText);
           }
    });

    jQuery.ajax({
           type: "POST",
           url: "<?php echo base_url() ?>input_master/lihatBiayaKelas2Edit", // the method we are calling
           data:  {
                idTindakan: idTindakan,
                kdTindakan: kdTindakan,
              },
           dataType: 'text',
           success: function (data) {

            $('#biayaKelasEdit2').val(data);

           },
           error: function (xhr,status,error) {
               swal(xhr.responseText);
           }
    });

    jQuery.ajax({
           type: "POST",
           url: "<?php echo base_url() ?>input_master/lihatBiayaKelas3Edit", // the method we are calling
           data:  {
                idTindakan: idTindakan,
                kdTindakan: kdTindakan,
              },
           dataType: 'text',
           success: function (data) {

            $('#biayaKelasEdit3').val(data);

           },
           error: function (xhr,status,error) {
               swal(xhr.responseText);
           }
    });

    jQuery.ajax({
           type: "POST",
           url: "<?php echo base_url() ?>input_master/lihatIdTindakanByKelas1Edit", // the method we are calling
           data:  {
                idTindakan: idTindakan,
                kdTindakan: kdTindakan,
              },
           dataType: 'text',
           success: function (data) {

            $('#id_tindBy_edit1').val(data);

           },
           error: function (xhr,status,error) {
               swal(xhr.responseText);
           }
    });

    jQuery.ajax({
           type: "POST",
           url: "<?php echo base_url() ?>input_master/lihatIdTindakanByKelas2Edit", // the method we are calling
           data:  {
                idTindakan: idTindakan,
                kdTindakan: kdTindakan,
              },
           dataType: 'text',
           success: function (data) {

            $('#id_tindBy_edit2').val(data);

           },
           error: function (xhr,status,error) {
               swal(xhr.responseText);
           }
    });

    jQuery.ajax({
           type: "POST",
           url: "<?php echo base_url() ?>input_master/lihatIdTindakanByKelas3Edit", // the method we are calling
           data:  {
                idTindakan: idTindakan,
                kdTindakan: kdTindakan,
              },
           dataType: 'text',
           success: function (data) {

            $('#id_tindBy_edit3').val(data);

           },
           error: function (xhr,status,error) {
               swal(xhr.responseText);
           }
    });

    $('#modal_edit_master_tindakan').modal('show');

  }

  function simpan_update_master_tindakan(){

    if ($("#nmKelompokEdit").val() == '') {
      swal("BELUM LENGKAP!", "Kolom Nama Kelompok Belum di isi!", "warning");
      $("#nmKelompokEdit").focus();
      return;
    } else if ($("#namaTindakanEdit").val() == '') {
      swal("BELUM LENGKAP!", "Kolom Tindakan Belum di isi!", "warning");
      $("#namaTindakanEdit").focus();
      return;
    } else if ($("#biayaKelasEdit1").val() == '' || $("#biayaKelasEdit1").val() == '0') {
      swal("BELUM LENGKAP!", "Kolom Biaya Kelas I Belum di isi!", "warning");
      $("#biayaKelasEdit1").focus();
      return;
    } else if ($("#biayaKelasEdit2").val() == '' || $("#biayaKelasEdit2").val() == '0') {
      swal("BELUM LENGKAP!", "Kolom Biaya Kelas II Belum di isi!", "warning");
      $("#biayaKelasEdit2").focus();
      return;
    } else if ($("#biayaKelasEdit3").val() == '' || $("#biayaKelasEdit3").val() == '0') {
      swal("BELUM LENGKAP!", "Kolom Biaya Kelas III Belum di isi!", "warning");
      $("#biayaKelasEdit3").focus();
      return;
    }

    jQuery.ajax({
           type: "POST",
           url: "<?php echo base_url() ?>input_master/updateMasterTindakanEdit", // the method we are calling
           data:  {
                id_tindakan_edit: $('#id_tindakan_edit').val(),
                kd_kelompok_edit: $('#kd_kelompok_edit').val(),
                kd_tindakan_edit: $('#kd_tindakan_edit').val(),
                namaTindakanEdit: $('#namaTindakanEdit').val(),
              },
           dataType: 'text',
           success: function (data) {

            simpan_update_master_tindakanby();

            $('#modal_edit_master_tindakan').modal('hide');

           },
           error: function (xhr,status,error) {
               swal(xhr.responseText);
           }
    });
    
     
  }

  function simpan_update_master_tindakanby(){

     jQuery.ajax({
           type: "POST",
           url: "<?php echo base_url() ?>input_master/updateMasterTindakanByEdit", // the method we are calling
           data:  {
                kd_tindakan_edit: $('#kd_tindakan_edit').val(),
                id_tindBy_edit1: $('#id_tindBy_edit1').val(),
                id_tindBy_edit2: $('#id_tindBy_edit2').val(),
                id_tindBy_edit3: $('#id_tindBy_edit3').val(),
                biayaKelasEdit1: $('#biayaKelasEdit1').val(),
                biayaKelasEdit2: $('#biayaKelasEdit2').val(),
                biayaKelasEdit3: $('#biayaKelasEdit3').val(),
              },
           dataType: 'text',
           success: function (data) {

            tabel_master_tindakan();

            swal("BERHASIL!", "Data Berhasil Diubah", "success");

           },
           error: function (xhr,status,error) {
               swal(xhr.responseText);
           }
    });
  }

  function hapusHasilInputan(idtind, kdtind, kdkel){

    jQuery.ajax({
           type: "POST",
           url: "<?php echo base_url() ?>input_master/lihatIdTindakanByKelas1Edit", // the method we are calling
           data:  {
                idTindakan: idtind,
                kdTindakan: kdtind,
              },
           dataType: 'text',
           success: function (data) {

            $('#id_tindBy_edit1').val(data);

           },
           error: function (xhr,status,error) {
               swal(xhr.responseText);
           }
    });

    jQuery.ajax({
           type: "POST",
           url: "<?php echo base_url() ?>input_master/lihatIdTindakanByKelas2Edit", // the method we are calling
           data:  {
                idTindakan: idtind,
                kdTindakan: kdtind,
              },
           dataType: 'text',
           success: function (data) {

            $('#id_tindBy_edit2').val(data);

           },
           error: function (xhr,status,error) {
               swal(xhr.responseText);
           }
    });

    jQuery.ajax({
           type: "POST",
           url: "<?php echo base_url() ?>input_master/lihatIdTindakanByKelas3Edit", // the method we are calling
           data:  {
                idTindakan: idtind,
                kdTindakan: kdtind,
              },
           dataType: 'text',
           success: function (data) {

            $('#id_tindBy_edit3').val(data);

           },
           error: function (xhr,status,error) {
               swal(xhr.responseText);
           }
    });

    // FUNCTION UNTUK HAPUS DATA
    swal({
      title: "PERINGATAN !!",
      text: "Yakin, item ini akan dihapus!",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Ya, hapus data!",
      cancelButtonText: "Tidak",
      cancelButtonColor: '#3085d6',
      closeOnConfirm: false,
      closeOnCancel: false
    },
    function(isConfirm) {
      if (isConfirm) {
        $.ajax({
            type: "POST",
            url: "input_master/hapusMasterTindakan", // the method we are calling
            data:  {
              
              idtind:idtind,
              kdtind: kdtind,
              kdkel: kdkel,
              id_tindBy_edit1: $('#id_tindBy_edit1').val(),
              id_tindBy_edit2: $('#id_tindBy_edit2').val(),
              id_tindBy_edit3: $('#id_tindBy_edit3').val(),
            },
           success: function(data) {
                swal("Berhasil!", "Data berhasil dihapus.", "success");
                tabel_master_tindakan();
           },
           error: function() {
              alert('Something is wrong');
           }
        });
      } else {
        swal("Batal!", "Data yang dipilih kembali disimpan", "error");
      }
    });

  }

  function hapusMasterKelompokBaru(kdKel) {

    // FUNCTION UNTUK HAPUS DATA
    swal({
      title: "PERINGATAN !!",
      text: "Yakin, item ini akan dihapus!",
      type: "warning",
      showCancelButton: true,
      confirmButtonClass: "btn-danger",
      confirmButtonText: "Ya, hapus data!",
      cancelButtonText: "Tidak",
      cancelButtonColor: '#3085d6',
      closeOnConfirm: false,
      closeOnCancel: false
    },
    function(isConfirm) {
      if (isConfirm) {
        $.ajax({
            type: "POST",
            url: "input_master/hapusMasterKelompok", // the method we are calling
            data:  {
              
              kdkel: kdKel,
            },
           success: function(data) {
                swal("Berhasil!", "Data berhasil dihapus.", "success");
                tabel_master_kelompok();
           },
           error: function() {
              alert('Something is wrong');
           }
        });
      } else {
        swal("Batal!", "Data yang dipilih kembali disimpan", "error");
      }
    });

  }

</script>

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Data Master
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-ambulance"></i> Daftar Master</a></li>
      <li class="active">Detail</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-orange">
          <div class="box-header">
            <h3 class="box-title">
              Daftar Master Tindakan CP
            </h3>
            <div class="pull-right box-tools">
              <button type="button" class="btn bg-orange btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fa fa-minus"></i></button>
              <button type="button" class="btn bg-orange btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body pad">
            <div>
              <input type="hidden" name="kode_tind" id="kode_tind">
              <button class="btn bg-olive" type="button" name="btn_tambah" id="btn_tambah" data-toggle="modal" data-target="#modal_tambah_master_tindakan"><i class='fa fa-fw fa-lg fa-plus'></i> Tambah</button>
              <br><br>
            </div>
            <form>
              <div class="table-responsive">
                <br>
                <table class="table table-bordered" id="tabel_master_tindakan" name="tabel_master_tindakan" width="100%" cellspacing="0">
                  <thead class="header-tabel">
                    <tr>
                      <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="5%"><center>NO.</center></th>
                      <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="35%">NAMA KELOMPOK</th>
                      <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="35%">NAMA TINDAKAN</th>
                      <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" colspan="3" width="25%"><center>AKSI</center></th>
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

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-maroon">
          <div class="box-header">
            <h3 class="box-title">
              Daftar Master Kelompok CP
            </h3>
            <div class="pull-right box-tools">
              <button type="button" class="btn bg-maroon btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fa fa-minus"></i></button>
              <button type="button" class="btn bg-maroon btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body pad">
            <div>
              <input type="hidden" name="kode_tind" id="kode_tind">
              <button class="btn bg-olive" type="button" name="btn_tambah_kel" id="btn_tambah_kel" data-toggle="modal" data-target="#modal_tambah_master_kelompok_baru"><i class='fa fa-fw fa-lg fa-plus'></i> Tambah</button>
              <br><br>
            </div>
            <form>
              <div class="table-responsive">
                <br>
                <table class="table table-bordered" id="tabel_master_kelompok" name="tabel_master_kelompok" width="100%" cellspacing="0">
                  <thead class="header-tabel">
                    <tr>
                      <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="5%"><center>NO.</center></th>
                      <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="45%">NAMA KELOMPOK</th>
                      <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="30%"><center>UPDATE TANGGAL</center></th>
                      <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" colspan="2" width="20%"><center>AKSI</center></th>
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

<!-- Modal Detail Master Input-->
<div class="modal fade" id="modal_detail_master_tindakan" role="dialog">
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Detail Master Input</h4>
      </div>
      <div class="modal-body" style="margin-bottom: 30px;">
        <br><br>
        <input type="hidden" name="idTindakan" id="idTindakan">
        <input type="hidden" name="kdTindakan" id="kdTindakan">
        <div class="form-group">
          <label class="control-label2 col-md-3 col-sm-3 col-xs-12" for="namaAdmin">Nama Kelompok </label>
          <div class="col-md-6 col-sm-6 col-xs-12">
            <input type="text" id="namaKelompok" name="namaKelompok" style="font-size: 16px; font-weight: bold;" readonly="" disabled="true" placeholder="Nama Pengguna" class="form-control">
          </div>
        </div>
        <br><br>
        <div class="table-responsive">
          <br>
          <table class="table table-bordered" id="tabel_detail_master_tindakan" name="tabel_detail_master_tindakan" width="100%" cellspacing="0">
            <thead class="header-tabel">
              <tr>
                <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="5%"><center>NO.</center></th>
                <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="72%">NAMA TINDAKAN</th>
                <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="8%"><center>KELAS</center></th>
                <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="10%"><center>DETAIL BIAYA</center></th>
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

<!-- Modal Nambah Master Input-->
<div class="modal fade" id="modal_tambah_master_tindakan" role="dialog">
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah Master Tindakan</h4>
      </div>
      <div class="modal-body" style="margin-bottom: 30px;">
        <div class="row"><br>
          <div class="form-group" style="margin-bottom: 20px;">
            <label class="control-label2 col-md-3 col-sm-3 col-xs-12" for="namaKelompok">KELOMPOK <span class="required">*</span>
            </label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <select id="nmKelompok" name="nmKelompok" required="required" placeholder="Ketikan Nama Kelompok" class="form-control col-md-7 col-xs-12" style="width: 100%"></select>
            </div>
          </div><br>
          <div class="form-group" style="margin-bottom: 20px;">
            <label class="control-label2 col-md-3 col-sm-3 col-xs-12" for="namaTindakan">TINDAKAN <span class="required">*</span>
            </label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input type="text" id="namaTindakan" name="namaTindakan" required="required" placeholder="Ketikan Jenis Tindakan" class="form-control col-md-7 col-xs-12">
            </div>
          </div><br>
          <div class="form-group" style="margin-bottom: 20px;">
            <label class="control-label2 col-md-3 col-sm-3 col-xs-12" for="biaya">BIAYA</label>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <div class="form-group">
                <label class="control-label2" for="biaya1">Kelas I<span class="required">*</span></label>
                <div class="form-group">
                  <input type="number" min="0" style="text-align: center;" id="biayaKelas1" name="biayaKelas1" required="required" placeholder="0,0-" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <div class="form-group">
                <label class="control-label2" for="biaya2">Kelas II<span class="required">*</span></label>
                <div class="form-group">
                  <input type="number" min="0" style="text-align: center;" id="biayaKelas2" name="biayaKelas2" required="required" placeholder="0,0-" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <div class="form-group">
                <label class="control-label2" for="biaya3">Kelas III<span class="required">*</span></label>
                <div class="form-group">
                  <input type="number" min="0" style="text-align: center;" id="biayaKelas3" name="biayaKelas3" required="required" placeholder="0,0-" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" id="simpan_input_tindakan" class="btn btn-success btn-sm"><i class='fa fa-fw fa-lg fa-check'></i>Simpan</button>
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class='fa fa-fw fa-lg fa-close'></i>Batal</button>
      </div>
    </div>
    
  </div>
</div>

<!-- Modal Nambah Master Input-->
<div class="modal fade" id="modal_edit_master_tindakan" role="dialog">
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Form Ubah Master Tindakan</h4>
      </div>
      <div class="modal-body" style="margin-bottom: 30px;">
        <div class="row"><br>
          <input type="hidden" name="id_tindakan_edit" id="id_tindakan_edit">
          <input type="hidden" name="kd_tindakan_edit" id="kd_tindakan_edit">
          <input type="hidden" name="kd_kelompok_edit" id="kd_kelompok_edit">
          <input type="hidden" name="id_tindBy_edit1" id="id_tindBy_edit1">
          <input type="hidden" name="id_tindBy_edit2" id="id_tindBy_edit2">
          <input type="hidden" name="id_tindBy_edit3" id="id_tindBy_edit3">
          <div class="form-group" style="margin-bottom: 20px;">
            <label class="control-label2 col-md-3 col-sm-3 col-xs-12" for="namaKelompok">KELOMPOK <span class="required">*</span>
            </label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input type="text" id="nmKelompokEdit" name="nmKelompokEdit" readonly="" disabled="" style="font-weight: bold; font-size: 16px;" placeholder="Ketikan Nama Kelompok" class="form-control col-md-7 col-xs-12">
            </div>
          </div><br>
          <div class="form-group" style="margin-bottom: 20px;">
            <label class="control-label2 col-md-3 col-sm-3 col-xs-12" for="namaTindakan">TINDAKAN <span class="required">*</span>
            </label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input type="text" id="namaTindakanEdit" name="namaTindakanEdit" required="required" placeholder="Ketikan Jenis Tindakan" class="form-control col-md-7 col-xs-12">
            </div>
          </div><br>
          <div class="form-group" style="margin-bottom: 20px;">
            <label class="control-label2 col-md-3 col-sm-3 col-xs-12" for="biaya">BIAYA</label>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <div class="form-group">
                <label class="control-label2" for="biaya1">Kelas I<span class="required">*</span></label>
                <div class="form-group">
                  <input type="number" min="0" style="text-align: center;" id="biayaKelasEdit1" name="biayaKelasEdit1" required="required" placeholder="0,0-" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <div class="form-group">
                <label class="control-label2" for="biaya2">Kelas II<span class="required">*</span></label>
                <div class="form-group">
                  <input type="number" min="0" style="text-align: center;" id="biayaKelasEdit2" name="biayaKelasEdit2" required="required" placeholder="0,0-" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-12">
              <div class="form-group">
                <label class="control-label2" for="biaya3">Kelas III<span class="required">*</span></label>
                <div class="form-group">
                  <input type="number" min="0" style="text-align: center;" id="biayaKelasEdit3" name="biayaKelasEdit3" required="required" placeholder="0,0-" class="form-control col-md-7 col-xs-12">
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" id="simpan_edit_tindakan" class="btn btn-info btn-sm"><i class='fa fa-fw fa-lg fa-check'></i>Update</button>
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class='fa fa-fw fa-lg fa-close'></i>Batal</button>
      </div>
    </div>
    
  </div>
</div>

<!-- Modal Nambah Master Input-->
<div class="modal fade" id="modal_tambah_master_kelompok_baru" role="dialog">
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Form Tambah Master Kelompok</h4>
      </div>
      <div class="modal-body" style="margin-bottom: 30px;">
        <div class="row"><br>
          <div class="form-group" style="margin-bottom: 20px;">
            <label class="control-label2 col-md-3 col-sm-3 col-xs-12" for="namaKelompok">KELOMPOK <span class="required">*</span>
            </label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input type="text" id="namaKelBaru" name="namaKelBaru" required="required" placeholder="Ketikan Nama Kelompok" class="form-control col-md-7 col-xs-12">
            </div>
          </div><br>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" id="simpan_kelompok_baru" class="btn btn-success btn-sm"><i class='fa fa-fw fa-lg fa-check'></i>Simpan</button>
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class='fa fa-fw fa-lg fa-close'></i>Batal</button>
      </div>
    </div>
    
  </div>
</div>

<!-- Modal Ubah Master Input-->
<div class="modal fade" id="modal_ubah_master_kelompok_baru" role="dialog">
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Form Ubah Master Kelompok</h4>
      </div>
      <div class="modal-body" style="margin-bottom: 30px;">
        <div class="row"><br>
          <input type="hidden" name="kd_kel_edit" id="kd_kel_edit">
          <div class="form-group" style="margin-bottom: 20px;">
            <label class="control-label2 col-md-3 col-sm-3 col-xs-12" for="namaKelompok">KELOMPOK <span class="required">*</span>
            </label>
            <div class="col-md-9 col-sm-9 col-xs-12">
              <input type="text" id="namaKelEdit" name="namaKelEdit" required="required" placeholder="Ketikan Nama Kelompok" class="form-control col-md-7 col-xs-12">
            </div>
          </div><br>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" id="simpan_update_baru" class="btn btn-info btn-sm"><i class='fa fa-fw fa-lg fa-check'></i>Update</button>
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class='fa fa-fw fa-lg fa-close'></i>Batal</button>
      </div>
    </div>
    
  </div>
</div>

<script type="text/javascript">
  
  $(document).ready(function() {

    tabel_master_tindakan();

    tabel_master_kelompok()

    pilihNamaKelompok();

    $('#modal_tambah_master_tindakan').on('hidden.bs.modal', function () {
      
      pilihNamaKelompok();

    });

    $('#nmKelompok').select2({})

    $('#simpan_input_tindakan').click(function(){
      simpan_input_master_tindakan();
    })

    $('#simpan_edit_tindakan').click(function() {
      simpan_update_master_tindakan();
    })

    $('#simpan_kelompok_baru').click(function() {
      simpan_input_master_kelompok_baru();
    })

    $('#simpan_update_baru').click(function() {
      simpan_update_master_kelompokedit();
    })

  })

</script>