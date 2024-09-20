<?php

namespace Permafrost\Dropbox;

class DropboxResponseToFile extends DropboxResponse
{
    /**
     * @var DropboxFile
     */
    protected $file;

    /**
     * Create a new DropboxResponse instance
     *
     * @param  int|null  $httpStatusCode
     */
    public function __construct(DropboxRequest $request, DropboxFile $file, $httpStatusCode = null, array $headers = [])
    {
        parent::__construct($request, null, $httpStatusCode, $headers);
        $this->file = $file;
    }

    /**
     * @throws Exceptions\DropboxClientException
     */
    public function getBody()
    {
        return $this->file->getContents();
    }

    public function getFilePath()
    {
        return $this->file->getFilePath();
    }

    public function getSteamOrFilePath()
    {
        return $this->file->getStreamOrFilePath();
    }
}
