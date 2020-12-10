<?php

namespace dyndns\Api\Evaluator;

use Datto\JsonRpc;
use Datto\JsonRpc\Exception;
use Demo\Device\DeviceManager;

class DevicesEvaluator implements JsonRpc\Evaluator
{
    private $devices;

    public function __construct()
    {
        $this->devices = new DeviceManager();
    }

    public function evaluate($method, $arguments)
    {
	if ($method === 'devices/update') {
            return $this->devices->update($arguments['iccid'], $arguments['ip_addr']);
        } else if ($method === 'devices/getRecord') {
            return $this->devices->getRecord($arguments['iccid']);
	} else if ($method === 'devices/getIPaddr') {
            return $this->devices->getIPaddr($arguments['msisdn']);
        }else {
            throw new Exception\Method();
        }
    }
}
