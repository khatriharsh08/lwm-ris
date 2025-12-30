<?php
/**
 * Password Reset Model
 * Manages password reset tokens for admin users
 * Handles token creation, verification, and cleanup
 */

namespace App\Models;
use CodeIgniter\Model;

class PasswordResetModel extends Model
{
    protected $table = 'password_resets';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'email',
        'token',
        'created_at',
        'expires_at'
    ];

    protected $useTimestamps = false;

    /**
     * Create a password reset token for the given email
     */
    public function createToken($email)
    {
        // Delete any existing tokens for this email
        $this->where('email', $email)->delete();

        // Generate a random token
        $token = bin2hex(random_bytes(32));
        
        // Set expiry to 1 hour from now
        $expiresAt = date('Y-m-d H:i:s', strtotime('+1 hour'));

        $this->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => date('Y-m-d H:i:s'),
            'expires_at' => $expiresAt
        ]);

        return $token;
    }

    /**
     * Verify if the token is valid
     */
    public function verifyToken($token)
    {
        $reset = $this->where('token', $token)
                      ->where('expires_at >', date('Y-m-d H:i:s'))
                      ->first();
        
        return $reset;
    }

    /**
     * Delete a token after it's been used
     */
    public function deleteToken($token)
    {
        return $this->where('token', $token)->delete();
    }

    /**
     * Clean up expired tokens
     */
    public function cleanExpiredTokens()
    {
        return $this->where('expires_at <', date('Y-m-d H:i:s'))->delete();
    }
}
