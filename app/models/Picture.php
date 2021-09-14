<?php
namespace App\Models;

class Picture extends Model
{    
    public $picturesNames = [];

    /**
	 * Upload picture to the server, returns array with names of uploaded files
	 * @param string directory path (from 'img/')
     * @param array $_FILES['input_name']
	 * @return array
	 */

    public function uploadPicture(string $dir, array $pictures): array
    {
        if (!is_dir("img/$dir")) {
            mkdir("img/$dir");
        }

        for ($i = 0; $i < count($pictures['name']); $i++) {
            $photo = $this->renameUploadedPicture($pictures['name'][$i]);

            move_uploaded_file($pictures['tmp_name'][$i], "img/$dir/$photo");

            $this->picturesNames[] = $photo;
        }

        return $this->picturesNames; 
    }

    public function deletePicturesByPath(string $path): void
    {
        if (is_dir($_SERVER['DOCUMENT_ROOT'] . "img/$path")) {
            rmdir($_SERVER['DOCUMENT_ROOT'] . "img/$path");
        } else {
            unlink($_SERVER['DOCUMENT_ROOT'] . "img/$path");
        }
    }

     /**
	 * Rename picture by md5-hashing and return new name.
	 * @param string user`s name of picture
	 * @return string hashed name of picture
	 */

    private function renameUploadedPicture(string $pictureName): string
    {
        $ext = '';
        preg_match_all('#\.[A-Za-z]{3,4}$#', $pictureName, $ext);

        return md5($pictureName) . $ext[0][0];
    }
}