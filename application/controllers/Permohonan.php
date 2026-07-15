<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permohonan extends CI_Controller
{
    private $tujuan_options = ['Permintaan', 'Aduan', 'Penelitian'];

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Permohonan_model');
    }

    public function index()
    {
        $keyword = $this->input->get('keyword', TRUE);
        $data['title']       = 'Data Permohonan Pengujian';
        $data['permohonan']  = $this->Permohonan_model->get_all($keyword);
        $data['keyword']     = $keyword;
        $this->load->view('permohonan/index', $data);
    }

    public function create()
    {
        $data['title']          = 'Tambah Permohonan';
        $data['tujuan_options'] = $this->tujuan_options;
        $data['list_layanan']   = $this->Permohonan_model->get_master_layanan();
        $this->load->view('permohonan/create', $data);
    }

    public function store()
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('no_hp', 'Nomor HP', 'required|trim');
        $this->form_validation->set_rules('instansi', 'Instansi', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('tujuan_pengujian', 'Tujuan Pengujian', 'required|in_list[' . implode(',', $this->tujuan_options) . ']');
        $this->form_validation->set_rules('tanggal_pengambilan', 'Tanggal Pengambilan', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->create(); // Kembali ke method create jika gagal validasi
            return;
        }

        $data = [
            'nama'                 => $this->input->post('nama', TRUE),
            'no_hp'                => $this->input->post('no_hp', TRUE),
            'instansi'             => $this->input->post('instansi', TRUE),
            'email'                => $this->input->post('email', TRUE),
            'alamat'               => $this->input->post('alamat', TRUE),
            'tujuan_pengujian'     => $this->input->post('tujuan_pengujian', TRUE),
            'koordinat_lokasi'     => $this->input->post('koordinat_lokasi', TRUE),
            'tanggal_pengambilan'  => $this->input->post('tanggal_pengambilan', TRUE),
            'tujuan_ipal_pertek'   => $this->input->post('tujuan_ipal_pertek', TRUE), // Field baru
        ];

        $pilihan_layanan = $this->input->post('layanan'); // Menangkap array checkbox

        if ($this->Permohonan_model->insert_with_layanan($data, $pilihan_layanan)) {
            $this->session->set_flashdata('success', 'Data permohonan berhasil ditambahkan.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menyimpan data.');
        }
        
        redirect('permohonan');
    }

    public function edit($id)
    {
        $permohonan = $this->Permohonan_model->get_by_id($id);
        if (!$permohonan) {
            show_404();
        }

        $data['title']          = 'Edit Permohonan';
        $data['permohonan']     = $permohonan;
        $data['tujuan_options'] = $this->tujuan_options;
        $data['list_layanan']   = $this->Permohonan_model->get_master_layanan();
        $data['layanan_aktif']  = $this->Permohonan_model->get_layanan_by_permohonan($id); // Array ID layanan yang sudah dipilih
        $this->load->view('permohonan/edit', $data);
    }

    public function update($id)
    {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('no_hp', 'Nomor HP', 'required|trim');
        $this->form_validation->set_rules('instansi', 'Instansi', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|trim');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('tujuan_pengujian', 'Tujuan Pengujian', 'required|in_list[' . implode(',', $this->tujuan_options) . ']');
        $this->form_validation->set_rules('tanggal_pengambilan', 'Tanggal Pengambilan', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->edit($id); // Kembali ke method edit jika gagal
            return;
        }

        $data = [
            'nama'                 => $this->input->post('nama', TRUE),
            'no_hp'                => $this->input->post('no_hp', TRUE),
            'instansi'             => $this->input->post('instansi', TRUE),
            'email'                => $this->input->post('email', TRUE),
            'alamat'               => $this->input->post('alamat', TRUE),
            'tujuan_pengujian'     => $this->input->post('tujuan_pengujian', TRUE),
            'koordinat_lokasi'     => $this->input->post('koordinat_lokasi', TRUE),
            'tanggal_pengambilan'  => $this->input->post('tanggal_pengambilan', TRUE),
            'tujuan_ipal_pertek'   => $this->input->post('tujuan_ipal_pertek', TRUE), // Field baru
        ];

        $pilihan_layanan = $this->input->post('layanan'); // Menangkap array checkbox

        if ($this->Permohonan_model->update_with_layanan($id, $data, $pilihan_layanan)) {
            $this->session->set_flashdata('success', 'Data permohonan berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui data.');
        }
        
        redirect('permohonan');
    }

    public function delete($id)
    {
        $permohonan = $this->Permohonan_model->get_by_id($id);
        if (!$permohonan) {
            show_404();
        }

        $this->Permohonan_model->delete($id);
        $this->session->set_flashdata('success', 'Data permohonan berhasil dihapus.');
        redirect('permohonan');
    }
}