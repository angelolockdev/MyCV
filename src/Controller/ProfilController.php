<?php
/**
 * Created by IntelliJ IDEA.
 * User: Angelo-KabyLake
 * Date: 03/03/2019
 * Time: 21:55
 */

namespace App\Controller;


use App\Entity\Profil;
use App\Entity\ReseauSocial;
use App\Repository\ProfilRepository;
use App\Repository\ReseauSocialRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    /**
     * @var ProfilRepository
     */
    private $profilRepository;
    /**
     * @var ReseauSocialRepository
     */
    private $reseauSocialRepository;

    public function __construct(ProfilRepository $profilRepository, ReseauSocialRepository $reseauSocialRepository)
    {
        $this->profilRepository = $profilRepository;
        $this->reseauSocialRepository = $reseauSocialRepository;
    }

    /**
     * @Route("/", name="index")
     * @return Response
     * @internal param ProfilRepository $repository
     */
    public function index():Response{
     //   $em = $this->getDoctrine()->getManager();
      //  $em->persist($reseauSociaux);
       // $em->flush();
        $reseaux = $this->reseauSocialRepository->findByIdProfil(1);
        dump($reseaux);

        $profil = $this->profilRepository->find(1);
        return $this->render('profil/index.html.twig',
            [
                'profil'=>$profil,
                'reseaux'=>$reseaux
            ]);
    }
}