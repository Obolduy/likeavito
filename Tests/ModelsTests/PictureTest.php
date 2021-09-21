<?php
use PHPUnit\Framework\TestCase;
use App\Models\Picture;

class PictureTest extends TestCase
{
    private $picture;

    protected function setUp(): void 
    {
        $this->picture = new Picture();
    }

    public function connectionProvider()
    {
        return [
            
        ];
    }

    /**
     * @dataProvider uploadPictureProvider
     */

    public function testUploadPicture()
    {
        
    }

    /**
     * @dataProvider deletePicturesByPathProvider
     */

    public function testDeletePicturesByPath()
    {
        
    }

    /**
     * @dataProvider renameUploadedPictureProvider
     */

    public function testRenameUploadedPicture()
    {
        
    }

    protected function tearDown(): void
    {
        $this->database = NULL;
    }
}