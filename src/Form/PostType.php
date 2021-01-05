<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Post;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            //le pongo image de nombre porque es el que use en la clase post $image
            ->add("attachment", FileType::class, [
                "mapped" => false
            ])
            ->add("category", EntityType::class,[
                "class" => Category::class
            ])
            ->add("save", SubmitType::class, [
                "attr"=>[
                    "class" => "btn btn-success float-right"
                ]
            ])
        ;
    }//se ve lindo porque en el config/packages/twig.yaml puse que use bootstrap para los form

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
