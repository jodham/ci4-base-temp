<?php

namespace App\Models;
use CodeIgniter\Model;
class LogModel extends Model
{
    protected $DBGroup = 'db1';
    protected $table = 'logs';
    protected $PrimaryKey = 'id';
    protected $allowedFields = ['user', 'action', 'time'];

    public function getLogs($page, $limit){
        $offset = ($page - 1) * $limit;

        $builder = $this->builder();
        $builder->limit($limit, $offset);
        
        $result = $builder->get()->getResultArray();
        return $result;
        
    }
}