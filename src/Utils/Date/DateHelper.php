<?php

declare(strict_types=1);

namespace App\Utils\Date;

use DateTimeImmutable;

class DateHelper
{
    public const FULL_TIME_FORMAT     = 'H:i:s';
    public const HOUR_MIN_TIME_FORMAT = 'H:i';
    public const DATE_FORMAT          = 'Y-m-d';
    public const DATE_TIME_FORMAT     = 'Y-m-d H:i:s';

    public static function createDateFromString(string $string): DateTimeImmutable
    {
        return DateTimeImmutable::createFromFormat(
            self::DATE_FORMAT,
            $string
        );
    }

    public static function createDateTimeFromString(string $string): DateTimeImmutable
    {
        return DateTimeImmutable::createFromFormat(
            self::DATE_TIME_FORMAT,
            $string
        );
    }

    public static function createTimeFromString(string $string): DateTimeImmutable
    {
        return DateTimeImmutable::createFromFormat(
            self::FULL_TIME_FORMAT,
            $string
        );
    }

    public static function toDateFormat(DateTimeImmutable $dateTimeImmutable): string
    {
        return $dateTimeImmutable->format(self::DATE_FORMAT);
    }

    public static function toDateTimeFormat(DateTimeImmutable $dateTimeImmutable): string
    {
        return $dateTimeImmutable->format(self::DATE_TIME_FORMAT);
    }

    public static function toTimeFormat(DateTimeImmutable $dateTimeImmutable): string
    {
        return $dateTimeImmutable->format(self::FULL_TIME_FORMAT);
    }
}
