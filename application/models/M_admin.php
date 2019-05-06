<?php 
class M_admin extends CI_Model{
/* 
    public function data()
    {
        switch ($this->session->userdata('level')) {
            case 'admin':
                # code...
                return $this->db->query("
                    SELECT * FROM table
                ")->result_object();
                break;
            
            default:
                # code...
                return NULL;
                break;
        }
    }
        
    public function data_store()
    {
        switch ($this->session->userdata('level')) {
            case 'admin':
                # code...
                $data= [
                    'name'=>$this->post['name']
                ];
                return $this->db->insert('table',$data);
                break;
            
            default:
                # code...
                return NULL;
                break;
        }
    }

    public function data_edit()
    {
        switch ($this->session->userdata('level')) {
            case 'admin':
                # code...
                return $this->db->query("
                    SELECT * FROM table WHERE id='{$this->id}'
                ")->row();
                break;
            
            default:
                # code...
                return NULL;
                break;
        }
    }

    public function data_update()
    {
        switch ($this->session->userdata('level')) {
            case 'admin':
                # code...
                $data= [
                    'name'=>$this->post['name'],
                ];
                $where= [
                    'id'=>$this->post['id'],
                ];
                return $this->db->update('table',$data,$where);
                break;
            
            default:
                # code...
                return NULL;
                break;
        }
    }
    
    public function data_delete()
    {
        switch ($this->session->userdata('level')) {
            case 'admin':
                # code...
                $where= [
                    'id'=>$this->post['id'],
                ];
                return $this->db->delete('table',$where);
                break;
            
            default:
                # code...
                return NULL;
                break;
        }
    }
*/	
    public function cek_user()
    {
        return $this->db->query("SELECT * FROM users WHERE username='{$this->username}' ")->num_rows();
    }
    public function user_store()
    {
        return $this->db->insert('users',[
            'username'=>$this->post['username'],
            'password'=> md5($this->post['password']),
            'level'=> $this->post['level'],
            'blok'=> 'N',
        ]);
    }
    public function user_update()
    {
        return $this->db->update('users',[
            'password'=> md5($this->post['password']),
        ],['username'=>$this->post['username'] ]);
    }

    public function guru_jk()
    {
        $query = " SHOW COLUMNS FROM `guru` LIKE 'jk' ";
        $row = $this->db->query(" {$query} ")->row()->Type;
        $regex = "/'(.*?)'/";
        preg_match_all( $regex , $row, $enum_array );
        $enum_fields = $enum_array[1];
        return( $enum_fields );
    }

    public function guru_agama()
    {
        $query = " SHOW COLUMNS FROM `guru` LIKE 'agama' ";
        $row = $this->db->query(" {$query} ")->row()->Type;
        $regex = "/'(.*?)'/";
        preg_match_all( $regex , $row, $enum_array );
        $enum_fields = $enum_array[1];
        return( $enum_fields );
    }

