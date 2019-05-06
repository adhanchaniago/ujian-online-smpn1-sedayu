<?php 
class Admin extends MY_Controller{
/* 
default function in this app:
    public function method_name()
    {
        switch ( $this->session->userdata('level') ) {
            case 'admin':
                # code...
                echo "admin";
                break;
            
            case 'guru':
                # code...
                echo "guru";
                break;
            
            case 'siswa':
                # code...
                echo "siswa";
                break;
            
            
            default:
                # code...
                break;
        }
    }

    // form
    $this->html= '
    <form action="'.base_url().'admin/data-store" role="form" id="addNew" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="inputNip">Nama</label>
            <input name="nama" type="text" class="form-control" placeholder="*) Masukan Nama" required="">
        </div>
        <div class="form-group">
            <label for="inputNip">Pelajaran</label>
            <select name="pelajaran_id" class="form-control" required="">
                <option value="" selected disabled> -- Pilih Pelajaran -- </option>
    ';
    foreach ($this->M_admin->guru_data_materi_input_pelajaran() as $key => $value) {
        $this->html .= '
        <option value="'.$value->pelajaran_id.'"> ('.$value->kelas_nama.') '.$value->pelajaran_nama.'</option>
        ';
    }
    $this->html .= '
            </select>
        </div>
        <div class="form-group">
            <label for="inputNama">Upload Materi <small class="badge badge-info">*) type: doc,docx,ppt,pptx,pdf,mp4</small></label>
            <input name="fupload" type="file" class="form-control"  required="">
        </div>
        <button type="submit" class="btn btn-primary">Publish</button>
    </form>
    ';
    echo $this->html;
    // form
*/
	function __construct(){
        parent::__construct();
		
		if($this->session->userdata('status') != "login"){
			redirect(base_url('auth'));
		}
		
        $this->load->model('m_admin');
        
		$msg= [
            'store'=> [
                'true'=> [
                    'stats'=> 1,
                    'msg'=> 'Data Berhasil Ditambahkan',
                ],
                'false'=> [
                    'stats'=> 0,
                    'msg'=> 'Data Gagal Ditambahkan',
                ],
            ],
            'update'=> [
                'true'=> [
                    'stats'=> 1,
                    'msg'=> 'Data Berhasil Diubah',
                ],
                'false'=> [
                    'stats'=> 0,
                    'msg'=> 'Data Gagal Diubah',
                ],
            ],
            'delete'=> [
                'true'=> [
                    'stats'=> 1,
                    'msg'=> 'Data Berhasil Dihapus',
                ],
                'false'=> [
                    'stats'=> 0,
                    'msg'=> 'Data Gagal Dihapus',
                ],
            ],
        ];
		$html= null;
		$json= null;
    }

    public function index()
    {
        switch ( $this->session->userdata('level') ) {
            case 'admin':
                # code...
                $this->view= 'admin/index';
                $this->render_pages();
                break;
                
                case 'guru':
                # code...
                $this->view= 'guru/index';
                $this->render_pages();
                break;
                
                case 'siswa':
                # code...
                $this->view= 'siswa/index';
                $this->render_pages();
                break;
            
            
            default:
                # code...
                break;
        }
    }

    // start users controller
    public function data_admin()
    {
        switch ( $this->session->userdata('level') ) {
            case 'admin':
                # code...
                $this->content['rows']= $this->m_admin->data_admin();
                $this->view= 'admin/data_admin';
                $this->render_pages();
                break;            
                
            default:
                # code...
                break;
        }
    }

    public function form_data_admin()
    {
        switch ( $this->session->userdata('level') ) {
            case 'admin':
                # code...
                $this->html= '
                <form action="'.base_url().'admin/data-admin-store" role="form" id="addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="inputNip">Nama Admin</label>
                        <input name="nama" type="text" class="form-control" placeholder="*) Masukan Nama" required="">
                    </div>
                    <button type="submit" class="btn btn-primary">Publish</button>
                </form>
                ';
                echo $this->html;
                break;                
            
            default:
                # code...
                break;
        }
    }

    public function data_admin_store()
    {
        switch ( $this->session->userdata('level') ) {
            case 'admin':
                # code...
                echo "admin";
                break;                
            
            default:
                # code...
                break;
        }
    }

