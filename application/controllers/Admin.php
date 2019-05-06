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
        
		$msg= null;
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
                        <label>Nama Admin</label>
                        <input name="nama" type="text" class="form-control" placeholder="*) Masukan Nama" required="">
                    </div>
                    <div class="form-group">
                        <label>No Telp</label>
                        <input name="telp" type="telp" class="form-control" placeholder="*) 08123456789" required="">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input name="email" type="text" class="form-control" placeholder="*) email@gmail.com" required="">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input name="username" type="text" class="form-control" placeholder="*) Masukan Username" required="">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input name="password" type="password" class="form-control" placeholder="**********" required="">
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
                $this->m_admin->username= $this->input->post('username');
                if ( $this->m_admin->cek_user() > 0 ) {
                    $this->msg= [
                        'stats'=> 0,
                        'msg'=> 'Maaf Username Sudah Digunakan',
                    ];
                } else {
                    $this->m_admin->post= $this->input->post();
                    $this->m_admin->post['level']= 'admin';
                    if ( $this->m_admin->data_admin_store() ) {
                        $this->msg= [
                            'stats'=> 1,
                            'msg'=> 'Data Berhasil Ditambahkan',
                        ];
                    } else {
                        $this->msg= [
                            'stats'=> 0,
                            'msg'=> 'Data Gagal Ditambahkan',
                        ];
                    }
                    
                }
                echo json_encode($this->msg);
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
                $this->m_admin->username= $this->uri->segment(3);
                $row= $this->m_admin->data_admin_edit();
                $this->html= '
                <form action="'.base_url().'admin/data-admin-update" role="form" id="edit" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Nama Admin</label>
                        <input value="'.$row->nama.'" name="nama" type="text" class="form-control" placeholder="*) Masukan Nama" required="">
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
                        <label>Password <small>*) Jika tidak diisi password masih sama seperti sebelumnya</small></label>
                        <input name="password" type="password" class="form-control" placeholder="**********" >
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

    public function data_admin_update()
    {
        switch ( $this->session->userdata('level') ) {
            case 'admin':
                # code...
                $this->m_admin->post= $this->input->post();
                if ( $this->m_admin->data_admin_update() ) {
                    $this->msg= [
                        'stats'=> 1,
                        'msg'=> 'Data Berhasil Diubah',
                    ];
                } else {
                    $this->msg= [
                        'stats'=> 0,
                        'msg'=> 'Data Gagal Diubah',
                    ];
                }
                echo json_encode($this->msg);
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
                $this->m_admin->username= $this->uri->segment(3);
                if ( $this->m_admin->data_admin_delete() ) {
                    $this->msg= [
                        'stats'=> 1,
                        'msg'=> 'Data Berhasil Dihapus',
                    ];
                } else {
                    $this->msg= [
                        'stats'=> 0,
                        'msg'=> 'Data Gagal Dihapus',
                    ];
                }
                echo json_encode($this->msg);
                
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
                $jk= "";
                foreach ($this->m_admin->guru_jk() as $key => $value) {
                    $jk .= '
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="jk" value="'.$value.'" required>'.($value=='L' ? 'Laki-Laki' : 'Perempuan' ).'
                            </label>
                        </div>
                    ';
                }

                $agama= "";
                foreach ($this->m_admin->guru_agama() as $key => $value) {
                    $agama .= '
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="agama" value="'.$value.'" required>'.$value.'
                            </label>
                        </div>
                    ';
                }

                $this->html= '
                <form action="'.base_url().'admin/data-guru-store" role="form" id="addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>NIP</label>
                        <input name="nip" type="text" class="form-control" placeholder="*) Masukan NIP" required="">
                    </div>
                    <div class="form-group">
                        <label>Nama Guru</label>
                        <input name="nama" type="text" class="form-control" placeholder="*) Masukan Nama" required="">
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
                        <input name="tempat_lahir" type="text" class="form-control" placeholder="*) Masukan Tempat Lahir" required="">
                    </div>
                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input name="tgl_lahir" type="date" class="form-control" placeholder="" required="">
                    </div>
                    <div class="form-group">
                        <label>No Telp</label>
                        <input name="telp" type="telp" class="form-control" placeholder="*) 08123456789" required="">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input name="email" type="text" class="form-control" placeholder="*) email@gmail.com" required="">
                    </div>
                    <div class="form-group">
                        <label>Alamat</label>
                        <textarea name="alamat" class="form-control" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Username</label>
                        <input name="username" type="text" class="form-control" placeholder="*) Masukan Username" required="">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input name="password" type="password" class="form-control" placeholder="**********" required="">
                    </div>
                    <div class="form-group">
                        <label>Upload Foto <small class="badge badge-info">*) type: JPG atau PNG</small></label>
                        <input name="fupload" type="file" class="form-control"  required="">
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
                $this->m_admin->username= $this->input->post('username');
                if ( $this->m_admin->cek_user() > 0 ) {
                    $this->msg= [
                        'stats'=> 0,
                        'msg'=> 'Maaf Username Sudah Digunakan',
                    ];
                } else {
                    $config['upload_path']          = 'src/guru/';
                    $config['allowed_types']        = 'jpg|png';
                    // $config['max_size']             = 1000000;
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
                        $this->m_admin->post= $this->input->post();
                        $this->m_admin->post['level']= 'guru';
                        $this->m_admin->post['gambar']= $this->upload->data()['file_name'];
                        if ( $this->m_admin->data_guru_store() ) {
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
                $this->m_admin->username= $this->uri->segment(3);
                $row= $this->m_admin->data_guru_edit();
                $jk= "";
                foreach ($this->m_admin->guru_jk() as $key => $value) {
                    $jk .= '
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input '.($value==$row->jk? 'checked' : null).' type="radio" class="form-check-input" name="jk" value="'.$value.'" required>'.($value=='L' ? 'Laki-Laki' : 'Perempuan' ).'
                            </label>
                        </div>
                    ';
                }

                $agama= "";
                foreach ($this->m_admin->guru_agama() as $key => $value) {
                    $agama .= '
                        <div class="form-check-inline">
                            <label class="form-check-label">
                                <input '.($value==$row->agama? 'checked' : null).' type="radio" class="form-check-input" name="agama" value="'.$value.'" required>'.$value.'
                            </label>
                        </div>
                    ';
                }

                $this->html= '
                <form action="'.base_url().'admin/data-guru-update" role="form" id="edit" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>NIP</label>
                        <input readonly value="'.$row->nip.'" name="nip" type="text" class="form-control" placeholder="*) Masukan NIP" required="">
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
                        <img class="d-block img-thumbnail" src="'.base_url('src/guru/'.$row->gambar).'">
                    </div>
                    <div class="form-group">
                        <label>Ganti Foto <small class="badge badge-info">*) type: JPG atau PNG</small></label>
                        <input name="fupload" type="file" class="form-control">
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

    public function data_guru_update()
    {
        switch ( $this->session->userdata('level') ) {
            case 'admin':
                # code...
                $this->m_admin->post= $this->input->post();
                if ( empty($_FILES['fupload']['tmp_name']) ) {
                    # code...without upload file
					if ( $this->m_admin->data_guru_update() ) {
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
					$this->m_admin->username= $this->input->post('username');
					$row= $this->m_admin->data_guru_edit();
					$config['upload_path']          = 'src/guru/';
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
						$this->m_admin->post['gambar']= $this->upload->data()['file_name'];
						if ( $this->m_admin->data_guru_update() ) {
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
				$this->m_admin->username= $this->uri->segment(3);
				$row= $this->m_admin->data_guru_edit();
				$config['upload_path']          = 'src/guru/';
				if ( file_exists($config['upload_path'].$row->gambar) ) {
					unlink($config['upload_path'].$row->gambar);
				}
				if ( $this->m_admin->data_guru_delete() ) {
					$this->msg= [
						'stats'=>1,
						'msg'=> 'Data Berhasil Dihapus',
					];
				} else {
					$this->msg= [
						'stats'=>0,
						'msg'=> 'Data Gagal Dihapus',
					];
				}
				echo json_encode($this->msg);
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