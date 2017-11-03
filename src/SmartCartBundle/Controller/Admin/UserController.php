<?php

namespace SmartCartBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use SmartCartBundle\Entity\User;
use SmartCartBundle\Form\Type\UserType;

class UserController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository(User::class)->findAll();

        return $this->render('SmartCartBundle:Admin\User:index.html.twig', [
            'users' => $users
        ]);
    }
}
