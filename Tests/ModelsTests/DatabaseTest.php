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

    public function dbQueryProvider()
    {
        return [
            'select all' => ['SELECT * FROM users', null, null],
            'select id' => ["SELECT id FROM users WHERE id = ?", [66], 66],
            'delete' => ['DELETE FROM users WHERE login = ?', ['djfnjffjndj'], 'djfnjffjndj'],
            'update' => ['UPDATE users SET login = ? WHERE id = 66', ['newtesttlogin'], 'newtesttlogin']
        ];
    }

    // add more tests
    public function transactionProvider()
    {
        return [
            [[['UPDATE users SET email = ? WHERE id = ?', ['newemail@test.ru', 69]], ['UPDATE names SET name = ? WHERE user_id = ?', ['holynewname', 69]], ['UPDATE surnames SET surname = ? WHERE user_id = ?', ['neeewsurname', 69]]], ['email' => 'newemail@test.ru', 'name' => 'holynewname', 'surname' => 'neeewsurname']]
        ];
    }

    /**
     * @dataProvider dbQueryProvider
     */

    public function testDbQuery(string $query, ?array $preparedData, $expected) 
    {
        $test = $this->database->dbQuery($query, $preparedData);

        if ($expected == null) {
            $this->assertNotNull($test->fetchAll());
        }

        if (is_int($expected)) {
            $this->assertEquals($expected, $test->fetchColumn());
        }

        if ($expected == 'djfnjffjndj') {
            $this->assertFalse($this->database->dbQuery('SELECT login FROM users WHERE login = ?', ['djfnjffjndj'])->fetchColumn());
        }

        if ($expected == 'newtesttlogin') {
            $this->assertEquals(
                $expected,
                $this->database->dbQuery('SELECT login FROM users WHERE id = ?', [66])->fetchColumn()
            );
        }
    }

    /**
     * @dataProvider transactionProvider
     */

    public function testTransaction(array $queries, array $expected)
    {
        $this->database->transaction($queries);

        $test = $this->database->dbQuery('SELECT u.email, n.name, s.surname FROM users AS u 
            JOIN names AS n ON u.id = n.user_id JOIN surnames AS s ON u.id = s.user_id WHERE u.id = 69')
                ->fetch();
        
        foreach ($test as $key => $value) {
            $this->assertEquals($value, $expected[$key]);
        }
    }

    protected function tearDown(): void
    {
        $this->database = NULL;
    }
}