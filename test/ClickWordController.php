<?php
declare(strict_types=1);

use Runtuer\Service\ClickWordCaptchaService;

class ClickWordController
{
    public function get()
    {
        $config = require '../src/config.php';
        $service = new ClickWordCaptchaService($config);
        $data = $service->get();
        echo json_encode([
            'error' => false,
            'repCode' => 0,
            'repData' => $data,
            'repMsg' => null,
            'success' => true,
        ]);
    }

    /**
     * 一次验证
     */
    public function check()
    {
        $config = require '../src/config.php';
        $service = new ClickWordCaptchaService($config);
        $data = $_REQUEST;
        $msg = null;
        $error = false;
        $repCode = 0;
        try {
            $service->check($data['token'], $data['pointJson']);
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            $error = true;
            $repCode = 1;
        }
        echo json_encode([
            'error' => $error,
            'repCode' => $repCode,
            'repData' => null,
            'repMsg' => $msg,
            'success' => !$error,
        ]);
    }

    /**
     * 二次验证
     */
    public function verification()
    {
        $config = require '../src/config.php';
        $service = new ClickWordCaptchaService($config);
        $data = $_REQUEST;
        $msg = null;
        $error = false;
        $repCode = 0;
        try {
            if (isset($data['captchaVerification'])) {
                $service->verificationByEncryptCode($data['captchaVerification']);
            } else if (isset($data['token']) && isset($data['pointJson'])) {
                $service->verification($data['token'], $data['pointJson']);
            } else {
                throw new \Exception('参数错误！');
            }
        } catch (\Exception $e) {
            $msg = $e->getMessage();
            $error = true;
            $repCode = 1;
        }
        echo json_encode([
            'error' => $error,
            'repCode' => $repCode,
            'repData' => null,
            'repMsg' => $msg,
            'success' => !$error,
        ]);
    }
}








