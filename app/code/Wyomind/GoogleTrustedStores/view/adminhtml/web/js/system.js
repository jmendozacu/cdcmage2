var badgeCode = null;
var orderCode = null;

GoogleTrustedStores = {
    testBadge: function (website_id, url_test) {
        var fieldset = jQuery('#googletrustedstores_gts');
        var data = {};
        fieldset.find('input,select,textarea').each(function () {
            data[jQuery(this).prop('id')] = jQuery(this).val();
        });
        data.website = website_id;
        data['product-sku'] = jQuery('#product-sku').val();

        jQuery.ajax({
            url: url_test,
            data: data,
            type: 'POST',
            showLoader: true,
            success: function (data) {
                badgeCode.setValue(data);
                jQuery('#GtsValidatorBadgeUrl').attr('href', jQuery('#GtsValidatorBadgeUrl').attr("base") + "id/" + jQuery('#product-sku').val());
                jQuery('#GtsValidatorBadgeUrl').text(jQuery('#GtsValidatorBadgeUrl').attr("base") + "id/" + jQuery('#product-sku').val());
            }
        });
    },
    testOrder: function (website_id, url_test) {
        var fieldset = jQuery('#googletrustedstores_gts');
        var data = {};
        fieldset.find('input,select,textarea').each(function () {
            data[jQuery(this).prop('id')] = jQuery(this).val();
        });
        fieldset = jQuery("#googletrustedstores_gts_orders");
        fieldset.find('input,select,textarea').each(function () {
            data[jQuery(this).prop('id')] = jQuery(this).val();
        });
        data.website = website_id;
        data['order-number'] = jQuery('#order-number').val();

        jQuery.ajax({
            url: url_test,
            data: data,
            type: 'POST',
            showLoader: true,
            success: function (data) {
                orderCode.setValue(data);
                jQuery('#GtsValidatorOrderUrl').attr('href', jQuery('#GtsValidatorOrderUrl').attr("base") + "id/" + jQuery('#order-number').val());
                jQuery('#GtsValidatorOrderUrl').text(jQuery('#GtsValidatorOrderUrl').attr("base") + "id/" + jQuery('#order-number').val());
            }
        });
    }

};

require([
    "jquery",
    "mage/mage"
], function ($) {
    $(function () {

        jQuery(document).ready(function () {

            if (document.getElementById('gts-badge-test-page')) {
                badgeCode = CodeMirror.fromTextArea(document.getElementById('gts-badge-test-page'), {
                    matchBrackets: true,
                    mode: "text/html",
                    readOnly: true,
                    indentUnit: 2,
                    indentWithTabs: false,
                    lineNumbers: true,
                    styleActiveLine: true
                });

                orderCode = CodeMirror.fromTextArea(document.getElementById('gts-badge-test-order'), {
                    matchBrackets: true,
                    mode: "text/html",
                    readOnly: true,
                    indentUnit: 2,
                    indentWithTabs: false,
                    lineNumbers: true,
                    styleActiveLine: true
                });
            }

        });

    });
});