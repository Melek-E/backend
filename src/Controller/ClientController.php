<?php
namespace App\Controller;
 
use App\Entity\Client;
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
class ClientController extends AbstractController
{ 
    
    /**
    * @Rest\Get("/clients", name="app_clients_list")
    * @View
    */
   public function listAction(EntityManagerInterface $em)
   {
       $clients = $em->getRepository('App\Entity\Client')->findAll();
       return $clients;
   }
 
   


    /**
     * @Rest\Post(
     *    path = "/client",
     *    name = "app_client_create"
     * )
     * @Rest\View(StatusCode = 201)
     * @ParamConverter("client", converter="fos_rest.request_body")
     */
    public function createAction(Client $client, PersistenceManagerRegistry $doctrine)
    {  
        $em = $doctrine->getManager();

        $em->persist($client);
        $em->flush();
        
        return $client;
    }

  /**
     * @Get(
     *     path = "/client/{id}",
     *     name = "app_client _show",
     *     requirements = {"id"="\d+"}
     * )
     * @View
     */
    public function showAction(Client $client)
    {
        return $client;
    }
 
    /**
     * @Route("/client/{id}", name="client_edit", methods={"PUT"})
     */
    public function edit(Request $request, int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $client = $entityManager->getRepository(Client::class)->find($id);
 
        if (!$client) {
            return $this->json('No client found for id' . $id, 404);
        }
 
        $client->setName($request->request->get('name'));
        $client->setDescription($request->request->get('description'));
        $entityManager->flush();
 
        $data =  [
            'id' => $client->getId(),
            'name' => $client->getNom(),
        ];
         
        return $this->json($data);
    }
 
    /**
     * @Route("/client/del/{id}", name="client_delete", methods={"DELETE"})
     */
    public function delete(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $client = $entityManager->getRepository(Client::class)->find($id);
 
        if (!$client) {
            return $this->json('No client found for id' . $id, 404);
        }
 
        $entityManager->remove($client);
        $entityManager->flush();
 
        return $this->json('Deleted a client successfully with id ' . $id);
    }
 
 
}