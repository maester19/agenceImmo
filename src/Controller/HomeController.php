<?php

namespace App\Controller;

use App\Entity\Properties;
use App\Repository\PropertiesRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

Class HomeController extends AbstractController
{

    /**
     * @Route("/", name="home")
     */

    public function index(PropertiesRepository $repository)
    {
        $properties = $repository->findLatest();
        
        return $this->render("pages/home.html.twig", [
            "properties" => $properties
        ]);
    }

    /**
     * @Route("/logout", name="logout")
     */

    public function logout()
    {
        return $this->render("pages/home.html.twig");
    }
}