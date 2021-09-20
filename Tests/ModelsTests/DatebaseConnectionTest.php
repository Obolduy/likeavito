<?php
use PHPUnit\Framework\TestCase;
use App\Models\DatabaseConnection;

class DatebaseConnectionTest extends TestCase
{
    private $databaseConnection;

    protected function setUp(): void 
    {
        $this->databaseConnection = new DatabaseConnection();
    }

    public function connectionProvider()
    {
        return [
            ['mysql', 'localhost', 'marketplace', 'root', 1111],
            ['mysql', 'localhost', 'marktplace', 'root', 'root'],
        ];
    }

    /**
     * @dataProvider connectionProvider
     */

    public function testConnection(string $dbms, string $host, string $dbName, string $login, $password)
    {
        // exception
        if ($dbName !== 'marketplace') {
            $this->assertIsNotObject($this->databaseConnection->connection($dbms, $host, $dbName, $login, $password));
        } else {
            $this->assertIsObject($this->databaseConnection->connection($dbms, $host, $dbName, $login, $password));
        }
        
    }

    protected function tearDown(): void
    {
        $this->database = NULL;
    }
}