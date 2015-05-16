<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle(),
            new Eher\QueroSerVoluntario\Bundle\AdminBundle\EherQueroSerVoluntarioAdminBundle(),
            new Eher\QueroSerVoluntario\Bundle\ApiBundle\EherQueroSerVoluntarioApiBundle(),
            new Eher\QueroSerVoluntario\Bundle\SecurityBundle\EherQueroSerVoluntarioSecurityBundle(),
            new Eher\QueroSerVoluntario\Bundle\DomainBundle\EherQueroSerVoluntarioDomainBundle(),
            new Eher\QueroSerVoluntario\Bundle\FrontendBundle\EherQueroSerVoluntarioFrontendBundle(),
            new FOS\OAuthServerBundle\FOSOAuthServerBundle(),
            new Fp\JsFormValidatorBundle\FpJsFormValidatorBundle(),
            new JMS\AopBundle\JMSAopBundle(),
            new JMS\DiExtraBundle\JMSDiExtraBundle($this),
            new JMS\I18nRoutingBundle\JMSI18nRoutingBundle(),
            new JMS\TranslationBundle\JMSTranslationBundle(),
            new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'))) {
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load(__DIR__.'/config/config_'.$this->getEnvironment().'.yml');
    }
}
