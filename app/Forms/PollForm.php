<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class PollForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('title', 'text')
            ->add('text', 'textarea')
            ->add('ok','submit');
    }
}
