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
     * @dataProvider updateProvider
     * Доделать
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