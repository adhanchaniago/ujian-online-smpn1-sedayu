<?php
class M_siswa extends CI_Model
{
    public $post= null;
/* ==================== Start Profil ==================== */
    public function data_siswa_edit()
    {
        return $this->db->query("
            SELECT *
            FROM siswa
                LEFT JOIN users
                    ON siswa.username=users.username
            WHERE siswa.username='{$this->username}'
        ")->row();
    }
    public function siswa_jk()
    {
        $query = " SHOW COLUMNS FROM `siswa` LIKE 'jk' ";
        $row = $this->db->query(" {$query} ")->row()->Type;
        $regex = "/'(.*?)'/";
        preg_match_all( $regex , $row, $enum_array );
        $enum_fields = $enum_array[1];
        return( $enum_fields );
    }
    public function siswa_agama()
    {
        $query = " SHOW COLUMNS FROM `siswa` LIKE 'agama' ";
        $row = $this->db->query(" {$query} ")->row()->Type;
        $regex = "/'(.*?)'/";
        preg_match_all( $regex , $row, $enum_array );
        $enum_fields = $enum_array[1];
        return( $enum_fields );
    }
    public function data_siswa_update()
    {
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
        return $this->db->update('siswa',$data,$where);
    }

    # update user
    public function user_update()
    {
        return $this->db->update('users',[
            'password'=> md5($this->post['password']),
        ],['username'=>$this->post['username'] ]);
    }
/* ==================== End Profil ==================== */
}
