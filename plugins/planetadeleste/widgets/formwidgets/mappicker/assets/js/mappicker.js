/*
 * Copyright (c) 2016 Planeta del Este .
 *
 * mappicker.js is part of PlanetaDelEste.Widgets.
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

/*
 * Map Picker and location autocomplete plugin
 *
 * Based on https://github.com/october-widgets/address
 *
 * Data attributes:
 * - data-control="mappicker" - enables the plugin on an element
 * - data-input-location="#inputLocation" - input to populate with location street
 * - data-input-city="#locationCity" - input to populate with city
 * - data-input-zip="#locationZip" - input to populate with zip
 * - data-input-state="#locationState" - input to populate with state
 * - data-input-country="#locationCountry" - input to populate with country
 * - data-input-country-long="#locationCountry" - input to populate with country (long name)
 * - data-input-latitude="#locationLatitude" - input to populate with latitude
 * - data-input-longitude="#locationLongitude" - input to populate with longitude
 * - data-input-placename="#locationPlaceName" - input to populate with building name
 * - data-input-placeaddress="#locationPlaceAddress" - input to populate with building address
 * - data-input-formataddress="#locationFormatAddress" - input to populate with formatted building address
 *
 * JavaScript API:
 * $('#addressMapPicker').mapPicker({ inputLocation: '#inputLocation' })
 *
 * Dependences:
 * - Google maps (http://maps.googleapis.com/maps/api/js?libraries=places&amp;sensor=false)
 * - JQuery Location Picker - https://github.com/Logicify/jquery-locationpicker-plugin
 *
 * Example markup:
 *
 <div
 type="text"
 class="form-control"
 data-control="mapPicker"
 data-input-location="#inputStreet"
 data-input-city="#locationCity"
 data-input-state="#locationState"
 data-input-zip="#locationZip"
 data-input-country="#locationCountry"
 data-input-name="#locationName"
 data-input-address="#locationAddress"
 data-input-formataddress="#locationFormatAddress"
 ></div>

 <input type="text" name="street" value="" id="inputStreet" />
 <input type="text" name="city" value="" id="locationCity" />
 <input type="text" name="state" value="" id="locationState" />
 <input type="text" name="zip" value="" id="locationZip" />
 <input type="text" name="country" value="" id="locationCountry" />
 <input type="text" name="name" value="" id="locationName" />
 <input type="text" name="addr" value="" id="locationAddress" />
 <input type="text" name="fmtaddr" value="" id="locationFormatAddress" />
 *
 */

String.prototype.toCamelCase = function () {
    return this.replace(/^([A-Z])|[\s-_](\w)/g, function (match, p1, p2, offset) {
        if (p2) return p2.toUpperCase();
        return p1.toLowerCase();
    });
};

