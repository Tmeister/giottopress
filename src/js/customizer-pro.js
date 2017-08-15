/* global wp */

(function (api) {
    api.sectionConstructor['giotto_up_sell'] = api.Section.extend({
        attachEvents: function () {
        },
        isContextuallyActive: function () {
            return true;
        }
    });
})(wp.customize);