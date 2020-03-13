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


class InscriptionForm extends Form
{

    public function initialize($oUtilisateur)
    {
        // firstname
        $firstname = new Text('firstname', [
            'placeholder' => ucfirst('saisissez votre prélastname'),
            'class'       => 'form-control',
            'required'    => 'required'
        ]);
        $firstname->setLabel(ucfirst('prélastname'));
        $firstname->addValidators(
            [
                new PresenceOf(
                    [
                        'message' => ucfirst('votre prélastname est requis')
                    ]
                )
            ]
        );
        $this->add($firstname);

        // lastname
        $lastname = new Text('lastname',
            [
                'placeholder' => ucfirst('saisissez votre lastname'),
                'class'       => 'form-control',
                'required'    => 'required'
            ]);
        $lastname->setLabel(ucfirst('lastname'));
        $lastname->addValidators(
            [
                new PresenceOf
                (
                    [
                        'message' => ucfirst('votre lastname est requis')
                    ]
                )
            ]
        );
        $this->add($lastname);

        // email
        $email = new Text('email',
            [
                'placeholder' => ucfirst('saisissez votre adresse e-mail'),
                'class'       => 'form-control',
                'required'    => 'required'
            ]
        );
        $email->setLabel(ucfirst('adresse e-mail'));
        $email->addValidators(
            [
                new PresenceOf
                (
                    [
                        'message' => ucfirst('votre adresse e-mail est requise')
                    ]
                )
            ]
        );
        $email->addValidators(
            [
                new Email(
                    [
                        'message' => ucfirst('votre adresse e-mail est invalide')
                    ]
                )
            ]
        );
        $this->add($email);

        // Mot de passe
        $motDePasse = new Password('password',
            [
                'placeholder' => ucfirst('saisissez votre mot de passe'),
                'class'       => 'form-control',
                'required'    => 'required'
            ]
        );
        $motDePasse->setLabel(ucfirst('mot de passe'));
        $motDePasse->addValidators(
            [
                new PresenceOf(
                    [
                        'message' => ucfirst('votre mot de passe est requis')
                    ]
                )
            ]
        );
        $motDePasse->addValidator(
            new StringLength(
                [
                    'min'            => 6,
                    'max'            => 20,
                    'messageMaximum' => ucfirst('votre mot de passe est trop long, max 20 caractères'),
                    'messageMinimum' => ucfirst('votre mot de passe est trop court, min 6 caractères')
                ]
            )
        );
        $this->add($motDePasse);

        // Mot de passe confirmation
        $password_confirmation = new Password('password_confirmation',
            [
                'placeholder' => ucfirst('réecrivez votre mot de passe'),
                'class'       => 'form-control',
                'required'    => 'required'
            ]);

        $password_confirmation->setLabel(ucfirst('mot de passe de confirmation'));
        $password_confirmation->addValidator(
            new PresenceOf(
                [
                    'message' => ucfirst('le mot de passe de confirmation est requis')
                ]
            )
        );
        $password_confirmation->addValidator(
            new Identical(
                [
                    'accepted' => $motDePasse->getValue(),
                    'message'  => ucfirst('votre mot de passe de confirmation ne correspond pas au premier mot de passe')
                ]
            )
        );
        $this->add($password_confirmation);

        $oBoutonDeSoumission = new Submit('bouton_de_soumission', [
            'class' => 'btn btn-primary',
        ]);
        $oBoutonDeSoumission->setDefault(ucfirst('s\'inscrire'));

        $this->add($oBoutonDeSoumission);
    }
}