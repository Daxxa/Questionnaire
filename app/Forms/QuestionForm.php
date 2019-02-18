<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class QuestionForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('title', 'text',[
                'attr' => ['placeholder' => 'Title'],
            ])
            ->add('text', 'textarea',[
                'attr' => ['placeholder' => 'Description'],
            ])
            ->add('ok','submit',[
                'attr' => ['class' => 'btn btn-primary'],
            ]);
    }
}
