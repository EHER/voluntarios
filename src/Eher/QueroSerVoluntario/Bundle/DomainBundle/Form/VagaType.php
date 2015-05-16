<?php
namespace Eher\QueroSerVoluntario\Bundle\DomainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VagaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('entidade')
            ->add('nome')
            ->add('descricao')
            ->add('comoAplicar')
            ->add('online', 'checkbox', array(
                'required'  => false,
            ));
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Eher\QueroSerVoluntario\Bundle\DomainBundle\Entity\Vaga'
        ));
    }

    public function getName()
    {
        return 'eher_queroservoluntario_bundle_vagatype';
    }
}
