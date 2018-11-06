<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EmailController extends AbstractController
{
    /**
     * @Route("/email", name="email")
     */
    public function index(\Swift_Mailer $mailer)
    {
        $address = 'mmatamala1982@gmail.com';

        $message = (new \Swift_Message('Prueba de selección mitocondria'))
            ->setFrom('mmatamala1982@gmail.com')
            ->setTo($address)
            ->setBody(
                $this->renderView(
                    'email/mensaje.html.twig',
                    array('address' => $address)
                ),
                'text/html'
            )
        ;

        return $this->json(['status' => $mailer->send($message)]);
    }
}
