<?php
/**
 * Created by PhpStorm.
 * User: sjoder
 * Date: 13.03.2018
 * Time: 13:13
 */

namespace PM\Bundle\LoggerBundle\Services;

use FOS\UserBundle\Model\User;
use PM\Bundle\LoggerBundle\Entity\Entry;
use PM\Bundle\ToolBundle\Components\Traits\HasDoctrineTrait;
use PM\Bundle\ToolBundle\Components\Traits\HasLoggerTrait;
use PM\Bundle\ToolBundle\Components\Traits\HasRequestStackTrait;
use Symfony\Component\HttpFoundation\Request;


/**
 * Class LogService
 *
 * @package PM\Bundle\LoggerBundle\Services
 */
class LogService
{
    use HasLoggerTrait;
    use HasDoctrineTrait;
    use HasRequestStackTrait;

    /**
     * Log
     *
     * @param string       $type
     * @param int          $errorCode
     * @param \Exception   $exception
     * @param Request|null $request
     * @param User         $user
     * @param array        $context
     *
     * @return string
     */
    public function log($type, $errorCode, \Exception $exception, Request $request = null, User $user = null, $context = [])
    {
        try {
            $logger = $this->getLogger();

            $loggerContext = array_merge($context, [
                'exception_class' => get_class($exception),
                'exception_code'  => $exception->getCode(),
            ]);


            if (Entry::TYPE_WARNING === $type) {
                $logger->addWarning($exception->getMessage(), $loggerContext);
            } else {
                $logger->addError($exception->getMessage(), $loggerContext);
            }
        } catch (\RuntimeException $exception) {
            /* No Logger available */
        }

        if (null === $request) {
            $request = $this->getRequestCurrent(true);
        }

        $entry = new Entry();
        $entry
            ->setType($type)
            ->setErrorCode($errorCode)
            ->setException($exception)
            ->setRequest($request)
            ->setUser($user)
            ->setContext(json_encode($context));

        if ('cli' === php_sapi_name()) {
            $uri = [];

            if (true === isset($_SERVER['PWD'])) {
                $uri[] = $_SERVER['PWD'];
            }

            if (true === isset($_SERVER['argv']) && true === is_array($_SERVER['argv'])) {
                $uri = array_merge($uri, $_SERVER['argv']);
            }

            $entry
                ->setRequestMethod('CLI')
                ->setRequestUri(implode(' ', $uri));
        }

        $this->persistAndFlush($entry);

        return $entry->getUniqueId();
    }

    /**
     * Log Error
     *
     * @param int          $errorCode
     * @param \Exception   $exception
     * @param Request|null $request
     * @param User         $user
     * @param array        $context
     *
     * @return string
     */
    public function logError($errorCode, \Exception $exception, Request $request = null, User $user = null, $context = [])
    {
        return $this->log(Entry::TYPE_ERROR, $errorCode, $exception, $request, $user, $context);
    }

    /**
     * Log Warning
     *
     * @param int          $errorCode
     * @param \Exception   $exception
     * @param Request|null $request
     * @param User         $user
     * @param array        $context
     *
     * @return string
     */
    public function logWarning($errorCode, \Exception $exception, Request $request = null, User $user = null, $context = [])
    {
        return $this->log(Entry::TYPE_WARNING, $errorCode, $exception, $request, $user, $context);
    }
}