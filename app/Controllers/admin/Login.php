<?php
/**
 * Login Controller
 * Handles admin authentication including login, logout, and password reset
 * Uses email-based verification for password recovery
 */

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Models\PasswordResetModel;

class Login extends BaseController
{
    /**
     * Display login form
     */
    public function index()
    {
        return view('admin/auth/login');
    }

    public function auth()
    {

        $rules = [
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|max_length[100]',
                'errors' => [
                    'required' => 'Please enter your email address.',
                    'valid_email' => 'Please enter a valid email address.',
                    'max_length' => 'Email cannot exceed 100 characters.'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => 'Please enter your password.',
                    'min_length' => 'Password must be at least 6 characters.'
                ]
            ]
        ];

        if (! $this->validate($rules)) {
            return view('admin/auth/login', [
                'validation' => $this->validator,
            ]);
        }

        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->where('is_deleted', '0')->first();

        if($user){
            if (password_verify($password, $user['password'])) {
                session()->set([
                    'logged_in'=> true,
                    'user_id' => $user['id'],
                    'user_role' => $user['role'],
                    'is_master' => $user['is_master'] ?? 0,
                    'user_name' => $user['name'],
                    'user_email' => $user['email'],
                    'user_photo' => $user['profile_photo'],
                ]);

                return redirect()->to('/dashboard');
            } else {
                return redirect()->back()->with('error', 'Incorrect password');
            }
        }else{
            return redirect()->back()->with('error','Email not found');
        }
    }

    public function logout(){
        session_destroy();
        return redirect()->to('login');
    }

    /**
     * Show forgot password form
     */
    public function showForgotPassword()
    {
        return view('admin/auth/forgot_password');
    }

    /**
     * Process forgot password request
     */
    public function processForgotPassword()
    {
        $rules = [
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email',
                'errors' => [
                    'required' => 'Please enter your email address.',
                    'valid_email' => 'Please enter a valid email address.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return view('admin/auth/forgot_password', [
                'validation' => $this->validator,
            ]);
        }

        $email = $this->request->getPost('email');
        
        // Check if user exists
        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

        if (!$user) {
            return redirect()->back()->with('error', 'No account found with that email address.');
        }

        // Create password reset token
        $resetModel = new PasswordResetModel();
        $token = $resetModel->createToken($email);

        // Build reset link
        $resetLink = site_url('reset-password/' . $token);

        // Try to send email
        $email_service = \Config\Services::email();
        
        $email_service->setTo($email);
        $email_service->setSubject('Password Reset - LWM-RIS');
        $email_service->setMessage("
            <h2>Password Reset Request</h2>
            <p>Hello {$user['name']},</p>
            <p>You have requested to reset your password. Click the link below to reset it:</p>
            <p><a href='{$resetLink}' style='background-color: #4e73df; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;'>Reset Password</a></p>
            <p>Or copy and paste this link in your browser:</p>
            <p>{$resetLink}</p>
            <p>This link will expire in 1 hour.</p>
            <p>If you did not request this, please ignore this email.</p>
            <br>
            <p>Thanks,<br>LWM-RIS Team</p>
        ");

        if ($email_service->send()) {
            return redirect()->to('forgot-password')->with('success', 'Password reset link has been sent to your email address.');
        } else {
            // If email fails, show the reset link directly (for development)
            return redirect()->to('forgot-password')->with('success', 'Password reset link generated. For development, use this link: ' . $resetLink);
        }
    }

    /**
     * Show reset password form
     */
    public function showResetPassword($token)
    {
        $resetModel = new PasswordResetModel();
        $reset = $resetModel->verifyToken($token);

        if (!$reset) {
            return redirect()->to('forgot-password')->with('error', 'Invalid or expired password reset link. Please request a new one.');
        }

        return view('admin/auth/reset_password', ['token' => $token]);
    }

    /**
     * Process password reset
     */
    public function processResetPassword($token)
    {
        $resetModel = new PasswordResetModel();
        $reset = $resetModel->verifyToken($token);

        if (!$reset) {
            return redirect()->to('forgot-password')->with('error', 'Invalid or expired password reset link. Please request a new one.');
        }

        $rules = [
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[6]',
                'errors' => [
                    'required' => 'Please enter a new password.',
                    'min_length' => 'Password must be at least 6 characters.'
                ]
            ],
            'confirm_password' => [
                'label' => 'Confirm Password',
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => 'Please confirm your password.',
                    'matches' => 'Passwords do not match.'
                ]
            ]
        ];

        if (!$this->validate($rules)) {
            return view('admin/auth/reset_password', [
                'validation' => $this->validator,
                'token' => $token
            ]);
        }

        // Update user password
        $userModel = new UserModel();
        $user = $userModel->where('email', $reset['email'])->first();

        if ($user) {
            $newPassword = $this->request->getPost('password');
            $userModel->update($user['id'], [
                'password' => password_hash($newPassword, PASSWORD_DEFAULT)
            ]);

            // Delete the used token
            $resetModel->deleteToken($token);

            return redirect()->to('login')->with('success', 'Your password has been reset successfully. Please login with your new password.');
        }

        return redirect()->to('forgot-password')->with('error', 'An error occurred. Please try again.');
    }
}

