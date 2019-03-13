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
use App\Entity\Resume;
use App\Entity\ResumeTitle;
use App\Repository\ProfilRepository;
use App\Repository\ReseauSocialRepository;
use App\Repository\ResumeRepository;
use App\Repository\ResumeTitleRepository;
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
    /**
     * @var ResumeTitleRepository
     */
    private $resumeTitleRepository;
    /**
     * @var ResumeRepository
     */
    private $resumeRepository;

    public function __construct(ProfilRepository $profilRepository, ReseauSocialRepository $reseauSocialRepository, ResumeTitleRepository $resumeTitleRepository, ResumeRepository $resumeRepository)
    {
        $this->profilRepository = $profilRepository;
        $this->reseauSocialRepository = $reseauSocialRepository;
        $this->resumeTitleRepository = $resumeTitleRepository;
        $this->resumeRepository = $resumeRepository;
    }

    /**
     * @Route("/", name="index")
     * @return Response
     * @internal param ProfilRepository $repository
     */
    public function index():Response{
       $em = $this->getDoctrine()->getManager();
       /* $resumeP = new Resume();

        $resumeP->setIdResumeTitle(1)
            ->setProjectName('Application "Gestion des équivalences administratives"')
            ->setBeginDate(new \DateTime('2018-08-06'))
            ->setEndDate(new \DateTime('2018-11-01'))
            ->setDetails('Les services des équivalences dans la MFPTLS, ont besoin d\'informatiser leurs services. D\'où la mise en place d\'une logiciel de qui gère les arrêtés d\'équivalences');

        $em->persist($resumeP);
        $em->flush();*/

        //Avoir tous les réseaux sociaux associés
        $reseaux = $this->reseauSocialRepository->findByIdProfil(1);
        dump($reseaux);
        //Avoir tous les Resumés
        $resume = $this->resumeRepository->find(1);
        $resumeTitle = $this->resumeTitleRepository->find(1);
        dump($resumeTitle);
        dump($resume);
        $profil = $this->profilRepository->find(1);
        return $this->render('profil/index.html.twig',
            [
                'profil'=>$profil,
                'reseaux'=>$reseaux,
                'resumeTitle'=>$resumeTitle,
                'resume'=>$resume
            ]);
    }
}