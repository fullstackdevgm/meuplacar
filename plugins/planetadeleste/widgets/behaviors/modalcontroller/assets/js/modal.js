/*
 * Copyright (c) 2016 Planeta del Este .
 *
 * modal.js is part of PlanetaDelEste.Widgets.
 *
 *     PlanetaDelEste.Widgets is free software: you can redistribute it and/or modify
 *     it under the terms of the GNU General Public License as published by
 *     the Free Software Foundation, either version 3 of the License, or
 *     (at your option) any later version.
 *
 *     PlanetaDelEste.Widgets is distributed in the hope that it will be useful,
 *     but WITHOUT ANY WARRANTY; without even the implied warranty of
 *     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *     GNU General Public License for more details.
 *
 *     You should have received a copy of the GNU General Public License
 *     along with PlanetaDelEste.Widgets.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * Created by alvaro on 26/10/15.
 */
+function ($) {
    "use strict";

    var ManageModal = function () {

        this.clickRecord = function (recordId) {
            var newPopup = $('<a />');

            newPopup.popup({
                handler: 'onUpdateForm',
                extraData: {
                    'record_id': recordId,
                }
            })
        };

        this.createRecord = function () {
            var newPopup = $('<a />');
            newPopup.popup({ handler: 'onCreateForm' });

            return false;
        }

    };

    $.manageModal = new ManageModal;

}(window.jQuery);