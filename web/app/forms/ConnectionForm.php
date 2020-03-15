<?php

namespace NovaMooc\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Submit;

use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;


class ConnectionForm extends Form
{

    public function initialize($oUser)
    {
        // email
        $email = new Text('email',
            [
                'placeholder' => ucfirst('your e-mail address'),
                'class'       => 'form-control',
                'required'    => 'required'
            ]
        );
        $email->setLabel(ucfirst('e-mail address'));
        $email->addValidators(
            [
                new PresenceOf(
                    [
                        'message' => ucfirst('your e-mail address is required')
                    ]
                ),
                new Email(
                    [
                        'message' => ucfirst('your e-mail address is invalid')
                    ]
                )
            ]
        );
        $this->add($email);

        // Password
        $password = new Password('password',
            [
                'placeholder' => ucfirst('your password'),
                'class'       => 'form-control',
                'required'    => 'required'
            ]
        );
        $password->setLabel(ucfirst('password'));
        $password->addValidators(
            [
                new PresenceOf(
                    [
                        'message' => ucfirst('your password is required')
                    ]
                )
            ]
        );

        $this->add($password);

        $oSubmitButton = new Submit('submit_button', [
            'class' => 'btn btn-primary',
            'id'    => 'submit_button'
        ]);
        $oSubmitButton->setDefault(ucfirst('login'));

        $this->add($oSubmitButton);
    }
}