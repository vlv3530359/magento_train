<?php
namespace Aaxis\HelloPage\Block;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\View\Element\Template;
use Magento\User\Model\UserFactory;
use Psr\Log\LoggerInterface;

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
     * @var LoggerInterface
     */
    protected $log;

    /**
     * Index constructor.
     * @param Template\Context $context
     * @param CustomerRepositoryInterface $customerRepository
     * @param LoggerInterface $log
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        CustomerRepositoryInterface $customerRepository,
        LoggerInterface $log,
        array $data = []
    )
    {
        $this->customerRepository = $customerRepository;
        $this->log = $log;
        parent::__construct($context, $data);
    }

    public function getCustomer() {
        //$this->log->error("get customer.......");
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