<?php 
/**
 * User Profile Controller
 * Handles user profile viewing and updates for logged-in admin users
 */

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\UserModel;

class User extends BaseController
{
    /**
     * Display logged-in user's profile
     */
    public function index()
    {
        $data['page_title'] = 'Profile';
        $model = new UserModel();
        $id = session()->get('user_id');
        $data['user'] = $model->where('id', $id)->first();

        if (empty($data['user'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the user with ID: ' . $id);
        }

        return view('admin/user/profile', $data);
    }

    /**
     * Update user profile
     * Handles name, email, password (optional), and profile photo (optional)
     * 
     * @param int $id User ID to update
     */
    public function update($id)
    {
        $model = new UserModel();
        $user = $model->find($id);

        // Base validation rules for required fields
        $rules = [
            'name' => [
                'label' => 'Full Name',
                'rules' => 'required|min_length[2]|max_length[100]',
                'errors' => [
                    'required' => 'Please enter your full name.',
                    'min_length' => 'Name must be at least 2 characters.',
                    'max_length' => 'Name cannot exceed 100 characters.'
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|max_length[100]',
                'errors' => [
                    'required' => 'Please enter your email address.',
                    'valid_email' => 'Please enter a valid email address.',
                    'max_length' => 'Email cannot exceed 100 characters.'
                ]
            ]
        ];

        // Add password validation only if user is changing password
        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $rules['password'] = [
                'label' => 'Password',
                'rules' => 'min_length[6]|max_length[50]',
                'errors' => [
                    'min_length' => 'Password must be at least 6 characters.',
                    'max_length' => 'Password cannot exceed 50 characters.'
                ]
            ];
        }

        // Add photo validation only if new photo is uploaded
        if ($this->request->getFile('profile_photo')->isValid()) {
            $rules['profile_photo'] = [
                'label' => 'Profile Photo',
                'rules' => 'uploaded[profile_photo]|max_size[profile_photo,5120]|is_image[profile_photo]|mime_in[profile_photo,image/jpg,image/jpeg,image/png,image/gif]',
                'errors' => [
                    'max_size' => 'Profile photo must be less than 5MB.',
                    'is_image' => 'Please upload a valid image file.',
                    'mime_in' => 'Only JPG, PNG, and GIF images are allowed.'
                ]
            ];
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Prepare update data
        $data = [
            'name'  => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
        ];

        // Hash and include new password if provided
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        // Handle profile photo upload and cleanup
        if ($this->request->getFile('profile_photo')->isValid()) {
            $file = $this->request->getFile('profile_photo');
            $newFileName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads/users', $newFileName);
            $data['profile_photo'] = $newFileName;

            // Remove old photo file to free up storage
            if (!empty($user['profile_photo']) && file_exists(ROOTPATH . 'public/uploads/users/' . $user['profile_photo'])) {
                unlink(ROOTPATH . 'public/uploads/users/' . $user['profile_photo']);
            }
        }

        $model->update($id, $data);

        return redirect()->to(site_url('dashboard'))->with('success', 'User profile updated successfully.');
    }
}