<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mutasi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('data_model');
        date_default_timezone_set("Asia/Jakarta");
        if($this->session->userdata('login_form') != "akses-as1563sd1679dsad8789asff53afhafaf670fa"){
            redirect(base_url("login"));
        }
    }
    function index(){
            echo 'Invalid token';
    } //end
    function create_mutasi(){
        $setup = $this->data_model->get_byid('table_settings', ['id_setup'=>1])->row_array();
        $data = array(
            'title' => 'Buat Mutasi Stok',
            'sess_nama' => $this->session->userdata('nama'),
            'sess_id' => $this->session->userdata('id'),
            'sess_username' => $this->session->userdata('username'),
            'sess_password' => $this->session->userdata('password'),
            'sess_akses' => $this->session->userdata('akses'),
            'setup' => $setup,
            'produk' => $this->data_model->getProduk(),
            'autocomplet' => 'mutasi',
            'codeProses' => $this->data_model->acakKode(13)
        );
        $this->load->view('part/main_head', $data);
        $this->load->view('part/left_sidebar', $data);
        $this->load->view('datapage/create_mutasi', $data);
        $this->load->view('part/main_jsmutasi', $data);
    } //end
}
?>