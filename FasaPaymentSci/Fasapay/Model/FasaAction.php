<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace FasaPaymentSci\Fasapay\Model;
use Magento\Framework\Option\ArrayInterface;

/**
 *
 * Authorize.net Payment Action Dropdown source
 */
class FasaAction implements ArrayInterface
{
    /**
     * {@inheritdoc}
     */
    public function toOptionArray()
    {
        return [
            [
                'value' => 'Facom',
                'label' => __('FasaPay.Com'),
            ],
            [
                'value' => 'Faid',
                'label' => __('FasaPay.Co.Id')
            ],
			[
                'value' => 'Sandbox',
                'label' => __('FasaPay Sandbox')
            ]
        ];
    }
}
