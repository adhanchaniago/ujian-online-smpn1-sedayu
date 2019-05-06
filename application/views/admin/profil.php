  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Data Informasi Profil</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url() ?>admin">Beranda</a></li>
              <li class="breadcrumb-item active">Informasi Profil</li>
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
            <!-- <div class="card-header"> -->
              <!-- <h3 class="card-title">Daftar Informasi Kelas</h3> -->
            <!-- </div> -->
            <!-- /.card-header -->
            <div class="card-body">
                  <div class="form-group">
                      <label>Nama Admin</label>
                      <input readonly value="<?php echo $row->nama ?>" name="nama" type="text" class="form-control" placeholder="*) Masukan Nama" required="">
                  </div>
                  <div class="form-group">
                      <label>No Telp</label>
                      <input readonly value="<?php echo $row->no_telp ?>" name="telp" type="telp" class="form-control" placeholder="*) 08123456789" required="">
                  </div>
                  <div class="form-group">
                      <label>Email</label>
                      <input readonly value="<?php echo $row->email ?>" name="email" type="text" class="form-control" placeholder="*) email@gmail.com" required="">
                  </div>
                  <div class="form-group">
                      <label>Alamat</label>
                      <textarea readonly name="alamat" class="form-control" rows="3" required><?php echo $row->alamat ?></textarea>
                  </div>
                  <div class="form-group">
                      <label>Username</label>
                      <input readonly value="<?php echo $row->username ?>" name="username" type="text" class="form-control" placeholder="*) Masukan Username" required="">
                  </div>
                  <a href="<?php echo base_url('admin/form-data-admin-edit/'.$row->username) ?>" class="btn btn-primary edit">Edit</a>
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
    <div class="modal-dialog modal-dialog-centered">
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

<script>
  $('.edit').on('click', function(e){
    e.preventDefault(); 
    $.get( $(this).attr('href'), function(data){
      $('#myModal .modal-title').html('Edit Informasi Profil');
      $('#myModal .modal-body').html(data);
      $('#myModal').modal('show');
    } ,'html');
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