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

    public function insertProvider()
    {
        return [
            ['users',
                ['login' => 'justNewTestLogin', 'email' => 'justNewTest@email.com', 'city_id' => 4, 'status_id' => 1,
                    'ban_status' => 0, 'active' => 0, 'password' => 'trgkferk'], ['login', 'justNewTestLogin', 103]],
            ['surnames', ['surname' => 'justtestsurname', 'user_id' => 99], ['surname', 'justtestsurname', 106]],
            ['names', ['name' => 'justtestname', 'user_id' => 99], ['name', 'justtestname', 109]]
        ];
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
            ['users', ['login' => 'newlogin0001', 'city_id' => 1], ['id' => 21], 21],
            ['users', ['login' => 'newlogin0002', 'city_id' => 2], ['id' => 22], 22],
            ['users', ['login' => 'newlogin0003', 'city_id' => 3], ['id' => 23], 23],
            ['users', ['login' => 'newlogin0004', 'city_id' => 4], ['id' => 24], 24]
        ];
    }

    public function prepareJoinProvider()
    {
        return [
            [['users.id', 'names.name', 'cities.city'], ['users', 'names', 'cities'],
                ['users.id', '=', '69'], [['users.id', 'names.user_id'], ['users.city_id', 'cities.id']]],
            [['users.id', 'users.login', 'comments.description', 'comments.add_time'], ['users', 'comments'],
                ['comments.lot_id', '=', '2'], [['users.id', 'comments.user_id']]]
        ];
    }

    public function joinProvider()
    {
        return [
            [['users.id', 'names.name', 'cities.city'], ['users', 'names', 'cities'],
            ['users.id', '=', '69'], [['users.id', 'names.user_id'], ['users.city_id', 'cities.id']],
                NULL, [69, 'dgdgdgd', 'Петербург']],
            [['users.id', 'users.login', 'comments.description', 'comments.add_time'], ['users', 'comments'],
            ['comments.lot_id', '=', '2'], [['users.id', 'comments.user_id']],
                'RIGHT', []]
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
     * @dataProvider insertProvider
     */

    public function testInsert(string $table, array $data, array $expected) 
    {
        $this->database->insert($table, $data);

        $info = $this->database->getOne($table, $expected[1], $expected[0]);

        foreach ($info as $elem) {
            $this->assertEquals($expected[2], $elem['id']);
        }
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
     */

    public function testUpdate(string $table, array $data, array $where, $expected) 
    {
        $this->database->update($table, $data, $where);

        $info = $this->database->getOne('users', $data['login'], 'login');

        foreach ($info as $elem) {
            $this->assertEquals($expected, $elem['id']);
        }
    }

    /**
     * @dataProvider prepareJoinProvider
     */

    public function testPrepareJoin(array $selectQuery, array $tables, array $whereQuery, array $joinOn) 
    {
        $this->database->prepareJoin($selectQuery, $tables, $whereQuery, $joinOn);

        $this->assertEquals($selectQuery, $this->database->joinData['select']);
        $this->assertEquals($tables, $this->database->joinData['tables']);
        $this->assertEquals($whereQuery, $this->database->joinData['where']);
        $this->assertEquals($joinOn, $this->database->joinData['joinOn']);
    }

    /**
     * @dataProvider joinProvider
     */

    public function testJoin(array $selectQuery, array $tables, array $whereQuery, array $joinOn, $param, $expected) 
    {
        $data = $this->database->prepareJoin($selectQuery, $tables, $whereQuery, $joinOn)->join($param);

        foreach ($data as $elem) {
            if ($param == NULL) {
                $this->assertEquals($expected[1][0], $elem['id']);
                $this->assertEquals($expected[1][1], $elem['name']);
                $this->assertEquals($expected[1][2], $elem['city']);
            } else {
                $this->assertNotNull($elem[3]);
            }
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