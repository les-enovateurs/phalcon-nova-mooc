<?php

namespace NovaMooc\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Submit;

use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;


class ConnexionForm extends Form
{

    public function initialize($oUtilisateur)
    {
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
                new PresenceOf(
                    [
                        'message' => ucfirst('votre adresse e-mail est requise')
                    ]
                ),
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

        $this->add($motDePasse);

        $oBoutonDeSoumission = new Submit('bouton_de_soumission', [
            'class' => 'btn btn-primary',
            'id'    => 'bouton_de_soumission'
        ]);
        $oBoutonDeSoumission->setDefault(ucfirst('se connecter'));

        $this->add($oBoutonDeSoumission);
    }
}