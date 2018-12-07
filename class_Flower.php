<?php

class Flower
{
    private $id;
    private $name;
    private $photo;
    private $description;
    private $annual;
    private $height;
    private $cost;
    private $color;
    private $shade;
    private $cover;
    private $cut;

/* getMethod */
    public function getid()
    {
     return $this->id;
    }
    public function getname()
    {
        return $this->name;
    }
    public function getphoto()
    {
        return $this->photo;
    }
    public function getdescription()
    {
        return $this->description;
    }
    public function getannual()
    {
        return $this->annual;
    }
    public function getheight()
    {
        return $this->height;
    }
    public function getcost()
    {
        return $this->cost;
    }
    public function getcolor()
    {
        return $this->color;
    }
    public function getshade()
    {
        return $this->shade;
    }
    public function getcover()
    {
        return $this->cover;
    }
    public function getcut()
    {
        return $this->cut;
    }

/* setMethod */
    public function setId($newId)
    {
        $this->id = $newId;
    }
    public function setName($newName)
    {
        $this->name = $newName;
    }
    public function setPhoto($newPhoto)
    {
        $this->photo = $newPhoto;
    }
    public function setDescription($newDescription)
    {
        $this->description = $newDescription;
    }
    public function setAnnual($newAnnual)
    {
        $this->annual = $newAnnual;
    }
    public function setHeight($newHeight)
    {
        $this->height = $newHeight;
    }
    public function setCost($newCost)
    {
        $this->cost = $newCost;
    }
    public function setColor($newColor)
    {
        $this->color = $newColor;
    }
    public function setShade($newShade)
    {
        $this->shade = $newShade;
    }
    public function setCover($newCover)
    {
        $this->cover = $newCover;
    }
    public function setCut($newCut)
    {
        $this->cut = $newCut;
    }

    public function save()
    {
        
    }

    public function load()
    {

    }
}