<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use App\Entity\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SorterController extends AbstractController
{
    /**
     * @Route("/newhomepage", name="homepage")
     */
    public function homepageAction()
    {
        $categoryRepository = $this->getDoctrine()
            ->getManager()
            ->getRepository('App\Entity\Client');

        $categories = $categoryRepository->findAll();

        return $this->render('fortune/homepage.html.twig',[
            'categories' => $categories
        ]);
    }

    /**
     * @Route("/category/{id}", name="category_show")
     */
    public function showCategoryAction($id)
    {
        $categoryRepository = $this->getDoctrine()
            ->getManager()
            ->getRepository('App\Entity\Client');

        $category = $categoryRepository->find($id);

        if (!$category) {
            throw $this->createNotFoundException();
        }

        return $this->render('fortune/showCategory.html.twig',[
            'category' => $category
        ]);
    }
}

