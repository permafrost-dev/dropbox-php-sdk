<?php

namespace Permafrost\Dropbox\Models;

class SearchResult extends BaseModel
{
    /**
     * Indicates what type of match was found for the result
     *
     * @var string
     */
    protected $matchType = null;

    /**
     * File\Folder Metadata
     *
     * @var \Permafrost\Dropbox\Models\FileMetadata|\Permafrost\Dropbox\Models\FolderMetadata
     */
    protected $metadata;

    /**
     * Create a new SearchResult instance
     */
    public function __construct(array $data)
    {
        parent::__construct($data);
        $matchType = $this->getDataProperty('match_type');
        $this->matchType = isset($matchType['.tag']) ? $matchType['.tag'] : null;
        $this->setMetadata();
    }

    /**
     * Set Metadata
     *
     * @return void
     */
    protected function setMetadata()
    {
        $metadata = $this->getDataProperty('metadata');

        if (is_array($metadata)) {
            $this->metadata = ModelFactory::make($metadata);
        }
    }

    /**
     * Indicates what type of match was found for the result
     *
     * @return bool
     */
    public function getMatchType()
    {
        return $this->matchType;
    }

    /**
     * Get the Search Result Metadata
     *
     * @return \Permafrost\Dropbox\Models\FileMetadata|\Permafrost\Dropbox\Models\FolderMetadata
     */
    public function getMetadata()
    {
        return $this->metadata;
    }
}
