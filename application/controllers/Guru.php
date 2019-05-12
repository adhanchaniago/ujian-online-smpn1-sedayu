<?php 
class Guru extends MY_Controller{
	function __construct(){
        parent::__construct();
		
		if($this->session->userdata('status') != "login" || $this->session->userdata('level') != "guru"){
			redirect(base_url('auth'));
		}
		
        $this->load->model('m_guru');
        
		$msg= null;
		$html= null;
		$json= null;
    }

    public function index()
    {
        $this->view= 'guru/index';
        $this->render_pages();
    }

    // start users controller


    public function form_data_guru_edit()
    {
        $this->m_guru->username= $this->session->userdata('username');
        $row= $this->m_guru->data_guru_edit();
        $jk= "";
        foreach ($this->m_guru->guru_jk() as $key => $value) {
            $jk .= '
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input '.($value==$row->jk? 'checked' : null).' type="radio" class="form-check-input" name="jk" value="'.$value.'" required>'.($value=='L' ? 'Laki-Laki' : 'Perempuan' ).'
                    </label>
                </div>
            ';
        }

        $agama= "";
        foreach ($this->m_guru->guru_agama() as $key => $value) {
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
    }

    public function data_guru_update()
    {
        $this->m_guru->post= $this->input->post();
        if ( empty($_FILES['fupload']['tmp_name']) ) {
            # code...without upload file
            if ( $this->m_guru->data_guru_update() ) {
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
            $this->m_guru->username= $this->input->post('username');
            $row= $this->m_guru->data_guru_edit();
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
                $this->m_guru->post['gambar']= $this->upload->data()['file_name'];
                if ( $this->m_guru->data_guru_update() ) {
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


    public function data_profil()
    {
        $this->m_guru->username= $this->session->userdata('username');

        $this->content['row']   = $this->m_guru->data_guru_edit();
        $this->content['jk']    = $this->m_guru->guru_jk();
        $this->content['agama'] = $this->m_guru->guru_agama();
        
        $this->view= 'guru/profil';
        $this->render_pages();
    }
    // end users controller

    public function data_grup_soal()
    {
        $this->view= 'guru/data_grup_soal';
        $this->content['rows']= $this->m_guru->data_grup_soal();
        $this->render_pages();
    }

    public function form_data_grup_soal()
    {
        $pelajaran= "";
        foreach ($this->m_guru->data_grup_soal_pelajaran() as $key => $value) {
            $pelajaran .= '<option value="'.$value->id_pelajaran.'">('.$value->nama_kelas.') '.$value->nama_pelajaran.'</option>';
        }

        $this->html= '
        <form action="'.base_url().'admin/data-grup-soal-store" role="form" id="addNew" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Nama Grup Soal</label>
                <input name="nama_grup_soal" type="text" class="form-control" placeholder="*) Masukan Nama Grup Soal" required="">
            </div>
            <div class="form-group">
                <label>Jenis Kelamin</label>
                <select name="id_pelajaran" class="form-control" required>
                    <option value="" selected disabled> -- Pilih Pelajaran -- </option>
                    '.$pelajaran.'
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Publish</button>
        </form>
        ';
        echo $this->html;
    }

    public function data_grup_soal_store()
    {
        $this->m_guru->post= $this->input->post();
        if ( $this->m_guru->data_grup_soal_store() ) {
            $this->msg= [
                'stats'=>1,
                'msg'=>'Data Berhasil Ditambahkan',
            ];
        } else {
            $this->msg= [
                'stats'=>1,
                'msg'=>'Data Berhasil Ditambahkan',
            ];
        }
        echo json_encode($this->msg);
    }

    public function data_soal()
    {
        $this->content['rows']= $this->m_guru->data_soal();
        $this->view= 'guru/data_soal';
        $this->render_pages();
    }

    public function form_data_soal()
    {
        $grup_soal= "";
        foreach ($this->m_guru->data_soal_grup_soal() as $key => $value) {
            $grup_soal .= '<option value="'.$value->id_grup_soal.'">'.$value->nama_grup_soal.' ('.$value->nama_kelas.') '.$value->nama_pelajaran.'</option>';
        }

        // $jawaban= 
        $jawaban= "";
        foreach ($this->m_guru->soal_jawaban() as $key => $value) {
            $jawaban .= '
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="jawaban" value="'.$value.'" required>'.$value.'
                    </label>
                </div>
            ';
        }

        $this->html= '
        <form action="'.base_url().'admin/data-soal-store" role="form" id="addNew" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Soal</label>
                <textarea name="soal" class="form-control" rows="5" required="" placeholder="*) Masukan Soal"></textarea>
            </div>
            <div class="form-group">
                <label>Pilihan A</label>
                <textarea name="a" class="form-control" rows="5" required="" placeholder="*) Masukan Pilihan A"></textarea>
            </div>
            <div class="form-group">
                <label>Pilihan B</label>
                <textarea name="b" class="form-control" rows="5" required="" placeholder="*) Masukan Pilihan B"></textarea>
            </div>
            <div class="form-group">
                <label>Pilihan C</label>
                <textarea name="c" class="form-control" rows="5" required="" placeholder="*) Masukan Pilihan C"></textarea>
            </div>
            <div class="form-group">
                <label>Pilihan D</label>
                <textarea name="d" class="form-control" rows="5" required="" placeholder="*) Masukan Pilihan D"></textarea>
            </div>
            <div class="form-group">
                <label>Pilih Grup Soal</label>
                <select name="id_grup_soal" class="form-control" required>
                    <option value="" selected disabled> -- Pilih Grup Soal -- </option>
                    '.$grup_soal.'
                </select>
            </div>
            <div class="form-group">
                <div class="form-group">
                    <label>Jawaban Benar</label>
                    <div class="form-group">
                        '.$jawaban.'
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Publish</button>
        </form>
        ';
        echo $this->html;
    }

    public function data_soal_store()
    {
        $this->m_guru->post= $this->input->post();
        if ( $this->m_guru->data_soal_store() ) {
            $this->msg= [
                'stats'=>1,
                'msg'=>'Data Berhasil Ditambahkan',
            ];
        } else {
            $this->msg= [
                'stats'=>1,
                'msg'=>'Data Berhasil Ditambahkan',
            ];
        }
        echo json_encode($this->msg);
    }

    public function form_data_soal_edit()
    {
        $this->m_guru->id_soal= $this->uri->segment(3);
        $row= $this->m_guru->data_soal_edit();
        $grup_soal= "";
        foreach ($this->m_guru->data_soal_grup_soal() as $key => $value) {
            $grup_soal .= '<option '.($value==$row->id_grup_soal? 'selected' : null).' value="'.$value->id_grup_soal.'">'.$value->nama_grup_soal.' ('.$value->nama_kelas.') '.$value->nama_pelajaran.'</option>';
        }

        // $jawaban= 
        $jawaban= "";
        foreach ($this->m_guru->soal_jawaban() as $key => $value) {
            $jawaban .= '
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input '.($value==$row->jawaban? 'checked' : null).' type="radio" class="form-check-input" name="jawaban" value="'.$value.'" required>'.$value.'
                    </label>
                </div>
            ';
        }

        $this->html= '
        <form action="'.base_url().'admin/data-soal-update" role="form" id="edit" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>Soal</label>
                <textarea name="soal" class="form-control" rows="5" required="" placeholder="*) Masukan Soal">'.$row->soal.'</textarea>
            </div>
            <div class="form-group">
                <label>Pilihan A</label>
                <textarea name="a" class="form-control" rows="5" required="" placeholder="*) Masukan Pilihan A">'.$row->a.'</textarea>
            </div>
            <div class="form-group">
                <label>Pilihan B</label>
                <textarea name="b" class="form-control" rows="5" required="" placeholder="*) Masukan Pilihan B">'.$row->b.'</textarea>
            </div>
            <div class="form-group">
                <label>Pilihan C</label>
                <textarea name="c" class="form-control" rows="5" required="" placeholder="*) Masukan Pilihan C">'.$row->c.'</textarea>
            </div>
            <div class="form-group">
                <label>Pilihan D</label>
                <textarea name="d" class="form-control" rows="5" required="" placeholder="*) Masukan Pilihan D">'.$row->d.'</textarea>
            </div>
            <div class="form-group">
                <label>Pilih Grup Soal</label>
                <select name="id_grup_soal" class="form-control" required>
                    <option value="" disabled> -- Pilih Grup Soal -- </option>
                    '.$grup_soal.'
                </select>
            </div>
            <div class="form-group">
                <div class="form-group">
                    <label>Jawaban Benar</label>
                    <div class="form-group">
                        '.$jawaban.'
                    </div>
                </div>
            </div>
            <input value="'.$row->id_soal.'" type="hidden" name="id_soal">
            <button type="submit" class="btn btn-primary">Publish</button>
        </form>
        ';
        echo $this->html;
    }

    public function data_soal_update()
    {
        $this->m_guru->post= $this->input->post();
        if ( $this->m_guru->data_soal_update() ) {
            $this->msg= [
                'stats'=>1,
                'msg'=>'Data Berhasil Diubah',
            ];
        } else {
            $this->msg= [
                'stats'=>1,
                'msg'=>'Data Berhasil Diubah',
            ];
        }
        echo json_encode($this->msg);
    }
}