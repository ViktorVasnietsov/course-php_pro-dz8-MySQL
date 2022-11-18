<?php
namespace Viktor\PhpPro\Shortener;

use Viktor\PhpPro\Shortener\Exceptions\DataNotFoundException;
use Viktor\PhpPro\Shortener\Exceptions\UrlNotFoundException;
use Viktor\PhpPro\Shortener\Interfaces\ICodeRepository;
use Viktor\PhpPro\Shortener\ValueObjects\UrlCodePair;

class FileRepository implements ICodeRepository
{
    protected string $fileDb;
    protected array $db = [];

    /**
     * @param string $fileDb
     */
    public function __construct(string $fileDb)
    {
        $this->fileDb = $fileDb;
        $this->getDbFromStorage();
    }

    /**
     * @return void
     */

    protected function getDbFromStorage(): void
    {
        if(file_exists($this->fileDb)){
            $content = file_get_contents($this->fileDb);
            $this->db = (array)json_decode($content,true);
        }
    }
    /**
     * @param UrlCodePair $urlCodePair
     * @return bool
     */
    public function saveEntity(UrlCodePair $urlCodePair): bool
    {
        $this->db[$urlCodePair->getCode()] = $urlCodePair->getUrl();
        return true;
    }

    /**
     * @param string $code
     * @return bool
     */
    public function codeIsset(string $code): bool
    {
        return isset($this->db[$code]);
    }
    /**
     * @param string $code
     * @return string code
     * @throws DataNotFoundException
     */

    public function getUrlByCode(string $code): string
    {
        if(!$this->codeIsset($code)){
            throw new UrlNotFoundException();
        }
        return $this->db[$code];
    }
    /**
     * @param string $url
     * @return string code
     * @throws DataNotFoundException
     */
    public function getCodeByUrl(string $url): string
    {
        if(!$code = array_search($url,$this->db)){
            throw new DataNotFoundException();
        }
        return $code;
    }

    protected function writeFile(string $content):void
    {
        $file = fopen($this->fileDb, 'w+');
        fwrite($file, $content);
        fclose($file);

    }
    public function __destruct()
    {
        $this->writeFile(json_encode($this->db));

    }

}