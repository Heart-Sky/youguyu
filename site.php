<?php
/**
 * 我的模块微站定义
 *
 * @ author HeartSky
 * @url http://bbs.we7.cc/
 */
defined('IN_IA') or exit('Access Denied');

class HeartSky_myModuleSite extends WeModuleSite {

	public function doMobileCover() {
		//这个操作被定义用来呈现 功能封面
	}
	public function doWebRule() {
		//这个操作被定义用来呈现 规则列表
	}
	public function doWebCheck() {
		//这个操作被定义用来呈现 商家号审核菜单
		include $this->template('check');	//调用check模板文件

		global $_POST,$_W;

		checklogin();

		//SQL查询
		$query = "SELECT * FROM ims_HeartSky_my_merchants_information WHERE flag=0";
		$result = $db->query($query);
		$num_results = $result->num_rows;
		for($i = 0; $i < $num_rows; $i++)
		{
			$row = $result->fetch_assoc();
			echo '<li>';
			echo $row['username'];
			echo '</li>';
		}
	}
	public function doMobileIcon() {
		//这个操作被定义用来呈现 微站首页导航图标
	}
	public function doMobileCenter() {
		//这个操作被定义用来呈现 微站个人中心导航
	}
	public function doMobileShortcut() {
		//这个操作被定义用来呈现 微站快捷功能导航
	}
}
?>