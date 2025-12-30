<?php

namespace Tests\Unit\Admin;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\FeatureTestTrait;
use App\Models\UserModel;

class AdminManagementTest extends CIUnitTestCase
{
    use DatabaseTestTrait;
    use FeatureTestTrait;

    protected $migrate = true;
    protected $migrateOnce = false;
    protected $refresh = true;

    protected function setUp(): void
    {
        parent::setUp();
        $this->createTestUsers();
        $this->loginAsMaster();
    }

    protected function createTestUsers(): void
    {
        $userModel = new UserModel();
        
        // Master admin (id=1)
        $userModel->insert([
            'name' => 'Master Admin',
            'email' => 'master@test.com',
            'password' => password_hash('password123', PASSWORD_DEFAULT),
            'role' => 'admin',
            'is_master' => 1,
            'is_deleted' => '0'
        ]);
        
        // Regular admin (id=2)
        $userModel->insert([
            'name' => 'Regular Admin',
            'email' => 'admin@test.com',
            'password' => password_hash('password123', PASSWORD_DEFAULT),
            'role' => 'admin',
            'is_master' => 0,
            'is_deleted' => '0'
        ]);
    }

    protected function loginAsMaster(): void
    {
        session()->set([
            'logged_in' => true,
            'user_id' => 1,
            'user_role' => 'admin',
            'is_master' => 1,
            'user_name' => 'Master Admin'
        ]);
    }

    /**
     * TC-3.1: Add New Admin
     */
    public function testAddNewAdmin(): void
    {
        $result = $this->post('/admins/store', [
            'name' => 'New Admin',
            'email' => 'newadmin@test.com',
            'password' => 'password123'
        ]);

        $result->assertRedirectTo(site_url('admins'));
        $result->assertSessionHas('success', 'Admin added successfully.');
        
        // Verify admin was created
        $userModel = new UserModel();
        $admin = $userModel->where('email', 'newadmin@test.com')->first();
        $this->assertNotNull($admin);
        $this->assertEquals('New Admin', $admin['name']);
        $this->assertEquals(0, $admin['is_master']);
    }

    /**
     * TC-3.2a: Validation - Empty Name
     */
    public function testValidationEmptyName(): void
    {
        $result = $this->post('/admins/store', [
            'name' => '',
            'email' => 'test@test.com',
            'password' => 'password123'
        ]);

        $result->assertSessionHas('errors');
    }

    /**
     * TC-3.2b: Validation - Duplicate Email
     */
    public function testValidationDuplicateEmail(): void
    {
        $result = $this->post('/admins/store', [
            'name' => 'Another Admin',
            'email' => 'admin@test.com', // Already exists
            'password' => 'password123'
        ]);

        $result->assertSessionHas('errors');
    }

    /**
     * TC-3.2c: Validation - Short Password
     */
    public function testValidationShortPassword(): void
    {
        $result = $this->post('/admins/store', [
            'name' => 'Test Admin',
            'email' => 'test@test.com',
            'password' => '123' // Too short
        ]);

        $result->assertSessionHas('errors');
    }

    /**
     * TC-3.3: Edit Admin
     */
    public function testEditAdmin(): void
    {
        $result = $this->post('/admins/update/2', [
            'name' => 'Updated Admin Name',
            'email' => 'updated@test.com'
        ]);

        $result->assertRedirectTo(site_url('admins'));
        
        // Verify admin was updated
        $userModel = new UserModel();
        $admin = $userModel->find(2);
        $this->assertEquals('Updated Admin Name', $admin['name']);
        $this->assertEquals('updated@test.com', $admin['email']);
    }

    /**
     * TC-3.4: Edit Admin - Leave Password Empty (No Change)
     */
    public function testEditAdminPasswordUnchangedWhenEmpty(): void
    {
        $userModel = new UserModel();
        $originalAdmin = $userModel->find(2);
        $originalPassword = $originalAdmin['password'];
        
        $result = $this->post('/admins/update/2', [
            'name' => 'Updated Name',
            'email' => 'admin@test.com',
            'password' => '' // Empty
        ]);
        
        $updatedAdmin = $userModel->find(2);
        $this->assertEquals($originalPassword, $updatedAdmin['password']);
    }

    /**
     * TC-3.5: Delete Admin (Soft Delete)
     */
    public function testDeleteAdminSoftDelete(): void
    {
        $result = $this->get('/admins/delete/2');
        
        $result->assertRedirectTo(site_url('admins'));
        $result->assertSessionHas('success', 'Admin deleted successfully.');
        
        // Verify soft delete
        $userModel = new UserModel();
        $admin = $userModel->find(2);
        $this->assertEquals('1', $admin['is_deleted']);
    }

    /**
     * TC-3.6: Cannot Delete Master Admin
     */
    public function testCannotDeleteMasterAdmin(): void
    {
        $result = $this->get('/admins/delete/1');
        
        $result->assertRedirectTo(site_url('admins'));
        $result->assertSessionHas('error', 'Cannot delete Master Admin.');
        
        // Verify not deleted
        $userModel = new UserModel();
        $admin = $userModel->find(1);
        $this->assertEquals('0', $admin['is_deleted']);
    }

    /**
     * TC-3.7: Cannot Delete Self
     */
    public function testCannotDeleteSelf(): void
    {
        // Login as regular admin (id=2)
        session()->set([
            'logged_in' => true,
            'user_id' => 2,
            'user_role' => 'admin',
            'is_master' => 1, // Override for test
            'user_name' => 'Regular Admin'
        ]);
        
        $result = $this->get('/admins/delete/2');
        
        $result->assertSessionHas('error', 'You cannot delete your own account.');
    }

    /**
     * Test Admin List Only Shows Non-Deleted Admins
     */
    public function testAdminListExcludesDeleted(): void
    {
        // First delete an admin
        $userModel = new UserModel();
        $userModel->update(2, ['is_deleted' => '1']);
        
        // Get the list
        $result = $this->get('/admins');
        
        $result->assertOK();
        $result->assertDontSee('admin@test.com');
    }

    /**
     * Test Edit Admin Form Displays Correctly
     */
    public function testEditAdminFormDisplays(): void
    {
        $result = $this->get('/admins/edit/2');
        
        $result->assertOK();
        $result->assertSee('Regular Admin');
        $result->assertSee('admin@test.com');
    }

    /**
     * Test Edit Non-Existent Admin
     */
    public function testEditNonExistentAdmin(): void
    {
        $result = $this->get('/admins/edit/999');
        
        $result->assertRedirectTo(site_url('admins'));
        $result->assertSessionHas('error', 'Admin not found.');
    }
}
