<?php

namespace Recca0120\LaravelPayum\Action;

use Illuminate\Contracts\View\Factory as ViewFactory;
use Payum\Core\Action\ActionInterface;
use Payum\Core\Exception\RequestNotSupportedException;
use Payum\Core\Request\RenderTemplate;

class RenderTemplateAction implements ActionInterface
{
    /**
     * $viewFactory.
     *
     * @var \Illuminate\Contracts\View\Factory
     */
    protected $viewFactory;

    /**
     * __construct.
     *
     * @method __construct
     *
     * @param \Illuminate\Contracts\View\Factory $viewFactory
     */
    public function __construct(ViewFactory $viewFactory)
    {
        $this->viewFactory = $viewFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function execute($request)
    {
        /* @var $request RenderTemplate */
        RequestNotSupportedException::assertSupports($this, $request);

        $request->setResult($this->viewFactory->make(
            $request->getTemplateName(),
            $request->getParameters()
        )->render());
    }

    /**
     * {@inheritdoc}
     */
    public function supports($request)
    {
        return $request instanceof RenderTemplate;
    }
}
