<?php
/**
 * Copyright (c) 2016 Planeta del Este .
 *
 * MapPicker.php is part of PlanetaDelEste.Widgets.
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

namespace PlanetaDelEste\Widgets\FormWidgets;

use Backend\Classes\FormField;
use Backend\Classes\FormWidgetBase;
use Html;

/**
 * MapPicker Form Widget
 */
class MapPicker extends FormWidgetBase
{

    /**
     * {@inheritDoc}
     */
    protected $defaultAlias = 'mappicker';

    protected $fieldMap;

    /**
     * {@inheritDoc}
     */
    public function init()
    {
        $this->fieldMap = $this->getConfig('fieldMap', []);
    }

    /**
     * {@inheritDoc}
     */
    public function render()
    {
        $this->prepareVars();
        return $this->makePartial('mappicker');
    }

    /**
     * Prepares the form widget view data
     */
    public function prepareVars()
    {
        $this->vars['name'] = $this->formField->getName();
        $this->vars['value'] = $this->getLoadValue();
        $this->vars['model'] = $this->model;
    }

    public function getFieldMapAttributes()
    {
        $widget = $this->controller->formGetWidget();
        $fields = $widget->getFields();
        $result = [];
        foreach ($this->fieldMap as $map => $fieldName) {

            if (!$field = array_get($fields, $fieldName))
                continue;

            $result['data-input-'.$map] = '#'.$field->getId();
        }

        if(!$this->hasLocationField()) {
            $result['data-input-location'] = '#' . $this->getId('location');
        }

        return Html::attributes($result);
    }

    /**
     * @return bool
     */
    public function hasLocationField()
    {
        return array_key_exists('location', $this->fieldMap);
    }

    /**
     * {@inheritDoc}
     */
    public function loadAssets()
    {
        $this->addCss('css/mappicker.css', 'PlanetaDelEste.Widgets');
        $this->addJs('http://maps.google.com/maps/api/js?libraries=places');
        $this->addJs('vendor/jquery-locationpicker/locationpicker.jquery.js', 'PlanetaDelEste.Widgets');
        $this->addJs('js/mappicker.js', 'PlanetaDelEste.Widgets');
    }

    /**
     * {@inheritDoc}
     */
    public function getSaveValue($value)
    {
        return FormField::NO_SAVE_DATA;
    }

}
