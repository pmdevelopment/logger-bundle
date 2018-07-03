<?php
/**
 * Created by PhpStorm.
 * User: sjoder
 * Date: 20.04.2018
 * Time: 16:52
 */

namespace PM\Bundle\LoggerBundle\Twig;

use PM\Bundle\LoggerBundle\Entity\Entry;
use PM\Bundle\ToolBundle\Components\Traits\HasDoctrineTrait;
use Symfony\Bridge\Doctrine\RegistryInterface;


/**
 * Class LoggerTwigExtension
 *
 * @package PM\Bundle\LoggerBundle\Twig
 */
class LoggerTwigExtension extends \Twig_Extension
{
    use HasDoctrineTrait;

    /**
     * LoggerTwigExtension constructor.
     */
    public function __construct(RegistryInterface $registry)
    {
        $this->setDoctrine($registry);
    }

    /**
     * Get Functions
     *
     * @return array|\Twig_Function[]
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('pm_logger_get_entry_count', [
                $this,
                'getEntryCount',
            ]),
        ];
    }

    /**
     * Get Count
     *
     * @return int
     */
    public function getEntryCount()
    {
        return $this->getDoctrine()->getRepository(Entry::class)->getCount();
    }
}