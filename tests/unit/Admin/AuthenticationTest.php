<?php

namespace Tests\Unit\Admin;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\FeatureTestTrait;
use App\Models\UserModel;

class AuthenticationTest extends CIUnitTestCase
{
    use DatabaseTestTrait;
    use FeatureTestTrait;

    protected $migrate = true;
    protected $migrateOnce = false;
    protected $refresh = true;
    protected $namespace = null;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Create test users
        $this->createTestUsers();
    }

    protected function createTestUsers(): void
    {
        $userModel = new UserModel();
        
        // Master admin
        $userModel->insert([
            'name' => 'Master Admin',
            'email' => 'master@test.com',
            'password' => password_hash('password123', PASSWORD_DEFAULT),
            'role' => 'admin',
            'is_master' => 1,
            'is_deleted' => '0'
        ]);
        
        // Regular admin
        $userModel->insert([
            'name' => 'Regular Admin',
            'email' => 'admin@test.com',
            'password' => password_hash('password123', PASSWORD_DEFAULT),
            'role' => 'admin',
            'is_master' => 0,
            'is_deleted' => '0'
        ]);
        
        // Deleted admin
        $userModel->insert([
            'name' => 'Deleted Admin',
            'email' => 'deleted@test.com',
            'password' => password_hash('password123', PASSWORD_DEFAULT),
            'role' => 'admin',
            'is_master' => 0,
            'is_deleted' => '1'
        ]);
    }

    /**
     * TC-1.1: Regular Admin Login
     */
    public function testRegularAdminLogin(): void
    {
        $result = $this->post('/login', [
            'email' => 'admin@test.com',
            'password' => 'password123'
        ]);

        $result->assertRedirectTo('/dashboard');
        $this->assertTrue(session()->get('logged_in'));
        $this->assertEquals(0, session()->get('is_master'));
    }

    /**
     * TC-1.2: Master Admin Login
     */
    public function testMasterAdminLogin(): void
    {
        $result = $this->post('/login', [
            'email' => 'master@test.com',
            'password' => 'password123'
        ]);

        $result->assertRedirectTo('/dashboard');
        $this->assertTrue(session()->get('logged_in'));
        $this->assertEquals(1, session()->get('is_master'));
    }

    /**
     * TC-1.3: Deleted Admin Cannot Login
     */
    public function testDeletedAdminCannotLogin(): void
    {
        $result = $this->post('/login', [
            'email' => 'deleted@test.com',
            'password' => 'password123'
        ]);

        $result->assertSessionHas('error', 'Email not found');
        $this->assertFalse(session()->get('logged_in'));
    }

    /**
     * TC-1.4a: Invalid Password
     */
    public function testInvalidPassword(): void
    {
        $result = $this->post('/login', [
            'email' => 'admin@test.com',
            'password' => 'wrongpassword'
        ]);

        $result->assertSessionHas('error', 'Incorrect password');
    }

    /**
     * TC-1.4b: Non-existent Email
     */
    public function testNonExistentEmail(): void
    {
        $result = $this->post('/login', [
            'email' => 'nonexistent@test.com',
            'password' => 'password123'
        ]);

        $result->assertSessionHas('error', 'Email not found');
    }

    /**
     * Test Login Form Displays
     */
    public function testLoginFormDisplays(): void
    {
        $result = $this->get('/login');
        
        $result->assertOK();
        $result->assertSee('Login');
    }

    /**
     * Test Logout
     */
    public function testLogout(): void
    {
        // First login
        $this->post('/login', [
            'email' => 'admin@test.com',
            'password' => 'password123'
        ]);

        // Then logout
        $result = $this->get('/logout');
        
        $result->assertRedirectTo('login');
    }
}
