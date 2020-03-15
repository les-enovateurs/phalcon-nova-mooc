<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    public function onConstruct(){
        $oEnteteCollection = $this->assets->collection('head');
        $oEnteteCollection->addCss('libraries/bootstrap-4.3.1-dist/css/bootstrap.min.css');
        $oEnteteCollection->addCss('libraries/fontawesome-free-5.11.2-web/css/all.css');
        $oEnteteCollection->addCss('css/novamooc.css');

        $oPiedPageCollection = $this->assets->collection('footer');
        $oPiedPageCollection->addJs('libraries/jquery-3.4.1/jquery-3.4.1.min.js');
        $oPiedPageCollection->addJs('libraries/bootstrap-4.3.1-dist/js/bootstrap.bundle.min.js');

        $this->tag->setTitle('NovaMooc');
        $this->tag->setDoctype(Phalcon\Tag::HTML5);
    }
}
