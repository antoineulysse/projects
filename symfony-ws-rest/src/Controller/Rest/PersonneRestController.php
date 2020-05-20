<?php

namespace App\Controller\Rest;

use App\DTO\PersonneDTO;
use App\Entity\InformationContact;
use App\Entity\Personne;
use App\Repository\PersonneRepository;
use App\Service\PersonneService;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\QueryException;
use Exception;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Put;
use FOS\RestBundle\View\View;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class PersonneRestController extends AbstractFOSRestController {

    private $personneRepository;
    private $personneEntityManager;
    private $personneService;

    const ALL_PERSONS_URI = "/personnes";
    const SINGLE_PERSON_URI = "/personnes/{id}"; 

    public function __construct(PersonneService $personneService, EntityManagerInterface $manager, PersonneRepository $personneRepository)
    {
        $this->personneService = $personneService;
        $this->personneRepository = $personneRepository;
        $this->personneEntityManager = $manager;
    }

    /**
     * Look for all personnes in database
     * @Get(PersonneRestController::ALL_PERSONS_URI)
     * @param PersonneRepository $personneRepository
     * @return Response
     */
    public function findAllPersonnes(){
        $personnes = $this->personneService->findAllPersonnes();
        if(empty($personnes)){
            return View::create(null, Response::HTTP_NO_CONTENT);
        }
        return View::create($personnes, Response::HTTP_OK);
    }

    /**
     * Create a new personne ein database
     * @POST(PersonneRestController::ALL_PERSONS_URI)
     * @ParamConverter("personneDTO", converter="fos_rest.request_body")
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function createPersonne(PersonneDTO $personneDTO){
        try{
            $this->personneService->addNewPersonne($personneDTO);
        } catch (Exception $e){
            return View::create($e->getMessage(), Response::HTTP_BAD_REQUEST);
        }
        return View::create(null, Response::HTTP_CREATED);
    }

    /**
     * Modifies a personn in database
     * @Put(PersonneRestController::SINGLE_PERSON_URI)
     * @ParamConverter("personneDTO", converter="fos_rest.request_body")
     * @param Request $request
     * @param Personne $personne
     * @param EntityManagerInterface $manager
     * @return void
     */
    public function updatePersonne(PersonneDTO $personneDTO, int $id){
        try {
            $this->personneService->updatePersonne($id, $personneDTO);
        } catch (QueryException $qe){
            return View::create("Echec lors de la mise à jour pour la personne avec id $id", Response::HTTP_INTERNAL_SERVER_ERROR);
        } catch (Exception $e){
            return View::create($e->getMessage(), Response::HTTP_NOT_FOUND);
        }

        return View::create(null, Response::HTTP_NO_CONTENT);
    }
}