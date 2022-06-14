<?php
namespace App\Controller;
set_time_limit(60);
use Exception; 
use App\Entity\Depanneur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Component\Routing\Annotation\Route;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Doctrine\Persistence\ManagerRegistry as PersistenceManagerRegistry;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

/**
 * @Route("/api", name="api_")
 */
class DepanneurController extends AbstractController
{   

 
 
      /**
     * @Rest\Get("/depanneurs", name="app_depanneur_list")
     * @View
     */
    public function listAction(EntityManagerInterface $em)
    {
        $depanneurs = $em->getRepository('App\Entity\Depanneur')->findAll();
        return $depanneurs;
    }


    #$articles = $this->getDoctrine()->getRepository('App\Entity\Depanneur')->findAll();
        #return $articles;
    
    /**
     * @Rest\Post(
     *    path = "/depanneur",
     *    name = "depanneur"
     * )
     * @Rest\View(StatusCode = 201)
     * @ParamConverter("depanneur", converter="fos_rest.request_body")
     */
    public function createAction(Depanneur $depanneur, PersistenceManagerRegistry $doctrine)
    {  
        $em = $doctrine->getManager();

        $em->persist($depanneur);
        $em->flush();
        
        return $depanneur;
    }
  /**
     * @Get(
     *     path = "/depanneur/{id}",
     *     name = "app_depanneur_show",
     *     requirements = {"id"="\d+"}
     * )
     * @View
     */
    public function showAction(Depanneur $depanneur)
    {
    
        return $depanneur;
    }
 
    /**
     * @Route("/depanneur/del/{id}", name="depanneur_delete", methods={"DELETE"})
     */
    public function delete(int $id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $depanneur = $entityManager->getRepository(Depanneur::class)->find($id);
 
        if (!$depanneur) {
            return $this->json('No depanneur found for id' . $id, 404);
        }
 
        $entityManager->remove($depanneur);
        $entityManager->flush();
 
        return $this->json('Deleted a depanneur successfully with id ' . $id);
    }
 

    // public function new(Request $request): Response
    // {
    //     // creates a task object and initializes some data for this example
    //     $task = new Task();
    //     $task->setTask('Write a blog post');
    //     $task->setDueDate(new \DateTime('tomorrow'));

    //     $form = $this->createFormBuilder($task)
    //         ->add('task', TextType::class)
    //         ->add('dueDate', DateType::class)
    //         ->add('save', SubmitType::class, ['label' => 'Create Task'])
    //         ->getForm();
        
    //     // ...
    // }
 
}