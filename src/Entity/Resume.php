<?php

namespace App\Entity;

use App\Utils\UtilsCV;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ResumeRepository")
 */
class Resume
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $idResumeTitle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $projectName;

    /**
     * @ORM\Column(type="datetime")
     */
    private $beginDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $endDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $details;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdResumeTitle(): ?int
    {
        return $this->idResumeTitle;
    }

    public function setIdResumeTitle(int $idResumeTitle): self
    {
        $this->idResumeTitle = $idResumeTitle;

        return $this;
    }

    public function getProjectName(): ?string
    {
        return $this->projectName;
    }

    public function setProjectName(string $projectName): self
    {
        $this->projectName = $projectName;

        return $this;
    }

    public function getBeginDate(): ?\DateTimeInterface
    {
        return $this->beginDate;
    }

    public function setBeginDate(\DateTimeInterface $beginDate): self
    {
        $this->beginDate = $beginDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getDetails(): ?string
    {
        return $this->details;
    }

    public function setDetails(string $details): self
    {
        $this->details = $details;

        return $this;
    }
    public function convertToString(?\DateTimeInterface $dateTime): ?string{
        $ret = date_parse($dateTime->format('d-m-Y'));
        $retour = $ret['day']."-".$ret['month']."-".$ret['year'];
        return $retour;
    }
    public function displayMonthYear(?\DateTimeInterface $dateTime): ?string{
        $funct = new UtilsCV();
        return $funct->displayMonthYear($dateTime);
    }
}
