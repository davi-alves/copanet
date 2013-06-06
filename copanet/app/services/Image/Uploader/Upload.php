<?php

namespace Services\Image\Uploader;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use \Config;
use \File;
use \DateTime;
use \DateTimeZone;

class Upload
{

    /**
     * Base upload path
     * @var string
     */
    protected $baseUploadPath;
    /**
     * Base upload url
     * @var string
     */
    protected $baseUploadUrl;

    public function save(UploadedFile &$image)
    {
        $fileName = $image->getClientOriginalName();
        $destination = $this->getDestinationPath();
        $fileName = $this->checkFileName($fileName, $destination);
        $image->move($destination, $fileName);

        $path = "$destination/$fileName";
        $url = $this->getUrlFromPath($path);

        return compact('url', 'path');
    }

    public function getUrlFromPath($path)
    {
        $url = $this->getBaseUploadUrl();
        $url = substr($path, strpos($path, $url));

        return $url;
    }

    /**
     * @return string
     */
    public function getBaseUploadPath()
    {
        if( null === $this->baseUploadPath) {
            $this->baseUploadPath = Config::get('misc.upload.path');
        }

        return $this->baseUploadPath;
    }

    /**
     * @return string
     */
    public function getBaseUploadUrl()
    {
        if( null === $this->baseUploadUrl) {
            $this->baseUploadUrl = Config::get('misc.upload.url');
        }

        return $this->baseUploadUrl;
    }

    /**
     * Create a folter according to the date and return the path
     * @return string Absolute path
     */
    protected function getDestinationPath()
    {
        $now = new DateTime('now', new DateTimeZone('America/Fortaleza'));
        $destination = $this->getBaseUploadPath() . '/' . $now->format('Y') . '/' . $now->format('m') . '/' . $now->format('d');
        if (!File::isDirectory($destination)) {
            FIle::makeDirectory($destination, 0777, true);
        }

        return $destination;
    }

    /**
     *  Create a file name alias and check if it already exists
     * @param string $name
     * @return string
     */
    protected function checkFileName($name, $path)
    {
        $nameArray = explode('.', $name);
        //- extension
        $ext = array_pop($nameArray);
        //- filtered file name
        $name = $this->createAlias(implode('.', $nameArray));

        //- check if file already exists and set a new name
        $count = 1;
        $newName = $name . ".{$ext}";
        while (File::exists($path . "/{$newName}")) {
            $newName = $name . "-{$count}.{$ext}";
            $count++;
        }

        return $newName;
    }

    /**
     * Create alias string
     * @param string $text
     * @param boolean $strtolower
     * @return string
     */
    protected function createAlias($text, $strtolower = true)
    {
        $array1 = array('"', "'", ')', '(', '!', ' ', '´', '`', '^', '~', 'á', 'à', 'â', 'ã', 'ä', 'é', 'è', 'ê', 'ë', 'í', 'ì', 'î', 'ï', 'ó', 'ò', 'ô', 'õ', 'ö', 'ú', 'ù', 'û', 'ü', 'ç', 'Á', 'À', 'Â', 'Ã', 'Ä', 'É', 'È', 'Ê', 'Ë', 'Í', 'Ì', 'Î', 'Ï', 'Ó', 'Ò', 'Ô', 'Õ', 'Ö', 'Ú', 'Ù', 'Û', 'Ü', 'Ç', '?', '.');
        $array2 = array('', '', '', '', '', '-', '', '', '', '', 'a', 'a', 'a', 'a', 'a', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'c', 'A', 'A', 'A', 'A', 'A', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'C', '', '');
        if ($strtolower) {
            return strtolower(str_replace($array1, $array2, $text));
        } else {
            return str_replace($array1, $array2, $text);
        }
    }
}
