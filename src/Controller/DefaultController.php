<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Tag;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    /*
    * @Route("/"), name="index"
    */
    public function index(): Response
    {
        $docMan = $this->getDoctrine()->getManager();
        $repoProduct = $docMan->getRepository(Product::class);
        $totalProduct = $repoProduct->createQueryBuilder('p')
                            ->select('count(p.id)')
                            ->getQuery()
                            ->getSingleScalarResult();
        
        $repoTag = $docMan->getRepository(Tag::class);
        $totalTag = $repoTag->createQueryBuilder('t')
                            ->select('count(t.id)')
                            ->getQuery()
                            ->getSingleScalarResult();
        return $this->render('index.html.twig', [
            'totalProduct' => $totalProduct,
            'totalTag' => $totalTag
        ]);
    }
}