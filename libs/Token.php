<?php

class Token {
	protected $context;
    function __construct($context){
        if(isset($context->db) && isset($context->enc) && isset($context->utils))
		    $this->context =& $context;
        else
            $context->error([
                'ttl' => 'Required Libraries Not Initialized',
                'msg' => 'Token library requires "Db" , "Enc" and "Utils". Please load fore mentioned libraries before loading Token library',
                'logs' => debug_backtrace(),
                'type' => 'danger'
            ]);
    }

	function getToken($userID=0,$type='GENERAL',$data=null){
        if($data===null)
			$data = time();
		if(is_array($data))
			$data = json_encode($data);

	    $opr = $this->context->db->insert('token',[
	        'uid'=>$userID,
            'ip_addr'=>$this->context->utils->get_ip(),
            't_for'=>$type,
            'data'=>$data
        ]);
	    if($opr['status'])
	        return $opr['insert_id'];
	    return 0;
	}

	function getLastToken($userID=0,$type='GENERAL',$crush=true,$getData=false){
        $params = [
            'id'=>'',
            'where' => "`uid`={$userID} AND `t_for`='{$type}' AND `ip_addr`='{$this->context->utils->get_ip()}' ORDER BY `id` DESC LIMIT 1"
        ];

        if($getData)
            $params['data'] = '';
	    $token = $this->context->db->select('token',$params);
	    if($token['status']) {

            if($crush)
                $this->getToken($userID,$type,'CRUSHED');

	        if($getData) {
                return ['id'=>$token['result']['id'],'data'=>$token['result']['data']];
            }
            return $token['result']['id'];

        }
	    return null;
	}

	function getLoginSignature(){
        if(isset($_SESSION['auth'])){
            $token = $this->getToken($_SESSION['auth']['uid'],'LOGIN_SIGNATURE');
            $ip = $_SESSION['auth']['ip'];
            $agent = $this->context->utils->get_browser_agent();
            $sig = md5("{$token}-{$ip}-{$agent}");
            return $sig;
        }
        return false;
    }

    function verifyLoginSignature($signature){
        if(isset($_SESSION['auth'])){
            $token = $this->getLastToken($_SESSION['auth']['uid'],'LOGIN_SIGNATURE',false,false);
            $ip = $this->context->utils->get_ip();
            $agent = $this->context->utils->get_browser_agent();
            $sig = md5("{$token}-{$ip}-{$agent}");
            return (strcmp($sig,$signature)===0) ? true : false;
        }
        return false;
    }
	function getPublicToken($forFile=null,$time=600){
	    if($tNo = $this->getToken(0,'PUBLIC')) {
            $tNoHash = md5($tNo . sha1("@*&%?3%##@232"));
            $end = time() + $time;
            if ($forFile === null)
                $token = $tNoHash . "___NoFile___" . $end;
            else
                $token = $tNoHash . "___" . $forFile . "___" . $end;
            if($tHash = $this->context->enc->cryptDecrypt($token))
                return $tHash;
        }
        return null;
	}

	function verifyPublicToken($hash,$forFile=null,$crush=true){
	    $hashArr = explode("___",$this->context->enc->cryptDecrypt($hash,'d'));
	    if($tokenNumber = $this->getLastToken(0,'PUBLIC',$crush))
	    $thsh = md5($tokenNumber.sha1("@*&%?3%##@232"));
	    if($forFile==null)
	        $forFile = "NoFile";
	    if(count($hashArr)!=3){
	        return array(
	            "status" => 0,
	            "reason" => 0,
	            "errmsg" => "String explosion not returned valid number of elements"
	        );
	    }else if($hashArr[0]!=$thsh){
	        return array(
	            "status" => 0,
	            "reason" => 1,
	            "errmsg" => "Security token is invalid, Please refresh the page"
	        );
	    }else if($hashArr[1]!=$forFile){
	        return array(
	            "status" => 0,
	            "reason" => 2,
	            "errmsg" => "Given public token is not intended for specified controller::action, or is invalid"
	        );
	    }else if($hashArr[2] < time()){
	        return array(
	            "status" => 0,
	            "reason" => 3,
	            "errmsg" => "Security token has expired"
	        );
	    }else{
	        if($crush)
	            $this->getPublicToken($forFile);
	        return array(
	            "status" => 1,
	            "time" => $hashArr[2]
	        );
	    }
	}

	function getCSRF($criteria=''){
		if(isset($_SESSION['auth']) && isset($_SESSION['auth']['uid']))
			$uid = $_SESSION['auth']['uid'];
		else
			$uid = 0;

		$t1 = $this->getToken($uid,'FORM');
		return hash('sha256',md5($t1).$this->context->utils->get_ip().$this->context->utils->get_browser_agent().md5($criteria));
	}

	function verifyCSRF($cipher,$criteria=''){
        if(isset($_SESSION['auth']) && isset($_SESSION['auth']['uid']))
            $uid = $_SESSION['auth']['uid'];
        else
            $uid = 0;

        $t1 = $this->getLastToken($uid,'FORM',false);
		$hash = hash('sha256',md5($t1).$this->context->utils->get_ip().$this->context->utils->get_browser_agent().md5($criteria));
		if((strcmp($hash,$cipher)===0)){
			$this->getLastToken($uid,'FORM');
			return true;
		}
		return false;
	}
}
