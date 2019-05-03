<?php
class Auth extends CI_Controller{
 
    function __construct(){
        parent::__construct();		
        $this->load->model('m_auth');

    }

    function index(){
        $this->load->view('login');
    }

    function process(){
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        
        $where_admin = array(
            'username' => $username,
            'password' => $password
        );
        $where_guru = array(
            'username' => $username,
            'password' => $password
        );
        $where_siswa = array(
            'username' => $username,
            'password' => $password
        );

        $cek_admin  = $this->m_auth->check_auth("admin",$where_admin)->num_rows();
        $cek_guru   = $this->m_auth->check_auth("guru",$where_guru)->num_rows();
        $cek_siswa  = $this->m_auth->check_auth("siswa",$where_siswa)->num_rows();
        
        if ( $cek_admin > 0 ) {
            # code...
            $row  = $this->m_auth->check_auth("admin",$where_admin)->row();
            $data_session = array(
                'id' => $row->id_admin,
                'username'  => $username,
                'password'  => $password,
                'fullname'  => $row->nama,
                'email'     => $row->email,
                'status'    => "login",
                'level'     => 'admin'
            );
            
            $this->session->set_userdata($data_session);
            
            redirect(base_url("admin/beranda"));
        }

        else{
            // login error
            // redirect(base_url("login-error"));
            $this->load->view('login_error');
        }
    }

    function logout(){
        $this->session->sess_destroy();
        redirect(base_url('auth'));
    }
}