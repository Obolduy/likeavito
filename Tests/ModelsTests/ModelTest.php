<?php
use PHPUnit\Framework\TestCase;
use App\Models\Model;

class ModelTest extends TestCase
{
    private $model;

    protected function setUp(): void 
    {
        $this->model = new Model();
    }

    public function getOneProvider()
    {
        return [
            ['users', 15, 15],
            ['lots', 'SomeTitle', 21, 'title'],
            ['users', 2, 2],
            ['users', 3, 3]
        ];
    }

    public function deleteProvider()
    {
        return [
            ['users', 21],
            ['users', 22],
            ['users', 23],
            ['users', 24]
        ];
    }

    public function updateProvider()
    {
        return [
            ['UPDATE users SET login = ?, city_id = ? WHERE id = ?', ['newlogin1', 1, 21], 21],
            ['UPDATE users SET login = ?, city_id = ? WHERE id = ?', ['newlogin2', 4, 22], 22],
            ['UPDATE users SET login = ?, city_id = ? WHERE id = ?', ['newlogin3', 6, 23], 23],
            ['UPDATE users SET login = ?, city_id = ? WHERE id = ?', ['newlogin4', 5, 24], 24]
        ];
    }

     /**
     * @dataProvider getOneProvider
     * 2 тест переподумать
     */
    public function testGetOne(string $table, $what, $expected, string $column = 'id') 
    {
        $info = $this->model->getOne($table, $what);

        foreach ($info as $elem) {
            $this->assertEquals($expected, $elem['id']);
        }
    }
      

    /**
     * @dataProvider deleteProvider
     */
    public function testDelete(string $table, $chosen) 
    {
        $this->model->delete($table, $data);

        $info = $this->model->getOne($table, $chosen);

        foreach ($info as $elem) {
            $this->assertNull($expected, $elem['id']);
        }
    }

    /**
     * @dataProvider updateProvider
     * Добавить лоты и комменты в проверку
     */
    public function testUpdate(string $query, array $data, $expected) 
    {
        $this->model->update($query, $data);

        $info = $this->model->getOne('users', $data[0], 'login');

        foreach ($info as $elem) {
            $this->assertEquals($expected, $elem['id']);
        }
    }

    protected function tearDown(): void
    {
        $this->model = NULL;
    }
}