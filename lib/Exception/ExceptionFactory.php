<?php

namespace Devhelp\Salesforce\Exception;

use GuzzleHttp\Exception\ClientException;

/**
 * @author <michal@devhelp.pl>
 */
class ExceptionFactory
{
    const INVALID_FIELD = 'INVALID_FIELD';
    const JSON_PARSER_ERROR = 'JSON_PARSER_ERROR';
    const REQUIRED_FIELD_MISSING = 'REQUIRED_FIELD_MISSING';
    const NOT_FOUND = 'NOT_FOUND';
    const INVALID_SESSION_ID = 'INVALID_SESSION_ID';

    public function create(ClientException $baseException)
    {
        $content = json_decode($baseException->getResponse()->getBody()->getContents(), true);

        if (isset($content[0])) {
            $errorCode = $content[0]['errorCode'];
            $message = $content[0]['message'];

            switch ($errorCode) {
                case self::INVALID_FIELD:
                    throw new InvalidFieldException($message, 400);
                case self::JSON_PARSER_ERROR:
                    throw new JsonParserErrorException($message, 400);
                case self::REQUIRED_FIELD_MISSING:
                    throw new RequiredFieldMissingException($message, 400);
                case self::NOT_FOUND:
                    throw new NotFoundException($message, 400);
                case self::INVALID_SESSION_ID:
                    throw new InvalidSessionIdException($message, 400);
                default:
                    throw new BadRequestException('Unpredictable exception', 400);
            }
        }

        throw new BadRequestException('Empty response from Salesforce Api', 400);
    }
}
