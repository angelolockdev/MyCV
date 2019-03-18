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
use App\Repository\SkillsRepository;
use App\Utils\UtilsCV;
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
    /**
     * @var SkillsRepository
     */
    private $skillsRepository;

    public function __construct(SkillsRepository $skillsRepository,ProfilRepository $profilRepository,  ReseauSocialRepository $reseauSocialRepository, ResumeTitleRepository $resumeTitleRepository, ResumeRepository $resumeRepository)
    {
        $this->profilRepository = $profilRepository;
        $this->reseauSocialRepository = $reseauSocialRepository;
        $this->resumeTitleRepository = $resumeTitleRepository;
        $this->resumeRepository = $resumeRepository;
        $this->skillsRepository = $skillsRepository;
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
        $resume = new Resume();
        $resumeTitle = new ResumeTitle();
        $resume = $this->resumeRepository->find(1);
        $resumeTitle = $this->resumeTitleRepository->find(1);
        $profil = $this->profilRepository->find(1);
        $allResumeTitle = $this->resumeTitleRepository->findAll();
        $allSkills = $this->skillsRepository->findAll();
        dump($allSkills);
        //$allResume = $this->resumeRepository->findAll();
        $allResume = $this->convertToAssociatedArray();

        return $this->render('profil/index.html.twig',
            [
                'profil'=>$profil,
                'reseaux'=>$reseaux,
                'allResumeTitle' =>$allResumeTitle,
                'allResume' =>$allResume,
                'resumeTitle'=>$resumeTitle,
                'resume'=>$resume,
                'allskills'=>$allSkills
            ]);
    }

    /**
     * @return array
     * @internal param ResumeTitle|ResumeTitle[] $listResumeTitle
     * @internal param Resume|Resume[] $listResume
     */
    public function convertToAssociatedArray(){
        $listResumeTitle = $this->resumeTitleRepository->findAll();
        $listResume = $this->resumeRepository->findAll();
        $ret = [];
        $compteur = 0;
        foreach($listResumeTitle as $resumeTitleTemp)
        {
            $tabKeyValue = [];
            foreach ($listResume as $resumeTemp){
                if($resumeTitleTemp->getId() === $resumeTemp->getIdResumeTitle()){
                    $tabKeyValue[$compteur] = $resumeTemp;                  //Tableau associé à clé - valeur
                    $ret[$resumeTitleTemp->getId()] = [
                        'key'=>$resumeTitleTemp,
                        'value'=>$tabKeyValue
                    ];      //Tableau normale contenant le tableau associative
                    $compteur++;
                }
            }
        }
        return $ret;
    }
}