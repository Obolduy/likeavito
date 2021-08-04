<?php
use PHPUnit\Framework\TestCase;
use App\Models\Database;

class DatabaseTest extends TestCase
{
    private $database;

    protected function setUp(): void 
    {
        $this->database = new Database();
    }

    public function getOneProvider()
    {
        return [
            ['users', 15, 15],
            ['lots', 'newAdd5', 30, 'title'],
            ['users', 8, 8],
            ['users', 9, 9]
        ];
    }

    public function getAllProvider()
    {
        return [
            ['users'],
            ['lots']
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

    public function getTableCountProvider()
    {
        return [
            ['users', 15, 'id', 1],
            ['comments', 8, 'lot_id', 2],
        ];
    }

     /**
     * @dataProvider getOneProvider
     */

    public function testGetOne(string $table, $what, $expected, string $column = 'id') 
    {
        $info = $this->database->getOne($table, $what, $column);

        foreach ($info as $elem) {
            $this->assertEquals($expected, $elem['id']);
        }
    }

    /**
     * @dataProvider getAllProvider
     */

    public function testGetAll(string $table) 
    {
        $info = $this->database->getAll($table);

        foreach ($info as $elem) {
            $this->assertNotNull($elem['id']);
        }
    }

    /**
     * @dataProvider deleteProvider
     */

    public function testDelete(string $table, $chosen) 
    {
        $this->database->delete($table, $data);

        $info = $this->database->getOne($table, $chosen);

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
        $this->database->update($query, $data);

        $info = $this->database->getOne('users', $data[0], 'login');

        foreach ($info as $elem) {
            $this->assertEquals($expected, $elem['id']);
        }
    }

    /**
     * @dataProvider getTableCountProvider
     */

    public function testGetTableCount($table, $what, $column, $expected) 
    {
        $data = $this->database->getTableCount($table, $what, $column);
        
        $this->assertEquals($expected, $data[0][0]);
    }

    protected function tearDown(): void
    {
        $this->database = NULL;
    }
}