<?php

namespace App\Controller;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Order;
use App\Entity\Address;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Query;

class FormOrderController extends AbstractController
{
	/**
	 * @Route("/order", name="order_route")
	 */
	public function formOrderAction(Request $request)
	{
		$form = $this->createFormBuilder()
			->add('address_id', EntityType::class, [
				'class' => Address::class,
				'choice_label' => function (Address $address) {
					return $address->getCountry() . ', ' . $address->getCity() . ', ' . $address->getAddress();
				},
				'label' => 'Számlázási cím:',
				// 'multiple' => true,
				// 'expanded' => true,
				'attr'  => [
					'class' => 'form-control'
				]
			])
			->add('submit', SubmitType::class, [
				'label' => 'Elküld',
				'attr'  => [
					'class' => 'btn btn-success mt-2'
				]
			])
			->getForm();

			$netto = 1000;
			$tax = $netto*0.27;
			$brutto = $netto + $tax;

		$form->handleRequest($request);
		if ($form->isSubmitted() && $form->isValid()) {
			$entityManager = $this->getDoctrine()->getManager();
			
			$address = $form->getData()['address_id'];
			
			$order = new Order();
			$order->setAddressId($address->getId());
			$order->setAddressName($address->getCountry() . ', ' . $address->getCity() . ', ' . $address->getAddress());
			$order->setNetto($netto);
			$order->setTax($tax);
			$order->setBrutto($brutto);

			$entityManager->persist($order);

			$entityManager->flush();

			return $this->render('order.html.twig', [
				'form' => $form->createView(),
				'success' => 'true',
				'netto' => $netto,
				'tax' => $tax,
				'brutto' => $brutto,
				'nav_2' => 'true'
			]);
		}
		
		return $this->render('order.html.twig', [
			'form' => $form->createView(),
			'netto' => $netto,
			'tax' => $tax,
			'brutto' => $brutto,
			'nav_2' => 'true'
		]);
	}
}