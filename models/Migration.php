<?php



use Doctrine\ORM\Mapping as ORM;

/**
 * Migration
 *
 * @Table(name="migration")
 * @Entity
 */
class Migration
{
    /**
     * @var string
     *
     * @Column(name="id", type="string", length=32, nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @Column(name="file_name", type="string", length=32, nullable=false)
     */
    private $file_name;

    public function getId()
    {
        return $this->id;
    }

    /**
     * Set file_name
     *
     * @param string $file_name
     * @return Migration
     */
    public function setFileName($file_name)
    {
        $this->file_name = $file_name;
        return $this;
    }

    /**
     * Get file_name
     *
     * @return string
     */
    public function getFileName() {
        return $this->file_name;
    }

    static public function getByFileName($file_name)
    {
        global $em;
        $migration = $em->getRepository('Migration')
                ->findOneBy(array('file_name'=>$file_name));

        return $migration;
    }

}
