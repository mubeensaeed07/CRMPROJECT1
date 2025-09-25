<?php

namespace App\Services;

use ReCaptcha\ReCaptcha;

class RecaptchaService
{
    private $recaptcha;

    public function __construct()
    {
        $this->recaptcha = new ReCaptcha(config('services.recaptcha.secret_key'));
    }

    public function verify($response, $remoteIp = null)
    {
        $result = $this->recaptcha->verify($response, $remoteIp);
        return $result->isSuccess();
    }

    public function getErrors()
    {
        return $this->recaptcha->getErrorCodes();
    }
}
