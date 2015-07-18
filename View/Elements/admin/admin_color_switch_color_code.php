<?php
/**
 * [ADMIN] AdminColorSwitch
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @license			MIT
 * 
 * フロント側のcss（テーマのcss）によっては、ログイン中公開側表示時に反映されない
 */
?>
<style type="text/css">
body #ToolBar{
	background-color: #<?php echo h($user['AdminColorSwitch']['color_code']) ?>;
}
<?php if ($user['AdminColorSwitch']['flg_footer']): ?>
#FooterInner{
	background-color: #<?php echo h($user['AdminColorSwitch']['color_code']) ?>;
}
<?php endif ?>
</style>
