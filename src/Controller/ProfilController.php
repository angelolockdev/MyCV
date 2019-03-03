<?php
/**
 * Created by IntelliJ IDEA.
 * User: Angelo-KabyLake
 * Date: 03/03/2019
 * Time: 21:55
 */

namespace App\Controller;


use App\Entity\Profil;
use App\Repository\ProfilRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    /**
     * @var EntityManager
     */
    private $em;
    /**
     * @var ProfilRepository
     */
    private $repository;

    public function __construct(ProfilRepository $repository, ObjectManager $em)
    {
        $this->em = $em;
        $this->repository = $repository;
    }

    /**
     * @Route("/")
     * @return Response
     */
    public function index():Response{
        $profil = $this->repository->findAll()[0];
        return $this->render('profil/index.html.twig',
            [
                'profil'=>$profil
            ]);
    }
}