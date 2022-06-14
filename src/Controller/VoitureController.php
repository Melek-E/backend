<?php
namespace App\Controller;
 
use App\Entity\Voiture;
use AppBundle\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;

/**
 * @Route("/api", name="api_")
 */
class VoitureController extends AbstractController
{ 
    
    /**
    * @Rest\Get("/voitures", name="app_voitures_list")
    * @View
    */
   public function listAction(EntityManagerInterface $em)
   {
       $voitures = $em->getRepository('App\Entity\Voiture')->findAll();
       return $voitures;
   }
 
   


    /**
     * @Rest\Post(
     *    path = "/voiture",
     *    name = "app_voiture_create"
     * )
     * @Rest\View(StatusCode = 201)
     * @ParamConverter("voiture", converter="fos_rest.request_body")
     */
    public function createAction(Voiture $voiture, PersistenceManagerRegistry $doctrine)
    {  
        $em = $doctrine->getManager();

        $em->persist($voiture);
        $em->flush();
        
        return $voiture;
    }

  /**
     * @Get(
     *     path = "/voiture/{id}",
     *     name = "app_voiture _show",
     *     requirements = {"id"="\d+"}
     * )
     * @View
     */
    public function showAction(Voiture $voiture)
    {
        return $voiture;
    }
 
    /**
     * @Route("/voiture/{id}", name="voiture_edit", methods={"PUT"})
     */
    public function edit(Request $request, int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $voiture = $entityManager->getRepository(Voiture::class)->find($id);
 
        if (!$voiture) {
            return $this->json('No voiture found for id' . $id, 404);
        }
 
        $voiture->setName($request->request->get('name'));
        $voiture->setDescription($request->request->get('description'));
        $entityManager->flush();
 
        $data =  [
            'id' => $voiture->getId(),
            'name' => $voiture->getNom(),
        ];
         
        return $this->json($data);
    }
 
    /**
     * @Route("/voiture/del/{id}", name="voiture_delete", methods={"DELETE"})
     */
    public function delete(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $voiture = $entityManager->getRepository(Voiture::class)->find($id);
 
        if (!$voiture) {
            return $this->json('No voiture found for id' . $id, 404);
        }
 
        $entityManager->remove($voiture);
        $entityManager->flush();
 
        return $this->json('Deleted a voiture successfully with id ' . $id);
    }
 
 
}