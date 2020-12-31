<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /** antes en el / decia /main, con el / redirige la pagina principal para aca
     * @Route("/", name="casita")
     */
    public function index(): Response
    {
        return $this->render("home/index.html.twig");
    }

    /** el ? lo hace opcional
     * @Route("/custom/{name?}", name="customPage")
     * @param Request $req
     * @return Response
     */

    public function custom(Request $req) {
        //$name=dump($req->get("name"));
        $name=$req->get("name");

        return $this->render("home/custom.html.twig", [
            "nombrecito"=>$name,
        ]);
    }
}
