<?php

declare(strict_types=1);

namespace Visa\Notifications;

use GuzzleHttp\Exception\GuzzleException;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator;
use Visa\VisaHttpClient;

class NotificationsApi
{
    public const SUB_CREATED = 'SUBSCRIPTION_CREATED';
    public const SUB_UPDATED = 'SUBSCRIPTION_UPDATED';

    private VisaHttpClient $httpClient;

    public function __construct(VisaHttpClient $httpClient)
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @throws GuzzleException
     * @throws \Exception
     */
    public function notify(array $message): void
    {
        $this->validateNotificationFormat($message);

        switch ($message['type']) {
            case self::SUB_CREATED:
                $this->validateSubscriptionCreatedNotificationPayload($message['payload']);
                break;
            case self::SUB_UPDATED:
                $this->validateSubscriptionUpdatedNotificationPayload($message['payload']);
                break;
            default:
                throw new \Exception('Unsupported notification type.');
        }

        $this->httpClient->post('/v2/3as/notifications', $message);
    }

    /**
     * @throws \Exception
     */
    private function validateNotificationFormat(array $message): void
    {
        $validationSchema = Validator::arrayType()
            ->key(
                'type',
                Validator::stringType()
                    ->oneOf(
                        Validator::equals(self::SUB_CREATED),
                        Validator::equals(self::SUB_UPDATED)
                    )
            )
            ->key('payload', Validator::arrayType());

        try {
            $validationSchema->assert($message);
        } catch (NestedValidationException $exception) {
            throw new \Exception(json_encode($exception->getMessages()));
        }
    }

    /**
     * @throws \Exception
     */
    private function validateSubscriptionCreatedNotificationPayload(array $payload): void
    {
        $payloadValidationSchema = Validator::arrayType()
                ->key('packageId', Validator::uuid(4))
                ->key(
                    'website',
                    Validator::arrayType()
                    ->key('intpWebsiteId', Validator::stringType())
                    ->key('domain', Validator::domain())
                    ->key(
                        'language',
                        Validator::oneOf(
                            Validator::languageCode(),
                            Validator::nullType()
                        )
                    )
                    ->key(
                        'timezone',
                        Validator::oneOf(
                            Validator::stringType(),
                            Validator::nullType()
                        )
                    )
                )->key(
                    'customer',
                    Validator::arrayType()
                    ->key('intpCustomerId', Validator::stringType())
                    ->key('email', Validator::email())
                );

        try {
            $payloadValidationSchema->assert($payload);
        } catch (NestedValidationException $exception) {
            throw new \Exception(json_encode($exception->getMessages()));
        }
    }

    /**
     * @throws \Exception
     */
    private function validateSubscriptionUpdatedNotificationPayload(array $payload): void
    {
        $payloadValidationSchema = Validator::arrayType()
            ->key('packageId', Validator::uuid(4))
            ->key(
                'website',
                Validator::arrayType()
                    ->key('id', Validator::stringType())
            );
        try {
            $payloadValidationSchema->assert($payload);
        } catch (NestedValidationException $exception) {
            throw new \Exception(json_encode($exception->getMessages()));
        }
    }
}
