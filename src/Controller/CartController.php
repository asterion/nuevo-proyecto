<?php

namespace App\Controller;

use App\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartController extends AbstractController
{
    /**
     * @Route("/cart/{id}", name="cart_add_product")
     */
    public function index(Product $product, SessionInterface $session)
    {
        $cart = $session->get('cart');

        if (!is_array($cart)) {
            $cart = [];
        }

        $cart[] = 1;

        $session->set('cart', $cart);

        return $this->json($cart);
    }
}
