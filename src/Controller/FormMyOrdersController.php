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

class FormMyOrdersController extends AbstractController
{
	/**
	 * @Route("/myorders", name="myorders_route")
	 */
	public function formMyOrdersAction(Request $request)
	{
		$repository = $this->getDoctrine()->getRepository('App:Order');
		$query = $repository->createQueryBuilder('p')->getQuery(); 
		$fetched_result = $query->getResult(); 
		
		return $this->render('myorders.html.twig', [
			'result' => $fetched_result,
			'nav_3' => 'true',
		]);
	}

}