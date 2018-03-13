<?php
/**
 * Created by PhpStorm.
 * User: sjoder
 * Date: 13.03.2018
 * Time: 16:10
 */

namespace PM\Bundle\LoggerBundle\Component\Interfaces;


use PM\Bundle\LoggerBundle\Services\LogService;

/**
 * Trait HasPersistentLoggerServiceTrait
 *
 * @package PM\Bundle\LoggerBundle\Component\Interfaces
 */
trait HasPersistentLoggerServiceTrait
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
        if (false === ($this->logService instanceof LogService)) {
            throw new \LogicException('LogService not available. Maybe Setter not called?');
        }

        return $this->logService;
    }

    /**
     * @param LogService $logService
     *
     * @return HasPersistentLoggerServiceTrait
     */
    public function setLogService($logService)
    {
        $this->logService = $logService;

        return $this;
    }


}