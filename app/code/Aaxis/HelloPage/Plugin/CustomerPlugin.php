<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Aaxis\HelloPage\Plugin;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Api\Data\CustomerInterface;
use Magento\LoginAsCustomerAssistance\Api\SetAssistanceInterface;
use Psr\Log\LoggerInterface;

/**
 * Plugin for Customer assistance_allowed extension attribute.
 */
class CustomerPlugin
{
    /**
     * @var SetAssistanceInterface
     */
    private $setAssistance;

    /**
     * @var LoggerInterface
     */
    protected $log;

    /**
     * @param SetAssistanceInterface $setAssistance
     * @param LoggerInterface $log
     */
    public function __construct(
        SetAssistanceInterface $setAssistance,
        LoggerInterface $log
    ) {
        $this->setAssistance = $setAssistance;
        $this->log = $log;
    }

    /**
     * Save assistance_allowed extension attribute for Customer instance.
     *
     * @param CustomerRepositoryInterface $subject
     * @param string $email
     * @param int|null $websiteId
     * @return CustomerInterface
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function beforeGet(
        CustomerRepositoryInterface $subject,
        string &$email
    ) {

        if (strpos($email,'@') == false) {
            $this->log->error('The email format is not expected.');
        }
    }

    /**
     * @param CustomerRepositoryInterface $subject
     * @param callable $proceed
     * @param string $email
     * @return mixed
     */
    public function aroundGet(CustomerRepositoryInterface $subject, callable $proceed, $email) {
        if (strpos($email,'@') == false) {
            $this->log->error('Tring to add email subbfix @aaxiscommerce.com for the user '. $email);
            $email = $email.'@aaxiscommerce.com';
        }

        return $proceed($email);

    }

    /**
     * @param CustomerRepositoryInterface $subject
     * @param CustomerInterface $customer
     * @return $customer
     */
    public function afterGet(CustomerRepositoryInterface $subject, CustomerInterface $customer) {
        if ($customer !=null) {
            $this->log->error('You can find the customer with plugin.');
        } else {
            $this->log->error('You can not find the customer with plugin.');
        }
        return $customer;

    }
}
