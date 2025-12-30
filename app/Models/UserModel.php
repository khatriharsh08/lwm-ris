<?php
/**
 * User Model
 * Manages admin user data in lwm_user table
 * Handles authentication and profile management
 */

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
        'is_master',
        'is_deleted',
        'profile_photo',
    ];
    protected $useTimestamps = true;
}
