<?php
namespace ErposBundle\Form\Type;
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
use PUGX\AutocompleterBundle\Form\Type\AutocompleteType;

class TblRechercheClientType extends AbstractType
{
	
	
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder 
            
			->add('prenom', TextType::class,	
						array('required' => false))
			->add('nom', TextType::class,
						array('required' => false))
			->add('adresse', TextType::class,	
						array('required' => false))
			->add('ville', TextType::class,		
						array('required' => false))
			->add('cp', TextType::class,		
						array('required' => false))
			->add('pays', TextType::class,		
						array('required' => false))
			->add('mobile', TextType::class,	
						array('required' => false))
			->add('numtel', TextType::class,	
						array('required' => false))
			->add('fax', TextType::class,		
						array('required' => false))
			->add('email', EmailType::class,	
						array('required' => false))
			->add('nomSociete', TextType::class,
						array('required' => false))
			->add('Recherche', SubmitType::class);
        ;
    }
   

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'ErposBundle\Entity\TblClient'
        ]);
    }
}