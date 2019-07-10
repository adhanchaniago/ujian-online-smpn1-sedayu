  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Informasi Hasil Ujian</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url('siswa') ?>">Beranda</a></li>
              <li class="breadcrumb-item active">Informasi Hasil Ujian</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- DataTables -->
    <link rel="stylesheet" href="<?php echo base_url()?>/themes/adminlte/adminlte.io/themes/dev/adminlte/plugins/datatables/dataTables.bootstrap4.css">

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-body">
                  <table class="table example1 table-bordered table-striped" style="width:100%">
                      <thead>
                          <tr>
                              <th>Judul Ujian</th>
                              <th>Nama Pelajaran </th>
                              <th>Tanggal</th>
                              <th>Jam</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        <tr>
                        <td>{value}</td>
                        <td>{value}</td>
                        <td>{value}</td>
                        <td>{value}</td>
                        <td>
                          <a class="btn btn-block btn-outline-primary detail" href="<?php echo base_url('siswa/detail-hasil-ujian') ?>">Lihat Hasil Ujian</a>
                        </td>
                        </tr>
                      </tbody>
                  </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
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
  $("table.example1").DataTable();
});
$(document).on('click', '.form-add-new', function(e){
  e.preventDefault();
  $.get($(this).attr('href'), function(data){
    $('#myModal .modal-title').html('Tambah Data Informasi Template');
    $('#myModal .modal-body').html(data);
    $('#myModal').modal('show');
  },'html');
});
$('.detail').on('click', function(e){
  e.preventDefault(); 
  $.get( $(this).attr('href'), function(data){
    $('#myModal .modal-title').html('Detail Hasil Ujian');
    $('#myModal .modal-body').html(data);
    $('#myModal').modal('show');
  } ,'html');
});
</script>