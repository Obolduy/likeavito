<?php

use PHPUnit\Framework\TestCase;
use App\Controllers\AdminChangeCategoryController;
use App\Models\CategoriesGet;

class AdminChangeCategoryControllerTest extends TestCase
{
    private $adminChangeCategoryController, $category;

    protected function setUp(): void 
    {
        $this->adminChangeCategoryController = new AdminChangeCategoryController();
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

    public function testAdminChangeCityController($category_id, $title) 
    {
        $_SERVER['REQUEST_METHOD'] = 'POST';

        $_POST['category'] = $title;

        $this->adminChangeCategoryController->adminChangeCategory($category_id);

        $data = $this->category->getCategory($category_id);

        $this->assertEquals($title, $data['category']);
    }

    protected function tearDown(): void
    {
        $this->adminChangeCategoryController = NULL;
        $this->category = NULL;
    }
}