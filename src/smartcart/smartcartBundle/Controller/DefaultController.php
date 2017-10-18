<?php

namespace smartcart\smartcartBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('smartcartsmartcartBundle:Default:index.html.twig');
    }
}
