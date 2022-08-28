<?php
declare(strict_types=1);


namespace App\TradeMarketing\Domain\Entities;

use JsonSerializable;


class Entity implements JsonSerializable
{
    /**
     * @return array|string
     */
    public function jsonSerialize()
    {
        if (method_exists($this, 'toArray')) {
            return $this->toArray();
        }

        if (method_exists($this, '__toString')) {
            return $this->__toString();
        }

        return '';
    }
}
