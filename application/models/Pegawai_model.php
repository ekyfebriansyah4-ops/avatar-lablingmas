<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai_model extends CI_Model
{
    private $table = 'pegawai';

    public function __construct()
    {
        parent::__construct();
    }

    // READ - ambil semua data (JOIN ke divisi supaya dapat nama_divisi)
    // $keyword opsional -> kalau diisi, filter berdasarkan nama pegawai
    public function get_all($keyword = null)
    {
        $this->db->select('pegawai.*, divisi.nama_divisi');
        $this->db->from('pegawai');
        // LEFT JOIN dipakai supaya pegawai yang belum punya divisi_id tetap muncul
        $this->db->join('divisi', 'divisi.id = pegawai.divisi_id', 'left');

        if (!empty($keyword)) {
            $this->db->like('pegawai.nama', $keyword);
        }

        $this->db->order_by('pegawai.id', 'DESC');
        return $this->db->get()->result();
    }

    // READ - ambil satu data berdasarkan id (untuk form edit)
    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    // CREATE
    public function insert($data)
    {
        return $this->db->insert($this->table, $data);
    }

    // UPDATE
    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    // DELETE
    public function delete($id)
    {
        return $this->db->delete($this->table, ['id' => $id]);
    }

    // Cek apakah email sudah dipakai pegawai LAIN (exclude id sendiri)
    // Dipakai waktu update, supaya email milik sendiri tidak dianggap duplikat
    public function email_exists_except($email, $except_id)
    {
        $this->db->where('email', $email);
        $this->db->where('id !=', $except_id);
        $result = $this->db->get($this->table);
        return $result->num_rows() > 0;
    }
}