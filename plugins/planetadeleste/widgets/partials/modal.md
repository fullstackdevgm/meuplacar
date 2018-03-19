### Modal Controller Behavior {#markdown-header-modal-controller-behavior}
This behavior is used to load create/update forms in modal window, from the lists view

#### Usage
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