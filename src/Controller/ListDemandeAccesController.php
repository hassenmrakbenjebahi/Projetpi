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


class ListDemandeAccesController extends AbstractController
{
    #[Route('/admin/list/demande_acces', name: 'app_list_demande_acces')]
    public function index(UserRepository $da): Response
    {
        $demandes = $da->findByDemandeAcces();
        return $this->render('list_demande_acces/index.html.twig', [
            "demandes"=>$demandes
        ]);
    }

    #[Route('/admin/accepter', name: 'accepter')]
    public function  update(ManagerRegistry $doctrine,  Request  $request) : Response
    { 
        $id=$_POST["accepte_id"];
        $user = $doctrine
        ->getRepository(User::class)
        ->find($id);
        $user->setDemandeAcces(0);

         $em = $doctrine->getManager();
            $em->flush();
            return $this->redirectToRoute('app_list_demande_acces');
        
    }

    #[Route("/admin/refuser_user", name:'refuser')]
    public function delete( ManagerRegistry $doctrine)
    {
        $id=$_POST["refuse_id"];
        $c = $doctrine
        ->getRepository(User::class)
        ->find($id);
        $em = $doctrine->getManager();
        $em->remove($c);
        $em->flush() ;
        return $this->redirectToRoute('app_list_demande_acces');
    }
}
