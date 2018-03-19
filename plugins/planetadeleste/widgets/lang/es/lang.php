<?php
/**
 * Copyright (c) 2016 Alvaro Cánepa <info@planetadeleste.com>.
 * PaySlip by Alvaro Cánepa is licensed under a
 * Creative Commons Attribution-NoDerivatives 4.0 International License (https://creativecommons.org/licenses/by-nd/4.0/).
 * Based on a work at recibosya.uy.
 */

return [
    'plugin' => [
        'name'        => 'Widgets',
        'description' => 'Widgets reutilizables para OctoberCMS.',
    ],
    'widget' => [
        'mappicker' => [
            'name'        => 'Map Picker',
            'description' => 'Busca y selecciona una ubicación en el mapa de Google'
        ],
        'autosize'  => [
            'name'        => 'Autosize Model Behavior',
            'description' => 'Redimesiona de forma automática las imagenes subidas.'
        ],
        'button'    => [
            'name'        => 'Botón',
            'description' => 'Crea botones con atributos de datos'
        ],
        'modal'    => [
            'name'        => 'Controlador Modal',
            'description' => 'Este behavior es usado para mostrar las vistas de crear/actualizar en una ventana modal.'
        ],
        'numbertoword'    => [
            'name'        => 'Twig Número a Palabra',
            'description' => 'Filtro twig para convertir un número en palabra'
        ],

        'settings'  => [
            'max_image_width'         => 'Ancho máximo de imágenes',
            'max_image_height'        => 'Alto máximo de imágenes',
            'max_image_comment'       => 'La imágenes de mayor tamañp a lo establecido serán redimensionadas',
            'autosize_models'         => 'Aplicar a modelos',
            'autosize_models_comment' => 'Aplica Autosize Behavior a los modelos seleccionados',
            'documentation'           => 'Documentación'
        ]
    ]
];