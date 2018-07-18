<?php

// src/AppBundle/Form/Type/ProductType.php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TblAdminType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class)
			->add('password', PasswordType::class)
			->add('numTel', TextType::class)
			//->add('service', TextType::class)
			->add('mobile', TextType::class)
			->add('nomComplet', TextType::class)
			->add('email', EmailType::class)
			->add('rs', TextType::class)
			->add('siret', TextType::class)
			->add('nTvaIntracommunautaire', TextType::class)
			//->add('categorie', TextType::class)
			->add('descActivite', TextareaType::class)
			->add('formeJuridique', TextareaType::class)
			->add('dateImmatriculationRcs', DateType::class, array(
				'widget' => 'single_text',
				'html5' => false,
				'attr' => ['class' => 'form-control datepicker'],
			))
			//->add('trancheEffectif', TextType::class)
			->add('capitalSocial', TextType::class)
			->add('rcs', TextType::class)
			->add('adresse', TextType::class)
			->add('ville', TextType::class)
			->add('cp', TextType::class)
			->add('pays', TextType::class)
			//->add('tel', TextType::class)
			//->add('port', TextType::class)
			->add('fax', NumberType::class)
			->add('site', TextType::class)
			->add('voipProvider', TextType::class)
			->add('logo', HiddenType::class , array(
					'required' => false,
				))
			->add('isActive', CheckboxType::class, array(
					'required' => false,
				))
            ->add('save', SubmitType::class);
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'AppBundle\Entity\TblAdmin'
        ]);
    }
}