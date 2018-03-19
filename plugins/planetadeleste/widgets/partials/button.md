### Button FormWidget {#markdown-header-button-formwidget}
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
|`dataAttr`|Array with format `key: value`. Each item will be rendered as `data-{KEY}='{VALUE}'` |

If the form widget is used to request ajax call, use the [documented](http://octobercms.com/docs/cms/ajax#data-attributes) data attributes, without the first `data-`.

    calculate_button
        type: button
        text: Calculate
        css: btn-primary oc-icon-calculator
        dataAttr:
            request: onCalculate
            request-update: "calcresult: '#result'"
            
If the form widget is used in Settings page, without a controller, the ajax request method must be in the model. In this case, use `model-request` instead of `request`.