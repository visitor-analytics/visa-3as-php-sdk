<?php

namespace Visa\Subscriptions;

interface SubscriptionManagement {
    public function upgrade(array $message): void;
    public function downgrade(array $message): void;
    public function cancel(array $message): void;
    public function resume(array $message): void;
    public function deactivate(array $message): void;
}

