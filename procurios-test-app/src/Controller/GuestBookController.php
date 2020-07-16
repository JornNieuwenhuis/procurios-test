<?php

namespace App\Controller;

use App\Entity\Entry;
use App\Form\EntryType;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class GuestBookController extends AbstractController
{
    /**
     * @Route("/", name="guest_book", methods={"GET"})
     */
    public function index()
    {
		$entries = $this->getDoctrine()->getRepository(Entry::class)->findAll();
        return $this->render('guest_book/index.html.twig', [
			'entries' => $entries
        ]);
	}

	/**
	 * @Route("/entry/new", name="new_entry", methods={"GET", "POST"})
	 */
	public function new(Request $request) {
		$entry = new Entry();

		$form = $this->createFormBuilder($entry)
			->add('guestName', TextType::class, array(
				'attr' => array('class' => 'form-control')
			))
			->add('guestLocation', TextType::class, array(
				'attr' => array('class' => 'form-control', 'required' => false)
			))
			->add('message', TextareaType::class, array(
				'attr' => array('class' => 'form-control')
			))
			->getForm();

		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()) {
			$entry = $form->getData();
			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->persist($entry);
			$entityManager->flush();
			$this->addFlash('success', 'NEW entry has been added.');
			return $this->redirectToRoute('guest_book');
		}

		return $this->render('guest_book/new.html.twig', [
			'form' => $form->createView()
		]);
	}

	/**
	 * @Route("/entry/edit/{id}", name="edit_entry", methods={"GET", "POST"})
	 */
	public function edit(Request $request, $id) {
		$entry = new Entry();
		$entry = $this->getDoctrine()->getRepository(Entry::class)->find($id);

		$form = $this->createFormBuilder($entry)
			->add('guestName', TextType::class, array(
				'attr' => array('class' => 'form-control')
			))
			->add('guestLocation', TextType::class, array(
				'attr' => array('class' => 'form-control', 'required' => 'false')
			))
			->add('message', TextareaType::class, array(
				'attr' => array('class' => 'form-control')
			))
			->getForm();

		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()) {
			$entityManager = $this->getDoctrine()->getManager();
			$entityManager->flush();
			$this->addFlash('success', 'The entry has been UPDATED.');
			return $this->redirectToRoute('guest_book');
		}

		return $this->render('guest_book/edit.html.twig', [
			'form' => $form->createView(),
			'id' => $id
		]);
	}

	/**
	 * @Route("/entry/delete/{id}", methods={"GET", "DELETE"})
	 */
	public function delete(Request $request, $id) {
		$entry = $this->getDoctrine()->getRepository(Entry::class)->find($id);
		$em = $this->getDoctrine()->getManager();
		try {
			$em->remove($entry);
			$em->flush();
			$this->addFlash('success', 'The entry has been REMOVED.');
		} catch (\Throwable $th) {
			$this->addFlash('error', 'Failed to delete entry.');
			return new Response($th.getMessage());
		}

		return $this->redirectToRoute('guest_book', array());
	}
}
