<?php
/**
 * Copyright (c) 2016 Planeta del Este .
 *
 * Button.php is part of PlanetaDelEste.Widgets.
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

class Button extends FormWidgetBase
{
    //
    // Configurable properties
    //

    /**
     * @var string Css class (http://octobercms.com/docs/ui/button)
     */
    public $css = 'btn-default';

    /**
     * @var string Add icon inside (http://octobercms.com/docs/ui/icon)
     */
    public $icon = '';

    /**
     * @var array Any data attributes (like data-request)
     */
    public $dataAttr = [];

    /**
     * @var string Label of button
     */
    public $text = '';

    /**
     * @var bool Add a container with class loading-indicator-container
     */
    public $loadingIndicator = false;

    //
    // Object properties
    //

    /**
     * {@inheritDoc}
     */
    protected $defaultAlias = 'button';


    /**
     * {@inheritDoc}
     */
    public function init()
    {
        $this->fillFromConfig(
            [
                'css',
                'icon',
                'dataAttr',
                'text',
                'loadingIndicator'
            ]
        );
    }

    /**
     * {@inheritDoc}
     */
    public function render()
    {
        $this->prepareVars();

        return $this->makePartial('button');
    }

    /**
     * Prepares the form widget view data
     */
    public function prepareVars()
    {
        $this->vars['name'] = $this->formField->getName();
        $this->vars['value'] = $this->getLoadValue();
        $this->vars['model'] = $this->model;
        $this->vars['css'] = $this->css ?: 'btn-default';
        $this->vars['icon'] = $this->icon;
        $this->vars['dataAttr'] = $this->dataAttr ?: [];
        $this->vars['text'] = $this->text ?: 'Misc';
        $this->vars['loadingIndicator'] = (bool)$this->loadingIndicator ?: false;
    }

    public function getFieldAttributes()
    {
        $result = [];
        if (is_array($this->dataAttr) && count($this->dataAttr)) {
            $request = array_get($this->dataAttr, 'model-request');
            if($request) {
                $data = array_get($this->dataAttr, 'request-data', '') . ', handlerRequest: \'' . e($request) . '\'';
                $this->dataAttr['request'] = $this->getEventHandler('onRequest');
                $this->dataAttr['request-data'] = ltrim($data, ', ');
            }
            foreach ($this->dataAttr as $key => $value) {
                $result['data-'.$key] = $value;
            }
        }

        return Html::attributes($result);
    }

    /**
     * {@inheritDoc}
     */
    public function getSaveValue($value)
    {
        return FormField::NO_SAVE_DATA;
    }

    public function onRequest()
    {
        $handle = post('handlerRequest');
        if($handle) {
            if(method_exists($this->model, 'methodExists')) {
                if($this->model->methodExists($handle)) {
                    return call_user_func_array([$this->model, $handle], [$this->controller]);
                }
            } else if(method_exists($this->model, $handle)) {
                return call_user_func_array([$this->model, $handle], [$this->controller]);
            }
        }
    }

}