<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RestaurantController extends AbstractController
{
    /**
     * @Route("/restaurant", name="restaurant")
     */
    public function index(): Response
    {
        return $this->render('restaurant/index.html.twig', [
            'controller_name' => 'RestaurantController',
        ]);
    }
    /*
    private $restaurantHandler;

    public function __construct(restaurantHandler $restaurantHandler)
    {
        $this->restaurantHandler = $restaurantHandler;
    }

    public function __invoke(Book $data): Book
    {
        $this->restaurantHandler->handle($data);

        return $data;
    }*/
}
