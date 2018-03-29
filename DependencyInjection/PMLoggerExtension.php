<?php
/**
 * Created by PhpStorm.
 * User: sjoder
 * Date: 29.03.2018
 * Time: 10:17
 */

namespace PM\Bundle\LoggerBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * Class PMLoggerExtension
 *
 * @package PM\Bundle\LoggerBundle\DependencyInjection
 */
class PMLoggerExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        /* Services */
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');
    }

}
