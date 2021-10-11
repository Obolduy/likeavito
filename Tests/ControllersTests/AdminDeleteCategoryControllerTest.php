<?php

use PHPUnit\Framework\TestCase;
use App\Models\CategoriesGet;
use App\Controllers\AdminDeleteCategoryController;

class AdminDeleteCategoryControllerTest extends TestCase
{
    private $adminDeleteCategoryController, $category;

    protected function setUp(): void 
    {
        $this->adminDeleteCategoryController = new AdminDeleteCategoryController();
        $this->category = new CategoriesGet();
    }

    public function adminDeleteCategoryProvider()
    {
        return [
            [3],
            [4],
            [5],
            [6]
        ];
    }

    /**
     * @dataProvider adminDeleteCategoryProvider
     * headers already sent by phpunit
     */

    public function testAdminDeleteCategory($category_id) 
    {
        $this->adminDeleteCategoryController->adminDeleteCategory($category_id);

        $this->assertNull($this->category->getCategory($category_id));
    }

    protected function tearDown(): void
    {
        $this->adminDeleteCategoryController = NULL;
        $this->category = NULL;
    }
}