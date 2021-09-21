<?php
use PHPUnit\Framework\TestCase;
use App\Models\Categories;

class CategoriesTest extends TestCase
{
    private $categories;

    protected function setUp(): void 
    {
        $this->categories = new Categories();
    }

    public function getCategoryProvider()
    {
        return [
            [9],
            [10],
            [11],
            [12]
        ];
    }

    public function categoryProvider()
    {
        return [
            [9, 'НоваяКатегория1'],
            [10, 'НоваяКатегория2'],
            [11, 'НоваяКатегория3'],
            [12, 'НоваяКатегория4']
        ];
    }

    /**
     * @dataProvider categoryProvider
     */

    public function testAddCategory(int $categoryId, string $categoryName)
    {
        $this->categories->addCategory($categoryName);

        $test = $this->categories->getCategory($categoryId);
        $this->assertNotNull($test);
    }

    public function testGetAllCategories()
    {
        $test = $this->categories->getAllCategories();

        foreach ($test as $elem) {
            $this->assertNotNull($elem);
        }
    }

    /**
     * @dataProvider getCategoryProvider
     */

    public function testGetCategory(int $categoryId)
    {
        $test = $this->categories->getCategory($categoryId);

        $this->assertEquals($test['id'], $categoryId);
    }

    /**
     * @dataProvider changeCategoryProvider
     */

    public function testChangeCategory(int $categoryId, string $categoryName)
    {
        $this->categories->changeCategory($categoryId, $categoryName);

        $test = $this->categories->getCategory($categoryId);
        $this->assertEquals($test['category'], $categoryName);
    }

    /**
     * @dataProvider getCategoryProvider
     */

    public function testDeleteCategory(int $categoryId)
    {
        $this->categories->deleteCategory($categoryId);

        $test = $this->categories->getCategory($categoryId);
        $this->assertNotNull($test);
    }

    protected function tearDown(): void
    {
        $this->categories = NULL;
    }
}