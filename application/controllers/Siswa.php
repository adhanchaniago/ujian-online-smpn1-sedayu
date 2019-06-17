<?php 
class Siswa extends MY_Controller{
	function __construct(){
        parent::__construct();
		
		if($this->session->userdata('status') != "login" && $this->session->userdata('level') != "siswa"){
			redirect(base_url('auth'));
		}
		
        $this->load->model('m_siswa');
        
		$msg= null;
		$html= null;
		$json= null;
    }

/* ==================== Start Beranda ==================== */
    public function index()
    {
        $this->content['rows'] =[];
        $this->view= 'siswa/index';
        $this->render_pages();
    }
/* ==================== End Beranda ==================== */

/* ==================== Start Profil ==================== */
    public function data_profil()
    {
        $this->m_siswa->username= $this->session->userdata('username');

        $this->content['row']   = $this->m_siswa->data_siswa_edit();
        $this->content['jk']    = $this->m_siswa->siswa_jk();
        $this->content['agama'] = $this->m_siswa->siswa_agama();
        $this->view= 'siswa/profil';
        $this->render_pages();

        # for debug data
        /* echo '<pre>';
        print_r($this->content);
        echo '</pre>'; */
    }
    public function form_data_siswa_edit()
    {
        $this->m_siswa->username= $this->session->userdata('username');
        $row= $this->m_siswa->data_siswa_edit();
        $jk= "";
        foreach ($this->m_siswa->siswa_jk() as $key => $value) {
            $jk .= '
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input '.($value==$row->jk? 'checked' : null).' type="radio" class="form-check-input" name="jk" value="'.$value.'" required>'.($value=='L' ? 'Laki-Laki' : 'Perempuan' ).'
                    </label>
                </div>
            ';
        }

        $agama= "";
        foreach ($this->m_siswa->siswa_agama() as $key => $value) {
            $agama .= '
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input '.($value==$row->agama? 'checked' : null).' type="radio" class="form-check-input" name="agama" value="'.$value.'" required>'.$value.'
                    </label>
                </div>
            ';
        }

        $this->html= '
        <form action="'.base_url().'siswa/data-siswa-update" role="form" id="edit" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>NIS</label>
                <input readonly value="'.$row->nis.'" name="nip" type="text" class="form-control" placeholder="*) Masukan NIS" required="">
            </div>
            <div class="form-group">
                <label>Nama Guru</label>
                <input value="'.$row->nama.'" name="nama" type="text" class="form-control" placeholder="*) Masukan Nama" required="">
            </div>
            <div class="form-group">
                <label>Jenis Kelamin</label>
                <div class="form-group">
                    '.$jk.'
                </div>
            </div>
            <div class="form-group">
                <label>Agama</label>
                <div class="form-group">
                    '.$agama.'
                </div>
            </div>
            <div class="form-group">
                <label>Tempat Lahir</label>
                <input value="'.$row->tempat_lahir.'" name="tempat_lahir" type="text" class="form-control" placeholder="*) Masukan Tempat Lahir" required="">
            </div>
            <div class="form-group">
                <label>Tanggal Lahir</label>
                <input value="'.$row->tgl_lahir.'" name="tgl_lahir" type="date" class="form-control" placeholder="" required="">
            </div>
            <div class="form-group">
                <label>No Telp</label>
                <input value="'.$row->no_telp.'" name="telp" type="telp" class="form-control" placeholder="*) 08123456789" required="">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input value="'.$row->email.'" name="email" type="text" class="form-control" placeholder="*) email@gmail.com" required="">
            </div>
            <div class="form-group">
                <label>Alamat</label>
                <textarea name="alamat" class="form-control" rows="3" required>'.$row->alamat.'</textarea>
            </div>
            <div class="form-group">
                <label>Username</label>
                <input readonly value="'.$row->username.'" name="username" type="text" class="form-control" placeholder="*) Masukan Username" required="">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input name="password" type="password" class="form-control" placeholder="**********">
            </div>
            <div class="form-group">
                <label>Foto</label>
                <img class="d-block img-thumbnail" src="'.base_url('src/siswa/'.$row->gambar).'">
            </div>
            <div class="form-group">
                <label>Ganti Foto <small class="badge badge-info">*) type: JPG atau PNG</small></label>
                <input name="fupload" type="file" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Publish</button>
        </form>
        ';
        echo $this->html;
    }
    public function data_siswa_update()
    {
        $this->m_siswa->post= $this->input->post();
        if ( empty($_FILES['fupload']['tmp_name']) ) {
            # code...without upload file
            if ( $this->m_siswa->data_siswa_update() ) {
                $this->msg= [
                    'stats'=>1,
                    'msg'=> 'Data Berhasil Disimpan'
                ];
            } else {
                $this->msg= [
                    'stats'=>1,
                    'msg'=> 'Data Gagal Disimpan'
                ];
            }
        } else {
            # code...with upload file
            $this->m_siswa->username= $this->input->post('username');
            $row= $this->m_siswa->data_siswa_edit();
            $config['upload_path']          = 'src/siswa/';
            $config['allowed_types']        = 'jpg|png';
            if ( file_exists($config['upload_path'].$row->gambar) ) {
                unlink($config['upload_path'].$row->gambar);
            }
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('fupload'))
            {
                $this->msg= [
                    'stats'=>0,
                    'msg'=> $this->upload->display_errors(),
                ];
            }
            else
            {
                $this->m_siswa->post['gambar']= $this->upload->data()['file_name'];
                if ( $this->m_siswa->data_siswa_update() ) {
                    $this->msg= [
                        'stats'=>1,
                        'msg'=> 'Data Berhasil Disimpan',
                    ];
                    
                } else {
                    $this->msg= [
                        'stats'=>0,
                        'msg'=> 'Maaf Data Gagal Disimpan',
                    ];
                }
                
            }
        }
        echo json_encode($this->msg);
    }
/* ==================== End Profil ==================== */

/* ==================== Start Ujian ==================== */
    public function data_ujian()
    {
        $this->content['rows']= [];
        $this->view= 'siswa/ujian';
        $this->render_pages();
    }
/* ==================== End Profil ==================== */

/* ==================== Start Ujian ==================== */
    public function data_hasil_ujian()
    {
        $this->content['rows']= [];
        $this->view= 'siswa/hasil_ujian';
        $this->render_pages();
    }
/* ==================== End Profil ==================== */
}