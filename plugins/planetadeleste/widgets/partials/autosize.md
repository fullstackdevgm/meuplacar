### Autosize Model Behavior {#markdown-header-autosize-model-behavior}

Automatic resize uploaded images to pre configured max width/height.  
The use is very simple, just add this line to your model.

```php
    public $implement = [
        'PlanetaDelEste.Widgets.Behaviors.AutosizeModel'
    ];
    
    public $autosizeRelation = 'relation_name';
```

In this example, extend the model `RainLab\User\Models\User` and add this behavior dynamically.  
In your `Plugin.php` write this:

```php
    use RainLab\User\Models\User;
    
    class Plugin extends PluginBase
    {
        public function boot()
        {
            // Extend RainLab User model
            User::extend(
                function (User $model) {
                    $model->addDynamicProperty('autosizeRelation', 'avatar');
                    $model->implement[] = '@PlanetaDelEste.Widgets.Behaviors.AutosizeModel';
                }
            );
        }
    }
```

And after model is saved, all images will be resized.

> This plugin require [`intervention/image`](http://image.intervention.io/) library.