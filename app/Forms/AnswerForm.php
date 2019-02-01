<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;
use Kris\LaravelFormBuilder\FormBuilder;
class AnswerForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('ok','submit',[
                'attr' => ['class' => 'btn-awr'],
            ]);
    }

}
