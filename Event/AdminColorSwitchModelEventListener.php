<?php
/**
 * [ModelEventListener] AdminColorSwitch
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @license			MIT
 */
class AdminColorSwitchModelEventListener extends BcModelEventListener {
/**
 * 登録イベント
 *
 * @var array
 */
	public $events = array(
		'User.beforeFind',
		'User.afterSave',
		'User.afterDelete',
	);
	
/**
 * userBeforeFind
 * ユーザー情報取得の際に、AdminColorSwitch 情報も併せて取得する
 * 
 * @param CakeEvent $event
 */
	public function userBeforeFind (CakeEvent $event) {
		$Model = $event->subject();
		$association = array(
			'AdminColorSwitch' => array(
				'className' => 'AdminColorSwitch.AdminColorSwitch',
				'foreignKey' => 'user_id'
			)
		);
		$Model->bindModel(array('hasOne' => $association));
	}
	
/**
 * userAfterSave
 * ユーザー情報保存時に、AdminColorSwitch 情報を保存する
 * 
 * @param CakeEvent $event
 */
	public function userAfterSave (CakeEvent $event) {
		$Model = $event->subject();
		
		// AdminColorSwitch のデータがない場合は save 処理を実施しない
		if (!isset($Model->data['AdminColorSwitch']) || empty($Model->data['AdminColorSwitch'])) {
			return;
		}
		
		$saveData['AdminColorSwitch'] = $Model->data['AdminColorSwitch'];
		$saveData['AdminColorSwitch']['user_id'] = $Model->id;
		if (!$Model->AdminColorSwitch->save($saveData)) {
			$this->log(sprintf('ID：%s の AdminColorSwitch の保存に失敗しました。', $Model->data['AdminColorSwitch']['id']));
		}
	}
	
/**
 * userAfterDelete
 * ユーザー情報削除時、そのユーザーが持つ AdminColorSwitch 情報を削除する
 * 
 * @param CakeEvent $event
 */
	public function userAfterDelete (CakeEvent $event) {
		$Model = $event->subject();
		$data = $Model->AdminColorSwitch->find('first', array(
			'conditions' => array('AdminColorSwitch.user_id' => $Model->id),
			'recursive' => -1
		));
		if ($data) {
			if (!$Model->AdminColorSwitch->delete($data['AdminColorSwitch']['id'])) {
				$this->log('ID:' . $data['AdminColorSwitch']['id'] . 'のAdminColorSwitchの削除に失敗しました。');
			}
		}
	}
	
}
