<?php
/**
 * [ViewEventListener] AdminColorSwitch
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @license			MIT
 */
class AdminColorSwitchViewEventListener extends BcViewEventListener {
/**
 * 登録イベント
 *
 * @var array
 */
	public $events = array(
		'beforeLayout',
	);
	
/**
 * beforeLayout
 * 
 * @param CakeEvent $event
 */
	public function beforeLayout(CakeEvent $event) {
		$View = $event->subject();
		
		if (!isset($View->viewVars['user'])) {
			return;
		}
		
		if (!isset($View->viewVars['user']['AdminColorSwitch']) || empty($View->viewVars['user']['AdminColorSwitch'])) {
			return;
		}
		
		if ($View->viewVars['user']['AdminColorSwitch']['color_code']) {
			// フッター色指定は管理側表示のみ適用する
			if (!BcUtil::isAdminSystem()) {
				$View->viewVars['user']['AdminColorSwitch']['flg_footer'] = false;
			}
			
			$View->start('admin_color_switch');
			$AdminColorSwitch = $View->element($this->plugin .'.admin/admin_color_switch_color_code');
			$View->end();
			$View->append('css', $AdminColorSwitch);
		}
	}
	
}
