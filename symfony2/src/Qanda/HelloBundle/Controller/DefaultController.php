<?php

namespace Qanda\HelloBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;

use Qanda\HelloBundle\Entity\Product;
use Qanda\HelloBundle\Entity\Category;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="product_list")
     * @Template()
     */
    public function indexAction()
    {
        $products = $this->getDoctrine()
            ->getRepository('QandaHelloBundle:Product')
            ->findAll();

        return array('products' => $products);
    }

    /**
     * @Route("/add", name="product_add")
     * @Template()
     */
    public function addAction(Request $request)
    {
        /*
        if (false){
            $category = new Category();
            $category->setName('Main Products');

            $product = new Product();
            $product->setName('New Product');
            $product->setPrice('19.99');
            $product->setDescription('Lorem ipsum dolor');
            $product->setCategory($category);

            $em = $this->getDoctrine()->getManager();
            $em->persist($category);
            $em->persist($product);
            $em->flush();
            return $this->redirect($this->generateUrl('product_list'));
        }
         */

        // Create the Form
        $product = new Product();
        $form = $this->createFormBuilder($product)
            ->add('name', 'text')
            ->add('price', 'text')
            ->add('description', 'text')
            ->add('save this product', 'submit')
            ->getForm();
        $form->handleRequest($request);
        if ($form->isValid()){
            // TODO save this object to database
            return $this->redirect($this->generateUrl('product_list'));
        }

        return array('product_form' => $form->createView());
    }

    /**
     * @Route("/show/{id}", name="product_show")
     * @Template()
     */
    public function showAction($id)
    {
        $product = $this->getDoctrine()
            ->getRepository('QandaHelloBundle:Product')
            ->find($id);

        if (!$product){
            throw $this->createNotFoundException("Product $id is not found!");
        }
            return array('product' => $product);
    }

    /**
     * @Route("/delete/{id}", name="product_delete")
     * @Template()
     */
    public function deleteAction($id)
    {
        $product = $this->getDoctrine()
            ->getRepository('QandaHelloBundle:Product')
            ->find($id);

        $em = $this->getDoctrine()->getManager();
        $em->remove($product);
        $em->flush();

        return $this->redirect($this->generateUrl('product_list'));
    }
}
