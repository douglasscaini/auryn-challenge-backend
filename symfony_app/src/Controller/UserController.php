<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
  /**
   * @Route("/users", methods={"GET"})
   */
  public function getUsers()
  {
    $users = $this->getDoctrine()
      ->getRepository(User::class)
      ->findAll();

    $serializer = $this->get('serializer');
    $data = $serializer->serialize($users, 'json');

    return new Response($data, 200, [
      'Access-Control-Allow-Origin' => 'http://localhost:8080'
    ]);
  }

  /**
   * @Route("/users", methods={"POST"})
   */
  public function postUsers(Request $request): Response
  {
    $user = new User();

    $user->setName($request->get('name'));
    $user->setPhoneNumber($request->get('phoneNumber'));
    $user->setEmail($request->get('email'));
    $user->setBirthday(new \DateTime($request->get('birthday')));
    $user->setPassword($request->get('password'));
    $user->setPasswordRepeated($request->get('passwordRepeated'));
    $user->setCpf($request->get('cpf'));

    $entityManager = $this->getDoctrine()->getManager();
    $entityManager->persist($user);
    $entityManager->flush();

    return new Response('Inserido com sucesso!', 200, [
      'Access-Control-Allow-Origin' => 'http://localhost:8080'
    ]);
  }
}
