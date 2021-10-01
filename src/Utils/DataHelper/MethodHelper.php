<?php

declare(strict_types=1);

namespace App\Utils\DataHelper;

use Symfony\Component\HttpFoundation\Request;

class MethodHelper
{
    public static function isDelete(array $context): bool
    {
        return isset($context["item_operation_name"])
               && self::isStringDelete($context["item_operation_name"]);
    }

    public static function isStringDelete(string $methodName): bool
    {
        return strpos(strtoupper($methodName), Request::METHOD_DELETE) === 0;
    }

    public static function isGet(array $context): bool
    {
        return (
                   isset($context["collection_operation_name"])
                   && self::isStringGet($context["collection_operation_name"])
               )
               || (
                   isset($context["item_operation_name"])
                   && self::isStringGet($context["item_operation_name"])
               );
    }

    public static function isStringGet(string $methodName): bool
    {
        return strpos(strtoupper($methodName), Request::METHOD_GET) === 0;
    }

    public static function isPost(array $context): bool
    {
        return isset($context["collection_operation_name"])
               && self::isStringPost($context["collection_operation_name"]);
    }

    public static function isStringPost(string $methodName): bool
    {
        return strpos(strtoupper($methodName), Request::METHOD_POST) === 0;
    }

    public static function isPut(array $context): bool
    {
        return isset($context["item_operation_name"])
               && self::isStringPut($context["item_operation_name"]);
    }

    public static function isStringPut(string $methodName): bool
    {
        return strpos(strtoupper($methodName), Request::METHOD_PUT) === 0;
    }

    public static function isRequestDelete(Request $request): bool
    {
        return $request->isMethod(Request::METHOD_DELETE);
    }

    public static function isRequestGet(Request $request): bool
    {
        return $request->isMethod(Request::METHOD_GET);
    }

    public static function isRequestPost(Request $request): bool
    {
        return $request->isMethod(Request::METHOD_POST);
    }

    public static function isRequestPut(Request $request): bool
    {
        return $request->isMethod(Request::METHOD_PUT);
    }
}
