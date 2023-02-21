<?php

namespace App\Controller;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use  Doctrine\Persistence\ManagerRegistry;

use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UpdatePasswordController extends AbstractController
{
    #[Route('/admin/update/password', name: 'app_update_password')]
    public function index(): Response
    {
        return $this->render('update_password/update_password_admin.html.twig'
            
        );
    }
    
#[Route('/admin/update_pwd', name: 'app_admin_pwd')]
public function  update_bloque(ManagerRegistry $doctrine,  Request  $request,UserPasswordHasherInterface $passwordHasher) : Response
{ 
    $id=$_POST['id'];
    $user = $doctrine
    ->getRepository(User::class)
    ->find($id);
    $plaintextPassword=$_POST["password"];
    // hash the password (based on the security.yaml config for the $user class)
   $hashedPassword = $passwordHasher->hashPassword(
   $user,
   $plaintextPassword
);
$user->setPassword($hashedPassword);

     $em = $doctrine->getManager();
        $em->flush();
        return $this->redirectToRoute('app_update_password');
        
    
}


#[Route('/veterinaire/update/password', name: 'app_update_password_vet')]
public function index_vet(): Response
{
    return $this->render('update_password/update_password_veterinaire.html.twig'
        
    );
}

#[Route('/veterinaire/update_pwd', name: 'app_veterinaire_pwd')]
public function  update_password_vet(ManagerRegistry $doctrine,  Request  $request,UserPasswordHasherInterface $passwordHasher) : Response
{ 
    $id=$_POST['id'];
    $user = $doctrine
    ->getRepository(User::class)
    ->find($id);
    $plaintextPassword=$_POST["password"];
    // hash the password (based on the security.yaml config for the $user class)
   $hashedPassword = $passwordHasher->hashPassword(
   $user,
   $plaintextPassword
);
$user->setPassword($hashedPassword);

     $em = $doctrine->getManager();
        $em->flush();
        return $this->redirectToRoute('app_update_password_vet');
        
    
}


#[Route('/proprietaire/update/password', name: 'app_update_password_prop')]
public function index_prp(): Response
{
    return $this->render('update_password/update_password_proprietaire.html.twig'
        
    );
}



#[Route('/proprietaire/update_pwd', name: 'app_proprietaire_pwd')]
public function  update_password_prp(ManagerRegistry $doctrine,  Request  $request,UserPasswordHasherInterface $passwordHasher) : Response
{ 
    $id=$_POST['id'];
    $user = $doctrine
    ->getRepository(User::class)
    ->find($id);
    $plaintextPassword=$_POST["password"];
    // hash the password (based on the security.yaml config for the $user class)
   $hashedPassword = $passwordHasher->hashPassword(
   $user,
   $plaintextPassword
);
$user->setPassword($hashedPassword);

     $em = $doctrine->getManager();
        $em->flush();
        return $this->redirectToRoute('app_update_password_prop');
        
    
}



#[Route('/magasin/update/password', name: 'app_update_password_magasin')]
public function index_mag(): Response
{
    return $this->render('update_password/update_password_magasin.html.twig'
        
    );
}



#[Route('/magasin/update_pwd', name: 'app_magasin_pwd')]
public function  update_password_mag(ManagerRegistry $doctrine,  Request  $request,UserPasswordHasherInterface $passwordHasher) : Response
{ 
    $id=$_POST['id'];
    $user = $doctrine
    ->getRepository(User::class)
    ->find($id);
    $plaintextPassword=$_POST["password"];
    // hash the password (based on the security.yaml config for the $user class)
   $hashedPassword = $passwordHasher->hashPassword(
   $user,
   $plaintextPassword
);
$user->setPassword($hashedPassword);

     $em = $doctrine->getManager();
        $em->flush();
        return $this->redirectToRoute('app_update_password_magasin');
        
    
}
}


