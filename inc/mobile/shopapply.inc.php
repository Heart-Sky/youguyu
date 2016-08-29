<?php  
/**
 * 接收微信端请求表单，并存进数据库
 * 
 * PHP version 5.6.21
 * nginx version 1.8.1
 * MySQL version 5.5.49
 * @ author HeartSky
 */

/**
 * 导入系统全局变量($_W)和全局请求变量($_GPC)
 */
global $_W;
global $_GPC;

/**
 * 加载Tpl控件函数所在的文件
 */
load()->func('tpl');	//framework/function/tpl.func.php

/**
 * 引入处理上传图片的文件
 */
//require_once('http://115.159.65.240/pro/addons/HeartSky_my/inc/mobile/uploadPhoto.php');

if(checksubmit('submit'))
{
	/**
	 * 接收变量
	 */
	$va              = array();	//定义变量数组
	$va['open_id']   = $_W['openid'];
	$va['username']  = $_GPC['username'];
	$va['password']  = $_GPC['password'];
	$va['name']      = $_GPC['name'];
	$va['sex']       = $_GPC['sex'];
	$va['age']       = $_GPC['age'];
	$va['id_number'] = $_GPC['id_number'];
	$va['phone']     = $_GPC['phone'];
	$va['email']     = $_GPC['email'];
	$va['shop_name'] = $_GPC['shop_name'];
	$va['shop_add']  = $_GPC['shop_add'];
	$va['shop_info'] = $_GPC['shop_info'];

	/**
	 * 验证数据
	 */
	if(preg_match('/[^_0-9a-zA-Z]/',$va['username']))
	{
		echo '{"status":"f_username","content":"请检查用户名"}';
		exit;
	}
	if(strlen($va['password']) < 6)
	{
		echo '{"status":"f_password","content":"请检查密码"}';
		exit;
	}
	if(preg_match('/[^0-9]/',$va['age']))
	{
		echo '{"status":"f_age","content":"请检查年龄"}';
		exit;
	}
	if(preg_match('/[^0-9]/',$va['id_number']))
	{
		echo '{"status":"f_id_number","content":"请检查身份证号"}';
		exit;
	}
	if(preg_match('/[^0-9]/',$va['phone']))
	{
		echo '{"status":"f_phone","content":"请检查手机号"}';
		exit;
	}
	if(! preg_match('/^\w+@[a-z0-9]+\.[a-z]+$/',$va['email']))
	{
		echo '{"status":"f_email","content":"请检查邮箱地址"}';
		exit;
	}

	/**
	 * 验证是否用户名已存在
	 */
	$record = pdo_fetch("SELECT * FROM ".tablename('HeartSky_my_shop_information')." 
		WHERE username = :username",array(":username" => $va['username']));
	if($record !== false)
	{
		echo '{"status":"e_username","content","用户名已存在"}';
		exit;	
	} 

	/**
	 * 存入数据库
	 */
	if($va['username'])
	{
		pdo_insert('HeartSky_my_shop_information',$va);
	}

	/**
	 * 返回正确标记
	 */
	echo '{"status":"success","content","提交成功，请注意近期邮件查看申请结果"}';

	//$record = pdo_fetch("SELECT * FROM ".tablename('HeartSky_my_shop_information')."WHERE id = :id",array(":id" => 1));
	//echo $this->createMobileUrl('home').'<br>';
	//echo url('entry//shopapplty',array('m' => 'HeartSky_my'));
}
	
include $this->template('shopapply');
?>