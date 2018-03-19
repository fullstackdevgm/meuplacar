<?php namespace PlanetaDelEste\Widgets\Models;

use Lang;
use Model;
use System\Classes\PluginManager;

/**
 * Settings Model
 *
 * @property int id
 * @property int max_image_height
 * @property int max_image_width
 */
class Settings extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $implement = ['System.Behaviors.SettingsModel'];

    public $settingsCode = 'planetadeleste_widgets_settings';

    public $settingsFields = 'fields.yaml';

    /**
     * Validation rules
     */
    public $rules = [
        'max_image_width'  => 'integer',
        'max_image_height' => 'integer',
    ];

    public function initSettingsData()
    {
        $this->max_image_width = 1920;
        $this->max_image_height = 1080;

        if (!$this->id) {
            $this->save();
        }

    }

    public function getModelsOptions()
    {
        $options = [];
        $models = config('planetadeleste.widgets::autosize.models', []);
        if(count($models)) {
            $pluginManager = PluginManager::instance();
            foreach ($models as $model => $relation) {
                list($author, $plugin_name) = explode('\\', trim($model, '\\'));
                if($pluginManager->exists("{$author}.{$plugin_name}")) {
                    $className = $author.'\\'.$plugin_name.'\Plugin';
                    $plugin = new $className($this->app);
                    $name = Lang::get($plugin->pluginDetails()['name']);
                    $desc = Lang::get($plugin->pluginDetails()['description']);
                    $options[$model] = [$name, $desc];
                }
            }
        }
        return $options;
    }

}