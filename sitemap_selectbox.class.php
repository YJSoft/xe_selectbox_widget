<?php
/**
* @class sitemap_selectbox
* @author YJSoft (yjsoft@yjsoft.xyz)
* @version 0.2
* @brief 설정된 메뉴를 이용하여 사이트맵 출력
**/

class sitemap_selectbox extends WidgetHandler {
	/**
	* @brief 위젯의 실행 부분
	* ./widgets/위젯/conf/info.xml에 선언한 extra_vars를 args로 받는다
	* 결과를 만든후 print가 아니라 return 해주어야 한다
	**/
	function proc($args) {
		// 메뉴설정
		$php_file = sprintf('%sfiles/cache/menu/%d.php', _XE_PATH_, $args->sitemap_widget_menu);
		@include($php_file);
		$widget_info = new stdClass();
		$widget_info->sitemap_widget_menu = $menu;
		
		// 이동 타입 설정
		$widget_info->sitemap_widget_movetype = $args->sitemap_widget_movetype ?? "button";

		// 기본 문자열 설정
		$widget_info->selectbox_default = $args->selectbox_default ?? "선택";

		// 버튼 라벨 설정
		$widget_info->button_label = $args->button_label ?? "이동";

		// 위젯 ID 설정
		$widget_info->widget_id = $args->widget_id ?? "sitemapWidgetBox";

		// select class 설정
		$widget_info->select_class = $args->select_class ?? "";

		// 버튼 class 설정
		$widget_info->button_class = $args->button_class ?? "btn";
		
		Context::set('widget_info', $widget_info);
		
		// 템플릿 컴파일
		$tpl_path = sprintf('%sskins/%s', $this->widget_path, $args->skin);
		$tpl_file = 'sitemap';
		
		$oTemplate = TemplateHandler::getInstance();
		return $oTemplate->compile($tpl_path, $tpl_file);
	}
}