<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityManager;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Routing\Annotation\Route;

class BaseController extends AbstractController
{
    /**
     * @Route("/base", name="base")
     */
    public function index()
    {
        return $this->render('base/index.html.twig', [
            'controller_name' => 'BaseController',
        ]);
    }

    public function getErrorsFromForm(FormInterface $form): array
    {
        $errors = [];
        foreach ($form->getErrors() as $error) {
            $errors[] = $error->getMessage();
        }
        foreach ($form->all() as $childForm) {
            if ($childForm instanceof FormInterface) {
                if ($childErrors = $this->getErrorsFromForm($childForm)) {
                    $errors[$childForm->getName()] = $childErrors;
                }
            }
        }
        return $errors;
    }

    /**
     * Return Json Response Form Form's Error
     *
     * @param FormInterface $form
     * @param integer $status
     * @return JsonResponse
     */
    public function responseErrorForm(FormInterface $form, int $status = 400): JsonResponse
    {
        $errors = $this->getErrorsFromForm($form);
        return $this->json($errors, $status);
    }

    /**
     * Get Doctrine Manager
     *
     * @return EntityManagerInterface
     */
    public function getEm(): EntityManagerInterface
    {
        return $this->getDoctrine()->getManager();
    }

    /**
     * Short function Get Entity Manager
     *
     * @return EntityManagerInterface
     */
    public function getManager(): EntityManagerInterface
    {
        return $this->getEm();
    }

    public function getRepository(string $repositoryName)
    {
        return $this->getEm()->getRepository($repositoryName);
    }

    public function getCustomer()
    {
        if (null === $user = $this->getUser()) {
            return null;
        }

        $customer = $this->getRepository('App:Customer')->findOneCustomerByUser($user);
        return $customer;
    }

    public function getSupplier()
    {
        if (null === $user = $this->getUser()) {
            return null;
        }
        $supplier = $this->getRepository('App:Supplier')->findOneSupplierByUser($user);
        return $supplier;
    }
}
