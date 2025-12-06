<?php
/**
* @class sitemap_selectbox
* @author YJSoft (yjsoft@yjsoft.xyz)
* @version 0.6.1
* @brief 설정된 메뉴를 이용하여 사이트맵 출력
**/

class sitemap_selectbox extends WidgetHandler {
    /**
    * @brief 위젯의 실행 부분
    **/
    function proc($args) {
        $menu_file = sprintf('%sfiles/cache/menu/%d.php', _XE_PATH_, $args->sitemap_widget_menu);
        $menu = null;
        if (file_exists($menu_file)) {
            include $menu_file;
        }
		
        $widget_info = (object) [
            'sitemap_widget_menu'     => $menu,
            'sitemap_widget_movetype' => $args->sitemap_widget_movetype ?? 'button',
            'selectbox_default'       => $args->selectbox_default ?? '선택',
            'button_label'            => $args->button_label ?? '이동',
            'widget_id'               => $args->widget_id ?? 'sitemapWidgetBox',
            'select_class'            => $args->select_class ?? '',
            'button_class'            => $args->button_class ?? 'btn',
        ];
		
        Context::set('widget_info', $widget_info);
		
        $tpl_path = sprintf('%sskins/%s', $this->widget_path, $args->skin);
        $oTemplate = TemplateHandler::getInstance();
        return $oTemplate->compile($tpl_path, 'sitemap');
    }
}