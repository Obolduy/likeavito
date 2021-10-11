<?php

use PHPUnit\Framework\TestCase;
use App\Controllers\AdminAddCategoryController;
use App\Models\CategoriesGet;

class AdminAddCategoryControllerTest extends TestCase
{
    private $adminAddCategoryController, $category;

    protected function setUp(): void 
    {
        $this->adminAddCategoryController = new AdminAddCategoryController();
        $this->category = new CategoriesGet();
    }

    public function changeCategoryProvider()
    {
        return [
            [10, 'NewCategory01'],
            [11, 'NewCategory02'],
            [12, 'NewCategory03'],
            [13, 'NewCategory04']
        ];
    }

    /**
     * @dataProvider changeCategoryProvider
     */

    public function testAddCategoryController($category) 
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';

        $_POST['category'] = $category;

        $this->adminAddCategoryController->addCategory();

        $data = $this->category->getAllCategories();

        foreach ($data as $elem) {
            if (in_array($category, $elem['category'])) {
                $check = true;
            }
        }
        
        $this->assertTrue($check);
    }

    protected function tearDown(): void
    {
        $this->adminAddCategoryController = NULL;
        $this->category = NULL;
    }
}