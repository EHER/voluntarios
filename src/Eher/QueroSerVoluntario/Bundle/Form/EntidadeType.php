<?php

namespace Eher\QueroSerVoluntario\Bundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EntidadeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome')
            ->add('endereco')
            ->add('bairro')
            ->add('cep')
            ->add('cidade')
            ->add('telefone')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Eher\QueroSerVoluntario\Bundle\Entity\Entidade'
        ));
    }

    public function getName()
    {
        return 'eher_queroservoluntario_bundle_entidadetype';
    }
}
