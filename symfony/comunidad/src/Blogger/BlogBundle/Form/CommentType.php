<?php

namespace Blogger\BlogBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class CommentType extends AbstractType
{
    
    private $roleFlag;

    public function __construct($roleFlag,$userName,$locale ="es")
    {
        $this->isGranted = $roleFlag;
        $this->userName = $userName;
        $this->locale = $locale;
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        

        if($this->isGranted) 
        {

           $builder
                ->add('lng','hidden', array('data'=>$this->locale))
                ->add('user','hidden', array('data'=>$this->userName))
                ->add('comment');     

        }
        else
        {

            $builder
                ->add('lng','hidden', array('data'=>$this->locale))
                ->add('user')
                ->add('comment');
        }
        
    }

    public function getName()
    {
        return 'blogger_blogbundle_commenttype';
    }
}
