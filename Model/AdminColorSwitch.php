<?php
/**
 * [Model] AdminColorSwitch
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @license			MIT
 */
class AdminColorSwitch extends BcPluginAppModel {
/**
 * ModelName
 * 
 * @var string
 */
	public $name = 'AdminColorSwitch';
	
/**
 * PluginName
 * 
 * @var string
 */
	public $plugin = 'AdminColorSwitch';
	
/**
 * belongsTo
 * 
 * @var array
 */
	public $belongsTo = array(
		'User' => array(
			'className'	=> 'User',
			'foreignKey' => 'user_id'
		),
	);
	
}
