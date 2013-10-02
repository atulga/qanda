<?php

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Query;

/**
 * User
 *
 * @Table(name="user", uniqueConstraints={@UniqueConstraint(name="name", columns={"name"})})
 * @Entity
 */
class User
{
    /**
     * @var integer
     *
     * @Column(name="id", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @Column(name="password", type="text", nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @Column(name="nickname", type="string", length=40, nullable=true)
     */
    private $nickname;

    /**
     * @var string
     *
     * @Column(name="name", type="string", length=250, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @Column(name="description", type="text", nullable=true)
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
