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
        // prenom
        $prenom = new Text('prenom', [
            'placeholder' => ucfirst('saisissez votre prénom'),
            'class'       => 'form-control',
            'required'    => 'required'
        ]);
        $prenom->setLabel(ucfirst('prénom'));
        $prenom->addValidators(
            [
                new PresenceOf(
                    [
                        'message' => ucfirst('votre prénom est requis')
                    ]
                )
            ]
        );
        $this->add($prenom);

        // nom
        $nom = new Text('nom',
            [
                'placeholder' => ucfirst('saisissez votre nom'),
                'class'       => 'form-control',
                'required'    => 'required'
            ]);
        $nom->setLabel(ucfirst('nom'));
        $nom->addValidators(
            [
                new PresenceOf
                (
                    [
                        'message' => ucfirst('votre nom est requis')
                    ]
                )
            ]
        );
        $this->add($nom);

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
        $motDePasse = new Password('mot_de_passe',
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
        $mot_de_passe_confirmation = new Password('mot_de_passe_confirmation',
            [
                'placeholder' => ucfirst('réecrivez votre mot de passe'),
                'class'       => 'form-control',
                'required'    => 'required'
            ]);

        $mot_de_passe_confirmation->setLabel(ucfirst('mot de passe de confirmation'));
        $mot_de_passe_confirmation->addValidator(
            new PresenceOf(
                [
                    'message' => ucfirst('le mot de passe de confirmation est requis')
                ]
            )
        );
        $mot_de_passe_confirmation->addValidator(
            new Identical(
                [
                    'accepted' => $motDePasse->getValue(),
                    'message'  => ucfirst('votre mot de passe de confirmation ne correspond pas au premier mot de passe')
                ]
            )
        );
        $this->add($mot_de_passe_confirmation);

        $oBoutonDeSoumission = new Submit('bouton_de_soumission', [
            'class' => 'btn btn-primary',
        ]);
        $oBoutonDeSoumission->setDefault(ucfirst('s\'inscrire'));

        $this->add($oBoutonDeSoumission);
    }
}