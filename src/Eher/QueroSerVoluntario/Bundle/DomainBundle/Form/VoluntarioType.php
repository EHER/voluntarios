<?php
namespace Eher\QueroSerVoluntario\Bundle\DomainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VoluntarioType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome')
            ->add('email')
            ->add('telefone', 'text', ['attr' => ['class' => 'js-phone']])
            ->add('cidade')
            ->add('cadastrar', 'submit')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Eher\QueroSerVoluntario\Bundle\DomainBundle\Entity\Voluntario'
        ));
    }

    public function getName()
    {
        return 'eher_queroservoluntario_bundle_voluntariotype';
    }
}
