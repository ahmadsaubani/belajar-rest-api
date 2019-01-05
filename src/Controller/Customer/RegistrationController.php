<?php

namespace App\Controller\Customer;

use App\Entity\Customer;
use App\Controller\BaseController;
use App\Form\Type\RegistrationCustomerType;
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
     * @Post("/api/customer/register")
     * 
     * 
     * @SWG\Response(
     *  response=200,
     *  description="Returns the rewards of an user"
     * )
     * @SWG\Parameter(
     *  name="fos_user_registration_form",
     *  in="body",
     *  description="The field used to order rewards",
     *  @SWG\Schema(type="object",
     *      @SWG\Property(property="fos_user_registration_form", ref=@Model(type=App\Form\Type\RegistrationCustomerType::class))
     *  )
     * )
     * 
     * @SWG\Tag(name="Register")
     *
     * @return JsonResponse
     */
    public function register(Request $request)
    {
        $customer = new Customer();
        $user = $this->userManager->createUser();
        $user->setEnabled(true);

        $form = $this->formFactory->createForm();
        $form->setData($user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $customer->setEmail($user->getEmail());
            $customer->setName($user->getName());
            $user->setCustomer($customer);
            $this->userManager->updateUser($user);

            $message = [
                'message' => 'Registration Success',
            ];

            return $this->json($message, 201);

        }

        return $this->responseErrorForm($form, 400);
    }

}
