<?php

namespace Hillel\Shortener;

use Hillel\Shortener\Exceptions\DataNotFoundException;
use Hillel\Shortener\Interfaces\ICodeRepository;
use Hillel\Shortener\ValueObjects\UrlCodePair;

class FileRepository implements ICodeRepository
{
    protected array $db = [];

    /**
     * @param string $fileDb
     */
    public function __construct(protected string $fileDb)
    {
        $this->getDbFromStorage();
    }

    /**
     * @return void
     */
    protected function getDbFromStorage(): void
    {
        if (file_exists($this->fileDb)) {
            $content = file_get_contents($this->fileDb);
            $this->db = (array)json_decode($content, true);
        }
    }

    /**
     * @param UrlCodePair $urlCodePair
     * @return bool
     */
    public function saveEntity(UrlCodePair $urlCodePair): bool
    {
        $this->db[$urlCodePair->code] = $urlCodePair->url;
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
        if (!$this->codeIsset($code)) {
            throw new DataNotFoundException();
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
        if (!$code = array_search($url, $this->db)) {
            throw new DataNotFoundException();
        }
        return $code;
    }

    protected function writeFile(string $content): void
    {
        $file = fopen($this->fileDb, 'w+');
        fwrite($file, $content);
        fclose($file);
    }

    /**
     * Зберегаємо в файл лише при вивільненні памʼяті
     */
    public function __destruct()
    {
        $this->writeFile(json_encode($this->db, JSON_PRETTY_PRINT)); // json_encode($this->db) це те, що потрапляє в аргумент
    }

    public function getAll(): array
    {
        return $this->db;
    }

}
