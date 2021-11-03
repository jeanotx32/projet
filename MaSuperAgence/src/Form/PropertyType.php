<?php

namespace App\Form;

use App\Entity\Option;
use App\Entity\Property;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\ORM\QueryBuilder as ORMQueryBuilder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class PropertyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', null, ['label' => 'Nom de la propriete'])
            ->add('description', null, ['label' => 'Description'])
            ->add('surface', null, ['label' => 'Surface'])
            ->add('rooms', null, ['label' => 'Pieces'])
            ->add('bedrooms', null, ['label' => 'Chambre'])
            ->add('floor', null, ['label' => 'Etages'])
            ->add('price', null, ['label' => 'Prix'])
            ->add('heat', ChoiceType::class, ['choices' => $this->getChoices()], [
                'label' => 'Chauffage'
            ])
            ->add('options', EntityType::class, [
                'class' => Option::class,
                'choice_label' => 'name',
                'multiple' => true,
            ])
            ->add('city', null, ['label' => 'Ville'])
            ->add('address', null, ['label' => 'Adresse'])
            ->add('postal_code', null, ['label' => 'Code Postal'])
            ->add('sold', null, ['label' => 'Vendu']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Property::class,
        ]);
    }

    private function getChoices()
    {
        $choices = Property::HEAT;
        $output = [];
        foreach ($choices as $k =>  $v) {
            $output[$v] = $k;
        }
        return $output;
    }
}                
?>