<?php

declare(strict_types=1);

namespace App\Common\Jms;

use Decimal\Decimal;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\GraphNavigator;
use JMS\Serializer\JsonSerializationVisitor;
use JMS\Serializer\JsonDeserializationVisitor;
use JMS\Serializer\Context;

final class DecimalHandler implements SubscribingHandlerInterface
{
    public static function getSubscribingMethods()
    {
        return [
            [
                'direction' => GraphNavigator::DIRECTION_SERIALIZATION,
                'format' => 'json',
                'type' => 'Decimal',
                'method' => 'serializeDecimalToJson',
            ],
            [
                'direction' => GraphNavigator::DIRECTION_DESERIALIZATION,
                'format' => 'json',
                'type' => 'Decimal',
                'method' => 'deserializeDecimalToJson',
            ],
        ];
    }

    public function serializeDecimalToJson(JsonSerializationVisitor $visitor, Decimal $decimal, array $type, Context $context)
    {
        return $decimal->toFixed(2);
    }

    public function deserializeDecimalToJson(JsonDeserializationVisitor $visitor, $decimal, array $type, Context $context)
    {
        $decimal = is_float($decimal) ? (string) $decimal : $decimal;

        return new Decimal($decimal);
    }
}