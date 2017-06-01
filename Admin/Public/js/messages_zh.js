(function( factory ) {
	if ( typeof define === "function" && define.amd ) {
		define( ["jquery", "jquery.validate.min"], factory );
	} else {
		factory( jQuery );
	}
}(function( $ ) {

/*
 * Translated default messages for the jQuery validation plugin.
 * Locale: ZH (Chinese, 中文 (Zhōngwén), 汉语, 漢語)
 */
$.extend($.validator.messages, {
	required: "必填(选)项!",
	remote: "已使用.请修改!",
	email: "请输入正确的电子邮件地址!",
	url: "请输入有效的网址!",
	date: "请输入正确的日期!",
	dateISO: "请输入正确的日期格式 (年-月-日) !",
	number: "请输入有效的数字!",
	digits: "只能输入数字!",
	creditcard: "请输入有效的信用卡号码!",
	equalTo: "两次输入不相同,请重新确认!",
	extension: "请输入有效的后缀!",
	maxlength: $.validator.format("最多可以输入 {0} 位!"),
	minlength: $.validator.format("最少要输入 {0} 位"),
	rangelength: $.validator.format("范围在 {0} 到 {1} 位"),
	range: $.validator.format("请输入范围在 {0} 到 {1} 之间的数字"),
	max: $.validator.format("请输小于 {0} 的数字"),
	min: $.validator.format("请输大于 {0} 的数字")
});

}));