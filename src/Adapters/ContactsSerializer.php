<?php

/**
 * This file is part of the yii2-user-account.
 *
 * Copyright 2021 Evgenii Dudal <wolfstrace@gmail.com>.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 * @package yii2-user-account
 */

namespace RobotE13\Yii2UserAccount\Adapters;

use RobotE13\UserAccount\Entities\Contact\{
    Contact,
    ContactsCollection
};

/**
 * Description of ContactSerializer
 *
 * @author Evgenii Dudal <wolfstrace@gmail.com>
 */
class ContactsSerializer implements \JsonSerializable
{

    /**
     * @var ContactsCollection
     */
    private $contacts;

    public function __construct(ContactsCollection $contacts)
    {
        $this->contacts = $contacts;
    }

    public function jsonSerialize()
    {
        return array_map(function($item) {
            /* @var $item Contact */
            return [
                'value' => $item->getValue(),
                'type' => $item->getType()
            ];
        }, $this->contacts->toArray());
    }

}
