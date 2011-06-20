<?php

namespace Eher\VoluntariosBundle\DependencyInjection;

use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ApontadorExtension extends Extension
{

    public function load(array $configs, ContainerBuilder $container)
    {
        $config = array();
        foreach ($configs as $subConfig) {
            $config = array_merge($config, $subConfig);
        }

        $container->setParameter('apontador.key', $config['key']);
        $container->setParameter('apontador.secret', $config['secret']);
    }
}