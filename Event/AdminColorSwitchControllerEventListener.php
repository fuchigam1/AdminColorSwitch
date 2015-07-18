<?php
/**
 * [ControllerEventListener] AdminColorSwitch
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @license			MIT
 */
class AdminColorSwitchControllerEventListener extends BcControllerEventListener {
/**
 * 登録イベント
 *
 * @var array
 */
	public $events = array(
		'Users.beforeRender',
	);
	
/**
 * usersBeforeRender
 * ユーザー情報追加画面で実行し、AdminColorSwitch の初期値を設定する
 * 
 * @param CakeEvent $event
 */
	public function usersBeforeRender (CakeEvent $event) {
		if (!BcUtil::isAdminSystem()) {
			return;
		}
		
		$Controller = $event->subject();
		if ($Controller->request->params['action'] == 'admin_add') {
			$Controller->request->data['AdminColorSwitch'] = array(
				'color_code' => '333333',
			);
		}
	}
	
}
