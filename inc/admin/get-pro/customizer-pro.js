'use strict';

/* global wp */

(
	function ( api ) {
		api.sectionConstructor['giottopress_up_sell'] = api.Section.extend( {
			attachEvents: function attachEvents() {
			},
			isContextuallyActive: function isContextuallyActive() {
				return true;
			}
		} );
	}
)( wp.customize );
