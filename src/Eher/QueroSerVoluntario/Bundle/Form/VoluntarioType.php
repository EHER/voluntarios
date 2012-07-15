<?php

namespace Eher\QueroSerVoluntario\Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class VoluntarioType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('nome')
            ->add('email')
            ->add('cidade')
            ->add('uf')
        ;
    }

    public function getName()
    {
        return 'eher_queroservoluntario_bundle_voluntariotype';
    }
}
