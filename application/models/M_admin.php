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
    public function data_admin()
    {
        switch ($this->session->userdata('level')) {
            case 'admin':
                # code...
                return $this->db->query("
                    SELECT * FROM admin
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

    public function data_admin_edit()
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
    
    public function data_admin_update()
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
    
    public function data_admin_delete()
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

    public function data_guru_edit()
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
    
    public function data_guru_update()
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
    
    public function data_guru_delete()
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