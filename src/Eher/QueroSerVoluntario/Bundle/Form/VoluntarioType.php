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
            ->add('nascimento')
            ->add('profissao')
            ->add('email')
            ->add('telefone')
            ->add('celular')
            ->add('empresa')
            ->add('ja_foi_voluntario')
            ->add('entidade')
            ->add('area_de_trabalho')
            ->add('area_de_atuacao')
            ->add('quer_fazer')
        ;
    }

    public function getName()
    {
        return 'eher_queroservoluntario_bundle_voluntariotype';
    }
}
