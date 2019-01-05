<?php

namespace App\Controller\Customer;

use App\Entity\Customer;
use App\Form\Type\CustomerType;
use App\Controller\BaseController;
use App\Service\FormHandler\FormHandlerInterface;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\Annotations\Get;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;

/**
 * @RouteResource("customer")
 */
class CustomerController extends BaseController
{
    private $formHandler;

    public function __construct(FormHandlerInterface $formHandler)
    {
        $this->formHandler = $formHandler;
    }

    /**
     * GET Route annotation.
     * @Get("/api/customer")
     * 
     * @SWG\Response(
     *  response=200,
     *  description="Returns the rewards of an user"
     * )
     * 
     * @SWG\Tag(name="Customer")
     * @Security(name="Bearer")
     *
     * @return JsonResponse
     */
    public function getCustomerData()
    {
        $customer = $this->getCustomer();

        if (null === $customer) {
            return $this->json(['message' => 'Customer Not Found'], 404);
        }

        $context = [
            'groups' => [
                'Customer',
            ],
        ];

        return $this->json($customer, 200, [], $context);

    }

    /**
     * Patch / Update Customer Profile
     *
     * @SWG\Response(
     *  response=200,
     *  description="Returns the rewards of an user"
     * )
     * 
     * @SWG\Parameter(
     *     name="customer",
     *     in="body",
     *     description="The field used to order rewards",
     *     @SWG\Schema(type="object",
     *       @SWG\Property(property="customer", ref=@Model(type=App\Form\Type\CustomerType::class))
     *     )
     * )
     * 
     * @SWG\Tag(name="Customer")
     * @Security(name="Bearer")
     */
    public function patchAction(Request $request, int $id)
    {
        $customer = $this->getRepository('App:Customer')->findOneById($id);

        if (null === $customer) {
            return $this->json(['message' => 'Customer Not Found'], 404);
        }


        $em = $this->getManager();

        $form = $this->formHandler->validateForm(CustomerType::class, $customer);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($customer);
            $em->flush();

            $context = [
                'groups' => [
                    'Customer',
                ],
            ];

            return $this->json($customer, 200, [], $context);
        }

        return $this->responseErrorForm($form);
    }
}
