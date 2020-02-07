<?php

namespace App\Form;

use App\Entity\Ad;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdType extends AbstractType
{
    /**
     * permet d'avoir la configuration d'un champ
     * @param string $label
     * @param string $placeholder
     * @param array $options
     * @return array
     */
    private function  getConfiguration($label, $placeholder, $options=[]){
    return array_merge([
        'label'=> $label,
        'attr'=>[
            'placeholder'=>$placeholder
        ]
    ], $options);
}
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title',TextType::class, $this->getConfiguration("Titre","Tapez un super titre"))
            ->add('slug',TextType::class, $this->getConfiguration('Chaine URL','Adresse web(automatique)',['required'=>false]))
            ->add('coverImage', UrlType::class, $this->getConfiguration('URL de l\'image principale','Mettez en avant une photo'))
            ->add('introduction', TextType::class, $this->getConfiguration('Introduction', 'description concise'))
            ->add('content', TextareaType::class, $this->getConfiguration('Description détaillé', 'Tapez une description détaillée'))
            ->add('price',MoneyType::class, $this->getConfiguration('Prix par Nuit','Donnez le prix par nuit'))
            ->add('rooms', IntegerType::class, $this->getConfiguration('Nombre de chambre','Le nombre de chambre disponible'))
            ->add('images',CollectionType::class,[
                'entry_type'=>ImageType::class,
                'allow_add'=>true,
                'allow_delete'=>true
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Ad::class,
        ]);
    }
}
