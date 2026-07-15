<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Pegawai_model');
        $this->load->model('Divisi_model');
    }

    // GET /pegawai -> tampilkan daftar pegawai (bisa difilter dengan ?keyword=...)
    public function index()
    {
        $keyword = $this->input->get('keyword', TRUE);

        $data['title']   = 'Data Pegawai';
        $data['pegawai'] = $this->Pegawai_model->get_all($keyword);
        $data['keyword'] = $keyword; // dikirim balik ke view supaya kotak search tetap terisi
        $this->load->view('pegawai/index', $data);
    }

    // GET /pegawai/create -> tampilkan form tambah
    public function create()
    {
        $data['title']  = 'Tambah Pegawai';
        $data['divisi'] = $this->Divisi_model->get_all();
        $this->load->view('pegawai/create', $data);
    }

    // POST /pegawai/store -> simpan data baru
    public function store()
    {
        // Validasi input
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
        $this->form_validation->set_rules('divisi_id', 'Divisi', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[pegawai.email]');

        $this->form_validation->set_message('required', '{field} wajib diisi.');
        $this->form_validation->set_message('valid_email', 'Format {field} tidak valid.');
        $this->form_validation->set_message('is_unique', 'Email ini sudah dipakai pegawai lain, gunakan email lain.');

        if ($this->form_validation->run() === FALSE) {
            $data['title']  = 'Tambah Pegawai';
            $data['divisi'] = $this->Divisi_model->get_all();
            $this->load->view('pegawai/create', $data);
            return;
        }

        $data = [
            'nama'      => $this->input->post('nama', TRUE),
            'jabatan'   => $this->input->post('jabatan', TRUE),
            'email'     => $this->input->post('email', TRUE),
            'no_hp'     => $this->input->post('no_hp', TRUE),
            'divisi_id' => $this->input->post('divisi_id', TRUE),
        ];

        $this->Pegawai_model->insert($data);
        $this->session->set_flashdata('success', 'Data pegawai berhasil ditambahkan.');
        redirect('pegawai');
    }

    // GET /pegawai/edit/(id) -> tampilkan form edit
    public function edit($id)
    {
        $pegawai = $this->Pegawai_model->get_by_id($id);

        if (!$pegawai) {
            show_404();
        }

        $data['title']   = 'Edit Pegawai';
        $data['pegawai'] = $pegawai;
        $data['divisi']  = $this->Divisi_model->get_all();
        $this->load->view('pegawai/edit', $data);
    }

    // POST /pegawai/update/(id) -> simpan perubahan
    public function update($id)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required');
        $this->form_validation->set_rules('divisi_id', 'Divisi', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_check_email_unique[' . $id . ']');

        $this->form_validation->set_message('required', '{field} wajib diisi.');
        $this->form_validation->set_message('valid_email', 'Format {field} tidak valid.');
        $this->form_validation->set_message('check_email_unique', 'Email ini sudah dipakai pegawai lain, gunakan email lain.');

        if ($this->form_validation->run() === FALSE) {
            $data['title']   = 'Edit Pegawai';
            $data['pegawai'] = $this->Pegawai_model->get_by_id($id);
            $data['divisi']  = $this->Divisi_model->get_all();
            $this->load->view('pegawai/edit', $data);
            return;
        }

        $data = [
            'nama'      => $this->input->post('nama', TRUE),
            'jabatan'   => $this->input->post('jabatan', TRUE),
            'email'     => $this->input->post('email', TRUE),
            'no_hp'     => $this->input->post('no_hp', TRUE),
            'divisi_id' => $this->input->post('divisi_id', TRUE),
        ];

        $this->Pegawai_model->update($id, $data);
        $this->session->set_flashdata('success', 'Data pegawai berhasil diperbarui.');
        redirect('pegawai');
    }

    // GET /pegawai/delete/(id) -> hapus data
    public function delete($id)
    {
        $this->Pegawai_model->delete($id);
        $this->session->set_flashdata('success', 'Data pegawai berhasil dihapus.');
        redirect('pegawai');
    }

    // Callback validasi: cek email unik saat UPDATE (exclude id pegawai yang sedang diedit)
    public function check_email_unique($email, $id)
    {
        return ! $this->Pegawai_model->email_exists_except($email, $id);
    }
}