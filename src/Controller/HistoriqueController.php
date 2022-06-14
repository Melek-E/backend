<?php
namespace App\Controller;
 
use App\Entity\Historique;
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
class HistoriqueController extends AbstractController
{ 
    
    /**
    * @Rest\Get("/historiques", name="app_historiques_list")
    * @View
    */

   public function listAction(EntityManagerInterface $em)
   {
       $historiques = $em->getRepository('App\Entity\Historique')->findAll();
       return $historiques;
   }
 
   


    /**
     * @Rest\Post(
     *    path = "/historique",
     *    name = "app_historique_create"
     * )
     * @Rest\View(StatusCode = 201)
     * @ParamConverter("historique", converter="fos_rest.request_body")
     */
    public function createAction(Historique $historique, PersistenceManagerRegistry $doctrine)
    {  
        $em = $doctrine->getManager();

        $em->persist($historique);
        $em->flush();
        
        return $historique;
    }

  /**
     * @Get(
     *     path = "/historique/{id}",
     *     name = "app_historique _show",
     *     requirements = {"id"="\d+"}
     * )
     * @View
     */
    public function showAction(Historique $historique)
    {
        return $historique;
    }
 
    /**
     * @Route("/historique/{id}", name="historique_edit", methods={"PUT"})
     */
    public function edit(Request $request, int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $historique = $entityManager->getRepository(Historique::class)->find($id);
 
        if (!$historique) {
            return $this->json('No historique found for id' . $id, 404);
        }
 
        $historique->setName($request->request->get('name'));
        $historique->setDescription($request->request->get('description'));
        $entityManager->flush();
 
        $data =  [
            'id' => $historique->getId(),
            'name' => $historique->getNom(),
        ];
         
        return $this->json($data);
    }
 
    /**
     * @Route("/historique/del/{id}", name="historique_delete", methods={"DELETE"})
     */
    public function delete(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $historique = $entityManager->getRepository(Historique::class)->find($id);
 
        if (!$historique) {
            return $this->json('No historique found for id' . $id, 404);
        }
 
        $entityManager->remove($historique);
        $entityManager->flush();
 
        return $this->json('Deleted a historique successfully with id ' . $id);
    }
 
 
}