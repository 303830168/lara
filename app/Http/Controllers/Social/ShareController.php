<?php

namespace App\Http\Controllers\Social;

use App\Http\Controllers\Social\CommonController;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Model\SelfMedia;
use App\Http\Model\ShareRec;
use App\Http\Model\User;
use Illuminate\Support\Facades\View;
use App\Http\Controllers\Social\WechatController;
include_once('WxHongBaoHelper.php');




class ShareController extends CommonController
{
    private $app_id = 'wx260619ea73a4b130';
    private $app_secret = '469536da8d67cd9df2cdde5609ffefaf';
    private $app_mchid = '1396303202';


    function index($media_id){

      //already sign in
      // if(session('user')){
      //   $status=0;
      // }
      // else{
      //   //not sign in
      //   $status=1;
      // }
      // dd($wechat);

      //get openid and media_id and save to database. we send redpack ,to check the database if the user is in it !


      //get content of the media info use parameter $media_id
      $content = SelfMedia::where('media_id',$media_id)->first()->content;

      $wechat = new WechatController;
      $wechat=$wechat->shareData() ;
      // dd($wechat);

      return view('social.share')
      // ->with('status',$status)
      ->with('wechat',$wechat)
      ->with('content',$content)
      ->with('media_id',$media_id);

    }

    function index2($media_id){
      return view('social.share2')
      ->with('media_id',$media_id);
    }

    function content($media_id){
      $content = SelfMedia::where('id',$media_id)->first()->content;
      return view('social.sharecontent')
      ->with('content',$content);
    }

    //when share successed
    function sharesuccess($media_id){
      //share success and send redpack

      $state='123';
      $code='';

      if($_GET['state']==$state){
      $code = $_GET['code'];
      $uinfo=file_get_contents("https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$this->app_id."&secret=".$this->app_secret."&code=".$code."&grant_type=authorization_code");
      $uinfo=(array)json_decode($uinfo);
      $openid=$uinfo['openid'];
      }


      // dd($openid);

      /* -----------------------redpack payment start-----------------------*/
      //for test
      $openid='oe72EwqRljlpSX3I9tNK2aIwzSWc';

      //check if the sender's balance is enough for sharing
      $user_id = SelfMedia::join('user','self_media.user_id','=','user.user_id')->where('media_id',$media_id)->first()->user_id;
      $user_balance = SelfMedia::join('user','self_media.user_id','=','user.user_id')->where('media_id',$media_id)->first()->user_balance;

      // the user's balance is less then 2
      if($user_balance<=2){
        return view('home.return_main')
        ->with('content','此内容已经失效，请继续分享其他精彩内容吧！');
      }

      //check if the people has already share the media and get paid
      $res = ShareRec::where('openid',$openid)->where('media_id',$media_id)->first();
      // dd($res);
      if(ShareRec::where('openid',$openid)->where('media_id',$media_id)->first()){
        return view('home.return_main')
        ->with('content','您已经分享过该主题啦！去分享更多精彩内容吧！');
      }

      //check if the $media_id exist
      if(!SelfMedia::where('media_id',$media_id)->first()){
        return view('home.return_main')
        ->with('content','该主题不存了， 请继续分享其他精彩内容吧！');
      }



      /* -----------------------redpack sending-----------------------*/
      $payres =  $this->pay($openid,$db=null);
      // save to database blog_share_rec
      if($payres =='SUCCESS'){
        //write into database
        $sharerec['openid'] = $openid;
        $sharerec['media_id'] = $media_id;
        ShareRec::create($shareinfo);
        //user's balance decrease by 2
        User::where('user_id',$user_id)->update(['user_balance'=>($user_balance - 2)]);
      }
      //decrease the

    }

    // send redpack
    private function pay($re_openid,$db=null)
  {

      $commonUtil = new CommonUtil();
      $wxHongBaoHelper = new WxHongBaoHelper();
      // dd($_SERVER);
      // dd($_SERVER["SERVER_ADDR"]);
      // die();
      $wxHongBaoHelper->setParameter("nonce_str", $this->great_rand());//随机字符串，丌长于 32 位
      $wxHongBaoHelper->setParameter("mch_billno", $this->app_mchid.date('YmdHis').rand(1000, 9999));//订单号
      $wxHongBaoHelper->setParameter("mch_id", $this->app_mchid);//商户号
      $wxHongBaoHelper->setParameter("wxappid", $this->app_id);
      $wxHongBaoHelper->setParameter("nick_name", '无穷大');//提供方名称
      $wxHongBaoHelper->setParameter("send_name", '无穷大红包部');//红包发送者名称
      $wxHongBaoHelper->setParameter("re_openid", $re_openid);//相对于医脉互通的openid
      $wxHongBaoHelper->setParameter("total_amount", 100);//付款金额，单位分
      $wxHongBaoHelper->setParameter("min_value", 100);//最小红包金额，单位分
      $wxHongBaoHelper->setParameter("max_value", 1000);//最大红包金额，单位分
      $wxHongBaoHelper->setParameter("total_num", 1);//红包収放总人数
      $wxHongBaoHelper->setParameter("wishing", '恭喜发财');//红包祝福诧
      $wxHongBaoHelper->setParameter("client_ip", $_SERVER["SERVER_ADDR"]);//调用接口的机器 Ip 地址
      $wxHongBaoHelper->setParameter("act_name", '红包活动');//活劢名称
      $wxHongBaoHelper->setParameter("remark", '快来抢！');//备注信息
      $postXml = $wxHongBaoHelper->create_hongbao_xml();
      // dd($postXml);

      $url = 'https://api.mch.weixin.qq.com/mmpaymkttransfers/sendredpack';

      $responseXml = $wxHongBaoHelper->curl_post_ssl($url, $postXml);
      // dd($responseXml);
      // dd(htmlspecialchars($responseXml));
      // die();
      $responseObj = simplexml_load_string($responseXml, 'SimpleXMLElement', LIBXML_NOCDATA);
      // dd(htmlspecialchars($responseObj));
      // die();
      return $responseObj->return_code;

  return;
  }

  /**
   * 生成随机数
   *
   */
  private function great_rand(){
      $str = '1234567890abcdefghijklmnopqrstuvwxyz';
      $t1 = "";
      for($i=0;$i<30;$i++){
          $j=rand(0,35);
          $t1 .= $str[$j];
      }
      return $t1;
  }


}
