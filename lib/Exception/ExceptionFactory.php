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
    const INVALID_GRANT = 'invalid_grant';

    /**
     * @param ClientException $baseException
     * @return SalesforceRestApiException
     */
    public function create(ClientException $baseException)
    {
        $content = json_decode($baseException->getResponse()->getBody()->getContents(), true);


        if (isset($content['error'])) {
            $errorCode = $content['error'];
            $message = $content['error_description'];
            switch ($errorCode) {
                case self::INVALID_GRANT:
                    return new InvalidGrantException($message, 400);
            }
        }

        if (isset($content[0])) {
            $errorCode = $content[0]['errorCode'];
            $message = $content[0]['message'];

            switch ($errorCode) {
                case self::INVALID_FIELD:
                    return new InvalidFieldException($message, 400);
                case self::JSON_PARSER_ERROR:
                    return new JsonParserErrorException($message, 400);
                case self::REQUIRED_FIELD_MISSING:
                    return new RequiredFieldMissingException($message, 400);
                case self::NOT_FOUND:
                    return new NotFoundException($message, 400);
                case self::INVALID_SESSION_ID:
                    return new InvalidSessionIdException($message, 400);
                default:
                    return new BadRequestException('Unpredictable exception', 400);
            }
        }

        return new BadRequestException('Empty response from Salesforce Api', 400);
    }
}
