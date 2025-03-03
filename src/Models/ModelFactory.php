<?php

namespace Permafrost\Dropbox\Models;

class ModelFactory
{
    /**
     * Make a Model Factory
     *
     * @param  array  $data  Model Data
     * @return \Permafrost\Dropbox\Models\ModelInterface
     */
    public static function make(array $data = [])
    {
        if (static::isFileOrFolder($data)) {
            $tag = $data['.tag'];

            //File
            if (static::isFile($tag)) {
                return new FileMetadata($data);
            }

            //Folder
            if (static::isFolder($tag)) {
                return new FolderMetadata($data);
            }
        }

        //Temporary Link
        if (static::isTemporaryLink($data)) {
            return new TemporaryLink($data);
        }

        //List
        if (static::isList($data)) {
            return new MetadataCollection($data);
        }

        //Search Results
        if (static::isSearchResult($data)) {
            return new SearchResults($data);
        }

        //Deleted File/Folder
        if (static::isDeletedFileOrFolder($data)) {
            return new DeletedMetadata($data);
        }

        //Base Model
        return new BaseModel($data);
    }

    /**
     * @return bool
     */
    protected static function isFileOrFolder(array $data)
    {
        return isset($data['.tag']) && isset($data['id']);
    }

    /**
     * @param  string  $tag
     * @return bool
     */
    protected static function isFile($tag)
    {
        return $tag === 'file';
    }

    /**
     * @param  string  $tag
     * @return bool
     */
    protected static function isFolder($tag)
    {
        return $tag === 'folder';
    }

    /**
     * @return bool
     */
    protected static function isTemporaryLink(array $data)
    {
        return isset($data['metadata']) && isset($data['link']);
    }

    /**
     * @return bool
     */
    protected static function isList(array $data)
    {
        return isset($data['entries']);
    }

    /**
     * @return bool
     */
    protected static function isSearchResult(array $data)
    {
        return isset($data['matches']);
    }

    /**
     * @return bool
     */
    protected static function isDeletedFileOrFolder(array $data)
    {
        return ! isset($data['.tag']) || ! isset($data['id']);
    }
}
