<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Akun extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        if ($this->session->userdata('status') != 'berhasil') {
            redirect(base_url('home/login'));
        }

        $this->load->model('m_data');

        function cekInput($data, $table, $info = '')
        {
            $pattern = '/^[a-zA-Z0-9 ]*$/'; //pattern untuk username (hanya huruf, spasi, dan angka)
            $pattern2 = '/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/'; //for pass
            // $pattern3 = '/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4}$/'; //for date
            $pattern3 = '/^[0-9]{4}-[0-9]{1,2}-[0-9]{1,2}$/'; //for date yyyy-mm-dd

            if (empty($data)) {
                die(showError('kosong', $table));
            }
            $data = stripslashes($data);
            $data = htmlspecialchars($data);

            if ($info == 'pass') { //validasi password beres
                if (!preg_match($pattern2, $data)) {
                    die(showError('gagal', $table));
                }
            } elseif ($info == 'tanggal') { //validasi tanggal beres
                if (!preg_match($pattern3, $data)) {
                    die(showError('gagal', $table));
                }
            } else {
                if (!preg_match($pattern, $data)) { //validasi selain password beres
                    die(showError('gagal', $table));
                }
            }
            return $data;
        }

        function showError($tipe, $table)
        {
            if ($tipe == 'kosong') {
                $pesan = 'Form tidak boleh kosong';
            } elseif ($tipe == 'gagal upload') {
                $pesan = 'Gagal upload file, inputan tidak dapat diproses';
            } elseif ($tipe == 'gagal hapus') {
                $pesan = 'Gagal hapus file';
            } else {
                $pesan = 'Inputan tidak dapat diproses';
            }
            refresh($pesan, $table);
        }

        function notif($cek, $info, $table)
        {
            if ($cek == 1) {
                $hasil = 'berhasil ';
            } else {
                $hasil = 'gagal ';
            }
            $pesan = 'Data ' . $hasil . $info;
            refresh($pesan, $table);
        }

        function refresh($pesan, $table)
        {
            if ($table == 'login') {
                $url = 'akun/index';
            } elseif ($table == 'surat_masuk') {
                $url = 'akun/index/suratmasuk';
            } elseif ($table == 'surat_keluar') {
                $url = 'akun/index/suratkeluar';
            } elseif ($table == 'nd_masuk') {
                $url = 'akun/index/ndmasuk';
            } else {
                $url = 'akun/index/ndkeluar';
            }

            echo "<script>alert('" . $pesan . "');</script>";
            echo "<meta http-equiv='refresh' content='0; url=" . base_url($url) . "'>";
        }
    }

    public function index($tipe = 'suratmasuk')
    {
        $data['cat'] = $this->session->userdata('cat');
        $data['user'] = $this->session->userdata('user');

        if ($data['cat'] == 'Admin') {
            $data['title_table'] = 'Daftar Pengguna';
            $table = 'login';
            $page = 'pages/akun/admin/index';
            $data['data_table'] = $this->m_data->AllData($table)->result();
        } else {
            if ($tipe == 'suratmasuk') {
                $data['title_table'] = 'Daftar Surat Masuk';
                $table = 'surat_masuk';
            } elseif ($tipe == 'suratkeluar') {
                $data['title_table'] = 'Daftar Surat Keluar';
                $table = 'surat_keluar';
            } elseif ($tipe == 'ndmasuk') {
                $data['title_table'] = 'Daftar ND Masuk';
                $table = 'nd_masuk';
            } else {
                $data['title_table'] = 'Daftar ND Keluar';
                $table = 'nd_keluar';
            }
            $page = 'pages/akun/operator/index';
            $where = array(
                'penginput' => $data['user'],
                'milik' => $data['cat']
            );
            $data['data_table'] = $this->m_data->byData($table, $where)->result();
            $data['folder'] = $table;
        }

        $this->load->view('templates/headerakun', $data);
        $this->load->view($page);
        $this->load->view('templates/footer');
    }

    public function tambah($table)
    {
        $data['user'] = $this->session->userdata('user');
        $data['cat'] = $this->session->userdata('cat');

        if ($table == 'surat_masuk' || $table == 'nd_masuk') {
            $asalTujuan = 'asal';
        } else {
            $asalTujuan = 'tujuan';
        }

        if ($data['cat'] == 'Admin') {
            if (isset($_POST['submit'])) {
                $dataInput = array(
                    'user'  => cekInput($this->input->post('username'), $table),
                    'pass'  => md5(cekInput($this->input->post('password'), $table, 'pass')),
                    'cat'   => cekInput($this->input->post('departemen'), $table)
                );
            }
        } else {
            if (isset($_POST['submit'])) {
                $dataInput = array(
                    'nomor_srt'     => cekInput($this->input->post('nosurat'), $table),
                    'tanggal'       => cekInput($this->input->post('tanggal'), $table, 'tanggal'), //wajib divalidasi
                    'agenda'        => cekInput($this->input->post('agenda'), $table),
                    $asalTujuan     => cekInput($this->input->post('asaltujuan'), $table),
                    'perihal'       => cekInput($this->input->post('perihal'), $table),
                    'milik'         => $data['cat'],
                    'penginput'     => $data['user']
                );
            }
            //validasi input file
            if (empty($_FILES['filesurat']['name'])) {
                die(showError('kosong', $table));
            } else {
                $file = $this->uploadFile('filesurat', $table);
                if ($file == 'gagal upload') {
                    die(showError($file, $table));
                } else {
                    $dataInput['nama_file_srt'] = $file;
                }
            }
        }
        $cek = $this->m_data->tambah($table, $dataInput);
        notif($cek, 'ditambahkan', $table);
    }

    public function getData()
    {
        $table = $this->input->post('table');
        $data = array(
            'id' => $this->input->post('id')
        );
        echo json_encode($this->m_data->byData($table, $data)->result());
    }

    public function edit($id, $table)
    {
        if ($table == 'surat_masuk' || $table == 'nd_masuk') {
            $asalTujuan = 'asal';
        } else {
            $asalTujuan = 'tujuan';
        }

        $data['user'] = $this->session->userdata('user');
        $data['cat'] = $this->session->userdata('cat');

        if ($data['cat'] == 'Admin') {
            if (isset($_POST['submit'])) {
                $dataInput = array(
                    'user'  => cekInput($this->input->post('username'), $table),
                    'pass'  => md5(cekInput($this->input->post('password'), $table, 'pass')),
                    'cat'   => cekInput($this->input->post('departemen'), $table)
                );
            }
        } else {
            if (isset($_POST['submit'])) {
                $dataInput = array(
                    'nomor_srt'     => cekInput($this->input->post('nosurat'), $table),
                    'tanggal'       => cekInput($this->input->post('tanggal'), $table, 'tanggal'),
                    'agenda'        => cekInput($this->input->post('agenda'), $table),
                    $asalTujuan     => cekInput($this->input->post('asaltujuan'), $table),
                    'perihal'       => cekInput($this->input->post('perihal'), $table)
                );
            }
            //validasi input file
            if (!empty($_FILES['filesurat']['name'])) {
                //hapus filenya dulu
                $dataFile = './uploads/' . $table . '/' . $this->input->post('info');
                if (!unlink($dataFile)) {
                    die(showError('gagal upload', $table));
                }
                //upload file yg baru
                $cek = $this->uploadFile('filesurat', $table);
                if ($cek == 'gagal upload') {
                    die(showError($cek, $table));
                } else {
                    $dataInput['nama_file_srt'] = $cek;
                }
            }
        }
        $cek = $this->m_data->edit($table, $dataInput, $id);
        notif($cek, 'dirubah', $table);
    }

    public function hapus($id, $table)
    {
        $data = array(
            'id' => $id
        );
        $cat = $this->session->userdata('cat');
        if ($cat != 'Admin') {
            $file = $this->m_data->byData($table, $data)->result();
            foreach ($file as $f) {
                $dataFile = './uploads/' . $table . '/' . $f->nama_file_srt;
            }
            if (!unlink($dataFile)) {
                die(showError('gagal hapus', $table));
            }
        }
        $cek = $this->m_data->hapus($table, $data);
        notif($cek, 'dihapus', $table);
    }

    public function uploadFile($data, $table)
    {
        $config['upload_path']          = './uploads/' . $table;
        $config['allowed_types']        = 'pdf';
        $config['max_size']             = 1024;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload($data)) {
            // $error = array('error' => $this->upload->display_errors());

            // $this->load->view('upload_form', $error);
            $pesan = 'gagal upload';
            return $pesan;
        } else {
            // $data = array('upload_data' => $this->upload->data('file_name'));

            // $this->load->view('upload_success', $data);
            return $this->upload->data('file_name');
        }
    }
}
