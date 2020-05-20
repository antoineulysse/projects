<?php

namespace App\Controller;

use App\Entity\Person;
use App\Entity\Adresse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use App\Form\PersonneType;
use App\Form\AdresseType;

class PersonneController extends AbstractController
{
    /**
     * @Route("/personnes", name="persons_route")
     * 
     */
    public function displayAll()
    {
        $repo=$this->getDoctrine()->getRepository(Person::class) ;
        $persons =$repo->findAll();
        dump($persons);
        return $this->render('personne/index.html.twig', [
            'persons' => $persons,
        ]);
    }
    /**
     * @Route("/personnes/{id}/detail", name="person_detail")
     */
    public function detail($id){
        $repo = $this->getdoctrine()->getrepository(Person::class);
        $person = $repo->find($id);
        return $this->render('personne/detail.html.twig',[
            'detailPerson' => $person
        ]);
    }
    /**
     * @Route("/personnes/add/", name="person_create")
     * @Route("/personnes/{id}/edit", name="person_edit")
     * @return void
     */

     public function createAndUpdate(Person $personne = null, Request $request){

        if(!$personne){
            $personne= new Person();
           
        }
       /* $form =$this->createFormBuilder($personne)
                 ->add('nom', TextType::class)
                    ->add('salaire', IntegerType::class)
                    ->add('valider', SubmitType::class)
                    ->getForm();*/
        $form = $this->createForm(PersonneType::class, $personne); 
               
        $form->handleRequest($request);
        
       if($form->isSubmitted() && $form->isValid()){

           $manager = $this->getDoctrine()->getManager();

           $manager->persist($personne);
       
           $manager->flush();

           return $this->redirectToRoute('persons_route');
       }
     /*   if($request->request->count() > 0){
            $person = new Person();
            $person->setPrenom($request->request->get("prenom"));
            $person->setNom($request->request->get("nom"));
            $person->setSalaire($request->request->get("salaire"));
            $manager = $this->getDoctrine()->getManager();
            $manager->persist($person);
            $manager->flush();
            return $this->redirectToRoute('persons_route');
        } */
        //return $this->render('personne/form-personne.html.twig');

        return $this->render('personne/form-personne.html.twig',[
            'formPersonne'=> $form->createView()
        ]);


     }

      /**
     * @route("/personnes/{id}/delete", name="person_delete")
     * 
     * 
     */
        public function delete(Person $personne){
            $manager = $this->getDoctrine()->getManager();
            $manager->remove($personne);
            $manager->flush();
            return $this->redirectToRoute('persons_route');
            
        }


}
