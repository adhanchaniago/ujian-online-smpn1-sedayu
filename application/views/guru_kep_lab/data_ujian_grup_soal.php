  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url()?>/themes/adminlte/adminlte.io/themes/dev/adminlte/plugins/datatables/dataTables.bootstrap4.css">


  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Informasi Ujian Grup Soal</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url() ?>guru-kep-lab">Beranda</a></li>
              <li class="breadcrumb-item active">Informasi Ujian Grup Soal</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <!-- <h3 class="card-title">Daftar Informasi Kelas</h3> -->
              <a href="<?php echo base_url() ?>guru-kep-lab/add-ujian-grup-soal" class="btn btn-default float-right form-add-new"><i class="fa fa-plus"></i> Add New</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Tahun Ajaran</th>
                  <th>Nama Grup Soal</th>
                  <th>Kelas</th>
                  <th>Pelajaran</th>
                  <th>Jumlah Soal</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  foreach ($rows as $key => $value) {
                    if( $value->jumlah_soal > 40 ){
                    echo "
                      <tr>
                        <td>{$value->tahun_ajaran}</td>
                        <td>{$value->nama_grup_soal}</td>
                        <td>{$value->nama_kelas}</td>
                        <td>{$value->nama_pelajaran}</td>
                        <td>{$value->jumlah_soal}</td>
                        <td>
                          <div class='btn-group'>
                            <button type='button' class='btn btn-default'>Action</button>
                            <button type='button' class='btn btn-default dropdown-toggle' data-toggle='dropdown' aria-expanded='false'>
                              <span class='caret'></span>
                              <span class='sr-only'>Toggle Dropdown</span>
                            </button>
                            <div class='dropdown-menu' role='menu' x-placement='top-start' style='position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(67px, -165px, 0px);'>
                              <a class='dropdown-item edit' href='".base_url('guru-kep-lab/edit-ujian-grup-soal/')."'>Edit</a>
                              <a class='dropdown-item delete' href='".base_url('guru-kep-lab/delete-ujian-grup-soal/')."'>Delete</a>
                            </div>
                          </div>
                        </td>
                      </tr>
                    ";
                    }
                  }
                ?>
                
                </tbody>
                <!-- <tfoot>
                <tr>
                  <th>Nama Materi</th>
                  <th>Tanggal Upload</th>
                  <th>Tipe File</th>
                  <th>Action</th>
                </tr>
                </tfoot> -->
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

    <!-- The Modal -->
    <div class="modal fade" id="myModal">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Modal Heading</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          Modal body..
        </div>
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
        
      </div>
    </div>
  </div>
  <!-- /.modal -->

