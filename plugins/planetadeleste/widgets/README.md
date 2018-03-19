# October CMS Widgets Plugin #

Reusable widgets for October CMS

### This plugin have Form Widgets and Behaviors

#### Form Widgets

* [Button](#markdown-header-button-formwidget)
* [MapPicker](#markdown-header-map-picker-formwidget)

#### Behaviors

* [AutosizeModel](#markdown-header-autosize-model-behavior)
* [ModalController](#markdown-header-modal-controller-behavior)

### Documentation

#### Button FormWidget
In your `fields.yaml` of your plugin, define the field type `button`.  
For official documentation go to [OctoberCMS Docs page](http://octobercms.com/docs/backend/forms#form-fields).

`button` - renders an html anchor element with `.btn` class.

    link_button:
        type: button
        text: Reload Items
        css: btn-default oc-icon-refresh
        loadingIndicator: true
        dataAttr:
            model-request: onReloadItems
            
|Option|Description|
|:-----|:----------|
|`text`| Button Label|
|`css` | Css class name (.btn is allways added). See [OC Button Docs](http://octobercms.com/docs/ui/button)|
|`loadingIndicator`|Render [loading indicator](http://octobercms.com/docs/ui/loader) when button is clicked|
|`dataAttr`|Array with format `key => value`. Each item will be rendered as `data-{KEY}="{VALUE}"` |

If the form widget is used to request ajax call, use the [documented](http://octobercms.com/docs/cms/ajax#data-attributes) data attributes, without the first `data-`.

    calculate_button
        type: button
        text: Calculate
        css: btn-primary oc-icon-calculator
        dataAttr:
            request: onCalculate
            request-update: "calcresult: '#result'"
            
If the form widget is used in Settings page, without a controller, the ajax request method must be in the model. In this case, use `model-request` instead of `request`.


#### Map Picker FormWidget
![MapPicker Screen](https://box.everhelper.me/attachment/400082/5e48bd50-beff-4239-af84-25fa63f6ba59/397815-LtFhqyTZwRn4vuwp/screen.png)

    mappicker:
        type: mappicker
        fieldMap:
            location: address
            latitude: lat
            longitude: lng
            city: city
            state: state
            country: country
            country-long: country_long

`fieldMap` options must be in format `key: value`, where `key` is the map data element, and `value` is the form field name, where set value on change address.   
The list of options:

- location
- latitude
- longitude
- city
- zip
- state
- country (can be a text field or options select)
- country-long

#### Autosize Model Behavior

Automatic resize uploaded images to pre configured max width/height.  
The use is very simple, just add this line to your model.

    public $implement = [
        'PlanetaDelEste.Widgets.Behaviors.AutosizeModel'
    ];
    
    public $autosizeRelation = 'relation_name';
    
In this example, extend the model `RainLab\User\Models\User` and add this behavior dynamically.  
In your `Plugin.php` write this:

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

And after model is saved, all images will be resized.  
This plugin require [`intervention/image`](http://image.intervention.io/) library.

#### Modal Controller Behavior
This behavior is used to load create/update forms in modal window, from the lists view

##### Usage
1) - In controller add `PlanetaDelEste.Widgets.Behaviors.ModalController` to the `$implement`var.

    public $implement = [
        'Backend.Behaviors.FormController',
        'Backend.Behaviors.ListController',
        'PlanetaDelEste.Widgets.Behaviors.ModalController',
    ];
    
2) - In `_list_toolbar.htm` add the attribute `onclick="return $.manageModal.createRecord()"` to the create new button

    <a
        href="<?= Backend::url('acme/foo/categories/create') ?>"
        onclick="return $.manageModal.createRecord()"
        class="btn btn-primary oc-icon-plus">
        <?= e(trans('acme.foo::lang.category.new')) ?>
    </a>
    
3) - From `config_list.yaml` comment the line `recordUrl: ...` and add `recordOnClick: $.manageModal.clickRecord(:id)`

```
    # ===================================
    #  List Behavior Config
    # ===================================
    
    # Link URL for each record
    recordOnClick: $.manageModal.clickRecord(:id)
```
![Modal Controller](https://box.everhelper.me/attachment/403855/5e48bd50-beff-4239-af84-25fa63f6ba59/397815-PadiTTvztWOGaA3x/screen.png)