<?php
/**
 * Created by PhpStorm.
 * User: sjoder
 * Date: 13.03.2018
 * Time: 13:14
 */

namespace PM\Bundle\LoggerBundle\Component\EntityModel;

use FOS\UserBundle\Model\User;
use PM\Bundle\LoggerBundle\Entity\Entry;
use Symfony\Component\HttpFoundation\Request;


/**
 * Class EntryEntityModel
 *
 * @package PM\Bundle\LoggerBundle\Component\EntityModel
 */
class EntryEntityModel
{
    const TYPE_ERROR = 'error';
    const TYPE_WARNING = 'warning';

    /**
     * Get Types
     *
     * @return array
     */
    public static function getTypes()
    {
        return [
            self::TYPE_ERROR,
            self::TYPE_WARNING,
        ];
    }

    /**
     * Set Exception
     *
     * @param \Exception $exception
     *
     * @return $this
     */
    public function setException(\Exception $exception)
    {
        if ($this instanceof Entry) {
            $this
                ->setExceptionClass(get_class($exception))
                ->setExceptionCode($exception->getCode())
                ->setExceptionMessage($exception->getMessage());

            return $this;
        }

        throw new \LogicException(sprintf('No %s', Entry::class));
    }

    /**
     * Set Request
     *
     * @param Request|null $request
     *
     * @return $this
     */
    public function setRequest(Request $request = null)
    {
        if ($this instanceof Entry) {
            if (null === $request) {
                $this
                    ->setRequestMethod('')
                    ->setRequestUri('');

                return $this;
            }

            $this
                ->setRequestMethod($request->getMethod())
                ->setRequestUri($request->getUri());

            return $this;
        }

        throw new \LogicException(sprintf('No %s', Entry::class));
    }

    /**
     * Set User
     *
     * @param User|null $user
     *
     * @return $this
     */
    public function setUser(User $user = null)
    {
        if (null === $user) {
            return $this;
        }

        if ($this instanceof Entry) {
            $this->setUserActive($user->getId());

            return $this;
        }

        throw new \LogicException(sprintf('No %s', Entry::class));
    }

    /**
     * Get Error Code Readable
     *
     * @return string
     */
    public function getUniqueIdReadable()
    {
        if ($this instanceof Entry) {
            return strtoupper(implode('-', str_split($this->getUniqueId(), 4)));
        }

        throw new \LogicException(sprintf('No %s', Entry::class));
    }
}