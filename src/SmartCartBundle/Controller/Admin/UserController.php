<?php

namespace SmartCartBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use SmartCartBundle\Entity\User;
use SmartCartBundle\Form\Type\UserType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

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

    public function createAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $encoder = $this->get('security.encoder_factory')->getEncoder($user);
            $user->setPassword($encoder->encodePassword($user->getPassword(), $user->getSalt()));

            $em->persist($user);
            $em->flush();
        }

        return $this->render('SmartCartBundle:Admin\User:create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function editAction(Request $request, $userId)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->findOneById($userId);

        if(!$user) {
            throw $this->createNotFoundException(
                'No user found for id ' . $userId
            );
        }

        $form = $this->createForm(UserType::class, $user);
        $form->add('password' , PasswordType::class, ['required' => false]);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            if($form->get('password')->getData()) {
                $encoder = $this->get('security.encoder_factory')->getEncoder($user);
                $user->setPassword($encoder->encodePassword($user->getPassword(), $user->getSalt()));
            }

            $em->persist($user);
            $em->flush();
        }

        return $this->render('SmartCartBundle:Admin\User:edit.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function deleteAction(Request $request, $userId)
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(User::class)->findOneById($userId);

        if(!$user) {
            throw $this->createNotFoundException(
                'No user found for id ' . $userId
            );
        }

        $em->remove($user);
        $em->flush();

        return $this->redirectToRoute('smart_cart_admin_user_list');
    }
}
