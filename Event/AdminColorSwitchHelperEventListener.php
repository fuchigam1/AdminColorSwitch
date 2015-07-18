<?php
/**
 * [HelperEventListener] AdminColorSwitch
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @license			MIT
 */
class AdminColorSwitchHelperEventListener extends BcHelperEventListener {
/**
 * 登録イベント
 *
 * @var array
 */
	public $events = array(
		'Form.afterForm',
	);
	
/**
 * 処理対象とするコントローラー
 * 
 * @var array
 */
	public $targetControllers = array('users');
	
/**
 * 処理対象とするアクション
 * 
 * @var array
 */
	public $targetActions = array('admin_edit', 'admin_add');
	
/**
 * formAfterForm
 * ユーザー編集・登録画面にアドミンカラースウィッチ指定欄を追加する
 * 
 * @param CakeEvent $event
 */
	public function formAfterForm (CakeEvent $event) {
		if (!BcUtil::isAdminSystem()) {
			return;
		}
		
		$View = $event->subject();
		
		if (!in_array($View->request->params['controller'], $this->targetControllers)) {
			return;
		}
		
		if (in_array($View->request->params['action'], $this->targetActions)) {
			echo $View->element('AdminColorSwitch.admin/admin_color_switch_form');
		}
	}
	
}
