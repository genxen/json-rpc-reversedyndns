<?php

namespace dyndns\Api\Endpoint;

use Datto\JsonRpc\Validator\Validate;
use dyndns\Device\DeviceManager;
use Symfony\Component\Validator\Constraints as Assert;

class Devices
{
    private $devices;

    public function __construct()
    {
        $this->devices = new DeviceManager();
    }
	
    /**
     * @Validate(fields={
     *   "iccid" = { @Assert\Type(type="string")}, @Assert\NotBlank() }
     *   "ip_addr" = { @Assert\Type(type="string"), @Assert\NotBlank() }
     * })
     */
    public function update($iccid, $ip_addr)
    {
        return $this->devices->update($iccid, $ip_addr);
    }


    /**
     * @Validate(fields={
     *   "iccid" = { @Assert\Regex("/^(id|iccid|ip_addr|last_modified)$/") }
     * })
     */
    public function getRecord($iccid = 'iccid')
    {
        return $this->devices->getRecord($iccid);
    }


     /**
     * @Validate(fields={
     *   "msisdn" = { @Assert\Regex("/^(ip_addr|last_modified/") }
     * })
     */
    public function getIPaddr($msisdn = 'msisdn')
    {
        return $this->devices->getIPaddr($msisdn);
    }


}

