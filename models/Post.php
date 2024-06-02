<?php

namespace models;

class Post extends Model
{

    protected $title;
    protected $image;
    protected $slug;
    protected $content;
    protected $author;
    protected $creationDate;
    protected $modificationDate;
    protected $published;
    protected $userId;


    //GETTERS    

    function getTitle()
    {
        return $this->title;
    }

    function getImage()
    {
        return $this->image;
    }

    function getSlug()
    {
        return $this->slug;
    }

    function getContent()
    {
        return $this->content;
    }

    function getAuthor()
    {
        return $this->author;
    }

    function getCreationDate()
    {
        return $this->creationDate;
    }

    function getModificationDate()
    {
        return $this->modificationDate;
    }

    function getPublished()
    {
        return $this->published;
    }

    function getUserId()
    {
        return $this->userId;
    }

    //SETTERS

    function setId($id)
    {
        $this->id = $id;
    }

    function setTitle($title)
    {
        $this->title = $title;
    }

    function setImage($image)
    {
        $this->image = $image;
    }
    function setSlug($slug)
    {
        $this->slug = $slug;
    }

    function setContent($content)
    {
        $this->content = $content;
    }

    function setAuthor($author)
    {
        $this->author = $author;
    }

    function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }

    function setModificationDate($modificationDate)
    {
        $this->modificationDate = $modificationDate;
    }

    function setPublished($published)
    {
        $this->published = $published;
    }

    function setUserId($userId)
    {
        $this->userId = $userId;
    }
}