    public function form_data_admin_edit()
    {
        switch ( $this->session->userdata('level') ) {
            case 'admin':
                # code...
                echo "admin";
                break;                
            
            default:
                # code...
                break;
        }
    }

    public function data_admin_update()
    {
        switch ( $this->session->userdata('level') ) {
            case 'admin':
                # code...
                echo "admin";
                break;                
            
            default:
                # code...
                break;
        }
    }

    public function data_admin_delete()
    {
        switch ( $this->session->userdata('level') ) {
            case 'admin':
                # code...
                echo "admin";
                break;                
            
            default:
                # code...
                break;
        }
    }
        
    public function data_guru()
    {
        switch ( $this->session->userdata('level') ) {
            case 'admin':
                # code...
                $this->content['rows']= $this->m_admin->data_guru();
                $this->view= 'admin/data_guru';
                $this->render_pages();
                break;            
            
            default:
                # code...
                break;
        }
    }

    public function form_data_guru()
    {
        switch ( $this->session->userdata('level') ) {
            case 'admin':
                # code...
                $this->html= '
                <form action="'.base_url().'admin/data-admin-store" role="form" id="addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="inputNip">Nama Admin</label>
                        <input name="nama" type="text" class="form-control" placeholder="*) Masukan Nama" required="">
                    </div>
                    <button type="submit" class="btn btn-primary">Publish</button>
                </form>
                ';
                echo $this->html;
                break;                
            
            default:
                # code...
                break;
        }
    }

    public function data_guru_store()
    {
        switch ( $this->session->userdata('level') ) {
            case 'admin':
                # code...
                echo "admin";
                break;                
            
            default:
                # code...
                break;
        }
    }

    public function form_data_guru_edit()
    {
        switch ( $this->session->userdata('level') ) {
            case 'admin':
                # code...
                echo "admin";
                break;                
            
            default:
                # code...
                break;
        }
    }

    public function data_guru_update()
    {
        switch ( $this->session->userdata('level') ) {
            case 'admin':
                # code...
                echo "admin";
                break;                
            
            default:
                # code...
                break;
        }
    }

    public function data_guru_delete()
    {
        switch ( $this->session->userdata('level') ) {
            case 'admin':
                # code...
                echo "admin";
                break;                
            
            default:
                # code...
                break;
        }
    }
        
    public function data_siswa()
    {
        switch ( $this->session->userdata('level') ) {
            case 'admin':
                # code...
                $this->content['rows']= $this->m_admin->data_siswa();
                $this->view= 'admin/data_siswa';
                $this->render_pages();
                break;            
        
            default:
                # code...
                break;
        }
    }

    public function form_data_siswa()
    {
        switch ( $this->session->userdata('level') ) {
            case 'admin':
                # code...
                $this->html= '
                <form action="'.base_url().'admin/data-admin-store" role="form" id="addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="inputNip">Nama Admin</label>
                        <input name="nama" type="text" class="form-control" placeholder="*) Masukan Nama" required="">
                    </div>
                    <button type="submit" class="btn btn-primary">Publish</button>
                </form>
                ';
                echo $this->html;
                break;                
            
            default:
                # code...
                break;
        }
    }

    public function data_siswa_store()
    {
        switch ( $this->session->userdata('level') ) {
            case 'admin':
                # code...
                echo "admin";
                break;                
            
            default:
                # code...
                break;
        }
    }

    public function form_data_siswa_edit()
    {
        switch ( $this->session->userdata('level') ) {
            case 'admin':
                # code...
                echo "admin";
                break;                
            
            default:
                # code...
                break;
        }
    }

    public function data_siswa_update()
    {
        switch ( $this->session->userdata('level') ) {
            case 'admin':
                # code...
                echo "admin";
                break;                
            
            default:
                # code...
                break;
        }
    }

    public function data_siswa_delete()
    {
        switch ( $this->session->userdata('level') ) {
            case 'admin':
                # code...
                echo "admin";
                break;                
            
            default:
                # code...
                break;
        }
    }

    public function data_profil()
    {
        switch ( $this->session->userdata('level') ) {
            case 'admin':
                # code...
                echo "admin";
                break;
            
            case 'guru':
                # code...
                echo "guru";
                break;
            
            case 'siswa':
                # code...
                echo "siswa";
                break;
            
            
            default:
                # code...
                break;
        }
    }
    // end users controller
}