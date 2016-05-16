<?php

namespace Nav\WunderlistBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WunderlistAccount
 *
 * @ORM\Table(name="wunderlist_account")
 * @ORM\Entity(repositoryClass="Nav\WunderlistBundle\Repository\WunderlistAccountRepository")
 */
class WunderlistAccount
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255,nullable=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="passsword", type="string", length=255,nullable=true)
     */
    private $passsword;

    /**
     * @var string
     *
     * @ORM\Column(name="account_id", type="integer", nullable=true)
     */
    private $accountId;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var string
     *
     * @ORM\Column(name="revision", type="string", length=255, nullable=true)
     */
    private $revision;

    /**
     * @var string
     *
     * @ORM\Column(name="access_token", type="string", length=255, nullable=true)
     */
    private $accessToken;

    /**
     * @var string
     *
     * @ORM\Column(name="client_id", type="string", length=255, nullable=true)
     */
    private $clientId;


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
     * Set name
     *
     * @param string $name
     *
     * @return WunderlistAccount
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return WunderlistAccount
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return WunderlistAccount
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
     * Set revision
     *
     * @param string $revision
     *
     * @return WunderlistAccount
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
     * Set accessToken
     *
     * @param string $accessToken
     *
     * @return WunderlistAccount
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    /**
     * Get accessToken
     *
     * @return string
     */
    public function getAccessToken()
    {
        return $this->accessToken;
    }

    /**
     * @return string
     */
    public function getAccountId()
    {
        return $this->accountId;
    }

    /**
     * @param string $accountId
     * @return WunderlistAccount
     */
    public function setAccountId($accountId)
    {
        $this->accountId = $accountId;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return WunderlistAccount
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getPasssword()
    {
        return $this->passsword;
    }

    /**
     * @param string $passsword
     * @return WunderlistAccount
     */
    public function setPasssword($passsword)
    {
        $this->passsword = $passsword;
        return $this;
    }

    /**
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param string $clientId
     * @return WunderlistAccount
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
        return $this;
    }
    
    
}

