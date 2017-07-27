<?php

namespace CT\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="CT\UserBundle\Repository\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     *
     * @Assert\NotBlank(message="Entrez votre nom", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="Nom trop court.",
     *     maxMessage="Nom trop long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $name;

    /**
     * @ORM\Column(name="firstname", type="string", length=255, nullable=true)
     *
     * @Assert\NotBlank(message="Entrez votre prénom.", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="Trop court pour un prénom.",
     *     maxMessage="Trop long pour un prénom.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $firstname;

    /**
     * @ORM\Column(name="borndate", type="datetime", nullable=true)
     *
     * @Assert\NotBlank(message="Entrez votre date de naissance .", groups={"Registration", "Profile"})
     *
     */
    protected $borndate;

    /**
     * @ORM\Column(name="country", type="string", length=255, nullable=true)
     *
     * @Assert\NotBlank(message="D'où venez vous ?", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     max=255,
     *     maxMessage="Trop long.",
     *     groups="Profile"
     * )
     */
    protected $country;

    /**
     * @ORM\Column(name="website", type="string", length=255, nullable=true)
     *
     * @Assert\NotBlank(message="Si vous avez un website ?", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     max=255,
     *     maxMessage="Trop long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $website;

    /**
     * @ORM\Column(name="description", type="string", length=255, nullable=true)
     *
     * @Assert\NotBlank(message="Une petite description", groups={"Registration", "Profile"})
     */
    protected $description;


    /**
     * Set name
     *
     * @param string $name
     *
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set borndate
     *
     * @param \DateTime $borndate
     *
     * @return User
     */
    public function setBorndate($borndate)
    {
        $this->borndate = $borndate;

        return $this;
    }

    /**
     * Get borndate
     *
     * @return \DateTime
     */
    public function getBorndate()
    {
        return $this->borndate;
    }

    /**
     * Set country
     *
     * @param string $country
     *
     * @return User
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set website
     *
     * @param string $website
     *
     * @return User
     */
    public function setWebsite($website)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return string
     */
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return User
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
}
