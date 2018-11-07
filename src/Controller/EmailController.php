<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EmailController extends AbstractController
{
    /**
     * @Route("/email", name="email")
     */
    public function index(Request $request, \Swift_Mailer $mailer)
    {
        $address = $request->request->get('address');

        if (filter_var($address, FILTER_VALIDATE_EMAIL) == false) {
            return $this->json([
                'message' => 'La dirección de correo no es válida.',
                'email' => $address,
                'error' => 'true'
            ]);
        } else {
            $message = (new \Swift_Message('Prueba de selección mitocondria'))
                ->setFrom('mmatamala1982@gmail.com')
                ->setTo($address)
                ->setBody(
                    $this->renderView(
                        'email/mensaje.html.twig',
                        array('address' => $address)
                    ),
                    'text/html'
                    );

            $mailer->send($message);

            return $this->json([
                'message' => 'Enviado correctamente.',
                'email' => $address,
                'error' => 'false'
            ]);
        }

    }
}
