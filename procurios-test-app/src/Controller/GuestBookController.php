<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

class GuestBookController extends AbstractController
{
    /**
     * @Route("", name="guest_book")
	 * @Method({"GET"})
     */
    public function index()
    {
		$entries = [""];
        return $this->render('guest_book/index.html.twig', [
			'controller_name' => 'GuestBookController',
			'entries' => $entries
        ]);
    }
}
