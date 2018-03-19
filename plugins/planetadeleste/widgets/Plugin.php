<?php
/**
 * Copyright (c) 2016 Planeta del Este .
 *
 * Plugin.php is part of PlanetaDelEste.Widgets.
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

namespace PlanetaDelEste\Widgets;

use App;
use Illuminate\Foundation\AliasLoader;
use PlanetaDelEste\Widgets\Models\Settings;
use Terbilang;
use System\Classes\PluginBase;

/**
 * Widgets Plugin Information File
 */
class Plugin extends PluginBase
{

    /**
     * Returns information about this plugin.
     *
     * @return array
     */
    public function pluginDetails()
    {
        return [
            'name'        => 'planetadeleste.widgets::lang.plugin.name',
            'description' => 'planetadeleste.widgets::lang.plugin.description',
            'author'      => 'PlanetaDelEste',
            'icon'        => 'icon-cubes'
        ];
    }

    public function registerSettings()
    {
        return [
            'settings' => [
                'label'       => 'planetadeleste.widgets::lang.plugin.name',
                'description' => 'planetadeleste.widgets::lang.plugin.description',
                'permissions' => ['planetadeleste.widgets.*'],
                'category'    => 'planetadeleste.widgets::lang.plugin.name',
                'icon'        => 'icon-cubes',
                'class'       => 'PlanetaDelEste\Widgets\Models\Settings',
                'order'       => 100,
            ],
        ];
    }

    public function registerFormWidgets()
    {
        return [
            'PlanetaDelEste\Widgets\FormWidgets\MapPicker' => [
                'label' => trans('planetadeleste.widgets::lang.widget.mappicker.name'),
                'code'  => 'mappicker'
            ],
            'PlanetaDelEste\Widgets\FormWidgets\Button'    => [
                'label' => trans('planetadeleste.widgets::lang.widget.button.name'),
                'code'  => 'button'
            ],
        ];
    }

    /**
     * Register new Twig variables
     * @return array
     */
    public function registerMarkupTags()
    {
        return [
            'filters' => [
                'numberToWord' => [$this, 'numberToWord'],
            ]
        ];
    }

    public function boot()
    {
        App::register('\Intervention\Image\ImageServiceProvider');
        App::register('\Riskihajar\Terbilang\TerbilangL5ServiceProvider');

        $alias = AliasLoader::getInstance();
        $alias->alias('Image', '\Intervention\Image\Facades\Image');
        $alias->alias('Terbilang', '\Riskihajar\Terbilang\Facades\Terbilang');

        if($models = Settings::get('models')) {
            foreach ($models as $modelClass) {
                $relation = array_get(config('planetadeleste.widgets::autosize.models'), $modelClass);
                if(!$relation)
                    continue;

                $model = new $modelClass;
                $model::extend(
                    function ($model) use ($relation) {
                        $autosizeImplement = '@PlanetaDelEste.Widgets.Behaviors.AutosizeModel';
                        $implements = $model->implement;
                        if(!is_array($implements))
                            $implements = [$implements];

                        if(!in_array($autosizeImplement, $implements)){
                            $model->addDynamicProperty('autosizeRelation', $relation);
                            $model->implement[] = $autosizeImplement;
                        }
                    }
                );
            }
        }
    }

    public function numberToWord($number, $suffix = false, $prefix = false)
    {
        return Terbilang::make($number);
    }

}
