<?php

namespace NovaMooc\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Textarea;
use Phalcon\Forms\Element\Submit;

use Phalcon\Validation\Validator\PresenceOf;

class CourseForm extends Form
{

    public function initialize($oCours)
    {
        // title
        $title = new Text('title',
            [
                'placeholder' => ucfirst('course\'s title'),
                'class'       => 'form-control',
                'required'    => 'required'
            ]
        );
        $title->setLabel(ucfirst('title'));
        $title->addValidators(
            [
                new PresenceOf
                (
                    [
                        'message' => ucfirst('the course\'s title is required')
                    ]
                )
            ]
        );
        $this->add($title);
        
        // description
        $description = new Textarea('description',
            [
                'placeholder' => ucfirst('a course\'s description'),
                'class'       => 'form-control'
            ]
        );
        $description->setLabel(ucfirst('description'));
        $this->add($description);
        

        $oSubmitButton = new Submit('submit_button', [
            'class' => 'btn btn-primary',
        ]);
        $oSubmitButton->setDefault(ucfirst('send'));

        $this->add($oSubmitButton);
    }
}