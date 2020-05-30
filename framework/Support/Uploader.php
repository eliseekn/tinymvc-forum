<?php

/**
 * TinyMVC
 * 
 * PHP framework based on MVC architecture
 * 
 * @copyright 2019-2020 - N'Guessan Kouadio Elisée (eliseekn@gmail.com)
 * @license MIT (https://opensource.org/licenses/MIT)
 * @link https://github.com/eliseekn/TinyMVC
 */

namespace Framework\Support;

/**
 * Uploader
 * 
 * Manage uploaded file
 */
class Uploader
{    
    /**
     * file
     *
     * @var array
     */
    public $file = [];
    
    /**
     * filename destination path
     *
     * @var string
     */
    public $filepath = '';
    
    /**
     * __construct
     *
     * @param  array $file
     * @return void
     */
    public function __construct(array $file)
    {
        $this->file = $file;
    }
    
    /**
     * getOriginalFilename
     *
     * @return string
     */
    public function getOriginalFilename(): string
    {
        return $this->file['name'] ?? '';
    }
    
    /**
     * getTempFilename
     *
     * @return string
     */
    public function getTempFilename(): string
    {
        return $this->file['tmp_name'] ?? '';
    }
        
    /**
     * getFileType
     *
     * @return string
     */
    public function getFileType(): string
    {
        return $this->file['type'] ?? '';
    }
        
    /**
     * getFileExtension
     *
     * @return string
     */
    public function getFileExtension(): string
    {
        return empty($this->getOriginalFilename()) ? '' : explode('.', $this->getOriginalFilename())[1];
    }
        
    /**
     * getfileize
     *
     * @return int
     */
    public function getfileize(): int
    {
        return $this->file['size'] ?? 0;
    }

    /**
     * move uploaded file
     *
     * @param  string $destination file destination
     * @param  string|null $filename uploaded filename
     * @return bool returns true or false
     */
    public function moveTo(string $destination, ?string $filename = null): bool
    {
        $filename = is_null($filename) ? $this->getOriginalFilename() : $filename;
        $this->filepath = $destination . DIRECTORY_SEPARATOR . $filename;
        return empty($filename) ? false : Storage::moveFile($this->getTempFilename(), $this->filepath);
    }
}