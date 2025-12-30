<?php

namespace Tests\Unit\Admin;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\FeatureTestTrait;
use App\Models\UserModel;

class AccessControlTest extends CIUnitTestCase
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

    protected function loginAsRegularAdmin(): void
    {
        session()->set([
            'logged_in' => true,
            'user_id' => 2,
            'user_role' => 'admin',
            'is_master' => 0,
            'user_name' => 'Regular Admin'
        ]);
    }

    /**
     * TC-2.1a: Regular Admin Cannot Access /admins
     */
    public function testRegularAdminCannotAccessAdminsList(): void
    {
        $this->loginAsRegularAdmin();
        
        $result = $this->get('/admins');
        
        $result->assertRedirectTo('/dashboard');
        $result->assertSessionHas('error', 'Access Denied. Only Master Admin can access this section.');
    }

    /**
     * TC-2.1b: Regular Admin Cannot Access /admins/add
     */
    public function testRegularAdminCannotAccessAddAdmin(): void
    {
        $this->loginAsRegularAdmin();
        
        $result = $this->get('/admins/add');
        
        $result->assertRedirectTo('/dashboard');
    }

    /**
     * TC-2.1c: Regular Admin Cannot Access /admins/edit
     */
    public function testRegularAdminCannotAccessEditAdmin(): void
    {
        $this->loginAsRegularAdmin();
        
        $result = $this->get('/admins/edit/1');
        
        $result->assertRedirectTo('/dashboard');
    }

    /**
     * TC-2.1d: Regular Admin Cannot Access /activitylog
     */
    public function testRegularAdminCannotAccessActivityLog(): void
    {
        $this->loginAsRegularAdmin();
        
        $result = $this->get('/activitylog');
        
        $result->assertRedirectTo('/dashboard');
    }

    /**
     * TC-2.2a: Master Admin Can Access /admins
     */
    public function testMasterAdminCanAccessAdminsList(): void
    {
        $this->loginAsMaster();
        
        $result = $this->get('/admins');
        
        $result->assertOK();
        $result->assertSee('Manage Admins');
    }

    /**
     * TC-2.2b: Master Admin Can Access /admins/add
     */
    public function testMasterAdminCanAccessAddAdmin(): void
    {
        $this->loginAsMaster();
        
        $result = $this->get('/admins/add');
        
        $result->assertOK();
        $result->assertSee('Add New Admin');
    }

    /**
     * TC-2.2c: Master Admin Can Access /activitylog
     */
    public function testMasterAdminCanAccessActivityLog(): void
    {
        $this->loginAsMaster();
        
        $result = $this->get('/activitylog');
        
        $result->assertOK();
        $result->assertSee('Activity Logs');
    }

    /**
     * Test Unauthenticated User Redirected to Login
     */
    public function testUnauthenticatedUserRedirectedToLogin(): void
    {
        $result = $this->get('/admins');
        
        $result->assertRedirectTo('/login');
    }

    /**
     * Test Regular Admin Can Access Normal Admin Routes
     */
    public function testRegularAdminCanAccessDashboard(): void
    {
        $this->loginAsRegularAdmin();
        
        $result = $this->get('/dashboard');
        
        $result->assertOK();
    }

    /**
     * Test Regular Admin Can Access Waste Categories
     */
    public function testRegularAdminCanAccessWasteCategories(): void
    {
        $this->loginAsRegularAdmin();
        
        $result = $this->get('/wastecategory');
        
        $result->assertOK();
    }
}
