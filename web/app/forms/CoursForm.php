<?php

namespace NovaMooc\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Textarea;
use Phalcon\Forms\Element\Submit;

use Phalcon\Validation\Validator\PresenceOf;

class CoursForm extends Form
{

    public function initialize($oCours)
    {
        // lastname
        $lastname = new Text('lastname',
            [
                'placeholder' => ucfirst('saisissez un lastname de cours'),
                'class'       => 'form-control',
                'required'    => 'required'
            ]
        );
        $lastname->setLabel(ucfirst('lastname'));
        $lastname->addValidators(
            [
                new PresenceOf
                (
                    [
                        'message' => ucfirst('un lastname de cours est requis')
                    ]
                )
            ]
        );
        $this->add($lastname);        
        
        // description
        $description = new Textarea('description',
            [
                'placeholder' => ucfirst('saisissez une description de cours'),
                'class'       => 'form-control'
            ]
        );
        $description->setLabel(ucfirst('description'));
        $this->add($description);
        

        $oBoutonDeSoumission = new Submit('bouton_de_soumission', [
            'class' => 'btn btn-primary',
        ]);
        $oBoutonDeSoumission->setDefault(ucfirst('envoyer'));

        $this->add($oBoutonDeSoumission);
    }
}