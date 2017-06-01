/*var option = function () {
this.optionName;
this.optionValue;
};{name : '100 Square Feet',value : ''}*/
(function () {
	var relate = {};
	
	relate.getAutocompleteDLzId = function (selectorId) {
		return 'jgd_dd_' + selectorId;
	};
	
	relate.reSetSelect = function (id, nameValueArray) {
		var newHTML = '',
		i = 0,
		len = nameValueArray.length,
		tmpHTML;
		jQuery('#' + id).html('');
		for (;i < len; i++) {
			tmpHTML = "<option value='" + nameValueArray[i]['value'] + "'>" + nameValueArray[i]['name'] + "</option>";
			newHTML += tmpHTML;
		}
		jQuery('#' + id).html(newHTML);
	};
	
	relate.eventListener = function () {
		//清空
		//var dlId = relate.getAutocompleteDLzId(selectorId);
		//jQuery('#' + dlId).html('');
		//jQuery('#jgd_dd_area').html('');
		jQuery('#jgd_dd_area').remove();
		//充填
		var selectedValue = jQuery(this).find('span.value').text().replace(' ','_');
		var nameValueArray = relate.json_selectValue_map[selectedValue];
		relate.reSetSelect('area', nameValueArray);
		//重新生成
		jQuery('#area').jgdDropdown({
			clsLIExpand : false,
			clsLISelected : 'hide_selected',
			initTitle : 'How many Square Feet?'
		});
	};
	
	window.relate = relate;
})();
