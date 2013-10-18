<?php
namespace Qanda\HomeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Query;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * User
 *
 * @ORM\Table(name="user", uniqueConstraints={@ORM\UniqueConstraint(name="name", columns={"name"})})
 * @ORM\Entity
 */
class User
{
    /**
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @Assert\NotBlank(message="Нууц үгээ оруулна уу!")
     * @ORM\Column(name="password", type="text", nullable=false)
     */
    private $password;

    /**
     * @ORM\Column(name="nickname", type="string", length=40, nullable=true)
     */
    private $nickname;

    /**
     * @Assert\NotBlank(message="Нэрээ оруулна уу!")
     * @ORM\Column(name="name", type="string", length=250, nullable=false)
     */
    private $name;

    /**
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set nickname
     *
     * @param string $nickname
     * @return User
     */
    public function setNickname($nickname)
    {
        $this->nickname = $nickname;

        return $this;
    }

    /**
     * Get nickname
     *
     * @return string
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * Set name
     *
     * @param string $name
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
     * Set description
     *
     * @param string $description
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

    static public function getByName($name=null)
    {
        global $em;
        $user = $em->getRepository('User')
                   ->findOneBy(array('name' => $name));
        return $user;
    }

    static public function getUser($name, $password=null)
    {
        global $em;
        $user = $em->getRepository('User')
                   ->findOneBy(array('name' => $name, 'password' => $password));
        return $user;
    }

    static public function getUserNameById($user_id)
    {
        global $em;
        $user = $em->getRepository('User')
                   ->findOneBy(array('id' => $user_id));
        $name = $user->getName();
        return $name;
    }

    static public function getById($id, $as_array=false)
    {
        global $em;
        $qb = $em->createQueryBuilder();
        $query = $qb->select('u')
            ->from('User', 'u')
            ->where('u.id = :id')
            ->setParameter('id', $id)
            ->getQuery();
        if ($as_array){
            $u = $query->getSingleResult(Query::HYDRATE_ARRAY);
        }else{
            $u = $query->getSingleResult();
        }
        return $u;
    }

}
?>
