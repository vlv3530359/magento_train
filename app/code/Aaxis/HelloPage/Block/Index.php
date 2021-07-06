<?php
namespace Aaxis\HelloPage\Block;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\View\Element\Template;
use Magento\User\Model\UserFactory;

/**
 * Class Index
 * @package PandaGroup\MyFirstController\Block
 */
class Index extends Template
{
    /**
     * @var CustomerRepositoryInterface
     */
    private $customerRepository;

    /**
     * Index constructor.
     * @param Template\Context $context
     * @param CustomerRepositoryInterface $customerRepository
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        CustomerRepositoryInterface $customerRepository,
        array $data = []
    )
    {
        $this->customerRepository = $customerRepository;
        parent::__construct($context, $data);
    }

    public function getCustomer() {
        $email = $this->getRequest()->getParam('email');
        if (empty($email)) {
            return null;
        }
        try {
            $customer = $this->customerRepository->get($email);
            return $customer;
        } catch (\Exception $e) {
            return null;
        }

    }
}