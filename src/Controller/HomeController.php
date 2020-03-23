<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends Controller{

    /**
     * @Route("/hello/{prenom}/age/{age}",name="hello")
     * @Route("/hello", name = "hello_base")
     *  @Route("/hello/{prenom}", name="hello_prenom")
     * montre la page qui dit bonjour
     */

    public function hello($prenom = "anonyme", $age = 0){
       /* return new Response(" bonjour...... ".$prenom. " vous avez ". $age. " ans ");*/
       return $this->render(
           'hello.html.twig',
           [
                'prenom'=> $prenom,
                'age'=> $age
           ]
       );
    }
    /**
     * @Route("/", name="homepage")
     */

    public function home(){

        $prenom = ['Louise'=>31,'Elisabeth'=>12,'Marie'=>55];
        return $this->render('home.html.twig',
                    ['title' => "bonjour à tous",
                     'age' => 12,
                     'tableau'=> $prenom
                    ]
                   );

    }
}


?>