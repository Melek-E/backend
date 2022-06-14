<?php
namespace App\Controller;
 
use App\Entity\Camion;
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
class CamionController extends AbstractController
{ 
    
    /**
    * @Rest\Get("/camions", name="app_camions_list")
    * @View
    */
   public function listAction(EntityManagerInterface $em)
   {
       $camions = $em->getRepository('App\Entity\Camion')->findAll();
       return $camions;
   }
 
   


    /**
     * @Rest\Post(
     *    path = "/camion",
     *    name = "app_camion_create"
     * )
     * @Rest\View(StatusCode = 201)
     * @ParamConverter("camion", converter="fos_rest.request_body")
     */
    public function createAction(Camion $camion, PersistenceManagerRegistry $doctrine)
    {  
        $em = $doctrine->getManager();

        $em->persist($camion);
        $em->flush();
        
        return $camion;
    }

  /**
     * @Get(
     *     path = "/camion/{id}",
     *     name = "app_camion _show",
     *     requirements = {"id"="\d+"}
     * )
     * @View
     */
    public function showAction(Camion $camion)
    {
        return $camion;
    }
 
    /**
     * @Route("/camion/{id}", name="camion_edit", methods={"PUT"})
     */
    public function edit(Request $request, int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $camion = $entityManager->getRepository(Camion::class)->find($id);
 
        if (!$camion) {
            return $this->json('No camion found for id' . $id, 404);
        }
 
        $camion->setName($request->request->get('name'));
        $camion->setDescription($request->request->get('description'));
        $entityManager->flush();
 
        $data =  [
            'id' => $camion->getId(),
            'name' => $camion->getNom(),
        ];
         
        return $this->json($data);
    }
 
    /**
     * @Route("/camion/del/{id}", name="camion_delete", methods={"DELETE"})
     */
    public function delete(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $camion = $entityManager->getRepository(Camion::class)->find($id);
 
        if (!$camion) {
            return $this->json('No camion found for id' . $id, 404);
        }
 
        $entityManager->remove($camion);
        $entityManager->flush();
 
        return $this->json('Deleted a camion successfully with id ' . $id);
    }
 
 
}