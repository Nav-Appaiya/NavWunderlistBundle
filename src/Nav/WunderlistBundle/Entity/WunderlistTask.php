<?php

namespace Nav\WunderlistBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WunderlistTask
 *
 * @ORM\Table(name="wunderlist_task")
 * @ORM\Entity(repositoryClass="Nav\WunderlistBundle\Repository\WunderlistTaskRepository")
 */
class WunderlistTask
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="task_id", type="integer")
     */
    private $taskId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var int
     *
     * @ORM\Column(name="created_by_id", type="integer")
     */
    private $createdById;

    /**
     * @var int
     *
     * @ORM\Column(name="created_by_request_id", type="string", nullable=true)
     */
    private $createdByRequestId;

    /**
     * @var bool
     *
     * @ORM\Column(name="completed", type="boolean")
     */
    private $completed;

    /**
     * @var bool
     *
     * @ORM\Column(name="starred", type="boolean")
     */
    private $starred;

    /**
     * @var int
     *
     * @ORM\Column(name="list_id", type="integer")
     */
    private $listId;

    /**
     * @var string
     *
     * @ORM\Column(name="revision", type="string", length=255)
     */
    private $revision;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
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
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return WunderlistTask
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
     * Set createdById
     *
     * @param integer $createdById
     *
     * @return WunderlistTask
     */
    public function setCreatedById($createdById)
    {
        $this->createdById = $createdById;

        return $this;
    }

    /**
     * Get createdById
     *
     * @return int
     */
    public function getCreatedById()
    {
        return $this->createdById;
    }

    /**
     * Set createdByRequestId
     *
     * @param integer $createdByRequestId
     *
     * @return WunderlistTask
     */
    public function setCreatedByRequestId($createdByRequestId)
    {
        $this->createdByRequestId = $createdByRequestId;

        return $this;
    }

    /**
     * Get createdByRequestId
     *
     * @return int
     */
    public function getCreatedByRequestId()
    {
        return $this->createdByRequestId;
    }

    /**
     * Set completed
     *
     * @param boolean $completed
     *
     * @return WunderlistTask
     */
    public function setCompleted($completed)
    {
        $this->completed = $completed;

        return $this;
    }

    /**
     * Get completed
     *
     * @return bool
     */
    public function getCompleted()
    {
        return $this->completed;
    }

    /**
     * Set starred
     *
     * @param boolean $starred
     *
     * @return WunderlistTask
     */
    public function setStarred($starred)
    {
        $this->starred = $starred;

        return $this;
    }

    /**
     * Get starred
     *
     * @return bool
     */
    public function getStarred()
    {
        return $this->starred;
    }

    /**
     * Set listId
     *
     * @param integer $listId
     *
     * @return WunderlistTask
     */
    public function setListId($listId)
    {
        $this->listId = $listId;

        return $this;
    }

    /**
     * Get listId
     *
     * @return int
     */
    public function getListId()
    {
        return $this->listId;
    }

    /**
     * Set revision
     *
     * @param string $revision
     *
     * @return WunderlistTask
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
     * Set title
     *
     * @param string $title
     *
     * @return WunderlistTask
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
     * Set type
     *
     * @param string $type
     *
     * @return WunderlistTask
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
    public function getTaskId()
    {
        return $this->taskId;
    }

    /**
     * @param int $taskId
     * @return WunderlistTask
     */
    public function setTaskId($taskId)
    {
        $this->taskId = $taskId;
        return $this;
    }
    
}

