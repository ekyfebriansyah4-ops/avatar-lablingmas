<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Divisi_model extends CI_Model
{
    private $table = 'divisi';

    public function __construct()
    {
        parent::__construct();
    }

    public function get_all()
    {
        return $this->db->order_by('nama_divisi', 'ASC')->get($this->table)->result();
    }
}