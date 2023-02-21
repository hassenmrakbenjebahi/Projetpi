<?php

namespace App\Controller;
use App\Entity\User;
use App\Form\UserType;
use App\Form\ProprietaireType;
use App\Form\MagasinType;

use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrationController extends AbstractController
{

    #[Route('/registration_veterinaire', name: 'app_registration_veterinaire')]
    public function addveterinaire(Request $request, UserRepository $userRepository, UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
             
            $plaintextPassword=$user->getPassword();
            // hash the password (based on the security.yaml config for the $user class)
           $hashedPassword = $passwordHasher->hashPassword(
           $user,
           $plaintextPassword
       );
       $user->setPassword($hashedPassword);
            // Set their role
            $user->setRoles(['ROLE_VETERINAIRE']);
            //set demande acces
            $user->setDemandeAcces(1);
            $user->setBloque(0);


            // Save
             $userRepository->save($user, true);
          
            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/addveterinaire.html.twig', [
            'f' => $form->createView(),
        ]);

    }




    //ajout proprietaire d'animaux

    #[Route('/registration_proprietaire', name: 'app_registration_proprietaire')]
    public function addproprietaire(Request $request, UserRepository $userRepository,UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();
        $user->setPermistravail("nothing");

        $form = $this->createForm(ProprietaireType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $plaintextPassword=$user->getPassword();
             // hash the password (based on the security.yaml config for the $user class)
        $hashedPassword = $passwordHasher->hashPassword(
            $user,
            $plaintextPassword
        );
        $user->setPassword($hashedPassword);

            // Set their role
            $user->setRoles(['ROLE_PROPRIETAIRE']);
            //set demande acces
            $user->setDemandeAcces(0);
            $user->setBloque(0);

            // Save
             $userRepository->save($user, true);
          
            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/addproprietaire.html.twig', [
            'f' => $form->createView(),
        ]);
    }





    //ajout magasin

    #[Route('/registration_magasin', name: 'app_registration_magasin')]
    public function addmagasin(Request $request, UserRepository $userRepository,UserPasswordHasherInterface $passwordHasher): Response
    {
        $user = new User();
        $user->setPrenom("nothing");

        $form = $this->createForm(MagasinType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $plaintextPassword=$user->getPassword();
            // hash the password (based on the security.yaml config for the $user class)
       $hashedPassword = $passwordHasher->hashPassword(
           $user,
           $plaintextPassword
       );
       $user->setPassword($hashedPassword);
            // Set their role
            $user->setRoles(['ROLE_MAGASIN']);
            //set demande acces
            $user->setDemandeAcces(1);
            $user->setBloque(0);


            // Save
             $userRepository->save($user, true);
          
            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/addmagasin.html.twig', [
            'f' => $form->createView(),
        ]);
    }


}
