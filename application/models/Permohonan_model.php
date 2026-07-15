<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permohonan_model extends CI_Model
{
    private $table = 'permohonan';

    public function __construct()
    {
        parent::__construct();
    }

    // Ambil daftar master layanan untuk checkbox
    public function get_master_layanan()
    {
        return $this->db->get('jenis_layanan')->result();
    }

    // Ambil layanan yang sudah dipilih berdasarkan ID permohonan (untuk Edit)
    public function get_layanan_by_permohonan($permohonan_id)
    {
        $this->db->where('permohonan_id', $permohonan_id);
        $query = $this->db->get('permohonan_layanan')->result_array();
        
        // Ubah menjadi array flat yang isinya hanya ID layanan agar mudah dicek di view
        return array_column($query, 'jenis_layanan_id');
    }

    // READ - ambil semua data dengan daftar layanan tergabung
    public function get_all($keyword = null)
    {
        // Menggunakan STRING_AGG (PostgreSQL) untuk menggabungkan nama layanan
        $this->db->select("permohonan.*, STRING_AGG(jenis_layanan.nama_layanan, ', ') as daftar_layanan");
        $this->db->from($this->table);
        $this->db->join('permohonan_layanan', 'permohonan.id = permohonan_layanan.permohonan_id', 'left');
        $this->db->join('jenis_layanan', 'permohonan_layanan.jenis_layanan_id = jenis_layanan.id', 'left');
        
        if ($keyword) {
            $this->db->group_start();
            $this->db->like('permohonan.nama', $keyword);
            $this->db->or_like('permohonan.instansi', $keyword);
            $this->db->or_like('permohonan.email', $keyword);
            $this->db->group_end();
        }

        // Group by semua kolom dari tabel permohonan yang akan di-select
        $this->db->group_by('permohonan.id');
        $this->db->order_by('permohonan.id', 'DESC');
        return $this->db->get()->result();
    }

    // READ - ambil satu data berdasarkan id
    public function get_by_id($id)
    {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    // CREATE - Simpan data utama dan relasi layanan
    public function insert_with_layanan($data, $pilihan_layanan)
    {
        $this->db->trans_start();
        
        // 1. Simpan ke tabel permohonan
        $this->db->insert($this->table, $data);
        $permohonan_id = $this->db->insert_id();
        
        // 2. Simpan ke tabel permohonan_layanan
        if (!empty($pilihan_layanan)) {
            foreach ($pilihan_layanan as $layanan_id) {
                $this->db->insert('permohonan_layanan', [
                    'permohonan_id' => $permohonan_id,
                    'jenis_layanan_id' => $layanan_id
                ]);
            }
        }
        
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    // UPDATE - Update data utama dan perbarui relasi layanan
    public function update_with_layanan($id, $data, $pilihan_layanan)
    {
        $this->db->trans_start();
        
        // 1. Update tabel permohonan
        $this->db->where('id', $id);
        $this->db->update($this->table, $data);
        
        // 2. Hapus relasi layanan lama
        $this->db->where('permohonan_id', $id);
        $this->db->delete('permohonan_layanan');
        
        // 3. Masukkan relasi layanan baru
        if (!empty($pilihan_layanan)) {
            foreach ($pilihan_layanan as $layanan_id) {
                $this->db->insert('permohonan_layanan', [
                    'permohonan_id' => $id,
                    'jenis_layanan_id' => $layanan_id
                ]);
            }
        }
        
        $this->db->trans_complete();
        return $this->db->trans_status();
    }

    // DELETE
    public function delete($id)
    {
        // Karena ada relasi ON DELETE CASCADE di database, 
        // menghapus permohonan akan otomatis menghapus permohonan_layanan
        return $this->db->delete($this->table, ['id' => $id]);
    }
}