<?php

namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'lwm_user';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'email',
        'password',
        'password_txt',
        'name',
        'role',
        'profile_photo',
    ];
    protected $useTimestamps = true;
}
