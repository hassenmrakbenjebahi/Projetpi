<?php

namespace App\Controller;
use App\Entity\User;
use App\Form\UserType;
use  Doctrine\Persistence\ManagerRegistry;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ListMagasinController extends AbstractController
{
    #[Route('/admin/list/magasin', name: 'app_list_magasin')]
    public function index(UserRepository $mag): Response
    {
        $acces=0;
        $role='%ROLE_MAGASIN%';
        $magasins = $mag->findByrole($role,$acces);
        return $this->render('list_magasin/index.html.twig', [
            "magasins"=>$magasins
        ]);
    }

    #[Route("/admin/delete/{id}", name:'delete_magasin')]
    public function delete($id, ManagerRegistry $doctrine)
    {$c = $doctrine
        ->getRepository(User::class)
        ->find($id);
        $em = $doctrine->getManager();
        $em->remove($c);
        $em->flush() ;
        return $this->redirectToRoute('app_list_magasin');
    }

    #[Route('/admin/bloquer_magasin', name: 'bloquer_magasin')]
    public function  update_bloque(ManagerRegistry $doctrine,  Request  $request) : Response
    { 
        $id=$_POST['bloque_id'];
        $user = $doctrine
        ->getRepository(User::class)
        ->find($id);
        $user->setBloque(1);

         $em = $doctrine->getManager();
            $em->flush();
            return $this->redirectToRoute('app_list_magasin');
        
    }

    #[Route('/admin/debloquer_magasin', name: 'debloquer_magasin')]
    public function  update_debloque(ManagerRegistry $doctrine,  Request  $request) : Response
    { 
        $id=$_POST['debloque_id'];
        $user = $doctrine
        ->getRepository(User::class)
        ->find($id);
        $user->setBloque(0);

         $em = $doctrine->getManager();
            $em->flush();
            return $this->redirectToRoute('app_list_magasin');
        
    }
}