+function ($, map) {
    "use strict";

    // LOCATION AUTOCOMPLETE CLASS DEFINITION
    // ============================

    var MapPicker = function (element, options) {
        this.options = options;
        this.$el = $(element);

        // Init
        this.init()
    };

    MapPicker.DEFAULTS = {
        inputRadius: null,
        inputLatitude: null,
        inputLongitude: null,
        inputLocation: null,
        inputCity: null,
        inputZip: null,
        inputState: null,
        inputCountry: null,
        inputCountryLong: null,
        inputName: null,
        inputAddress: null,
        inputFormatAddress: null,
        autocomplete: true,
        radius: 300
    };

    MapPicker.address_components = [];

    MapPicker.prototype.init = function () {

        var self = this;
        if (this.$el.parents('.tab-pane:first').length) {
            var tabid = '#' + this.$el.parents('.tab-pane:first').attr('id');
            $('a[data-target="' + tabid + '"]').on('shown.bs.tab', function (e) {
                self.render();
            })
        } else {
            this.render();
        }
    };

    MapPicker.prototype.render = function () {
        if (this.$el.data('locationpicker'))
            return this;

        this.$el.locationpicker({
            location: this.locationBinding(),
            radius: $(this.options.inputRadius).length ? $(this.options.inputRadius).val() : this.options.radius,
            enableAutocomplete: $.type(this.options.autocomplete) == 'boolean' ? this.options.autocomplete : true,
            inputBinding: this.inputBinding(),
            onchanged: $.proxy(this.changed, this),
            oninitialized: $.proxy(this.initialized, this)
        });

        return this;
    };

    MapPicker.prototype.changed = function () {

        this.updateControls(this.$el.locationpicker('map').location);
    };

    MapPicker.prototype.initialized = function (component) {
        this.getTypes().addIcon();
        //this.updateControls($(component).locationpicker('map').location);
    };

    MapPicker.prototype.addIcon = function () {
        var $locationField = $(this.getElement('location'));
        if ($locationField.length) {
            var $locationGroup = $locationField.parent();
            if (!$locationGroup.hasClass('has-feedback')) {
                $locationGroup.addClass('has-feedback');
                $locationGroup.append(
                    $('<span class="icon-google form-control-feedback" aria-hidden="true" />')
                        .css({color: '#4285F4'})
                );
            }
        }
    };

    MapPicker.prototype.updateControls = function (location) {
        var addressComponents = location.addressComponents;

        $(this.getElement('location')).val(location.formattedAddress);
        $(this.getElement('city')).val(addressComponents.city);
        $(this.getElement('state')).val(addressComponents.stateOrProvince);
        $(this.getElement('zip')).val(addressComponents.postalCode);
        $(this.getElement('countryLong')).val(this.getType('country', 'long_name'));

        var $country = $(this.getElement('country'));
        if ($country.length) {
            if ($country.is('select')) {
                var value = $country.find('option:contains("' + this.getType('country', 'long_name') + '")').val();
                $country.val(value).trigger('change');
            } else {
                $country.val(addressComponents.country);
            }
        }
    };

    MapPicker.prototype.getTypes = function () {
        var gMapContext = this.$el.data('locationpicker'),
            self = this;

        gMapContext.geodecoder.geocode({
            latLng: gMapContext.location
        }, function (results, status) {
            if (status == google.maps.GeocoderStatus.OK && results.length > 0) {
                self.address_components = results[0].address_components;
            }
        });

        return this;
    };

    MapPicker.prototype.getType = function (name, key) {
        var result = null;
        if ($.isArray(this.address_components)) {
            for (var i = this.address_components.length - 1; i >= 0; i--) {
                var component = this.address_components[i];
                if (component.types.indexOf(name) >= 0) {
                    result = (key) ? component[key] : component;
                }
            }
        }
        return result;
    };

    MapPicker.prototype.getElement = function (inputName) {
        var name = ('input_' + inputName).toCamelCase();
        var el = $(this.options[name]);
        if (!el.length)
            return null;

        return el;
    };

    /**
     *
     * @returns {{}}
     */
    MapPicker.prototype.inputBinding = function () {
        return {
            locationNameInput: this.getElement('location'),
            latitudeInput: this.getElement('latitude'),
            longitudeInput: this.getElement('longitude'),
            radiusInput: this.getElement('radius')
        };
    };

    MapPicker.prototype.locationBinding = function () {
        var $lat = this.getElement('latitude'),
            $lng = this.getElement('longitude');

        return ($lat.val() && $lng.val()) ? {
            latitude: $lat.val(),
            longitude: $lng.val()
        } : { latitude: null, longitude: null }; // $.fn.locationpicker.defaults.location;
    };


    // LOCATION AUTOCOMPLETE PLUGIN DEFINITION
    // ============================

    var old = $.fn.mapPicker;

    $.fn.mapPicker = function (option) {
        var args = Array.prototype.slice.call(arguments, 1), result;
        this.each(function () {
            var $this = $(this);
            var data = $this.data('mapPicker');
            var options = $.extend({}, MapPicker.DEFAULTS, $this.data(), typeof option == 'object' && option);
            if (!data) $this.data('mapPicker', (data = new MapPicker(this, options)));
            if (typeof option == 'string') result = data[option].apply(data, args);
            if (typeof result != 'undefined') return false
        });

        return result ? result : this
    };

    $.fn.mapPicker.Constructor = MapPicker;

    // LOCATION AUTOCOMPLETE NO CONFLICT
    // =================

    $.fn.mapPicker.noConflict = function () {
        $.fn.mapPicker = old;
        return this
    };

    // LOCATION AUTOCOMPLETE DATA-API
    // ===============

    $(document).render(function () {
        $('[data-control="mappicker"]').mapPicker()
    })

}(window.jQuery, google.maps);