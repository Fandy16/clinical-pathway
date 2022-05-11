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

</style>

<script type="text/javascript">
  
  function tabel_tambah_user(){
    $('#tabel_tambah_user').DataTable().destroy();
    $('#tabel_tambah_user').DataTable({
      "oLanguage": {
            "sEmptyTable": "Tidak ada data yang ditampilkan"
        },
        "bAutoWidth": false,
        "ordering": false,
        "info": false,
      "destroy": true,
      "processing" : true,
          "ajax": {
                "url": "<?php echo base_url() ?>tambah_user/tabelDaftarNamaUser",
                "type": "POST",
                "data": {
                  // nm_unit : $('#nm_unit').val(),
                  },
                  },
      "columns"       : [

              // {"data" : "kosong"},
              {"data" : "no"},
              {"data" : "NAMA"},
              {"data" : "USERNAME"},
              {"data" : "LEVEL"},
              {"data" : "STATUS"},
              {"data" : "RESET"},
              
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

  function simpan_nama_user_baru(){

    if ($("#namaUser").val() == '') {
      swal("BELUM LENGKAP!", "Kolom Nama Belum di isi!", "warning");
      $("#namaUser").focus();
      return;
    } else if ($("#username").val() == '') {
      swal("BELUM LENGKAP!", "Kolom Username Belum di isi!", "warning");
      $("#username").focus();
      return;
    } else if ($("#password").val() == '') {
      swal("BELUM LENGKAP!", "Kolom Password Belum di isi!", "warning");
      $("#password").focus();
      return;
    }
    
     jQuery.ajax({
           type: "POST",
           url: "<?php echo base_url() ?>tambah_user/simpanNamaUserAdminBaru", // the method we are calling pilihkelompok
           data:  {
                namaUser: $('#namaUser').val(),
                username: $('#username').val(),
                password: $('#password').val(),
              },
           dataType: 'text',
           success: function (data) {

            // alert("Upload Image Berhasil.");
            swal("BERHASIL!", "Data Berhasil Disimpan", "success");
            $('#modal_tambah_user').modal('hide');
            $('#namaUser').val('');
            $('#username').val('');
            // $('#password').val('');

            tabel_tambah_user();

           },
           error: function (xhr,status,error) {
               swal(xhr.responseText);
           }
      });
  }

  function resetPasswordUser(id_user, username){

     jQuery.ajax({
           type: "POST",
           url: "<?php echo base_url() ?>tambah_user/resetPasswordUser", // the method we are calling
           data:  {
                id_user: id_user,
                username: username,
              },
           dataType: 'text',
           success: function (data) {

            swal("BERHASIL!", "Password User Berhasil Diupdate", "success");
            

            tabel_tambah_user();

           },
           error: function (xhr,status,error) {
               swal(xhr.responseText);
           }
    });
  }

</script>

<div class="content-wrapper">
  <section class="content-header">
    <h1>
      Daftar User
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-user-plus"></i> Daftar User</a></li>
      <li class="active">Detail</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header">
            <h3 class="box-title">
              Daftar Pengguna Aplikasi
            </h3>
            <div class="pull-right box-tools">
              <button type="button" class="btn btn-info btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
                <i class="fa fa-times"></i></button>
            </div>
          </div>
          <div class="box-body pad">
            <div>
              <button class="btn btn-success" type="button" name="btn_tambah_user" id="btn_tambah_user" data-toggle="modal" data-target="#modal_tambah_user"><i class='fa fa-fw fa-lg fa-plus'></i> Tambah User</button>
              <br><br>
              <div>
                <span class="ket2" style="font-size: 13px; margin: 5px; padding-left: 10px;"> Password yang sudah di <b>RESET</b> akan kembali default <code><b>123456</b></code></span>
              </div>
            </div>
            <form>
              <div class="table-responsive">
                <br>
                <table class="table table-bordered" id="tabel_tambah_user" name="tabel_tambah_user" width="100%" cellspacing="0">
                  <thead class="header-tabel">
                    <tr>
                      <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="5%"><center>NO.</center></th>
                      <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="30%">NAMA</th>
                      <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="30%">USERNAME</th>
                      <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="10%"><center>LEVEL</center></th>
                      <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="10%"><center>STATUS</center></th>
                      <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="15%"><center>AKSI</center></th>
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

<!-- Modal Nambah User Admin-->
<div class="modal fade" id="modal_tambah_user" role="dialog">
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Tambah User</h4>
      </div>
      <div class="modal-body">
        <form id="" class="form-horizontal form-label-left col-xs-12">
          <div class="row">
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-12" for="namaAdmin">Nama <span class="required">*</span>
              </label>
              <div class="col-md-8 col-sm-8 col-xs-12">
                <input type="text" id="namaUser" name="namaUser" required="required" placeholder="Nama Pengguna" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-12" for="username">Username <span class="required">*</span>
              </label>
              <div class="col-md-8 col-sm-8 col-xs-12">
                <input type="text" id="username" name="username" required="required" placeholder="Ketikan Username" class="form-control col-md-7 col-xs-12">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-md-4 col-sm-4 col-xs-12" for="password">Password Default 123456 <span class="required">*</span>
              </label>
              <div class="col-md-8 col-sm-8 col-xs-12">
                <input type="text" id="password" name="password" required="required" placeholder="Password Default 123456" class="form-control col-md-7 col-xs-12" value="123456">
              </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="submit" id="simpan_user" class="btn btn-success btn-sm"><i class='fa fa-fw fa-lg fa-check'></i>Simpan</button>
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class='fa fa-fw fa-lg fa-close'></i>Batal</button>
      </div>
    </div>
    
  </div>
</div>

<script type="text/javascript">
  
  $(document).ready(function() {

    tabel_tambah_user();

    $('#modal_tambah_user').on('hidden.bs.modal', function () {
      
      $('#namaUser').val('');
      $('#username').val('');

    });

    $('#simpan_user').click(function(){
      simpan_nama_user_baru();
    })

  })

</script>