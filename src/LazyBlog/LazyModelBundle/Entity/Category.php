<?php

namespace LazyBlog\LazyModelBundle\Entity;

use Doctrine\Common\Annotations\Annotation;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Category
 *
 * @ORM\Table(name="category")
 * @ORM\Entity(repositoryClass="LazyBlog\LazyModelBundle\Repository\CategoryRepository")
 */
class Category
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Post", mappedBy="categories", cascade={"remove"})
     */
    private $category;



    public function __construct() {
        $this->category = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Add category
     *
     * @param \LazyBlog\LazyModelBundle\Entity\Post $category
     *
     * @return Category
     */
    public function addCategory(\LazyBlog\LazyModelBundle\Entity\Post $category)
    {
        $this->category[] = $category;

        return $this;
    }

    /**
     * Remove category
     *
     * @param \LazyBlog\LazyModelBundle\Entity\Post $category
     */
    public function removeCategory(\LazyBlog\LazyModelBundle\Entity\Post $category)
    {
        $this->category->removeElement($category);
    }

    /**
     * Get category
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategory()
    {
        return $this->category;
    }
}
