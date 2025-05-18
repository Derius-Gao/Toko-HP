<?php

namespace App\Models;

use CodeIgniter\Model;

class ActivityLogModel extends Model
{
    protected $table = 'activity_log';
    protected $primaryKey = 'id_activity';
    protected $allowedFields = ['id_user', 'username', 'aksi', 'timestamp', 'ip_address'];
}
