<?php

namespace HeringBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ProdutoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('codigo')
            ->add('nome')
            ->add('tamanho', ChoiceType::class, array(
                                                'choices'  => array(
                                                    'Selecione' => '',
                                                    'PP' => 'PP',
                                                    'P' => 'P',
                                                    'M' => 'M',
                                                    'G' => 'G',
                                                    'GG' => 'GG',
                                                    'XXX' => 'XXX'
                                                )))
            ->add('valor')
            ->add('modelo')
            ->add('quantidade')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'HeringBundle\Entity\Produto'
        ));
    }
}
