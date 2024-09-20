<?php

namespace Permafrost\Dropbox\Models;

use Permafrost\Dropbox\DropboxFile;

class File extends BaseModel
{
    /**
     * The file contents
     *
     * @var string|DropboxFile
     */
    protected $contents;

    /**
     * File Metadata
     *
     * @var \Permafrost\Dropbox\Models\FileMetadata
     */
    protected $metadata;

    /**
     * Create a new File instance
     *
     * @param  string|DropboxFile  $contents
     */
    public function __construct(array $data, $contents)
    {
        parent::__construct($data);
        $this->contents = $contents;
        $this->metadata = new FileMetadata($data);
    }

    /**
     * The metadata for the file
     *
     * @return \Permafrost\Dropbox\Models\FileMetadata
     */
    public function getMetadata()
    {
        return $this->metadata;
    }

    /**
     * Get the file contents
     *
     * @return string
     *
     * @throws \Permafrost\Dropbox\Exceptions\DropboxClientException
     */
    public function getContents()
    {
        if ($this->contents instanceof DropboxFile) {
            return $this->contents->getContents();
        }

        return $this->contents;
    }
}
