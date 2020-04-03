<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Entity\Image;
use App\Form\AdType;
use App\Repository\AdRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
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
     * permet de creer une annonce et de l'enregostré dans une base de données
     * @Route("ads/new", name="ads_create")
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function create(Request $request, EntityManagerInterface $manager){

        $ad = new Ad();

        $form = $this->createForm(AdType::class, $ad);
        $form->handleRequest($request);

        $this->addFlash(
            'success',
            "l'annonce <strong>Test</strong> a bien été enregistrée!"

        );
        if($form->isSubmitted() && $form->isValid()){
            //$manager = $this->getDoctrine()->getManager();
            $manager->persist($ad);
            $manager->flush();
            //
            return $this->redirectToRoute('ads_show',[
                'slug'=>$ad->getSlug()
                ]);

        }
        return $this->render('ad/new.html.twig',[
            'form'=> $form->createView()
        ]);
    }

    /**
     * permet d'afficher une seule annonce
     * @param $slug
     * @param AdRepository $repository
     * @Route("/ads/{slug}", name="ads_show")
     * @return Response
     */
    public  function show(Ad $ad){
        //$ad = $repository->findOneBySlug($slug);
        //$ad = $repository->findOneBySlug($slug);
        
        return $this->render('ad/show.html.twig',[
                'ad' => $ad
            ]
            );
    }


}
