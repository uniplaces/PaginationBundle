<?php

/*
 * This file is part of the UniplacesPaginationBundle package.
 *
 * (c) Uniplaces
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Uniplaces\PaginationBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * UniplacesPaginationExtension.
 *
 * @author 
 */
class UniplacesPaginationExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        //Add the default template to the template array
        $templates =  array('UniplacesPaginationBundle:Twig:paginate.html.twig');
        if (isset($config['template'])) {
            //Add any overriding template if defined in the configuration
            $templates[] = $config['template'];
        }
        $container->setParameter('uniplaces_pagination.templates', $templates);
    }
}
