<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Repository\AdRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdController extends AbstractController
{
    /**
     * @Route("/ads", name="ads_index")
     * @param AdRepository $repo, injection de dependance
     * @return Response
     */
    public function index(AdRepository $repo)
    {
        //$repo = $this->getDoctrine()->getRepository(Ad::class  );
        $ads = $repo->findAll();

        return $this->render('ad/index.html.twig', [
           'ads' => $ads
        ]);
    }

    /**
     * permet d'afficher une seule annonce
     * @param $slug
     * @param AdRepository $repository
     * @Route("/ads/{slug}", name="ads_show")
     * @return Response
     */
    public  function show($slug, AdRepository $repository){
        //$ad = $repository->findOneBySlug($slug);
        $ad = $repository->findOneBySlug($slug);
        
        return $this->render('ad/show.html.twig',[
                'ad' => $ad
            ]
            );
    }
}
