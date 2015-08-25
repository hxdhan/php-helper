<?php

$menu= array();
$first = array();
$first['name'] = "微商城";

//$first['type'] = "click";
//$first['key'] = "beidu001";
$frst_sub_button = array();
//$first_sub_button[] = array("name"=>"最新优惠","type"=>"click","key"=>"beidu004");
$first_sub_button[] = array("name"=>"男士正装","type"=>"view","url"=>"http://wap.koudaitong.com/v2/feature/9ctla0az");
$first_sub_button[] = array("name"=>"女士正装","type"=>"view","url"=>"http://wap.koudaitong.com/v2/feature/jo60zmmc");
$first_sub_button[] = array("name"=>"男士手工皮鞋","type"=>"view","url"=>"http://wap.koudaitong.com/v2/feature/13hxgws6u");
$first['sub_button'] = $first_sub_button;


$second = array();
$second['name'] = "预约量体";

$second['type'] = "view";
$second['url'] = "http://m.ybren.com/?from=YBRWX";


$third = array();
$third['name'] = "优惠活动";
$third_sub_button = array();
$third_sub_button[] = array("name"=>"关于衣邦人","type"=>"view","url"=>"http://wx.ybren.com/product_info/");
$third_sub_button[] = array("name"=>"我的客服","type"=>"click","key"=>"beidu003");
$third_sub_button[] = array("name"=>"西服优惠","type"=>"click","key"=>"beidu005");
$third_sub_button[] = array("name"=>"衬衫优惠","type"=>"click","key"=>"beidu006");


$third['sub_button'] = $third_sub_button;

$menu["button"][] = $first;
$menu["button"][] = $second;
$menu["button"][] = $third;

$mem = new Memcached('ocs');
if(count($mem->getServerList()) == 0) {
  $mem->setOption(Memcached::OPT_COMPRESSION, false);
  $mem->setOption(Memcached::OPT_BINARY_PROTOCOL, true);
  $mem->addServer('', 11211);
  $mem->setSaslAuthData('', '');
}
if($access_token = $mem->get(md5("access_token".'test'))) {

  $send_url = "https://api.weixin.qq.com/cgi-bin/menu/create?access_token=$access_token";
//$cmd = "curl --insecure -X POST -H 'Content-Type: application/json' -u ':'";
  $cmd = "curl -X POST -H 'Content-Type: application/json'";
  $cmd.= " -d '" . json_encode($menu,JSON_UNESCAPED_UNICODE) . "' " . "'" . $send_url . "'";
//  $cmd .= " > /dev/null 2>&1 &";
  exec($cmd, $output, $exit);
  var_dump($output);
}
