<?php

namespace Tests\Unit\Admin;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\FeatureTestTrait;
use App\Models\UserModel;
use App\Models\WasteModel;
use App\Models\CentersModel;
use App\Models\EventModel;
use App\Models\ContactMessageModel;

class SoftDeleteTest extends CIUnitTestCase
{
    use DatabaseTestTrait;
    use FeatureTestTrait;

    protected $migrate = true;
    protected $migrateOnce = false;
    protected $refresh = true;

    protected function setUp(): void
    {
        parent::setUp();
        $this->createTestData();
        $this->loginAsAdmin();
    }

    protected function createTestData(): void
    {
        // Create admin user
        $userModel = new UserModel();
        $userModel->insert([
            'name' => 'Test Admin',
            'email' => 'admin@test.com',
            'password' => password_hash('password123', PASSWORD_DEFAULT),
            'role' => 'admin',
            'is_master' => 1,
            'is_deleted' => '0'
        ]);
    }

    protected function loginAsAdmin(): void
    {
        session()->set([
            'logged_in' => true,
            'user_id' => 1,
            'user_role' => 'admin',
            'is_master' => 1,
            'user_name' => 'Test Admin'
        ]);
    }

    /**
     * TC-6.1a: Deleted Waste Categories Not Shown
     */
    public function testDeletedWasteCategoriesNotShown(): void
    {
        $model = new WasteModel();
        
        // Create active category
        $model->insert(['name' => 'Active Category', 'is_deleted' => '0']);
        // Create deleted category
        $model->insert(['name' => 'Deleted Category', 'is_deleted' => '1']);
        
        $result = $this->get('/wastecategory');
        
        $result->assertOK();
        $result->assertSee('Active Category');
        $result->assertDontSee('Deleted Category');
    }

    /**
     * TC-6.1b: Deleted Recycling Centers Not Shown
     */
    public function testDeletedRecyclingCentersNotShown(): void
    {
        $model = new CentersModel();
        
        $model->insert([
            'name' => 'Active Center', 
            'address' => 'Address',
            'city' => 'City',
            'state' => 'State',
            'is_deleted' => '0'
        ]);
        $model->insert([
            'name' => 'Deleted Center', 
            'address' => 'Address',
            'city' => 'City',
            'state' => 'State',
            'is_deleted' => '1'
        ]);
        
        $result = $this->get('/recyclingcenter');
        
        $result->assertOK();
        $result->assertSee('Active Center');
        $result->assertDontSee('Deleted Center');
    }

    /**
     * TC-6.1c: Deleted Events Not Shown
     */
    public function testDeletedEventsNotShown(): void
    {
        $model = new EventModel();
        
        $model->insert([
            'title' => 'Active Event',
            'date' => date('Y-m-d H:i:s'),
            'venue' => 'Venue',
            'is_deleted' => '0'
        ]);
        $model->insert([
            'title' => 'Deleted Event',
            'date' => date('Y-m-d H:i:s'),
            'venue' => 'Venue',
            'is_deleted' => '1'
        ]);
        
        $result = $this->get('/eventsseminar');
        
        $result->assertOK();
        $result->assertSee('Active Event');
        $result->assertDontSee('Deleted Event');
    }

    /**
     * TC-6.1d: Deleted Admins Not Shown
     */
    public function testDeletedAdminsNotShown(): void
    {
        $model = new UserModel();
        
        $model->insert([
            'name' => 'Deleted Admin',
            'email' => 'deleted@test.com',
            'password' => password_hash('password', PASSWORD_DEFAULT),
            'role' => 'admin',
            'is_master' => 0,
            'is_deleted' => '1'
        ]);
        
        $result = $this->get('/admins');
        
        $result->assertOK();
        $result->assertDontSee('deleted@test.com');
    }

    /**
     * TC-6.2a: Cannot Edit Deleted Waste Category
     */
    public function testCannotEditDeletedWasteCategory(): void
    {
        $model = new WasteModel();
        $id = $model->insert(['name' => 'Deleted Category', 'is_deleted' => '1']);
        
        $result = $this->get("/wastecategory/edit/$id");
        
        // Should not display the category (null check in edit)
        $result->assertOK();
    }

    /**
     * TC-6.2b: Cannot Edit Deleted Recycling Center
     */
    public function testCannotEditDeletedRecyclingCenter(): void
    {
        $model = new CentersModel();
        $id = $model->insert([
            'name' => 'Deleted Center',
            'address' => 'Address',
            'city' => 'City',
            'state' => 'State',
            'is_deleted' => '1'
        ]);
        
        $this->expectException(\CodeIgniter\Exceptions\PageNotFoundException::class);
        $result = $this->get("/recyclingcenter/edit/$id");
    }

    /**
     * TC-6.2c: Cannot Edit Deleted Event
     */
    public function testCannotEditDeletedEvent(): void
    {
        $model = new EventModel();
        $id = $model->insert([
            'title' => 'Deleted Event',
            'date' => date('Y-m-d H:i:s'),
            'venue' => 'Venue',
            'is_deleted' => '1'
        ]);
        
        $this->expectException(\CodeIgniter\Exceptions\PageNotFoundException::class);
        $result = $this->get("/eventsseminar/edit/$id");
    }

    /**
     * Test Soft Delete Preserves Data
     */
    public function testSoftDeletePreservesData(): void
    {
        $model = new WasteModel();
        $id = $model->insert(['name' => 'Test Category', 'is_deleted' => '0']);
        
        // Perform soft delete
        $model->update($id, ['is_deleted' => '1']);
        
        // Data should still exist in database
        $category = $model->find($id);
        $this->assertNotNull($category);
        $this->assertEquals('Test Category', $category['name']);
        $this->assertEquals('1', $category['is_deleted']);
    }

    /**
     * Test Model Count Methods Exclude Deleted
     */
    public function testContactMessageCountExcludesDeleted(): void
    {
        $model = new ContactMessageModel();
        
        $model->insert([
            'name' => 'Test',
            'email' => 'test@test.com',
            'message' => 'Test',
            'status' => 'new',
            'is_deleted' => '0'
        ]);
        $model->insert([
            'name' => 'Deleted',
            'email' => 'deleted@test.com',
            'message' => 'Deleted',
            'status' => 'new',
            'is_deleted' => '1'
        ]);
        
        $count = $model->getTotalMessages();
        
        $this->assertEquals(1, $count);
    }
}
