<?php

namespace NovaMooc\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Submit;

use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Identical;
use Phalcon\Validation\Validator\Email;


class RegisterForm extends Form
{

    public function initialize($oUtilisateur)
    {
        // firstname
        $firstname = new Text('firstname', [
            'placeholder' => ucfirst('your firstname'),
            'class'       => 'form-control',
            'required'    => 'required'
        ]);
        $firstname->setLabel(ucfirst('firstname'));
        $firstname->addValidators(
            [
                new PresenceOf(
                    [
                        'message' => ucfirst('your firstname is required')
                    ]
                )
            ]
        );
        $this->add($firstname);

        // lastname
        $lastname = new Text('lastname',
            [
                'placeholder' => ucfirst('your lastname'),
                'class'       => 'form-control',
                'required'    => 'required'
            ]);
        $lastname->setLabel(ucfirst('lastname'));
        $lastname->addValidators(
            [
                new PresenceOf
                (
                    [
                        'message' => ucfirst('your lastname is required')
                    ]
                )
            ]
        );
        $this->add($lastname);

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
                new PresenceOf
                (
                    [
                        'message' => ucfirst('your e-mail address is required')
                    ]
                )
            ]
        );
        $email->addValidators(
            [
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
        $password->addValidator(
            new StringLength(
                [
                    'min'            => 6,
                    'max'            => 20,
                    'messageMaximum' => ucfirst('your password is too long, max 20 caracters'),
                    'messageMinimum' => ucfirst('your password is too short, min 6 caracters')
                ]
            )
        );
        $this->add($password);

        // confirm password
        $password_confirmation = new Password('password_confirmation',
            [
                'placeholder' => ucfirst('password confirmation'),
                'class'       => 'form-control',
                'required'    => 'required'
            ]);

        $password_confirmation->setLabel(ucfirst('your confirmation password'));
        $password_confirmation->addValidator(
            new PresenceOf(
                [
                    'message' => ucfirst('confirmation password is required')
                ]
            )
        );
        $password_confirmation->addValidator(
            new Identical(
                [
                    'accepted' => $password->getValue(),
                    'message'  => ucfirst('your confirmation password is not the same that the first password')
                ]
            )
        );
        $this->add($password_confirmation);

        $oSubmitButton = new Submit('submit_button', [
            'class' => 'btn btn-primary',
        ]);
        $oSubmitButton->setDefault(ucfirst('register'));

        $this->add($oSubmitButton);
    }
}