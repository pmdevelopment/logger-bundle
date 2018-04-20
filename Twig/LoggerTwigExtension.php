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


/**
 * Class LoggerTwigExtension
 *
 * @package PM\Bundle\LoggerBundle\Twig
 */
class LoggerTwigExtension extends \Twig_Extension
{
    use HasDoctrineTrait;

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