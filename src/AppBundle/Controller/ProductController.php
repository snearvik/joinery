<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Product;
use AppBundle\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

/**
 * Product controller.
 *
 * @Route("product")
 */
class ProductController extends Controller
{
    /**
     * Lists all product entities.
     *
     * @Route("/", name="product_index")
	 * @Method({"GET", "POST"})
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
		$products = null;
		
		$category = new Category();
		$minPrice = $em->getRepository('AppBundle:Product')->findMinPrice();
		$maxPrice = $em->getRepository('AppBundle:Product')->findMaxPrice();
		$existence = false;
		$errorMessage = '';
		
		$filterForm = $this->createFilterForm($category, $minPrice, $maxPrice, $existence);
        $filterForm->handleRequest($request);

        if ($filterForm->isSubmitted() && $filterForm->isValid()) {
			$category = $filterForm['category']->getData();
			$minPrice = $filterForm['minPrice']->getData();
			$maxPrice = $filterForm['maxPrice']->getData();
			$existence = $filterForm['existence']->getData();
			
			if ($minPrice > $maxPrice){
				$products = null;
				$errorMessage = 'minPrice must be lower than maxPrice!';
			}
			else 
				$products = $em->getRepository('AppBundle:Product')->findByFilter($category, $minPrice, $maxPrice, $existence);
        }

        return $this->render('product/index.html.twig', array(
            'products' => $products,
			'filter_form' => $filterForm->createView(),
			'errorMessage' => $errorMessage
        ));
    }
	
	private function createFilterForm($category, $minPrice, $maxPrice, $existence)
    {
        return $this->createFormBuilder()
			->add('category',EntityType::class, array(
					'class' => 'AppBundle:Category',
					'choice_label' => 'getName',
					'multiple' => false,
					'label' => 'Category',
					'required' => false))
			->add('minPrice', NumberType::class, array('label' => 'minPrice', 'scale' => 2, 'data' => $minPrice))
			->add('maxPrice', NumberType::class, array('label' => 'maxPrice', 'scale' => 2, 'data' => $maxPrice))
			->add('existence', CheckboxType::class, array('label' => 'existence', 'data' => $existence, 'required' => false))
            ->setAction($this->generateUrl('product_index'))
            ->setMethod('POST')
            ->getForm();
    }
	
    /**
     * Creates a new product entity.
     *
     * @Route("/new", name="product_new")
     * @Method({"GET", "POST"})
	 * @Security("has_role('ROLE_ADMIN')")
     */
    public function newAction(Request $request)
    {
        $product = new Product();
        $form = $this->createForm('AppBundle\Form\ProductType', $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush();

            return $this->redirectToRoute('product_show', array('id' => $product->getId()));
        }

        return $this->render('product/new.html.twig', array(
            'product' => $product,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a product entity.
     *
     * @Route("/{id}", name="product_show")
     * @Method("GET")
     */
    public function showAction(Product $product)
    {
        $deleteForm = $this->createDeleteForm($product);

        return $this->render('product/show.html.twig', array(
            'product' => $product,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing product entity.
     *
     * @Route("/{id}/edit", name="product_edit")
     * @Method({"GET", "POST"})
	 * @Security("has_role('ROLE_ADMIN')")
     */
    public function editAction(Request $request, Product $product)
    {
        $deleteForm = $this->createDeleteForm($product);
        $editForm = $this->createForm('AppBundle\Form\ProductType', $product);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('product_edit', array('id' => $product->getId()));
        }

        return $this->render('product/edit.html.twig', array(
            'product' => $product,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a product entity.
     *
     * @Route("/{id}", name="product_delete")
     * @Method("DELETE")
	 * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction(Request $request, Product $product)
    {
        $form = $this->createDeleteForm($product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($product);
            $em->flush();
        }

        return $this->redirectToRoute('product_index');
    }

    /**
     * Creates a form to delete a product entity.
     *
     * @param Product $product The product entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Product $product)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('product_delete', array('id' => $product->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
