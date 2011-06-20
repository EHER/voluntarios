<?php

namespace Eher\VoluntariosBundle\Entity;

use Doctrine\REST\Client\Entity,
    Doctrine\REST\Client\EntityConfiguration,
    Doctrine\REST\Client\URLGenerator\ApontadorURLGenerator;

/**
 * Description of Place
 *
 * @author alexandreeher
 */
class Place extends Entity
{

    private $id;
    private $name;
    private $description;
    private $click_count;
    private $review_count;
    private $average_rating;
    private $thumbs;
    private $category;
    private $address;
    private $phone;
    private $created;
    private $point;
    private $main_url;
    private $icon_url;
    private $other_url;

    public static function configure(EntityConfiguration $entityConfiguration)
    {
        $entityConfiguration->setUsername(APONTADOR_KEY);
        $entityConfiguration->setPassword(APONTADOR_SECRET);
        $entityConfiguration->setUrl("http://api.apontador.com.br/v1");
        $entityConfiguration->setName("places");
        $entityConfiguration->setResponseType('xml');
        $entityConfiguration->setURLGeneratorImpl(new ApontadorUrlGenerator($entityConfiguration));
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getClick_count()
    {
        return $this->click_count;
    }

    public function setClick_count($click_count)
    {
        $this->click_count = $click_count;
    }

    public function getReview_count()
    {
        return $this->review_count;
    }

    public function setReview_count($review_count)
    {
        $this->review_count = $review_count;
    }

    public function getAverage_rating()
    {
        return $this->average_rating;
    }

    public function setAverage_rating($average_rating)
    {
        $this->average_rating = $average_rating;
    }

    public function getThumbs()
    {
        return $this->thumbs;
    }

    public function setThumbs($thumbs)
    {
        $this->thumbs = $thumbs;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddress($address)
    {
        $this->address = $address;
    }

    public function getPhone()
    {
        return $this->phone;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function getCreated()
    {
        return $this->created;
    }

    public function setCreated($created)
    {
        $this->created = $created;
    }

    public function getPoint()
    {
        return $this->point;
    }

    public function setPoint($point)
    {
        $this->point = $point;
    }

    public function getMain_url()
    {
        return $this->main_url;
    }

    public function setMain_url($main_url)
    {
        $this->main_url = $main_url;
    }

    public function getIcon_url()
    {
        return $this->icon_url;
    }

    public function setIcon_url($icon_url)
    {
        $this->icon_url = $icon_url;
    }

    public function getOther_url()
    {
        return $this->other_url;
    }

    public function setOther_url($other_url)
    {
        $this->other_url = $other_url;
    }

}
