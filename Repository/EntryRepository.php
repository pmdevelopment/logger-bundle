<?php
/**
 * Created by PhpStorm.
 * User: sjoder
 * Date: 13.03.2018
 * Time: 13:15
 */

namespace PM\Bundle\LoggerBundle\Repository;

use Doctrine\ORM\EntityRepository;
use PM\Bundle\LoggerBundle\Entity\Entry;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class EntryRepository
 *
 * @package PM\Bundle\LoggerBundle\Repository
 */
class EntryRepository extends EntityRepository
{
    /**
     * @inheritDoc
     */
    public function findAll()
    {
        return $this->findBy(
            [],
            [
                'created' => 'asc',
            ]
        );
    }

    /**
     * Find By Error Code
     *
     * @param int $errorCode
     *
     * @return array|Entry[]
     */
    public function findByErrorCode($errorCode)
    {
        return $this->findBy(
            [
                'errorCode' => $errorCode,
            ]
        );
    }

    /**
     * Get
     *
     * @param string $uniqueId
     *
     * @return mixed|Entry
     */
    public function get($uniqueId)
    {
        $result = $this->findBy(
            [
                'uniqueId' => $uniqueId,
            ]
        );

        if (0 === count($result)) {
            throw new NotFoundHttpException();
        }

        return $result[0];
    }

    /**
     * Get Count
     *
     * @return int
     */
    public function getCount()
    {
        $builder = $this->createQueryBuilder('entry');
        $builder
            ->select('COUNT(entry)');

        try {
            return intval($builder->getQuery()->getSingleScalarResult());
        } catch (\Exception $e) {
            return -1;
        }
    }
}