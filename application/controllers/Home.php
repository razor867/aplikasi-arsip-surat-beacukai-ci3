<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_login');

        function cekInput($data, $cat)
        {
            if (empty($data)) {
                die(showError('kosong'));
            }
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            $pattern = '/^[a-zA-Z0-9 ]*$/'; //pattern untuk username (hanya huruf, spasi, dan angka)
            $pattern2 = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/';
            //pattern2 Input Password and Submit [8 to 15 characters 
            //which contain at least one lowercase letter, one uppercase letter, 
            //one numeric digit, and one special character]

            if ($cat == 'user') {
                if (!preg_match($pattern, $data)) {
                    die(showError('gagal'));
                }
            } else {
                if (!preg_match($pattern2, $data)) {
                    die(showError('gagal'));
                }
            }
            return $data;
        }

        function showError($tipe)
        {
            if ($tipe == 'kosong') {
                $pesan = 'Form tidak boleh kosong';
            } else {
                $pesan = 'Username dan Password salah';
            }
            echo "<script>alert('" . $pesan . "');</script>";
            echo "<meta http-equiv='refresh' content='0; url=" . base_url('home/login') . "'>";
        }
    }

    public function index()
    {
        if ($this->session->userdata('status') != 'berhasil') {
            $statusLogin = 'Login';
            $linkLogin = base_url('home/login');
        } else {
            $statusLogin = 'Akun';
            $linkLogin = base_url('akun');
        }
        $data = array(
            'statusLogin' => $statusLogin,
            'linkLogin' => $linkLogin
        );

        $this->load->view('templates/header', $data);
        $this->load->view('pages/home/index');
        $this->load->view('templates/footer');
    }

    public function login()
    {
        $this->load->view('pages/home/login');
    }

    public function cekLogin()
    {
        if (isset($_POST['submit'])) {
            $dataForm = array(
                'user' => cekInput($this->input->post('user'), 'user'),
                'pass' => md5(cekInput($this->input->post('pass'), 'pass'))
            );
            $data = $this->m_login->login('login', $dataForm);
            if ($data->num_rows() > 0) {
                $data = $data->result();
                foreach ($data as $d) {
                    $data_session = array(
                        'user' => $d->user,
                        'cat' => $d->cat,
                        'status' => 'berhasil'
                    );
                }
                $this->session->set_userdata($data_session);
                redirect(base_url('akun'));
            } else {
                die(showError('gagal'));
            }
        }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('home/login'));
    }
}
