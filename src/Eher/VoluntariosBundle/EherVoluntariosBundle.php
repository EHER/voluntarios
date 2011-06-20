<?php

namespace Eher\VoluntariosBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder,
    Symfony\Component\HttpKernel\Bundle\Bundle,
    Eher\VoluntariosBundle\DependencyInjection\ApontadorExtension;

class EherVoluntariosBundle extends Bundle
{

    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->registerExtension(new ApontadorExtension());
    }

}