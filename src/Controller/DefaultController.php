<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * [index description]
     * @Route("/ahoj/{name}", name="index_default")
     */
    public function index($name)
    {
        return $this->render("default/default.html.twig", ["name" => $name]);
    }
}
