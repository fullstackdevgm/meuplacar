<?php
/**
 * Copyright (c) 2016 Planeta del Este .
 *
 * lang.php is part of PlanetaDelEste.Widgets.
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

return [
    'plugin' => [
        'name'        => 'Widgets',
        'description' => 'Reusable widgets for OctoberCMS.',
    ],
    'widget' => [
        'mappicker' => [
            'name'        => 'Map Picker',
            'description' => 'Find and select a location on the Google map'
        ],
        'autosize'  => [
            'name'        => 'Autosize Model Behavior',
            'description' => 'Automatic resize uploaded images to pre configured max width/height.'
        ],
        'button'    => [
            'name'        => 'Button',
            'description' => 'Render a simple button with data attributes'
        ],
        'modal'    => [
            'name'        => 'Modal Controller',
            'description' => 'This behavior is used to load create/update forms in modal window, from the lists view'
        ],
        'numberToWord'    => [
            'name'        => 'Number to World Twig',
            'description' => 'Twig filter to convert any number into world'
        ],
        'settings'  => [
            'max_image_width'         => 'Maximum width of images',
            'max_image_height'        => 'Maximum height of images',
            'max_image_comment'       => 'Larger images will be resized',
            'autosize_models'         => 'Apply to models',
            'autosize_models_comment' => 'Auto apply autosize behavior to selected models',
            'documentation'           => 'Documentation',
        ]
    ]
];