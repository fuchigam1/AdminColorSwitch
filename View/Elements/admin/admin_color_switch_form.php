<?php
/**
 * [ADMIN] AdminColorSwitch
 *
 * @link			http://www.materializing.net/
 * @author			arata
 * @license			MIT
 */
$this->BcBaser->css(array('AdminColorSwitch.admin/colpick'), array('inline' => false));
$this->BcBaser->js(array('AdminColorSwitch.admin/colpick'), false);
?>
</table>
<!-- #FormTable -->

<script type="text/javascript">
$(function () {
	/**
	 * ツールバーの色指定欄にデフォルト色の値を入れる
	 */
	$('#AdminColorSwitchColorCodeReset').on('click', function(){
		if (confirm('デフォルト色 #333333 に設定します。よろしいですか?')) {
			$('#AdminColorSwitchColorCode').val('333333');
		}
		return false;
	});

	/**
	 * カラーピッカーを起動してツールバーの色を指定する
	 */
	$('#AdminColorSwitchColorCode').colpick({
		//layout:'hex',
		submit:0,
		//colorScheme:'dark',
		onChange:function(hsb,hex,rgb,el,bySetColor) {
			$(el).css('border-color','#'+hex);
			// Fill the text box just if the color was set using the picker, and not the colpickSetColor function.
			if(!bySetColor) $(el).val(hex);
		}
	}).keyup(function(){
		$(this).colpickSetColor(this.value);
	});
});
</script>

<?php echo $this->BcForm->input('AdminColorSwitch.id', array('type' => 'hidden')) ?>
<table cellpadding="0" cellspacing="0" id="AdminColorSwitchTable" class="form-table">
	<tr>
		<th class="col-head"><?php echo $this->BcForm->label('AdminColorSwitch.color_code', 'ツールバーの色') ?></th>
		<td class="col-input">
			<?php echo $this->BcForm->input('AdminColorSwitch.color_code', array('type' => 'text', 'size' => 10)) ?>
			&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->BcForm->input('デフォルト色に戻す', array('type' => 'button', 'id' => 'AdminColorSwitchColorCodeReset')) ?>
			<?php echo $this->BcForm->error('AdminColorSwitch.color_code') ?>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $this->BcForm->input('AdminColorSwitch.flg_footer', array('type' => 'checkbox', 'label' => 'フッター色に適用する')) ?>
			<?php echo $this->BcForm->error('AdminColorSwitch.flg_footer') ?>
		</td>
	</tr>
