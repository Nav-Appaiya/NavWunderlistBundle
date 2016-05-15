<?php

namespace Nav\WunderlistBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WunderlistList
 *
 * @ORM\Table(name="wunderlist_list")
 * @ORM\Entity(repositoryClass="Nav\WunderlistBundle\Repository\WunderlistListRepository")
 */
class WunderlistList
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="string", length=36)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="wunderlist_id", type="string", nullable=true)
     */
    private $wunderlistId;


    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="owner_type", type="string", length=255)
     */
    private $ownerType;

    /**
     * @var int
     *
     * @ORM\Column(name="owner_id", type="integer")
     */
    private $ownerId;

    /**
     * @var string
     *
     * @ORM\Column(name="list_type", type="string", length=255)
     */
    private $listType;

    /**
     * @var string
     *
     * @ORM\Column(name="public", type="string", length=255, nullable=true)
     */
    private $public;

    /**
     * @var string
     *
     * @ORM\Column(name="revision", type="string", length=255)
     */
    private $revision;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, nullable=true)
     */
    private $type;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return WunderlistList
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set ownerType
     *
     * @param string $ownerType
     *
     * @return WunderlistList
     */
    public function setOwnerType($ownerType)
    {
        $this->ownerType = $ownerType;

        return $this;
    }

    /**
     * Get ownerType
     *
     * @return string
     */
    public function getOwnerType()
    {
        return $this->ownerType;
    }

    /**
     * Set ownerId
     *
     * @param integer $ownerId
     *
     * @return WunderlistList
     */
    public function setOwnerId($ownerId)
    {
        $this->ownerId = $ownerId;

        return $this;
    }

    /**
     * Get ownerId
     *
     * @return int
     */
    public function getOwnerId()
    {
        return $this->ownerId;
    }

    /**
     * Set listType
     *
     * @param string $listType
     *
     * @return WunderlistList
     */
    public function setListType($listType)
    {
        $this->listType = $listType;

        return $this;
    }

    /**
     * Get listType
     *
     * @return string
     */
    public function getListType()
    {
        return $this->listType;
    }

    /**
     * Set public
     *
     * @param string $public
     *
     * @return WunderlistList
     */
    public function setPublic($public)
    {
        $this->public = $public;

        return $this;
    }

    /**
     * Get public
     *
     * @return string
     */
    public function getPublic()
    {
        return $this->public;
    }

    /**
     * Set revision
     *
     * @param string $revision
     *
     * @return WunderlistList
     */
    public function setRevision($revision)
    {
        $this->revision = $revision;

        return $this;
    }

    /**
     * Get revision
     *
     * @return string
     */
    public function getRevision()
    {
        return $this->revision;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return WunderlistList
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return WunderlistList
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getWunderlistId()
    {
        return $this->wunderlistId;
    }

    /**
     * @param int $wunderlistId
     */
    public function setWunderlistId($wunderlistId)
    {
        $this->wunderlistId = $wunderlistId;
    }

}

