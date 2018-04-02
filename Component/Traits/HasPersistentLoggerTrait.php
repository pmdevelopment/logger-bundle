<?php
/**
 * Created by PhpStorm.
 * User: sjoder
 * Date: 02.04.2018
 * Time: 12:19
 */

namespace PM\Bundle\LoggerBundle\Component\Traits;

use PM\Bundle\LoggerBundle\Services\LogService;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

/**
 * Trait HasPersistentLoggerTrait
 *
 * @package PM\Bundle\LoggerBundle\Component\Traits
 */
trait HasPersistentLoggerTrait
{
    /**
     * @var LogService
     */
    private $logService;

    /**
     * @return LogService
     */
    public function getLogService()
    {
        if ($this instanceof ContainerAwareInterface) {
            return $this->getContainer()->get('pm_bundle_logger.services.log_service');
        }

        if (false === ($this->logService instanceof LogService)) {
            throw new \LogicException('LogService not available. Maybe Setter not called?');
        }

        return $this->logService;
    }

    /**
     * @param LogService $logService
     *
     * @return HasPersistentLoggerTrait
     */
    public function setLogService($logService)
    {
        $this->logService = $logService;

        return $this;
    }


}