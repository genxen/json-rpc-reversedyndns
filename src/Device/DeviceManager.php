<?php

namespace dyndns\Device;
use Datto\JsonRpc\Validator\Validate;
use Symfony\Component\Validator\Constraints as Assert;
use PDO;

class DeviceManager
{

    private $conn;
    private $servername = "localhost"; 
    private $dbname = "dyndns_wirex";
    private $username = "demo";
    private $password = "demo123";

    public function __construct()
    {
	try {
        $this->conn = new PDO("mysql:host=$this->servername;dbname=$this->dbname", $this->username, $this->password);
		$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch (PDOException $e) {
    			echo 'Connexion échouée : ' . $e->getMessage();
	}
    }

    public function __destruct()
    {
        $this->conn = null;
    }
    

     // update table WirexID
    public function update($iccid, $ip_addr)
    {	

	//check if msisdn exist
	$RecordExist = $this->conn->prepare("SELECT * FROM wirexID WHERE iccid=:iccid");
	$RecordExist->bindParam(':iccid', $iccid, PDO::PARAM_INT);
	$RecordExist->execute(); 
	if ($RecordExist->rowCount() > 0) {
  	
		// Update WirexID with new data
	        $request = $this->conn->prepare("
                	update wirexID
                	set ip_addr=:ip_addr, last_modified = CURRENT_TIMESTAMP()
                	where iccid=:iccid
        	");

	} else {
		
		// Insert new entry in wirexID
		 $request = $this->conn->prepare("
			insert into wirexID (iccid, ip_addr, last_modified)
    			VALUES (:iccid, :ip_addr, CURRENT_TIMESTAMP())
            ");
	}

    $request->bindParam(':iccid', $iccid);
    $request->bindParam(':ip_addr', $ip_addr);
    $request->execute();

    return $RecordExist->fetch(PDO::FETCH_ASSOC);   		

    }
	
    //Get record using iccid
    public function getRecord($iccid)
    {

        $Record = $this->conn->prepare("SELECT * FROM wirexID WHERE iccid = :iccid");
        $Record->bindParam(':iccid', $iccid);
        $Record->execute();
	
	$result = $Record->fetch(PDO::FETCH_ASSOC);
        
	return $result;
    }
	
    //Get ip and date of last modification using msisdn
    public function getIPaddr($msisdn)
    {
	// take phone number without indicative
        $msisdnlastdigit = substr($msisdn, -9);
	$Record = $this->conn->prepare("
		SELECT ip_addr,TIMESTAMPDIFF(SECOND,last_modified,NOW()) 'Diff last_modified'
		FROM wirexID 
		INNER JOIN msisdnIndex ON wirexID.iccid = msisdnIndex.iccid 
		WHERE msisdnIndex.msisdn = :msisdn"
  	);

        $Record->bindParam(':msisdn', $msisdnlastdigit);
        $Record->execute();
	
	$mysql_Result = $Record->fetch(PDO::FETCH_ASSOC);

	//find specific network patern
	//$pos = strpos($mysql_Result['ip_addr'], '10.');
	//$pos1 = strpos($mysql_Result['ip_addr'], '.6.');
	//$pos2 = strpos($mysql_Result['ip_addr'], '.2.');
	//if ($pos == 0 and ($pos1 == 2 or $pos2 == 2)) {                
	//		$mysql_Result['ip_addr'] = substr_replace($mysql_Result['ip_addr'],'11.',$pos,strlen('10.'));
        //}
	
	return $mysql_Result;
    }
	
}
