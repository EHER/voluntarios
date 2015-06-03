<?php
namespace Eher\QueroSerVoluntario\Bundle\DomainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
            ->add('telefone', 'text', ['attr' => ['class' => 'js-phone']])
            ->add('site')
            ->add('contato')
            ->add('email')
            ->add('cadastrar', 'submit')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Eher\QueroSerVoluntario\Bundle\DomainBundle\Entity\Entidade'
        ));
    }

    public function getName()
    {
        return 'eher_queroservoluntario_bundle_entidadetype';
    }
}
