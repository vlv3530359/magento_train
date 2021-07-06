<?php /**
 * Copyright © 2016 Magento. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Aaxis\HelloPage\Controller\Page;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\User\Model\UserFactory;

class Index extends Action
{
    /**
     * @var PageFactory $pageFactory
     */
    protected $pageFactory;


    /**
     * Index constructor.
     * @param Context $context
     * @param PageFactory $pageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $pageFactory
    ) {
        $this->pageFactory = $pageFactory;
        return parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $email = ($this->getRequest()->getParam('email') ?? 'Anoymous');
        $page = $this->pageFactory->create();
//        $block = $page->getLayout()->getBlock('hellopage_page_index');
//        $block->setData('email_parameter', $email);

        return $page;
    }

}
