<?php
namespace Qanda\HelloBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="product")
 */
class Product
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="string", length=100)
     */
    protected $name;

    /**
     * @Assert\NotBlank()
     * @Assert\Range(
     *      min = 0.1,
     *      max = 500,
     *      minMessage = "Please enter more than 0.1",
     *      maxMessage = "Please enter less than 500"
     * )
     * @ORM\Column(type="decimal", scale=2)
     */
    protected $price;

    /**
     * @Assert\NotBlank()
     * @ORM\Column(type="text")
     */
    protected $description;

    /**
     * @Assert\Type(type="Qanda\HelloBundle\Entity\Category")
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="products")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    protected $category;

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
     * Set name
     *
     * @param string $name
     * @return Product
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
     * Set price
     *
     * @param float $price
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Product
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

    /**
     * Set category
     *
     * @param \Qanda\HelloBundle\Entity\Category $category
     * @return Product
     */
    public function setCategory(\Qanda\HelloBundle\Entity\Category $category = null)
    {
        $this->category = $category;
        return $this;
    }

    /**
     * Get category
     *
     * @return \Qanda\HelloBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }
}
