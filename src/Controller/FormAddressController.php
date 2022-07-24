<?php

namespace App\Controller;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Address;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class FormAddressController extends AbstractController
{
	/**
	 * @Route("/", name="index_route")
	 * @Route("/address", name="address_route")
	 */
	public function formAddressAction(Request $request)
	{
		$form = $this->createFormBuilder()
			->add('type', ChoiceType::class, [
				'choices'  => [
					'Céges' => true,
					'Magánszemély' => false
				],
				'label' => 'Típus:',
				'attr'  => [
					'class' => 'form-control'
				]
			])
			->add('name', TextType::class, [
				'label' => 'Név:',
				'attr'  => [
					'class' => 'form-control'
				]
			])
			->add('phone', TextType::class, [
				'label' => 'Telefon:',
				'attr'  => [
					'class' => 'form-control'
				]
			])
			->add('tax_num', NumberType::class, [
				'label' => 'Adószám:',
				'attr'  => [
					'class' => 'form-control'
				]
			])
			->add('country', ChoiceType::class, [
				'choices'  => [
					// 'Magyarország' => 'hu',
					// 'Németország' => 'en',
					// 'Egyéb' => 'other'
					'Magyarország' => 'Magyarország',
					'Németország' => 'Németország',
					'Egyéb' => 'Egyéb'
				],
				'label' => 'Város:',
				'attr'  => [
					'class' => 'form-control'
				]
			])
			->add('city', TextType::class, [
				'label' => 'Város:',
				'attr'  => [
					'class' => 'form-control'
				]
			])
			->add('address', TextType::class, [
				'label' => 'Utca/Házszám:',
				'attr'  => [
					'class' => 'form-control'
				]
			])
			->add('submit', SubmitType::class, [
				'label' => 'Mentés',
				'attr'  => [
					'class' => 'btn btn-success mt-2'
				]
			])
			->getForm();

		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$entityManager = $this->getDoctrine()->getManager();

			$address = new Address();
			$address->setType($form->getData()['type']);
			$address->setName($form->getData()['name']);
			$address->setPhone($form->getData()['phone']);
			$address->setTaxNum($form->getData()['tax_num']);
			$address->setCountry($form->getData()['country']);
			$address->setCity($form->getData()['city']);
			$address->setAddress($form->getData()['address']);

			$entityManager->persist($address);

			$entityManager->flush();

			return $this->render('address.html.twig', [
				'form' => $form->createView(),
				'success' => 'true',
				'result' => $this->getAddresses(),
				'nav_1' => 'true'
			]);
		}
		
		return $this->render('address.html.twig', [
			'form' => $form->createView(),
			'result' => $this->getAddresses(),
			'nav_1' => 'true'
		]);
	}
	
	public function getAddresses()
	{
		$repository = $this->getDoctrine()->getRepository('App:Address');
		$query = $repository->createQueryBuilder('p')->getQuery(); 
		return $query->getResult(); 
	}

}