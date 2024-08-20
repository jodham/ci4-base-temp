<?php

namespace App\Models;
use CodeIgniter\Model;
class BiotimeModel extends Model
{
    protected $table = 'finger_users_table';
    protected $primaryKey = 'id';
    protected $allowedFields = ['StaffID','FirstName','MiddleName','LastName','Department','Campus','Email','Phone','Status','BioData'];

    public function getUserByEmail($email){
        return $this->where('Email', $email)->first();
    }
}