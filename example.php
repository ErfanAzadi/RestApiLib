<?php
require_once 'RestApiLib.php';
class example extends RestfulApiLib
{
    public function __construct()
    {
        parent::__construct();
    }

    final function onReceiveRequest(array $request): void
    {
        $token = $request['token'];
        $tokenList = [
            'expired' => ['JYiK8XmH4lN6tqOk2vGw3pDx7RzZcEba', 'fSBrsLjgWU2QIPa3Z0zkhTnE9y6xHV1C'],
            'valid'   => ['5OvVt3s42exrZ9HiNUwKnaMlIbBAXL0G', 'aYL23iXGg6R0ryJhTfVvS8mKkU7spWto']
        ];

        if (isset($token) and !empty($token)) {
            if (in_array($token, $tokenList['expired'])) {
                $this->fail('Your token is expired! Try to use a new one.');
            } elseif (in_array($token, $tokenList['valid'])) {
                $result = [
                    'authenticated' => true,
                    'data1' => 'this is data1',
                    'expire_date' => '3000/03/33'
                ];
                $this->success($result);
            } else {
                $this->fail('Token is not valid.');
            }
            return;
        }

        $this->fail('Token parameter not found.');
    }
}

new example();