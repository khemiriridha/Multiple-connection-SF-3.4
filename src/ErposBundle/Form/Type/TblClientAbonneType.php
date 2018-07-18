<?php
namespace ErposBundle\Form\Type;
//php bin/console assets:install
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

class TblClientAbonneType extends AbstractType
{
	
	
	public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('rS', TextType::class)
            ->add('rS', TextType::class)
			->add('siret', TextType::class)
			->add('account', TextType::class)
			->add('description', TextType::class)
			->add('prenom', TextType::class)
			->add('nom', TextType::class)
			->add('adresse', TextType::class)
			->add('ville', TextType::class)
			->add('cp', TextType::class)
			->add('pays', TextType::class)
			->add('mobile', TextType::class)
			->add('numtel', TextType::class)
			->add('fax', TextType::class)
			->add('email', EmailType::class)
			->add('nomSociete', TextType::class)
			->add('fonction', TextType::class)
			->add('specialite', TextareaType::class, array(
				'attr' => array('cols' => '5', 'rows' => '8','placeholder' => 'Spécialité') 
			))
			->add('typeActivite', TextareaType::class, array(
				'attr' => array('cols' => '5', 'rows' => '8','placeholder' => 'Activité') 
			))
			->add('save', SubmitType::class);
        ;
    }
   

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'ErposBundle\Entity\TblClient'
        ]);
    }
}