<?php 
/**
 * Admins Controller
 * CRUD operations for admin user management
 * Only accessible by Master Admin (is_master = 1)
 * Uses soft delete pattern for data preservation
 */

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\UserModel;
use App\Libraries\ActivityLogger;

class Admins extends BaseController
{
    protected $userModel;
    protected $activityLogger;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->activityLogger = new ActivityLogger();
    }

    /**
     * List all admin users
     */
    public function index()
    {
        $data['page_title'] = 'Manage Admins';
        $data['admins'] = $this->userModel->where('is_deleted', '0')->findAll();
        
        return view('admin/admins/view', $data);
    }

    /**
     * Show add admin form
     */
    public function add()
    {
        $data['page_title'] = 'Add New Admin';
        return view('admin/admins/add', $data);
    }

    /**
     * Store new admin
     */
    public function store()
    {
        $rules = [
            'name' => [
                'label' => 'Full Name',
                'rules' => 'required|min_length[2]|max_length[100]',
                'errors' => [
                    'required' => 'Please enter admin name.',
                    'min_length' => 'Name must be at least 2 characters.',
                    'max_length' => 'Name cannot exceed 100 characters.'
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|max_length[100]|is_unique[lwm_user.email]',
                'errors' => [
                    'required' => 'Please enter email address.',
                    'valid_email' => 'Please enter a valid email address.',
                    'max_length' => 'Email cannot exceed 100 characters.',
                    'is_unique' => 'This email is already registered.'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[6]|max_length[50]',
                'errors' => [
                    'required' => 'Please enter a password.',
                    'min_length' => 'Password must be at least 6 characters.',
                    'max_length' => 'Password cannot exceed 50 characters.'
                ]
            ]
        ];

        // Validate profile photo if uploaded
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

        $data = [
            'name'      => $this->request->getPost('name'),
            'email'     => $this->request->getPost('email'),
            'password'  => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'role'      => 'admin',
            'is_master' => 0, // New admins are NOT master admins
        ];

        // Handle profile photo upload
        if ($this->request->getFile('profile_photo')->isValid()) {
            $file = $this->request->getFile('profile_photo');
            $newFileName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads/users', $newFileName);
            $data['profile_photo'] = $newFileName;
        }

        $insertId = $this->userModel->insert($data);
        
        // Log the activity
        $this->activityLogger->logCreate('admins', $insertId, $data['name'], ['name' => $data['name'], 'email' => $data['email']]);

        return redirect()->to(site_url('admins'))->with('success', 'Admin added successfully.');
    }

    /**
     * Show edit admin form
     */
    public function edit($id)
    {
        $data['page_title'] = 'Edit Admin';
        $data['admin'] = $this->userModel->find($id);

        if (empty($data['admin'])) {
            return redirect()->to(site_url('admins'))->with('error', 'Admin not found.');
        }

        return view('admin/admins/edit', $data);
    }

    /**
     * Update admin
     */
    public function update($id)
    {
        $admin = $this->userModel->find($id);
        
        if (empty($admin)) {
            return redirect()->to(site_url('admins'))->with('error', 'Admin not found.');
        }

        $rules = [
            'name' => [
                'label' => 'Full Name',
                'rules' => 'required|min_length[2]|max_length[100]',
                'errors' => [
                    'required' => 'Please enter admin name.',
                    'min_length' => 'Name must be at least 2 characters.',
                    'max_length' => 'Name cannot exceed 100 characters.'
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|max_length[100]|is_unique[lwm_user.email,id,' . $id . ']',
                'errors' => [
                    'required' => 'Please enter email address.',
                    'valid_email' => 'Please enter a valid email address.',
                    'max_length' => 'Email cannot exceed 100 characters.',
                    'is_unique' => 'This email is already registered.'
                ]
            ]
        ];

        // Validate password if provided
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

        // Validate profile photo if uploaded
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

        $data = [
            'name'  => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
        ];

        // Update password if provided
        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        // Handle profile photo upload
        if ($this->request->getFile('profile_photo')->isValid()) {
            $file = $this->request->getFile('profile_photo');
            $newFileName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads/users', $newFileName);
            $data['profile_photo'] = $newFileName;

            // Delete old photo if exists
            if (!empty($admin['profile_photo']) && file_exists(ROOTPATH . 'public/uploads/users/' . $admin['profile_photo'])) {
                unlink(ROOTPATH . 'public/uploads/users/' . $admin['profile_photo']);
            }
        }

        $this->userModel->update($id, $data);
        
        // Log the activity
        $this->activityLogger->logUpdate('admins', $id, $data['name'], ['name' => $admin['name'], 'email' => $admin['email']], $data);

        return redirect()->to(site_url('admins'))->with('success', 'Admin updated successfully.');
    }

    /**
     * Delete admin
     */
    public function delete($id)
    {
        $admin = $this->userModel->find($id);
        
        if (empty($admin)) {
            return redirect()->to(site_url('admins'))->with('error', 'Admin not found.');
        }

        // Prevent deleting master admin
        if ($admin['is_master'] == 1) {
            return redirect()->to(site_url('admins'))->with('error', 'Cannot delete Master Admin.');
        }

        // Prevent self-deletion
        if ($admin['id'] == session()->get('user_id')) {
            return redirect()->to(site_url('admins'))->with('error', 'You cannot delete your own account.');
        }

        // Soft delete (don't remove photo since record still exists)
        $this->userModel->update($id, ['is_deleted' => '1']);
        
        // Log the activity
        $this->activityLogger->logDelete('admins', $id, $admin['name'], ['name' => $admin['name'], 'email' => $admin['email']]);

        return redirect()->to(site_url('admins'))->with('success', 'Admin deleted successfully.');
    }
}
