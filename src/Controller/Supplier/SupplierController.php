<?php

namespace App\Controller\Supplier;

use App\Entity\Supplier;
use App\Form\Type\SupplierType;
use App\Controller\BaseController;
use App\Service\FormHandler\FormHandlerInterface;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\Annotations\Get;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;

/**
 * @RouteResource("supplier")
 */
class SupplierController extends BaseController
{
    private $formHandler;

    public function __construct(FormHandlerInterface $formHandler)
    {
        $this->formHandler = $formHandler;
    }

    /**
     * GET Route annotation.
     * @Get("/api/supplier")
     * 
     * @SWG\Response(
     *  response=200,
     *  description="Returns the rewards of an user"
     * )
     * 
     * @SWG\Tag(name="Supplier")
     * @Security(name="Bearer")
     *
     * @return JsonResponse
     */
    public function getSupplierData()
    {
        $supplier = $this->getSupplier();

            if (null === $supplier) {
            return $this->json(['message' => 'Supplier Not Found'], 404);
            }

        $context = [
            'groups' => [
                'Supplier',
                'Product',
            ],
        ];

        return $this->json($supplier, 200, [], $context);

    }

    /**
     * Patch / Update Supplier Profile
     *
     * @SWG\Response(
     *  response=200,
     *  description="Returns the rewards of an user"
     * )
     * 
     * @SWG\Parameter(
     *     name="supplier",
     *     in="body",
     *     description="The field used to order rewards",
     *     @SWG\Schema(type="object",
     *       @SWG\Property(property="supplier", ref=@Model(type=App\Form\Type\SupplierType::class))
     *     )
     * )
     * 
     * @SWG\Tag(name="Supplier")
     * @Security(name="Bearer")
     */
    public function patchAction(Request $request, int $id)
    {
        $supplier = $this->getRepository('App:Supplier')->findOneById($id);

            if (null === $supplier) {
                return $this->json(['message' => 'Supplier Not Found'], 404);
            }

        $em = $this->getManager();

        $form = $this->formHandler->validateForm(SupplierType::class, $supplier);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($supplier);
            $em->flush();

            $context = [
                'groups' => [
                    'Supplier',
                    'Product',
                ],
            ];

            return $this->json($supplier, 200, [], $context);
        }

        return $this->responseErrorForm($form);
        
    }

    /**
     * Delete / Delete Supplier
     *
     * @SWG\Response(
     *  response=204,
     *  description="Delete Success"
     * )
     * 
     * @SWG\Tag(name="Supplier")
     * @Security(name="Bearer")
     */

    public function deleteAction(int $id)
    {
        $supplier = $this->getRepository('App:Supplier')->findOneById($id);

        if (null === $supplier) {
            return $this->json(['message' => 'Supplier Not Found'], 404);
        }

        $em = $this->getManager();
        $em->remove($supplier);
        $em->flush();

        return $this->json([], 204);

    }
    
}
