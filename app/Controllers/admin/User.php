<?php 

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Models\UserModel;

class User extends BaseController
{
    public function index()
    {
        $data['page_title'] = 'Profile';
		$model = new UserModel();
        $id = session()->get('user_id');
        $data['user'] = $model->where('id', $id)->first();

        if (empty($data['user'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Cannot find the user with ID: ' . $id);
        }

        return view('admin/user/profile', $data); // your view path
    }

   public function update($id)
    {
        $model = new UserModel();
        $user = $model->find($id);

        $rules = [
            'name'  => 'required|max_length[100]',
            'email' => 'required|valid_email|max_length[100]',
        ];

        // Only validate photo if uploaded
        if ($this->request->getFile('profile_photo')->isValid()) {
            $rules['profile_photo'] = 'uploaded[profile_photo]|max_size[profile_photo,1024]|is_image[profile_photo]';
        }

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        $data = [
            'name'  => $this->request->getPost('name'),
            'email' => $this->request->getPost('email'),
        ];

        // If password is entered
        $password = $this->request->getPost('password');


        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_DEFAULT);
        }

        // $password_txt = $this->request->getPost('password_txt');
        // if (!empty($password_txt)) {
        //     $data['password_txt'] = $password_txt;
        // }

        // Handle profile photo upload
        if ($this->request->getFile('profile_photo')->isValid()) {
            $file = $this->request->getFile('profile_photo');
            $newFileName = $file->getRandomName();
            $file->move(ROOTPATH . 'public/uploads/users', $newFileName);
            $data['profile_photo'] = $newFileName;

            // Delete old photo if exists
            if (!empty($user['profile_photo']) && file_exists(ROOTPATH . 'public/uploads/users/' . $user['profile_photo'])) {
                unlink(ROOTPATH . 'public/uploads/users/' . $user['profile_photo']);
            }
        }

        $model->update($id, $data);

        return redirect()->to(site_url('dashboard'))->with('success', 'User profile updated successfully.');
    }
}

?>