<?php

namespace App\Models;

use CodeIgniter\Model;
use Exception;

class NasabahModel extends Model
{
    protected $table         = 'nasabah';
    protected $primaryKey    = 'id';
    protected $allowedFields = ['id','id_nasabah','email','username','password','nama_lengkap','notelp','alamat','tgl_lahir','kelamin','token'];
	protected $useTimestamps = true;
	protected $dateFormat    = 'datetime';
	protected $createdField  = 'created_at';

    public function getLastNasabah(){
        return $this->db->table($this->table)->orderBy('created_at','DESC')->limit(1)->get()->getResultArray();
    }

    public function addNasabah($data){
        $query = $this->db->table($this->table)->insert($data);

        return $query ? true : false;
    }

    public function emailVerification($otp){
        try {
            $data = [
                'is_verify' => 'yes',
                'otp'       => null
            ];
    
            $this->db->table('nasabah')->where('otp', $otp)->update($data);
            return $this->db->affectedRows();
        } 
        catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function updateToken($id,$token){
        try {
            $data = [
                'token' => $token
            ];
    
            $this->db->table('nasabah')->where('id', $id)->update($data);
            return $this->db->affectedRows();
        } 
        catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function setTokenNull(string $id_nasabah){
        try {
            $data = [
                'token' => null
            ];
    
            $this->db->table('nasabah')->where('id_nasabah', $id_nasabah)->update($data);
            return $this->db->affectedRows();
        } 
        catch (Exception $e) {
            return $e->getMessage();
        }
    }

    public function editProfileNasabah($data){
        try {

            $this->db->table('nasabah')->where('id',$data['id'])->update($data);
            return $this->db->affectedRows();
        } 
        catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
