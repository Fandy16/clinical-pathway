<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!-- <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
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

<?php

  function getClientIP() {

      if (isset($_SERVER)) {

          if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
              return $_SERVER["HTTP_X_FORWARDED_FOR"];

          if (isset($_SERVER["HTTP_CLIENT_IP"]))
              return $_SERVER["HTTP_CLIENT_IP"];

          return $_SERVER["REMOTE_ADDR"];
      }

      if (getenv('HTTP_X_FORWARDED_FOR'))
          return getenv('HTTP_X_FORWARDED_FOR');

      if (getenv('HTTP_CLIENT_IP'))
          return getenv('HTTP_CLIENT_IP');

      return getenv('REMOTE_ADDR');
  }

?>

<script type="text/javascript">

  function editDetailTindNamaCP(nmcp, kdkel, nmkelompok, dx, nmdx) {

    $('#nama_cp').val(nmcp);
    $('#kdkel').val(kdkel);
    $('#dx').val(dx);
    $('#nama_cp_edit').val(nmcp);
    $('#kdkel_edit').val(nmkelompok);
    $('#nm_dx_edit').val(dx+ ' - '+nmdx);
    $('#modal_edit_nama_cp_input_cp').modal('show');

    tabel_detail_input_cp();

  }

  function editSubDetailTindakan(noid, kdcp, kdKel, kdtind, hari, hari_ke, jml, biaya_kelas1, biaya_kelas2, biaya_kelas3) {

    $('#noid').val(noid);
    $('#kdcp').val(kdcp);
    $('#kdkel_tind_edit').val(kdkel);
    $('#nm_tind_edit').val(kdtind);
    $('#jml_tnd_edit').val(jml);
    $('#hari_ke_edit').val(hari_ke);
    $('#kelas1_edit').val('Rp. '+biaya_kelas1);
    $('#kelas2_edit').val('Rp. '+biaya_kelas2);
    $('#kelas3_edit').val('Rp. '+biaya_kelas3);
    // $('#nm_dx_edit').val(dx+ ' - '+nmdx);
    $('#modal_edit_detail_tind_input_cp').modal('show');

  }

  function editHasilInputan(noIdInput, tglInput, level, kdKel, kdTind, hari, hari_ke, jumlah) {

    $('#idInputEdit').val(noIdInput);
    $('#tglEdit').val(tglInput);
    $('#levelEdit').val(level);
    $('#pilihKelompokEdit').val(kdKel);
    $('#pilihTindakanEdit').val(kdTind);
    $('#jmlHariEdit').val(hari_ke);
    $('#jmlTindakanEdit').val(jumlah);

    $('#modal_ubah_input_cp').modal('show');

    // pilihNamaTindakanEDit();

  }

  function tabel_tambah_cp(){
    $('#tabel_tambah_cp').DataTable().destroy();
    $('#tabel_tambah_cp').DataTable({
      "oLanguage": {
            "sEmptyTable": "Tidak ada data yang ditampilkan"
        },
      "paging": false,
      "bLengthChange": false,
      "bAutoWidth": false,
      "filter": false,
      "ordering": false,
      "searching": false,
      "info": false,
      "destroy": true,
      "processing" : true,
          "ajax": {
                "url": "<?php echo base_url() ?>input_cp/tabelDaftarDiagnosa",
                "type": "POST",
                "data": {
                  keyword : $('#ambilDiagnosa').val(),
                  },
                  },
      "columns"       : [

              // {"data" : "kosong"},
              {"data" : "no"},
              {"data" : "KODE"},
              {"data" : "NAMADIAG"},
              {"data" : "AKSI"},
              
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

  function pilihNamaTindakanEDit() {

      jQuery.ajax({
          type: "POST",
          url: "<?php echo base_url() ?>input_cp/pilih_nama_tindakan", 
          type: "POST",
          data:  {
              pilihKelompok : $("#pilihKelompokEdit").val(),
          },
          // dataType: 'json',
          success: function (data) {
            $('#pilihTindakanEdit').html(data);

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

  function total_biaya_tindakan_kelas1() {

    jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url() ?>input_cp/totalBiayaTindakanCPKelas1", 
        type: "POST",
        data:  {
            ip_komputer : $('#ip_komputer').val(),
        },
        // dataType: 'json',
        success: function (data) {
          // console.log(data);
          $('#biaya_kelas1').val(data);

          
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

  function total_biaya_tindakan_kelas2() {

    jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url() ?>input_cp/totalBiayaTindakanCPKelas2", 
        type: "POST",
        data:  {
            ip_komputer : $('#ip_komputer').val(),
        },
        // dataType: 'json',
        success: function (data) {
          // console.log(data);
          $('#biaya_kelas2').val(data);

          
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

  function total_biaya_tindakan_kelas3() {

    jQuery.ajax({
        type: "POST",
        url: "<?php echo base_url() ?>input_cp/totalBiayaTindakanCPKelas3", 
        type: "POST",
        data:  {
            ip_komputer : $('#ip_komputer').val(),
        },
        // dataType: 'json',
        success: function (data) {
          // console.log(data);
          $('#biaya_kelas3').val(data);

          
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



  function pilihNamaDiag() {

      jQuery.ajax({
          type: "POST",
          url: "<?php echo base_url() ?>input_cp/pilih_nama_diagnosa", 
          type: "POST",
          data:  {
              // pilihunit : $("#pilihunit").val(),
          },
          // dataType: 'json',
          success: function (data) {
            $('#pilihDiagnosa').html(data);

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

  function pilihNamaKelompok() {

      jQuery.ajax({
          type: "POST",
          url: "<?php echo base_url() ?>input_cp/pilih_nama_kelompok", 
          type: "POST",
          data:  {
              // namaDiag : $("#pilihDiagnosa").val(),
          },
          // dataType: 'json',
          success: function (data) {
            $('#pilihKelompok').html(data);

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

  function pilihNamaTindakan() {

      jQuery.ajax({
          type: "POST",
          url: "<?php echo base_url() ?>input_cp/pilih_nama_tindakan", 
          type: "POST",
          data:  {
              pilihKelompok : $("#pilihKelompok").val(),
          },
          // dataType: 'json',
          success: function (data) {
            $('#pilihTindakan').html(data);

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

  function ambilDataBiaya() {

      jQuery.ajax({
          type: "POST",
          url: "<?php echo base_url() ?>input_cp/ambil_biaya_tindakan", 
          type: "POST",
          data:  {
              pilihTindakan : $('#pilihTindakan').val(),
              kelasPerawatan : $('#kelasPerawatan').val(),
          },
          // dataType: 'json',
          success: function (data) {
            $('#biayaTindakan').val(data);

            
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

    function ambilDataBiayaEdit() {

      jQuery.ajax({
          type: "POST",
          url: "<?php echo base_url() ?>input_cp/ambil_biaya_tindakan", 
          type: "POST",
          data:  {
              pilihTindakan : $('#pilihTindakanEdit').val(),
              kelasPerawatan : $('#kdKelasEdit').val(),
          },
          // dataType: 'json',
          success: function (data) {
            $('#biayaTindakanEdit').val(data);

            
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

    function simpan_input_tindakan_cp(){

      if ($("#namaCP").val() == '') {
        swal("BELUM LENGKAP!", "Kolom Nama CP Belum di isi!", "warning");
        $("#namaCP").focus();
        return;
      } else if ($("#pilihDiagnosa").val() == '') {
        swal("BELUM LENGKAP!", "Kolom Diagnosa Belum di isi!", "warning");
        $("#pilihDiagnosa").focus();
        return;
      } else if ($("#lamaPerawatan").val() == '' || $("#lamaPerawatan").val() == '0') {
        swal("BELUM LENGKAP!", "Kolom Lama Perawatan Belum di isi!", "warning");
        $("#lamaPerawatan").focus();
        return;
      } else if ($("#pilihKelompok").val() == '') {
        swal("BELUM LENGKAP!", "Kolom Kelompok Belum di pilih!", "warning");
        $("#pilihKelompok").focus();
        return;
      } else if ($("#pilihTindakan").val() == '') {
        swal("BELUM LENGKAP!", "Kolom Tindakan Belum di pilih!", "warning");
        $("#pilihTindakan").focus();
        return;
      } else if ($("#jml_hari").val() == '' || $("#jml_hari").val() == '0') {
        swal("BELUM LENGKAP!", "Kolom Hari Belum di isi!", "warning");
        $("#jml_hari").focus();
        return;
      } else if ($("#jml_hari").val() > $("#lamaPerawatan").val()) {
        swal("BELUM LENGKAP!", "Jumlah Hari Tidak Boleh Lebih Besar Dari Lama Perawatan!", "warning");
        $("#jml_hari").focus();
        return;
      } else if ($("#jml_tindakan").val() == '' || $("#jml_tindakan").val() == '0') {
        swal("BELUM LENGKAP!", "Kolom Jumlah Belum di isi!", "warning");
        $("#jml_tindakan").focus();
        return;
      }
      
       jQuery.ajax({
             type: "POST",
             url: "<?php echo base_url() ?>input_cp/simpanInputTindakanCP", // the method we are calling pilihkelompok
             data:  {
                  namaCP        : $('#namaCP').val(),
                  pilihDiagnosa : $('#pilihDiagnosa').val(),
                  lamaPerawatan : $('#lamaPerawatan').val(),
                  pilihKelompok : $('#pilihKelompok').val(),
                  pilihTindakan : $('#pilihTindakan').val(),
                  jml_hari      : $('#jml_hari').val(),
                  jml_tindakan  : $('#jml_tindakan').val(),
                  ip_komputer   : $('#ip_komputer').val(),
                },
             dataType: 'text',
             success: function (data) {

              // alert("Upload Image Berhasil.");
              // swal("BERHASIL!", "Data Berhasil Disimpan", "success");

              var diag = $('#pilihDiagnosa').val();

              $('#namaCPHidden').val($('#namaCP').val());
              $('#pilihDiagnosaHidden').val(diag);
              $('#lamaPerawatanHidden').val($('#lamaPerawatan').val());

              $('#input_tindakan').hide();
              $('#hidden_tindakan').show();

              tabel_tambah_cp();
              total_biaya_tindakan_kelas1();
              total_biaya_tindakan_kelas2();
              total_biaya_tindakan_kelas3();
              pilihNamaKelompok();

              $('#pilihTindakan').html('');
              $('#jml_hari').val('');
              $('#jml_tindakan').val('');

             },
             error: function (xhr,status,error) {
                 swal(xhr.responseText);
             }
        });
    }

    function simpan_update_tindakan_cp(){

      if ($("#jmlHariEdit").val() == '' || $("#jmlHariEdit").val() == '0') {
        swal("BELUM LENGKAP!", "Kolom Hari Tidak Boleh Bernilai 0!", "warning");
        $("#jmlHariEdit").focus();
        return;
      } else if ($("#jmlTindakanEdit").val() == '' || $("#jmlTindakanEdit").val() == '0') {
        swal("BELUM LENGKAP!", "Kolom Jumlah  Tidak Boleh Bernilai 0!", "warning");
        $("#jmlTindakanEdit").focus();
        return;
      }
      
       jQuery.ajax({
             type: "POST",
             url: "<?php echo base_url() ?>input_cp/simpanUpdateTindakanCP", // the method we are calling pilihkelompok
             data:  {
                  idInputEdit       : $('#idInputEdit').val(),
                  pilihTindakanEdit : $('#pilihTindakanEdit').val(),
                  pilihKelompokEdit : $('#pilihKelompokEdit').val(),
                  jmlHariEdit       : $('#jmlHariEdit').val(),
                  jmlTindakanEdit   : $('#jmlTindakanEdit').val(),
                  ip_komputer       : $('#ip_komputer').val(),
                  levelEdit         : $('#levelEdit').val(),
                },
             dataType: 'text',
             success: function (data) {

              // alert("Upload Image Berhasil.");
              swal("BERHASIL!", "Data Berhasil Diubah", "success");

              $('#modal_ubah_input_cp').modal('hide');
             
              tabel_tambah_cp();
              total_biaya_tindakan_kelas1();
              total_biaya_tindakan_kelas2();
              total_biaya_tindakan_kelas3();

             },
             error: function (xhr,status,error) {
                 swal(xhr.responseText);
             }
        });
    }


    function tabel_tambah_cp(){
    $('#tabel_tambah_cp').DataTable().destroy();
    $('#tabel_tambah_cp').DataTable({
      "oLanguage": {
            "sEmptyTable": "Belum ada Input Tindakan"
        },
      "paging": false,
      "bLengthChange": false,
      "bAutoWidth": false,
      "filter": false,
      "ordering": false,
      "searching": false,
      "info": false,
      "destroy": true,
      "processing" : true,
          "ajax": {
                "url": "<?php echo base_url() ?>input_cp/tabelDaftarInputCP",
                "type": "POST",
                "data": {
                  ip_komputer : $('#ip_komputer').val(),
                  },
                  },
      "columns"       : [

              // {"data" : "kosong"},
              {"data" : "no"},
              {"data" : "KELOMPOK"},
              {"data" : "TINDAKAN"},
              {"data" : "HARIKE"},
              {"data" : "JUMLAH"},
              {"data" : "KELAS1"},
              {"data" : "KELAS2"},
              {"data" : "KELAS3"},
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

  function hapusHasilInputan(id_inp, tgl_inp, level){

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
            url: "input_cp/hapusDataInputTindakan", // the method we are calling
            data:  {
              
              id_inp:id_inp,
              tgl_inp: tgl_inp,
              level: level,
            },
           success: function(data) {
                swal("Berhasil!", "Data berhasil dihapus.", "success");
                tabel_tambah_cp();
                total_biaya_tindakan_kelas1();
                total_biaya_tindakan_kelas2();
                total_biaya_tindakan_kelas3();
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

  function hapusHasilInputanAll(){

     swal({
      title: "PERINGATAN !!",
      text: "Yakin, data ini akan dihapus semua!",
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
            url: "input_cp/hapusDataInputTindakanAll", // the method we are calling
            data:  {
              
              ip_komputer : $('#ip_komputer').val(),
            },
           success: function(data) {
                swal("Berhasil!", "Data berhasil dihapus.", "success");
                window.location.reload();

                $('#input_tindakan').show();
                $('#hidden_tindakan').hide();
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

  function hapusHasilInputanKetikaRefresh(){

     swal({
      title: "TRASAKSI BELUM SELESAI !!",
      text: "Trasaksi ini akan dihapus semua!",
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
            url: "input_cp/hapusDataInputTindakanAll", // the method we are calling
            data:  {
              
              ip_komputer : $('#ip_komputer').val(),
            },
           success: function(data) {
                swal("Berhasil!", "Data transaksi telah dihapus.", "success");
                tabel_tambah_cp();
                total_biaya_tindakan_kelas1();
                total_biaya_tindakan_kelas2();
                total_biaya_tindakan_kelas3();

           },
           error: function() {
              alert('Something is wrong');
           }
        });
      } else {
        swal("Batal!", "Data kembali disimpan", "error");
        simpan_input_tindakan_ketabelcp();
      }
    });

  }

  function simpan_input_tindakan_ketabelcp() {

      jQuery.ajax({
          type: "POST",
          url: "<?php echo base_url() ?>input_cp/simpanDataInputTindakankeTabelCP", 
          type: "POST",
          data:  {
              ip_komputer : $('#ip_komputer').val(),
          },
          // dataType: 'json',
          success: function (data) {

            simpan_input_tindakan_ketabel_detailcp();
            
            
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

    function simpan_input_tindakan_ketabel_detailcp() {

      jQuery.ajax({
          type: "POST",
          url: "<?php echo base_url() ?>input_cp/simpanDataInputTindakankeTabelDetailCP", 
          type: "POST",
          data:  {
              ip_komputer : $('#ip_komputer').val(),
          },
          // dataType: 'json',
          success: function (data) {
            
            hapus_isi_tabel_input_tindakan_cp();

            // $('#input_tindakan').show();
            // $('#hidden_tindakan').hide();

            
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

    function hapus_isi_tabel_input_tindakan_cp() {

      jQuery.ajax({
          type: "POST",
          url: "<?php echo base_url() ?>input_cp/hapusDataInputTindakanAll", 
          type: "POST",
          data:  {
              ip_komputer : $('#ip_komputer').val(),
          },
          // dataType: 'json',
          success: function (data) {

            swal("BERHASIL!", "Data Berhasil Disimpan", "success");

            window.location.reload();
            
            pilihNamaDiag();
            ambilDataBiaya();
            tabel_tambah_cp();
            total_biaya_tindakan_kelas1();
            total_biaya_tindakan_kelas2();
            total_biaya_tindakan_kelas3();

            tabel_hasil_input_cp();

            $('#input_tindakan').show();
            $('#hidden_tindakan').hide();
            
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
                "url": "<?php echo base_url() ?>input_cp/tabelHasilInputCP",
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

  function tabel_detail_input_cp(){
    $('#tabel_detail_input_cp').DataTable().destroy();
    $('#tabel_detail_input_cp').DataTable({
      "oLanguage": {
            "sEmptyTable": "Tidak ada data yang ditampilkan"
        },
        "bAutoWidth": false,
        "ordering": false,
        "info": false,
        "paging": false,
        "searching": false,
      "destroy": true,
      "processing" : true,
          "ajax": {
                "url": "<?php echo base_url() ?>input_cp/tabelDaftarDetalInputCP",
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
              {"data" : "EDIT"},
              
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

  function simpan_update_nama_cp(){

    if ($("#nama_cp_edit").val() == '' || $("#nama_cp_edit").val() == ' ' || $("#nama_cp_edit").val() == '-' || $("#nama_cp_edit").val() == '.') {
      swal("BELUM LENGKAP!", "Kolom Nama CP Belum di isi!", "warning");
      $("#nama_cp_edit").focus();
      return;
    }

       jQuery.ajax({
             type: "POST",
             url: "<?php echo base_url() ?>input_cp/simpanUpdateNamaCPTind", // the method we are calling pilihkelompok
             data:  {
                  nama_cp_edit  : $('#nama_cp_edit').val(),
                  kdkel         : $('#kdkel').val(),
                  dx            : $('#dx').val(),
                },
             dataType: 'text',
             success: function (data) {

              // alert("Upload Image Berhasil.");
              swal("BERHASIL!", "Data Berhasil Diubah", "success");

              $('#modal_edit_nama_cp_input_cp').modal('hide');
             
              tabel_hasil_input_cp();

             },
             error: function (xhr,status,error) {
                 swal(xhr.responseText);
             }
        });
    }

    function simpan_update_detail_tindakan(){

    if ($("#nm_tind_edit").val() == '') {
      swal("BELUM LENGKAP!", "Kolom Nama Tindakan Belum di pilih!", "warning");
      $("#nm_tind_edit").focus();
      return;
    } else if ($("#hari_ke_edit").val() == '' || $("#hari_ke_edit").val() == ' ' || $("#hari_ke_edit").val() == '-' || $("#hari_ke_edit").val() == '.' || $("#hari_ke_edit").val() == '0') {
      swal("BELUM LENGKAP!", "Kolom Hari Ke Belum di isi!", "warning");
      $("#hari_ke_edit").focus();
      return;
    } else if ($("#jml_tnd_edit").val() == '' || $("#jml_tnd_edit").val() == ' ' || $("#jml_tnd_edit").val() == '-' || $("#jml_tnd_edit").val() == '.' || $("#jml_tnd_edit").val() == '0') {
      swal("BELUM LENGKAP!", "Kolom Jumlah Belum di isi!", "warning");
      $("#jml_tnd_edit").focus();
      return;
    }

       jQuery.ajax({
             type: "POST",
             url: "<?php echo base_url() ?>input_cp/simpanUpdateDetailTindCP", // the method we are calling pilihkelompok
             data:  {
                  nm_tind_edit : $('#nm_tind_edit').val(),
                  kdcp         : $('#kdcp').val(),
                  hari_ke_edit : $('#hari_ke_edit').val(),
                  jml_tnd_edit : $('#jml_tnd_edit').val(),
                },
             dataType: 'text',
             success: function (data) {

              // alert("Upload Image Berhasil.");
              swal("BERHASIL!", "Data Berhasil Diubah", "success");

              $('#modal_edit_detail_tind_input_cp').modal('hide');

              tabel_detail_input_cp();
              tabel_hasil_input_cp();

             },
             error: function (xhr,status,error) {
                 swal(xhr.responseText);
             }
        });
    }

    function hapusDetailTindCP(tgl, nm_cp, dx){

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
              url: "input_cp/hapusDaftarInputTindakanCPAll", // the method we are calling
              data:  {
                
                tgl:tgl,
                nm_cp: nm_cp,
                dx: dx,
              },
             success: function(data) {
                  swal("Berhasil!", "Data berhasil dihapus.", "success");
                  tabel_hasil_input_cp();
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
      Input CP
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-medkit"></i> Input CP</a></li>
      <li class="active">Detail</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-primary">
          <div class="box-header">
            <!-- <h3 class="box-title">Proses Input CP</h3> -->
            <!-- tools box -->
            <div class="pull-right box-tools">
              <button type="button" class="btn btn-primary btn-sm" data-widget="collapse" data-toggle="tooltip"
                      title="Collapse">
                <i class="fa fa-minus"></i></button>
              <button type="button" class="btn btn-primary btn-sm" data-widget="remove" data-toggle="tooltip"
                      title="Remove">
                <i class="fa fa-times"></i></button>
            </div>
          </div>

          <div class="box-body pad">
            <form class="form-horizontal form-label-left col-xs-12">
              <input type="hidden" name="ip_komputer" id="ip_komputer" value="<?php echo getClientIP(); ?>">
              
              <div class="col-xs-12" id="input_tindakan" name="input_tindakan">
                <br><br>
                <div class="col-xs-12">
                  <div class="form-group" style="padding-right: 5px;">
                    <label>Nama CP</label>
                    <input type="text" id="namaCP" name="namaCP" required="required" class="form-control">
                  </div>
                </div>
                <div class="col-sm-10 col-md-10 col-xs-12">
                  <div class="form-group" style="padding-right: 5px;">
                    <label>Diagnosa</label>
                    <select type="text" id="pilihDiagnosa" name="pilihDiagnosa" required="required" class="form-control" style="width: 100%;"></select>
                  </div>
                </div>
                <div class="col-sm-2 col-md-2 col-xs-12">
                  <div class="form-group" style="padding-right: 5px;">
                    <label>Lama Perawatan</label>
                    <div class="input-group">
                      <input type="number" min="0" id="lamaPerawatan" name="lamaPerawatan" required="required" class="form-control" style="text-align: center;" placeholder="0">
                      <span class="input-group-addon" style="background-color: #e2fbff; color: black;"> hari</span>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-xs-12" id="hidden_tindakan" name="hidden_tindakan">
                <br><br>
                <div class="col-xs-12">
                  <div class="form-group" style="padding-right: 5px;">
                    <label>Nama CP</label>
                    <input type="text" id="namaCPHidden" name="namaCPHidden" required="required" readonly="" disabled="" class="form-control">
                  </div>
                </div>
                <div class="col-sm-10 col-md-10 col-xs-12">
                  <div class="form-group" style="padding-right: 5px;">
                    <label>Diagnosa</label>
                    <input type="text" id="pilihDiagnosaHidden" name="pilihDiagnosaHidden" required="required" readonly="" disabled="" class="form-control" style="width: 100%;">
                  </div>
                </div>
                <div class="col-sm-2 col-md-2 col-xs-12">
                  <div class="form-group" style="padding-right: 5px;">
                    <label>Lama Perawatan</label>
                    <div class="input-group">
                      <input type="number" min="0" id="lamaPerawatanHidden" name="lamaPerawatanHidden" readonly="" disabled="" required="required" class="form-control" style="text-align: center;" placeholder="0">
                      <span class="input-group-addon" style="background-color: #eae6f5; color: black;"> hari</span>  
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-xs-12">
                <br>
                <div class="col-sm-4 col-md-4 col-xs-12">
                  <div class="form-group" style="padding-right: 5px;">
                    <label>Kelompok</label>
                    <select id="pilihKelompok" name="pilihKelompok" required="required" class="form-control"></select>
                  </div>
                </div>
                <div class="col-sm-4 col-md-4 col-xs-12">
                  <div class="form-group" style="padding-right: 5px;">
                    <label>Jenis Tindakan</label>
                    <select id="pilihTindakan" name="pilihTindakan" class="form-control" style="width: 100%;"></select>
                  </div>
                </div>
                <div class="col-sm-1 col-md-1 col-xs-12">
                  <div class="form-group" style="padding-right: 5px;">
                    <label>Hari ke</label>
                    <input type="number" min="0" id="jml_hari" name="jml_hari" required="required" class="form-control" style="text-align: center;" placeholder="0">
                  </div>
                </div>
                <div class="col-sm-1 col-md-1 col-xs-12">
                  <div class="form-group" style="padding-right: 5px;">
                    <label>Jumlah</label>
                    <input type="number" min="0" id="jml_tindakan" name="jml_tindakan" required="required" class="form-control" style="text-align: center;" placeholder="0">
                  </div>
                </div>
                <div class="col-sm-1 col-md-1 col-xs-12">
                  <div class="form-group" style="padding-right: 5px;">
                    <label></label>
                    <button type="button" class="btn btn-block btn-success btn-sm" id="btn_simpan_input" name="btn_simpan_input" style="margin-top: 5px; padding: 3px; height: 33px;">
                      <i class='fa fa-fw fa-lg fa-plus'></i>&nbsp;
                      Tambah
                    </button>
                  </div>
                </div>
                <div class="col-sm-1 col-md-1 col-xs-12">
                  <div class="form-group">
                    <label></label>
                    <button type="button" id="btn_batal_input" name="btn_batal_input" class="btn btn-block btn-danger btn-sm" style="margin-top: 5px;  padding: 3px; height: 33px;">
                      <i class='fa fa-fw fa-lg fa-close'></i>&nbsp;
                      Batal
                    </button>
                  </div>
                </div>
              </div>

              <br>
              <div class="col-xs-12">
                <div class="table-responsive">
                  <br><br><br>
                  <table class="table table-bordered" id="tabel_tambah_cp" name="tabel_tambah_cp" width="100%" cellspacing="0">
                    <thead class="header-tabel">
                      <tr>
                        <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="5%"><center>NO.</center></th>
                        <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="15%">KELOMPOK</th>
                        <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="30%">TINDAKAN</th>
                        <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="6%"><center>HARI KE</center></th>
                        <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="6%"><center>JUMLAH</center></th>
                        <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="12%"><center>KELAS 1</center></th>
                        <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="12%"><center>KELAS 2</center></th>
                        <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="12%"><center>KELAS 3</center></th>
                        <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" colspan="2" width="4%"><center></center></th>
                      </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="form-horizontal col-xs-12">
                <div class="row">
                  <div class="col-sm-9 col-md-9 col-xs-12">
                    <div class="form-group2" style="font-size: 20px; color: #337ab7; text-align: right; margin-top: 10px;">
                      <b>BIAYA KELAS I</b> &nbsp; &nbsp;
                    </div>
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="form-group" style="padding-left: 15px; padding-right: 15px;">
                      <input type="text" min="0" id="biaya_kelas1" name="biaya_kelas1" required="required" class="form-control" style="text-align: right; font-size: 25px; font-weight: bold; font-style: italic; padding-top: 20px; padding-bottom: 20px;" placeholder="0.00-" readonly="" disabled="true">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-9 col-md-9 col-xs-12">
                    <div class="form-group2" style="font-size: 20px; color: #337ab7; text-align: right; margin-top: 10px;">
                      <b>BIAYA KELAS II </b> &nbsp;
                    </div>
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="form-group" style="padding-left: 15px; padding-right: 15px;">
                      <input type="text" min="0" id="biaya_kelas2" name="biaya_kelas2" required="required" class="form-control" style="text-align: right; font-size: 25px; font-weight: bold; font-style: italic; padding-top: 20px; padding-bottom: 20px;" placeholder="0.00-" readonly="" disabled="true">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-9 col-md-9 col-xs-12">
                    <div class="form-group2" style="font-size: 20px; color: #337ab7; text-align: right; margin-top: 10px;">
                      <b>BIAYA KELAS III</b>
                    </div>
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="form-group" style="padding-left: 15px; padding-right: 15px;">
                      <input type="text" min="0" id="biaya_kelas3" name="biaya_kelas3" required="required" class="form-control" style="text-align: right; font-size: 25px; font-weight: bold; font-style: italic; padding-top: 20px; padding-bottom: 20px;" placeholder="0.00-" readonly="" disabled="true">
                    </div>
                  </div>
                </div>
                <br><br>
                <div class="row">
                  <div class="col-sm-6 col-md-6 col-xs-12">
                    <div class="form-group">
                    </div>
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="form-group" style="padding-left: 15px; padding-right: 15px;">
                      <button type="button" class="btn btn-block btn-success btn-md" id="btn_simpan_tindakan_cp_pertama" name="btn_simpan_tindakan_cp_pertama">
                        <i class='fa fa-fw fa-lg fa-check'></i>&nbsp;
                        Simpan
                      </button>
                    </div>
                  </div>
                  <div class="col-sm-3 col-md-3 col-xs-12">
                    <div class="form-group" style="padding-left: 15px; padding-right: 15px;">
                      <button type="button" class="btn btn-block btn-danger btn-md" id="btn_hapus_all" name="btn_hapus_all">
                        <i class='fa fa-fw fa-lg fa-close'></i>&nbsp;
                        Batal Semua
                      </button>
                    </div>
                  </div>
                </div>
            </form>
            <br><br><br>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Daftar Tindakan CP -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-orange">
          <div class="box-header">
            <h3 class="box-title">
              Daftar Hasil Tindakan CP
            </h3>
            <div class="pull-right box-tools">
              <button type="button" class="btn bg-orange btn-sm" data-widget="collapse" data-toggle="tooltip" title="Collapse">
                <i class="fa fa-minus"></i></button>
              <button type="button" class="btn bg-orange btn-sm" data-widget="remove" data-toggle="tooltip" title="Remove">
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
                      <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="10%"><center>HARI PERAWATAN</center></th>
                      <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" colspan="2" width="5%"><center></center></th>
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

<!-- Modal Ubah input CP-->
<div id="modal_ubah_input_cp" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Form Ubah Input CP</h4>
      </div>
      <div class="modal-body" style="margin-bottom: 30px;">
        <br>
        <input type="hidden" name="idInputEdit" id="idInputEdit">
        <input type="hidden" name="tglEdit" id="tglEdit">
        <input type="hidden" name="levelEdit" id="levelEdit">
        <div class="row">
          <div class="col-xs-12">
            <div class="form-group">
              <label>Kelompok</label>
              <select id="pilihKelompokEdit" name="pilihKelompokEdit" required="required" class="form-control" style="width: 100%;">
                <?php
                  foreach ($lihatDaftarKelompokEdit->result() as $kolom) { ?>
                    <option value="<?php echo $kolom->kdkel;?>"><?php echo $kolom->nmkelompok;?></option>
                <?php } ?>
              </select>
            </div>
          </div>
          <div class="col-xs-12">
            <div class="form-group">
              <label>Jenis Tindakan</label>
              <select id="pilihTindakanEdit" name="pilihTindakanEdit" class="form-control" style="width: 100%;">
                <?php
                  foreach ($lihatDaftarTindakanEdit->result() as $kolom) { ?>
                    <option value="<?php echo $kolom->kdtind;?>"><?php echo $kolom->nmtind;?></option>
                <?php } ?>
              </select>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
              <label>Hari ke</label>
              <input type="number" min="0" id="jmlHariEdit" name="jmlHariEdit" required="required" class="form-control" style="text-align: center;" placeholder="0">
            </div>
          </div>
          <div class="col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
              <label>Jumlah</label>
              <input type="number" min="0" id="jmlTindakanEdit" name="jmlTindakanEdit" required="required" class="form-control" style="text-align: center;" placeholder="0">
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" id="btn_simpan_edit" name="btn_simpan_edit" class="btn btn-info btn-sm"><i class='fa fa-fw fa-lg fa-check'></i>Update</button>
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class='fa fa-fw fa-lg fa-close'></i>Tutup</button>
      </div>
    </div>

  </div>
</div>

<!-- Modal Detail Hasil Input CP-->
<div class="modal fade" id="modal_edit_nama_cp_input_cp" role="dialog">
  <div class="modal-dialog modal-lg">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Form Ubah Hasil Input CP</h4>
      </div>
      
      <div class="modal-body" style="margin-bottom: 30px;">
        <div class="row">
          <div class="form-group col-sm-9 col-md-9 col-xs-12">
            <label>Nama CP</label>
            <input type="text" id="nama_cp_edit" name="nama_cp_edit" required="required" class="form-control">
          </div>
          <div class="col-sm-3 col-md-3 col-xs-12">
            <button type="button" id="update_nm_cp" name="update_nm_cp" class="btn btn-info btn-sm" style="margin-top: 25px;"><i class='fa fa-fw fa-lg fa-check'></i>Update Nama CP</button>
          </div>
          <div class="form-group col-sm-9 col-md-9 col-xs-12">
            <label>Diagnosa</label>
            <input type="text" id="nm_dx_edit" name="nm_dx_edit" required="required" class="form-control" readonly="" disabled="">
          </div>
          <div class="form-group col-sm-3 col-md-3 col-xs-12">
            <label>Kelompok</label>
            <input type="text" id="kdkel_edit" name="kdkel_edit" required="required" class="form-control" readonly="" disabled="">
          </div>
          <div class="col-xs-12">
            <input type="hidden" name="nama_cp" id="nama_cp">
            <input type="hidden" name="kdkel" id="kdkel">
            <input type="hidden" name="dx" id="dx">
            <div class="table-responsive">
              <table class="table table-bordered" id="tabel_detail_input_cp" name="tabel_detail_input_cp" width="100%" cellspacing="0">
                <thead class="header-tabel">
                  <tr>
                    <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="5%"><center>NO.</center></th>
                    <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="15%"><center>UPDATE TGL</center></th>
                    <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="30%">NAMA TINDAKAN</th>
                    <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="7%"><center>JUMLAH</center></th>
                    <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="8%"><center>HARI KE</center></th>
                    <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="10%"><center>BIAYA KLS 1</center></th>
                    <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="10%"><center>BIAYA KLS 2</center></th>
                    <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="10%"><center>BIAYA KLS 3</center></th>
                    <th style = "font-family: 'Carrois Gothic SC', sans-serif; color: white" width="5%"><center></center></th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

      <div class="modal-footer" style="padding-top: 15px; padding-right: 15px;">
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class='fa fa-fw fa-lg fa-close'></i>Tutup</button>
      </div>
    </div>
    
  </div>
</div>

<!-- Modal Detail Hasil Input CP-->
<div class="modal fade" id="modal_edit_detail_tind_input_cp" role="dialog">
  <div class="modal-dialog">
  
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Form Ubah Detail Tindakan Input CP</h4>
      </div>
      <div class="modal-body" style="margin-bottom: 30px;">
        <div class="row">
          <input type="hidden" name="noid" id="noid">
          <input type="hidden" name="kdcp" id="kdcp">
          <input type="hidden" name="kdkel_tind_edit" id="kdkel_tind_edit">
          <div class="form-group col-sm-8 col-md-8 col-xs-12">
            <label>Nama Tindakan</label>
            <select type="text" id="nm_tind_edit" name="nm_tind_edit" required="required" class="form-control">
              <?php
                foreach ($ambilDataTindHasilEdit->result() as $kolom) { ?>
                  <option value="<?php echo $kolom->kdtind;?>"><?php echo $kolom->nmtind;?></option>
              <?php } ?>
            </select>
          </div>
          <div class="form-group col-sm-2 col-md-2 col-xs-12">
            <label>Hari Ke</label>
            <input type="text" id="hari_ke_edit" name="hari_ke_edit" style="text-align: center" required="required" class="form-control">
          </div>
          <div class="form-group col-sm-2 col-md-2 col-xs-12">
            <label>Jumlah</label>
            <input type="text" id="jml_tnd_edit" name="jml_tnd_edit" style="text-align: center" required="required" class="form-control">
          </div>
          <div class="form-group col-sm-4 col-md-4 col-xs-12">
            <label>Biaya Kelas 1</label>
            <input type="text" id="kelas1_edit" name="kelas1_edit" required="required" class="form-control" readonly="" disabled="">
          </div>
          <div class="form-group col-sm-4 col-md-4 col-xs-12">
            <label>Biaya Kelas 2</label>
            <input type="text" id="kelas2_edit" name="kelas2_edit" required="required" class="form-control" readonly="" disabled="">
          </div>
          <div class="form-group col-sm-4 col-md-4 col-xs-12">
            <label>Biaya Kelas 3</label>
            <input type="text" id="kelas3_edit" name="kelas3_edit" required="required" class="form-control" readonly="" disabled="">
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" id="simpan_update_tind_detail" name="simpan_update_tind_detail" class="btn btn-info btn-sm"><i class='fa fa-fw fa-lg fa-check'></i>Simpan Perubahan</button>
        <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class='fa fa-fw fa-lg fa-close'></i>Batal</button>
      </div>
    </div>
    
  </div>
</div>

<script type="text/javascript">
  
  $(document).ready(function() {

    if ($('#biaya_kelas1').val() == 0) {

      // alert($('#biaya_kelas1').val());
      // die();
      $('#input_tindakan').show();
      $('#hidden_tindakan').hide();
    } else {
      $('#input_tindakan').hide();
      $('#hidden_tindakan').show();
      pilihNamaKelompok();
    }

    pilihNamaDiag();
    ambilDataBiaya();
    tabel_tambah_cp();
    total_biaya_tindakan_kelas1();
    total_biaya_tindakan_kelas2();
    total_biaya_tindakan_kelas3();

    tabel_hasil_input_cp();

    // window.location.reload();

    // if (window.location.reload()) {

      if($('#biaya_kelas1').val() == 0 || $('#biaya_kelas1').val() == null) {
        // hapusHasilInputanKetikaRefresh();
      } else {
        hapusHasilInputanKetikaRefresh();
      }

    // }

    $("#pilihDiagnosa").select2({
        minimumInputLength: 3,
        allowClear: true,
        placeholder: 'pilih kode / nama diagnosa',
    });

    $('#pilihDiagnosa').change(function() {
      // pilihKelas();
    })

    $('#lamaPerawatan').change(function() {
      pilihNamaKelompok();
    })

    $('#pilihKelompok').change(function() {
      pilihNamaTindakan();
    })

    $('#pilihKelompok').select2({
        allowClear:true,
    })

    $('#pilihTindakan').change(function() {
      // ambilDataBiaya();
    })

    $('#btn_simpan_input').click(function() {
      simpan_input_tindakan_cp();
    })

    $('#pilihTindakanEdit').change(function() {
      ambilDataBiayaEdit();
    })

    $('#btn_simpan_edit').click(function() {
      simpan_update_tindakan_cp();
    })

    $('#btn_simpan_tindakan_cp_pertama').click(function() {

      if($('#biaya_kelas1').val() == 0) {
        swal("PERINGATAN!", "Tidak ada data yang akan disimpan!", "warning");
      } else {
        // swal("ADA DATA!", "data yang akan disimpan!", "warning");
        simpan_input_tindakan_ketabelcp();
      }

    })

    $('#btn_hapus_all').click(function() {

      if($('#biaya_kelas1').val() == 0) {
        swal("PERINGATAN!", "Tidak ada data yang akan dihapus!", "warning");
      } else {
        // swal("ADA DATA!", "data yang akan disimpan!", "warning");
        hapusHasilInputanAll();
      }

    })

    $('#btn_batal_input').click(function() {

      $('#namaCP').val('');
      $('#pilihDiagnosa').html('');
      $('#lamaPerawatan').val('');
      $('#kelasPerawatan').html('');
      $('#pilihKelompok').html('');
      $('#pilihTindakan').html('');
      $('#biayaTindakan').val('');
      $('#jml_hari').val('');
      $('#jml_tindakan').val('');
      pilihNamaDiag();

    })

    $('#update_nm_cp').click(function() {
      simpan_update_nama_cp();
    })

    $('#simpan_update_tind_detail').click(function() {
      simpan_update_detail_tindakan();
    })

  })

</script>