<?php

namespace SmartCartBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ContactController extends Controller
{
    public function indexAction(Request $request, \Swift_Mailer $mailer)
    {
        $message = (new \Swift_Message($request->get('topic')))
        ->setFrom('contact@smartcart.fr')
        ->setTo('smartcartfr@gmail.com')
        ->setBody(
            $this->renderView(
                // templates/emails/registration.html.twig
                'emails/registration.html.twig',
                array(
                    'email' => $request->get('email'),
                    'name' => $request->get('name'),
                    'topic' => $request->get('topic'),
                    'message' => $request->get('message')
                )
            ),
            'text/html'
            )
            ;

            $mailer->send($message);

            return $this->render(...);
        }
    }
