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
/* ==================== End Profil ==================== */
}
