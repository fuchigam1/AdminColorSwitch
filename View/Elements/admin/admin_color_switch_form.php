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
	var options = {
		/* デフォルトカラー */
		defaultColor: '333333'
	};
	
	/**
	 * 画面を開いた際にカラーコード色を入力欄のボーダーに適用する
	 */
	$(".color-picker").each(function() {
		if ($(this).val()) {
			$(this).css('border-color', '#'+ $(this).val());
		}
	});

	/**
	 * ツールバーの色指定欄にデフォルト色の値を入れる
	 */
	$("#AdminColorSwitchColorCodeReset").on('click', function(){
		if (confirm('デフォルト色 #' +options.defaultColor+ ' に設定します。よろしいですか？')) {
			$("#AdminColorSwitchColorCode").val(options.defaultColor);
			$("#AdminColorSwitchColorCode").css('border-color', '#'+ options.defaultColor);
			changeColor('ToolBar', options.defaultColor);
			changeColor('FooterInner', options.defaultColor);
		}
		return false;
	});

	/**
	 * フッター色適用チェックボックスのON・OFFを反映する
	 */
	$("#AdminColorSwitchFlgFooter").on('click', function() {
		if ($(this).prop('checked')) {
			color = $("#AdminColorSwitchColorCode").val();
			changeColor('FooterInner', color);
		} else {
			changeColor('FooterInner', options.defaultColor);
		}
	});

	/**
	 * カラーピッカーを起動してツールバーの色を指定する
	 */
	$("#AdminColorSwitchColorCode").colpick({
		onChange:function(hsb,hex,rgb,el,bySetColor) {
			$(el).css('border-color', '#'+ hex);
			/* Fill the text box just if the color was set using the picker, and not the colpickSetColor function. */
			if(!bySetColor) $(el).val(hex);
			changeColor('ToolBar', hex);
			if ($("#AdminColorSwitchFlgFooter").prop('checked')) {
				changeColor('FooterInner', hex);
			}
		},
		onSubmit:function(hsb,hex,rgb,el) {
			$(el).css('border-color', '#'+ hex);
			$(el).colpickHide();
			changeColor('ToolBar', hex);
		}
	}).keyup(function(){
		$(this).colpickSetColor(this.value);
	});

	/**
	 * 指定id背景色を指定colorに変更する
	 * 
	 * @param {string} id
	 * @param {string} color
	 */
	function changeColor(id, color) {
		if (color) {
			$("#"+ id).css('background-color', '#'+ color);
		}
	}
});
</script>

<?php echo $this->BcForm->input('AdminColorSwitch.id', array('type' => 'hidden')) ?>
<table cellpadding="0" cellspacing="0" id="AdminColorSwitchTable" class="form-table">
	<tr>
		<th class="col-head"><?php echo $this->BcForm->label('AdminColorSwitch.color_code', 'ツールバーの色') ?></th>
		<td class="col-input">
			<?php echo $this->BcForm->input('AdminColorSwitch.color_code', array('type' => 'text', 'size' => 10, 'class' => 'color-picker')) ?>
			&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->BcForm->input('デフォルト色に戻す', array('type' => 'button', 'id' => 'AdminColorSwitchColorCodeReset')) ?>
			<?php echo $this->BcForm->error('AdminColorSwitch.color_code') ?>
			&nbsp;&nbsp;&nbsp;&nbsp;
			<?php echo $this->BcForm->input('AdminColorSwitch.flg_footer', array('type' => 'checkbox', 'label' => 'フッター色に適用する')) ?>
			<?php echo $this->BcForm->error('AdminColorSwitch.flg_footer') ?>
		</td>
	</tr>
