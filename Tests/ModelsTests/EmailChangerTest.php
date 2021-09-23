<?php
use PHPUnit\Framework\TestCase;
use App\Models\EmailChanger;
use App\Models\Database;

class EmailChangerTest extends TestCase
{
    private $emailChanger, $database;

    protected function setUp(): void 
    {
        $this->emailChanger = new EmailChanger();
        $this->database = new Database();
    }

    public function addEmailToChangeTableProvider()
    {
        return [
            ['newchange1@email.verify', 'vdsvc@fef.ru', 'sessionlink1'],
            ['newchange2@email.verify', 'cbfdbdf@efe.ru', 'sessionlink2'],
            ['newchange3@email.verify', 'bibaboba@ffd.ru', 'sessionlink3'],
            ['newchange4@email.verify', 'newemail@test.ru', 'sessionlink4']
        ];
    }

    public function changeEmailProvider()
    {
        return [
            ['sessionlink1', 66, 'newchange1@email.verify'],
            ['sessionlink2', 67, 'newchange2@email.verify'],
            ['sessionlink3', 68, 'newchange3@email.verify'],
            ['sessionlink4', 69, 'newchange4@email.verify']
        ];
    }

    /**
     * @dataProvider addEmailToChangeTableProvider
     */

    public function testAddEmailToChangeTable($newEmail, $currentEmail, $sessionLink)
    {
        $_SESSION['changeemail_link'] = $sessionLink;

        $this->emailChanger->addEmailToChangeTable($newEmail, $currentEmail);

        $test = $this->database->dbQuery("SELECT * FROM emails_changes WHERE link = ?", [$sessionLink])->fetch();
        $this->assertEquals($newEmail, $test['new_email']);
        $this->assertEquals($currentEmail, $test['current_email']);
    }

    /**
     * @dataProvider changeEmailProvider
     */

    public function testChangeEmail($sessionLink, $userId, $expected)
    {
        $_SESSION['user_id'] = $userId;

        $this->emailChanger->changeEmail($sessionLink);

        $email = $this->database->dbQuery("SELECT email FROM users WHERE id = ?", [$userId])->fetchColumn();
        $this->assertEquals($expected, $email);
    }

    protected function tearDown(): void
    {
        $this->emailChanger = NULL;
        $this->database = NULL;
    }
}