<?php

namespace App\Service\FormHandler;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\RequestStack;

class FormHandler implements FormHandlerInterface
{
    /**
     * Form Factory
     *
     * @var Symfony\Component\Form\FormFactoryInterface
     */
    private $formFactory;

    private $requestStack;

    public function __construct(FormFactoryInterface $formFactory, RequestStack $requestStack)
    {
        $this->formFactory = $formFactory;
        $this->requestStack = $requestStack;
    }

    public function validateForm(string $formTypeClass, $entity, array $options = [])
    {
        $form = $this->formFactory->create($formTypeClass, $entity, $options);
        $request = $this->requestStack->getCurrentRequest();
        $isNotPatch = $request->getMethod() !== 'PATCH';

        if ($isNotPatch) {
            $form->handleRequest($request);
        } else {
            if (null !== $requestPatch = $request->request->get($form->getName())) {
                $form->submit($requestPatch, false);
            }
        }

        return $form;
    }
}
