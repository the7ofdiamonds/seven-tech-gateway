<?php

namespace SEVEN_TECH\Gateway\Model\Response;

class ResponseCreateAccount {
    public string $id;
    public string $userActivationCode;
    public string $confirmationCode;

    public function __construct(
        string $id,
        string $userActivationCode,
        string $confirmationCode,
    ) {
        $this->id = $id;
        $this->userActivationCode = $userActivationCode;
        $this->confirmationCode = $confirmationCode;
    }

    public function getId(): string {
        return $this->id;
    }

    public function getUserActivationCode(): string {
        return $this->userActivationCode;
    }

    public function getConfirmationCode(): string {
        return $this->confirmationCode;
    }
}