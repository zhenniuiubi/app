<?php
namespace dysms;
use Think\Controller;
use dysms\SignatureHelper;
// require_once "./SignatureHelper.php"; 

class Alisms extends Controller {
    
    public function _initialize(){
        $this->accessKeyId = "LTAIiRHgyiPxTGDa"; //keyid
        $this->accessKeySecret = "ZAUA0QSg1BsLfo85msh293p73XBrGs"; //keysecret
        $this->SignName = "我的编程之旅"; //签名
        $this->CodeId = "SMS_165413163"; //验证码模板id
    }
    
    //发送验证码
    public function code($phone,&$msg){
        
        if(!$this->isphone($phone)){
            $msg = "手机号不正确";
            return false;
        }
        
        $params["PhoneNumbers"] = $phone; 
        $params["TemplateCode"] = $this->CodeId; //模板
        
        //记录验证码
        if(session("?code")){
            $code = session("code");
        }else{
            $code = rand(100000,999999);
            session("code",$code);
        }
        
        $params['TemplateParam'] = ["code" => $code]; //验证码
        return $this->send($params,$msg);        
    }
    
    private function isphone($phone){
        if (!is_numeric($phone)) {
            return false;
        }
        return preg_match('#^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$#', $phone) ? true : false;
    }
    
    //发送
    
    private function send($params=[],&$msg){
        
        $params["SignName"] = $this->SignName;
        
        if(!empty($params["TemplateParam"]) && is_array($params["TemplateParam"])) {
            $params["TemplateParam"] = json_encode($params["TemplateParam"], JSON_UNESCAPED_UNICODE);
        }
        $helper = new SignatureHelper();
        $content = $helper->request(
            $this->accessKeyId,
            $this->accessKeySecret,
            "dysmsapi.aliyuncs.com",
            array_merge($params, array(
                "RegionId" => "cn-hangzhou",
                "Action" => "SendSms",
                "Version" => "2017-05-25",
            ))
        );
        halt($content);
        if($content===false){
            $msg = "发送异常";
            return false;
        }else{
            $data = (array)$content;
            if($data['Code']=="OK"){
                $msg = "发送成功";
                return true;
            }else{
                $msg = "发送失败 ".$data['Message'];
                return false;
            }
        }        
    }
}