<?php

namespace Tests\Unit\Admin;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\FeatureTestTrait;
use App\Models\UserModel;
use App\Models\ActivityLogModel;
use App\Libraries\ActivityLogger;

class ActivityLogTest extends CIUnitTestCase
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
     * TC-4.1: View Activity Logs
     */
    public function testViewActivityLogs(): void
    {
        $result = $this->get('/activitylog');
        
        $result->assertOK();
        $result->assertSee('Activity Logs');
        $result->assertSee('Filter Logs');
    }

    /**
     * Test Activity Logger Creates Log Entry
     */
    public function testActivityLoggerCreatesLogEntry(): void
    {
        $logger = new ActivityLogger();
        $logger->logCreate('test_module', 1, 'Test Record', ['field' => 'value']);
        
        $logModel = new ActivityLogModel();
        $log = $logModel->where('module', 'test_module')->first();
        
        $this->assertNotNull($log);
        $this->assertEquals('create', $log['action']);
        $this->assertEquals(1, $log['record_id']);
        $this->assertEquals('Test Record', $log['record_title']);
    }

    /**
     * Test Activity Logger Log Update
     */
    public function testActivityLoggerLogUpdate(): void
    {
        $logger = new ActivityLogger();
        $logger->logUpdate('test_module', 1, 'Test Record', 
            ['name' => 'Old Name'], 
            ['name' => 'New Name']
        );
        
        $logModel = new ActivityLogModel();
        $log = $logModel->where('module', 'test_module')
                        ->where('action', 'update')
                        ->first();
        
        $this->assertNotNull($log);
        $this->assertEquals('update', $log['action']);
        $this->assertStringContainsString('Old Name', $log['old_values']);
        $this->assertStringContainsString('New Name', $log['new_values']);
    }

    /**
     * Test Activity Logger Log Delete
     */
    public function testActivityLoggerLogDelete(): void
    {
        $logger = new ActivityLogger();
        $logger->logDelete('test_module', 1, 'Test Record', ['data' => 'value']);
        
        $logModel = new ActivityLogModel();
        $log = $logModel->where('module', 'test_module')
                        ->where('action', 'delete')
                        ->first();
        
        $this->assertNotNull($log);
        $this->assertEquals('delete', $log['action']);
    }

    /**
     * Test Activity Logger Log Status Change
     */
    public function testActivityLoggerLogStatusChange(): void
    {
        $logger = new ActivityLogger();
        $logger->logStatusChange('contactmessage', 1, 'Test Message', 'pending', 'done');
        
        $logModel = new ActivityLogModel();
        $log = $logModel->where('module', 'contactmessage')
                        ->where('action', 'status_change')
                        ->first();
        
        $this->assertNotNull($log);
        $this->assertStringContainsString('pending', $log['old_values']);
        $this->assertStringContainsString('done', $log['new_values']);
    }

    /**
     * TC-4.2: Filter by Module
     */
    public function testFilterByModule(): void
    {
        // Create test logs
        $logger = new ActivityLogger();
        $logger->logCreate('admins', 1, 'Admin 1', []);
        $logger->logCreate('wastecategory', 1, 'Category 1', []);
        
        $result = $this->get('/activitylog?module=admins');
        
        $result->assertOK();
        $result->assertSee('Admin 1');
        $result->assertDontSee('Category 1');
    }

    /**
     * TC-4.3: Filter by Action
     */
    public function testFilterByAction(): void
    {
        $logger = new ActivityLogger();
        $logger->logCreate('test', 1, 'Created Item', []);
        $logger->logDelete('test', 2, 'Deleted Item', []);
        
        $result = $this->get('/activitylog?action=create');
        
        $result->assertOK();
        $result->assertSee('Created Item');
    }

    /**
     * Test Log Model Get Recent Logs
     */
    public function testLogModelGetRecentLogs(): void
    {
        $logger = new ActivityLogger();
        for ($i = 1; $i <= 60; $i++) {
            $logger->logCreate('test', $i, "Item $i", []);
        }
        
        $logModel = new ActivityLogModel();
        $logs = $logModel->getRecentLogs(50, 0, []);
        
        $this->assertCount(50, $logs);
    }

    /**
     * Test Log Model Count Logs
     */
    public function testLogModelCountLogs(): void
    {
        $logger = new ActivityLogger();
        for ($i = 1; $i <= 10; $i++) {
            $logger->logCreate('test', $i, "Item $i", []);
        }
        
        $logModel = new ActivityLogModel();
        $count = $logModel->countLogs(['module' => 'test']);
        
        $this->assertEquals(10, $count);
    }

    /**
     * Test Log Model Get Distinct Modules
     */
    public function testLogModelGetDistinctModules(): void
    {
        $logger = new ActivityLogger();
        $logger->logCreate('admins', 1, 'Admin', []);
        $logger->logCreate('wastecategory', 1, 'Category', []);
        $logger->logCreate('events', 1, 'Event', []);
        
        $logModel = new ActivityLogModel();
        $modules = $logModel->getDistinctModules();
        
        $this->assertCount(3, $modules);
    }

    /**
     * Test Activity Log Contains User Info
     */
    public function testActivityLogContainsUserInfo(): void
    {
        $logger = new ActivityLogger();
        $logger->logCreate('test', 1, 'Test', []);
        
        $logModel = new ActivityLogModel();
        $log = $logModel->where('module', 'test')->first();
        
        $this->assertEquals(1, $log['user_id']);
        $this->assertEquals('Master Admin', $log['user_name']);
        $this->assertNotEmpty($log['ip_address']);
    }
}
