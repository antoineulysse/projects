<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\AccountType;
use App\Entity\PasswordUpdate;
use App\Form\RegistrationType;
use App\Form\PasswordUpdateType;
use Symfony\Component\Form\FormError;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AccountController extends AbstractController
{
    /**
     * permet d'afficher et de gérer le formulaire de connexion
     * @Route("/login", name="account_login")
     * @return Response
     */
    public function login(AuthenticationUtils $utils)
    {
        $error = $utils->getLastAuthenticationError();
        $username = $utils->getLastUsername();
        

        return $this->render('account/login.html.twig',[
            'hasError'=>$error !== null,
            'username'=>$username
        ]);

    }

    /**
     * Permet de déconnecter
     * 
     * @Route("/logout", name="account_logout")
     * 
     * @return void
     */
    public function logout(){}

    /**
     * permet d'afficher le formulaire d'incription
     * 
     * @Route("/register", name="account_register")
     *
     * @return Response
     */
    public function register(Request $request, EntityManagerInterface $manager,UserPasswordEncoderInterface $encoder){
        $user= new User();

        $form= $this->createForm(RegistrationType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $hash= $encoder->encodePassword($user, $user->getHash());
            $user->setHash($hash);

            $manager->persist($user);
            $manager->flush();

            $this->addFlash(
                'success',
                "Votre compte a bien été crée! vous pouvez maintenant vous connecter"
            );
            
            return $this->redirectToRoute("account_login");

        }

        return $this->render('account/registration.html.twig', [
            'form' =>$form->createView()
        ]);
    }
    /**
     * permet d'afficher et de modifier les infos du profil
     * @Route("/account/profile", name="account_profile")
     * @IsGranted("ROLE_USER")
     * @return Response
     */
    public function profile(Request $request,EntityManagerInterface $manager){
        $user = $this->getUser();
        $form =$this->createForm(AccountType::class,$user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($user);
            $manager->flush();


            $this->addFlash(
                'success',
                "les données du compte ont bien été modifié "
            );
        }

        return $this->render('account/profile.html.twig',[
            'form' => $form->createView()
        ]);
    }
    /**
     * permet de modifier le mot de passe
     * 
     * @Route("/account/password-update", name="account_password")
     * @IsGranted("ROLE_USER")
     *
     * @return void
     */
    public function updatePassword(Request $request, UserPasswordEncoderInterface $encoder,EntityManagerInterface $manager){
        $passwordUpdate = new PasswordUpdate();

        $user=$this->getUser();

        $form = $this->createForm(PasswordUpdateType::class, $passwordUpdate);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            //1. vérifier que le old Password du formulaire soit le même que le password de l'user
            if(!password_verify($passwordUpdate->getOldPassword(), $user->getHash())){
                //gerer l erreur
                $form->get('oldPassword')->addError(new FormError("le mot de passe que vous avez tapé n'est pas votre mot de passe actuel"));
            }else{
                $newPassword = $passwordUpdate->getNewPassword();
                $hash = $encoder->encodePassword($user, $newPassword);
                $user->setHash($hash);

                $manager->persist($user);
                $manager->flush();

                $this->addFlash(
                    'success',
                    "Votre mot de passe a bien été modifié "
                );

                return $this->redirectToRoute('homepage');
            }
            
        }

        return $this->render('account/password.html.twig',[
            'form' => $form->createView()
        ]);
    }
    /**
     * permet d'affciher le profil de l utilisateur connecté
     * @Route("/account", name="account_index")
     * @IsGranted("ROLE_USER")
     * 
     * @return Response
     */
    public function myAccount(){
        return $this->render('user/index.html.twig',[
            'user' => $this->getUser()
        ]);

    }
}
