<?php
namespace  App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController{
    /**
     * @Route("/hello/{name}", name="hello_name")
     * @Route("/hello", name="hello_base")
     * @Route("/hello/{name}/{age}", name="hello_age")
     */
    public function hello($name = "", $age="0"){
        return $this->render(
            'hello.html.twig',
            [
                'name' => $name,
                'age' => $age
            ]
        );
    }
    /**
     * @Route("/", name="home")
     */
    public function home(){
        return $this->render('home.html.twig');
    }
}