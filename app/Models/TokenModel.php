<?php

namespace App\Models;
use CodeIgniter\Model;
class TokenModel extends Model
{
    protected $DBGroup = 'db1';
    protected $table = 'token';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user', 'tkn', 'expiry_time'];

    public function validateToken($user, $tkn)
    {
        return $this->where('user', $user)->where('tkn', $tkn)->first();
    }

}