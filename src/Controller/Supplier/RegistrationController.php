<?php

namespace App\Controller\Supplier;

use App\Entity\Supplier;
use App\Controller\BaseController;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\UserBundle\Model\UserManagerInterface;
use FOS\UserBundle\Form\Factory\FactoryInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;

class RegistrationController extends BaseController
{
    /**
     * UserManager
     *
     * @var UserManagerInterface
     */
    private $userManager;

    /**
     * Form Factory
     *
     * @var FactoryInterface
     */
    private $formFactory;

    public function __construct(
        UserManagerInterface $userManager,
        FactoryInterface $formFactory
    )
    {
        $this->userManager = $userManager;
        $this->formFactory = $formFactory;
    }


    /**
     * @Post("/api/supplier/register")
     * 
     * 
     * @SWG\Response(
     *  response=200,
     *  description="Returns the rewards of an user"
     * )
     * @SWG\Parameter(
     *  name="fos_supplier_registration_form",
     *  in="body",
     *  description="The field used to order rewards",
     *  @SWG\Schema(type="object",
     *      @SWG\Property(property="fos_supplier_registration_form", ref=@Model(type=App\Form\Type\RegistrationSupplierType::class))
     *  )
     * )
     * 
     * @SWG\Tag(name="Register")
     *
     * @return JsonResponse
     */
    public function register(Request $request)
    {
        $supplier = new Supplier();
        $em = $this->getManager();
        $user = $this->userManager->createUser();
        $user->setEnabled(true);

        $form = $this->formFactory->createForm();
        $form->setData($user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $supplier->setEmail($user->getEmail());
            $supplier->setNamaToko($user->getNamaToko());
            $supplier->setAlamatToko($user->getAlamatToko());
            $supplier->setJenisToko($user->getJenisToko());
            $supplier->setSloganToko($user->getSloganToko());

            $this->userManager->updateUser($user);
            $supplier->setUser($user);
            $em->persist($supplier);
            $em->flush();

            $message = [
                'message' => 'Registration Success',
            ];

            return $this->json($message, 201);

        }

        return $this->responseErrorForm($form, 400);
    }
}
