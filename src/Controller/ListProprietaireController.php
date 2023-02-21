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


class ListProprietaireController extends AbstractController
{
    #[Route('/admin/list/proprietaire', name: 'app_list_proprietaire')]
    public function index(UserRepository $prp): Response
    {
        $acces=0;
        $role='%ROLE_PROPRIETAIRE%';
        $proprietaires = $prp->findByrole($role,$acces);
        return $this->render('list_proprietaire/index.html.twig', [
            "propritaires"=>$proprietaires
        ]);
    }

    #[Route("/admin/delete_proprietaire/{id}", name:'delete_proprietaire')]
    public function delete($id, ManagerRegistry $doctrine)
    {$c = $doctrine
        ->getRepository(User::class)
        ->find($id);
        $em = $doctrine->getManager();
        $em->remove($c);
        $em->flush() ;
        return $this->redirectToRoute('app_list_proprietaire');
    }

    #[Route('/admin/bloquer_proprietaire', name: 'bloquer_proprietaire')]
    public function  update_bloque(ManagerRegistry $doctrine,  Request  $request) : Response
    {
        $id=$_POST['bloque_id'];

        $user = $doctrine
        ->getRepository(User::class)
        ->find($id);
        $user->setBloque(1);

         $em = $doctrine->getManager();
            $em->flush();
            return $this->redirectToRoute('app_list_proprietaire');
        
    }

    #[Route('/admin/debloquer_proprietaire', name: 'debloquer_proprietaire')]
    public function  update_debloque(ManagerRegistry $doctrine,  Request  $request) : Response
    {
        $id=$_POST['debloque_id'];

        $user = $doctrine
        ->getRepository(User::class)
        ->find($id);
        $user->setBloque(0);

         $em = $doctrine->getManager();
            $em->flush();
            return $this->redirectToRoute('app_list_proprietaire');
        
    }
}
