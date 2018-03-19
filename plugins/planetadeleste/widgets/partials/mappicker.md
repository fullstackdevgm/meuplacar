### Map Picker FormWidget {#markdown-header-map-picker-formwidget}
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