    public function data_admin()
    {
        switch ($this->session->userdata('level')) {
            case 'admin':
                # code...
                return $this->db->query("
                    SELECT *,
                        IF(admin.username='{$this->session->userdata('username')}',FALSE,TRUE) AS del
                    FROM admin
                        LEFT JOIN users
                            ON admin.username=users.username
                ")->result_object();
                break;
            
            default:
                # code...
                return NULL;
                break;
        }
    }
    
    public function data_admin_store()
    {
        switch ($this->session->userdata('level')) {
            case 'admin':
                # code...
                if ( $this->user_store() ) {
                    $admin_store= $this->db->insert('admin', [
                        'username' => $this->post['username'],
                        'nama' => $this->post['nama'],
                        'alamat' => $this->post['alamat'],
                        'no_telp' => $this->post['telp'],
                        'email' => $this->post['email'],
                    ]);

                    if ( $admin_store )
                        return TRUE;
                    else
                        return FALSE;
                    
                } else {
                    return FALSE;
                }
                
                break;
            
            default:
                # code...
                return NULL;
                break;
        }
    }

    public function data_admin_edit()
    {
        switch ($this->session->userdata('level')) {
            case 'admin':
                # code...
                return $this->db->query("
                    SELECT *
                    FROM admin
                        LEFT JOIN users
                            ON admin.username=users.username
                    WHERE admin.username='{$this->username}'
                ")->row();
                break;
            
            default:
                # code...
                return NULL;
                break;
        }
    }
    
    public function data_admin_update()
    {
        switch ($this->session->userdata('level')) {
            case 'admin':
                # code...
                if ( ! empty($this->post['password']) ) {
                    $this->user_update();
                } 
                
                $data= [
                    'nama'=>$this->post['nama'],
                    'alamat'=>$this->post['alamat'],
                    'no_telp'=>$this->post['telp'],
                    'email'=>$this->post['email'],
                ];
                $where= [
                    'username'=>$this->post['username'],
                ];
                return $this->db->update('admin',$data,$where);
                break;
            
            default:
                # code...
                return NULL;
                break;
        }
    }
    
    public function data_admin_delete()
    {
        switch ($this->session->userdata('level')) {
            case 'admin':
                # code...
                return $this->db->query("
                    DELETE users , admin
                    FROM users
                        INNER JOIN admin  
                    WHERE users.username= admin.username AND users.username = '{$this->username}'
                ");
                break;
            
            default:
                # code...
                return NULL;
                break;
        }
    }

    public function data_guru()
    {
        switch ($this->session->userdata('level')) {
            case 'admin':
                # code...
                return $this->db->query("
                    SELECT *,
                        IF(guru.jk='L','Laki-Laki','Perempuan') AS gender
                    FROM guru
                        LEFT JOIN users
                            ON guru.username=users.username
                ")->result_object();
                break;
            
            default:
                # code...
                return NULL;
                break;
        }
    }
    
    public function data_guru_store()
    {
        switch ($this->session->userdata('level')) {
            case 'admin':
            # code...
            if ( $this->user_store() ) {
                $admin_store= $this->db->insert('guru', [
                    'nip' => $this->post['nip'],
                    'username' => $this->post['username'],
                    'nama' => $this->post['nama'],
                    'alamat' => $this->post['alamat'],
                    'tempat_lahir' => $this->post['tempat_lahir'],
                    'tgl_lahir' => $this->post['tgl_lahir'],
                    'agama' => $this->post['agama'],
                    'no_telp' => $this->post['telp'],
                    'email' => $this->post['email'],
                    'gambar' => $this->post['gambar'],
                    'jk' => $this->post['jk'],
                ]);

                if ( $admin_store )
                    return TRUE;
                else
                    return FALSE;
                
            } else {
                return FALSE;
            }
            break;
            
            default:
            # code...
            return NULL;
            break;
        }
    }

    public function data_guru_edit()
    {
        switch ($this->session->userdata('level')) {
            case 'admin':
                # code...
                return $this->db->query("
                    SELECT *
                    FROM guru
                        LEFT JOIN users
                            ON guru.username=users.username
                    WHERE guru.username='{$this->username}'
                ")->row();
                break;
            
            default:
                # code...
                return NULL;
                break;
        }
    }
    
    public function data_guru_update()
    {
        switch ($this->session->userdata('level')) {
            case 'admin':
                # code...
                if ( ! empty($this->post['password']) ) {
                    $this->user_update();
                } 
                
                $data= [
                    'nama'=>$this->post['nama'],
                    'alamat'=>$this->post['alamat'],
                    'tempat_lahir'=>$this->post['tempat_lahir'],
                    'tgl_lahir'=>$this->post['tgl_lahir'],
                    'agama'=>$this->post['agama'],
                    'no_telp'=>$this->post['telp'],
                    'email'=>$this->post['email'],
                    'jk'=>$this->post['jk'],
                ];
                
                if ( ! empty($this->post['gambar']) ) {
                    $data['gambar']= $this->post['gambar'];
                }

                $where= [
                    'username'=>$this->post['username'],
                ];
                return $this->db->update('guru',$data,$where);
                break;
            
            default:
                # code...
                return NULL;
                break;
        }
    }
    
    public function data_guru_delete()
    {
        switch ($this->session->userdata('level')) {
            case 'admin':
                # code...
                return $this->db->query("
                    DELETE users , guru
                    FROM users
                        INNER JOIN guru  
                    WHERE users.username= guru.username AND users.username = '{$this->username}'
                ");
                break;
            
            default:
                # code...
                return NULL;
                break;
        }
    }

    public function data_siswa()
    {
        switch ($this->session->userdata('level')) {
            case 'admin':
                # code...
                return $this->db->query("
                    SELECT *,
                        IF(siswa.jk='L','Laki-Laki','Perempuan') AS gender
                    FROM siswa
                        LEFT JOIN users
                            ON siswa.username=users.username
                ")->result_object();
                break;
            
            default:
                # code...
                return NULL;
                break;
        }
    }
    
    public function data_siswa_store()
    {
        switch ($this->session->userdata('level')) {
            case 'admin':
            # code...
            $data= [
                'name'=>$this->post['name']
            ];
            return $this->db->insert('table',$data);
            break;
            
            default:
            # code...
            return NULL;
            break;
        }
    }

    public function data_siswa_edit()
    {
        switch ($this->session->userdata('level')) {
            case 'admin':
                # code...
                return $this->db->query("
                    SELECT * FROM table WHERE id='{$this->id}'
                ")->row();
                break;
            
            default:
                # code...
                return NULL;
                break;
        }
    }
    
    public function data_siswa_update()
    {
        switch ($this->session->userdata('level')) {
            case 'admin':
                # code...
                $data= [
                    'name'=>$this->post['name'],
                ];
                $where= [
                    'id'=>$this->post['id'],
                ];
                return $this->db->update('table',$data,$where);
                break;
            
            default:
                # code...
                return NULL;
                break;
        }
    }
    
    public function data_siswa_delete()
    {
        switch ($this->session->userdata('level')) {
            case 'admin':
                # code...
                $where= [
                    'id'=>$this->post['id'],
                ];
                return $this->db->delete('table',$where);
                break;
            
            default:
                # code...
                return NULL;
                break;
        }
    }

}