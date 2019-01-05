<?php

namespace App\Controller\Supplier;

use App\Entity\Product;
use App\Entity\Supplier;
use App\Form\Type\ProductType;
use App\Controller\BaseController;
use App\Service\FormHandler\FormHandlerInterface;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Controller\Annotations\Get;
use Nelmio\ApiDocBundle\Annotation\Model;
use Nelmio\ApiDocBundle\Annotation\Security;
use Swagger\Annotations as SWG;
use Symfony\Component\HttpFoundation\Request;

/**
 * @RouteResource("product")
 */
class ProductController extends BaseController
{
    private $formHandler;

    public function __construct(FormHandlerInterface $formHandler)
    {
        $this->formHandler = $formHandler;
    }

    /**
     * Get Product
     *
     * @SWG\Response(
     *  response=200,
     *  description="Returns the rewards of an user"
     * )
     * 
     * 
     * @SWG\Tag(name="Product")
     * @Security(name="Bearer")
     */
    public function cgetAction()
    {
        $supplier = $this->getSupplier();

        $product = $this->getRepository('App:Product')->findBySupplier($supplier);

        if (null === $product) {
            return $this->json(['message' => 'Product Not Found'], 404);
        }

        $context = [
                'groups' => [
                    'Product',
                ],
            ];

        return $this->json($product, 200, [], $context);
    }

    /**
     * Get Product
     *
     * @SWG\Response(
     *  response=200,
     *  description="Returns the rewards of an user"
     * )
     * 
     * 
     * @SWG\Tag(name="Product")
     * @Security(name="Bearer")
     */
    public function getAction(int $id)
    {
        $supplier = $this->getSupplier();

        $product = $this->getRepository('App:Product')->findOneBySupplier($supplier);

        if (null === $product) {
            return $this->json(['message' => 'Product Not Found'], 404);
        }

        $groups = [
            'Product',
        ];

        return $this->json($product, 200, [], ['groups' => $groups]);
    }

    /**
     * Create Product
     *
     * @SWG\Response(
     *  response=200,
     *  description="Returns the rewards of an user"
     * )
     * 
     * @SWG\Parameter(
     *     name="product",
     *     in="body",
     *     description="The field used to order rewards",
     *     @SWG\Schema(type="object",
     *       @SWG\Property(property="product", ref=@Model(type=App\Form\Type\ProductType::class))
     *     )
     * )
     * 
     * @SWG\Tag(name="Product")
     * @Security(name="Bearer")
     */
    public function postAction()
    {
        $em = $this->getManager();
        $supplier = $this->getSupplier();

        $product = new Product();

        $form = $this->formHandler->validateForm(ProductType::class, $product);

        if ($form->isSubmitted() && $form->isValid()) {

            $product->setSupplier($supplier);

            $em->persist($product);
            $em->flush();

            $groups = [
                'Product',
            ];

            return $this->json($product, 200, [], ['groups' => $groups]);
        }

        return $this->responseErrorForm($form);
    }

    /**
     * Patch / Update Product
     *
     * @SWG\Response(
     *  response=200,
     *  description="Returns the rewards of an user"
     * )
     * 
     * @SWG\Parameter(
     *     name="product",
     *     in="body",
     *     description="The field used to order rewards",
     *     @SWG\Schema(type="object",
     *       @SWG\Property(property="product", ref=@Model(type=App\Form\Type\ProductEditType::class))
     *     )
     * )
     * 
     * @SWG\Tag(name="Product")
     * @Security(name="Bearer")
     */
    public function patchAction(Request $request, int $id)
    {
        $em = $this->getManager();
        $product = $this->getRepository('App:Product')->findOneById($id);

        if (null === $product) {
            return $this->json(['message' => 'Product Not Found'], 404);
        }

        $form = $this->formHandler->validateForm(ProductType::class, $product);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($product);
            $em->flush();

                $groups = [
                    'Product',
            ];

            return $this->json($product, 200, [], ['groups' => $groups]);
        }

        return $this->responseErrorForm($form);
        
    }

    /**
     * Delete Product
     *
     * @SWG\Response(
     *  response=204,
     *  description="Delete Success"
     * )
     * 
     * @SWG\Tag(name="Product")
     * @Security(name="Bearer")
     */

    public function deleteAction(int $id)
    {
        $product = $this->getRepository('App:Product')->findOneById($id);

        if (null === $product) {
            return $this->json(['message' => 'Product Not Found'], 404);
        }

        $em = $this->getManager();
        $em->remove($product);
        $em->flush();

        return $this->json([], 204);

    }
}