<!-- DataTables -->
<script src="<?php echo base_url()?>/themes/adminlte/adminlte.io/themes/dev/adminlte/plugins/datatables/jquery.dataTables.js"></script>
<script src="<?php echo base_url()?>/themes/adminlte/adminlte.io/themes/dev/adminlte/plugins/datatables/dataTables.bootstrap4.js"></script>
<script>
  $(function () {
    $("#example1").DataTable();
  });

  $(function() {
    // Handler for .ready() called.
    $(document).on('click', '.form-add-new', function(e){
      e.preventDefault();
      $.get($(this).attr('href'), function(data){
        $('#myModal .modal-title').html('Tambah Data Informasi Ujian Grup Soal');
        $('#myModal .modal-body').html(data);
        $('#myModal').modal('show');

        $('#id_grup_soal').on('change',function(){
          var option = $('option:selected', this).attr('tot');
          $('#total_soal').val( option );
        });

        /* ketika metode acak dipilih */
        $('.metode').on('change',function(){
          if ( $('#id_grup_soal').val()==null ) {
            alert('Maaf Anda Belum Bisa Memilih Metode, Mohon Pilih Grup Soal Terlebih Dahulu');
          } else {
            if ( $(this).val()=="LCG" ) {
              $.get(
                '<?php echo base_url() ?>guru-kep-lab/pilihan-bilangan-prima',
                {"jumlah_soal":$('#total_soal').val()},
                function(data){
                  $('#formula').html(data);
                }
              );

            } else if ( $(this).val()=="SQL RANDOM" ){
              $('#formula').html(null);
            }
          }
          // var stat=1;
          // var id_grup_soal= $('#id_grup_soal').val();
          // var jumlah= $('#jumlah').val();
          // if ( jumlah=="" ) {
          //   alert('Maaf Anda Belum Memasukan Jumlah Soal');
          //   stat=0;
            
          // }
          // else if ( id_grup_soal==null ) {
          //   alert('Maaf Anda Belum Bisa Memilih Metode, Mohon Pilih Grup Soal Terlebih Dahulu');
          //   stat=0;
            
          // }

          // if ( stat==1 ) {
          //   var p= {
          //         "metode": $(this).val(),
          //         "id_grup_soal": id_grup_soal,
          //         "total_soal": $('#total_soal').val(),
          //         "jumlah": $('#jumlah').val(),
          //       };
          //   $.get('<?php echo base_url() ?>guru-kep-lab/try-metode-acak',p,function(data){
          //     $('#tryMetode').html(data);
          //   },'html');
          // }
        });
      },'html');
    });

    /* ketika coba acak di klik */
    $(document).on('click','#tesMetode',function(){
      if ( cekInput( getInputan() )==1 ) {
        $.get('<?php echo base_url() ?>guru-kep-lab/try-metode-acak', getInputan() ,function(data){
          $('#tryMetode').html(data);
        },'html');
      }
    });

    /* cek inputan */
    function cekInput(input)
    {
      var stats=1;
      if ( input.jumlah_soal==null ) {
        stats=0;
        alert("Masukan Jumlah Soal Terlebih Dahulu ")
      } else if ( input.jumlah_siswa=="" ) {
        stats=0;
        alert("Masukan Jumlah Siswa Terlebih Dahulu ")
      } else if ( input.id_grup_soal==null ) {
        stats=0;
        alert("Anda Belum Memilih Grup Soal ")
      } else if ( input.metode==undefined ) {
        stats=0;
        alert("Anda Belum Memilih Metode ")
      } else if ( input.metode!=undefined ) {
        if ( input.metode=="LCG" ) {
          // stats=0;
          if( input.bil_prima==null ){
            stats=0;
            alert("Anda Belum Memilih Bilangan Prima ")
          }
        }
      }
 
      return stats==1? 1 : 0;      
    }
  });

  /* mendapatkan inputan */
  function getInputan()
  {
    return {
      "total_soal": $('#total_soal').val(),
      "jumlah_soal" : $('#jumlah').val(),
      "jumlah_siswa" : $('#jumlah_siswa').val(),
      "id_grup_soal" : $('#id_grup_soal').val(),
      "metode" : $("input[name=metode]:checked").val(),
      "bil_prima" : $("#bilPrima").val(),
    };
  }
  
  
  $(document).on('submit', 'form#addNew', function(e) {
    e.preventDefault();    
    var formData = new FormData(this);
    $.ajax({
        url: $(this).attr("action"),
        type: 'POST',
        data: formData,
        success: function (data) {
          if ( data.stats==1 ) {
            alert( data.msg )
            location.reload()
          } else {
            alert( data.msg );
          }
          // console.log(data);
        },
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json'
    });
  });
  $('.edit').on('click', function(e){
    e.preventDefault(); 
    $.get( $(this).attr('href'), function(data){
      $('#myModal .modal-title').html('Edit Informasi Ujian Grup Soal');
      $('#myModal .modal-body').html(data);
      $('#myModal').modal('show');
    } ,'html');
  });
  
  $('.delete').on('click', function(e){
    e.preventDefault(); 
    $.get( $(this).attr('href'), function(data){
      alert( (data.stats=='1') ? data.msg : data.msg )
      location.reload()
    } ,'json');
  });
  $(document).on('submit','form#edit',function(e){
    e.preventDefault();    
    var formData = new FormData(this);
    $.ajax({
        url: $(this).attr("action"),
        type: 'POST',
        data: formData,
        success: function (data) {
          // console.log(data)
            alert( (data.stats=='1') ? data.msg : data.msg )
            location.reload()
        },
        cache: false,
        contentType: false,
        processData: false,
        dataType: 'json'
    });
  });
</script>