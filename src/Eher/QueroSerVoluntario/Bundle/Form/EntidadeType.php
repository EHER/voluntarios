<?php

namespace Eher\QueroSerVoluntario\Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class EntidadeType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('nome')
            ->add('endereco')
            ->add('numero')
            ->add('complemento')
            ->add('bairro')
            ->add('cep')
            ->add('cidade')
            ->add('uf')
            ->add('telefone')
        ;
    }

    public function getName()
    {
        return 'eher_queroservoluntario_bundle_entidadetype';
    }
}
