<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->redirectToRoute('product_index');
    }
	
	/**
     * @Route("/admin")
     */
    public function adminAction()
    {
		$this->denyAccessUnlessGranted('ROLE_ADMIN', null, 'Unable to access this page!');
        return new Response('<html><body>Admin page!</body></html>');
    }
}
