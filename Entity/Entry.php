<?php
/**
 * Created by PhpStorm.
 * User: sjoder
 * Date: 13.03.2018
 * Time: 13:14
 */

namespace PM\Bundle\LoggerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use PM\Bundle\LoggerBundle\Component\EntityModel\EntryEntityModel;
use PM\Bundle\ToolBundle\Framework\Annotations\UniqueId;
use PM\Bundle\ToolBundle\Framework\Interfaces\HasUniqueIdEntityInterface;

/**
 * Class Entry
 *
 * @package PM\Bundle\LoggerBundle\Entity
 *
 * @ORM\Table(name="pm_logger_entry")
 * @ORM\Entity(repositoryClass="PM\Bundle\LoggerBundle\Repository\EntryRepository")
 */
class Entry extends EntryEntityModel implements HasUniqueIdEntityInterface
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
     * @var string
     *
     * @ORM\Column(name="unique_id", type="string", length=255, unique=true)
     *
     * @UniqueId(length=12)
     */
    private $uniqueId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=20)
     */
    private $type;

    /**
     * @var string
     *
     * @ORM\Column(name="request_uri", type="string", length=255)
     */
    private $requestUri;

    /**
     * @var string
     *
     * @ORM\Column(name="request_method", type="string", length=10)
     */
    private $requestMethod;

    /**
     * @var string
     *
     * @ORM\Column(name="exception_class", type="string", length=255)
     */
    private $exceptionClass;

    /**
     * @var string
     *
     * @ORM\Column(name="exception_code", type="string", length=10)
     */
    private $exceptionCode;

    /**
     * @var string
     *
     * @ORM\Column(name="exception_message", type="text")
     */
    private $exceptionMessage;

    /**
     * @var int|null
     *
     * @ORM\Column(name="user_active", type="integer", nullable=true)
     */
    private $userActive;

    /**
     * @var integer
     *
     * @ORM\Column(name="error_code", type="integer")
     */
    private $errorCode;

    /**
     * @var string
     *
     * @ORM\Column(name="context", type="text")
     */
    private $context;

    /**
     * Entry constructor.
     */
    public function __construct()
    {
        $this->setCreated(new \DateTime());
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getUniqueId()
    {
        return $this->uniqueId;
    }

    /**
     * @param string $uniqueId
     *
     * @return Entry
     */
    public function setUniqueId($uniqueId)
    {
        $this->uniqueId = $uniqueId;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     *
     * @return Entry
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * @return string
     */
    public function getRequestUri()
    {
        return $this->requestUri;
    }

    /**
     * @param string $requestUri
     *
     * @return Entry
     */
    public function setRequestUri($requestUri)
    {
        $this->requestUri = $requestUri;

        return $this;
    }

    /**
     * @return string
     */
    public function getRequestMethod()
    {
        return $this->requestMethod;
    }

    /**
     * @param string $requestMethod
     *
     * @return Entry
     */
    public function setRequestMethod($requestMethod)
    {
        $this->requestMethod = $requestMethod;

        return $this;
    }

    /**
     * @return string
     */
    public function getExceptionClass()
    {
        return $this->exceptionClass;
    }

    /**
     * @param string $exceptionClass
     *
     * @return Entry
     */
    public function setExceptionClass($exceptionClass)
    {
        $this->exceptionClass = $exceptionClass;

        return $this;
    }

    /**
     * @return string
     */
    public function getExceptionCode()
    {
        return $this->exceptionCode;
    }

    /**
     * @param string $exceptionCode
     *
     * @return Entry
     */
    public function setExceptionCode($exceptionCode)
    {
        $this->exceptionCode = $exceptionCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getExceptionMessage()
    {
        return $this->exceptionMessage;
    }

    /**
     * @param string $exceptionMessage
     *
     * @return Entry
     */
    public function setExceptionMessage($exceptionMessage)
    {
        $this->exceptionMessage = $exceptionMessage;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getUserActive()
    {
        return $this->userActive;
    }

    /**
     * @param int|null $userActive
     *
     * @return Entry
     */
    public function setUserActive($userActive)
    {
        $this->userActive = $userActive;

        return $this;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     *
     * @return Entry
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return int
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * @param int $errorCode
     *
     * @return Entry
     */
    public function setErrorCode($errorCode)
    {
        $this->errorCode = $errorCode;

        return $this;
    }

    /**
     * @return string
     */
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @param string $context
     *
     * @return Entry
     */
    public function setContext($context)
    {
        $this->context = $context;

        return $this;
    }

}