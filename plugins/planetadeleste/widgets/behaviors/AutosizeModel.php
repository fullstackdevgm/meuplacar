<?php
/**
 * Copyright (c) 2016 Planeta del Este .
 *
 * AutosizeModel.php is part of PlanetaDelEste.Widgets.
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

namespace PlanetaDelEste\Widgets\Behaviors;

use Image;
use PlanetaDelEste\Widgets\Models\Settings as WidgetSettings;
use System\Classes\ModelBehavior;

class AutosizeModel extends ModelBehavior
{
    /**
     * @var string Name of the relation, must be type of attachOne|attachMany
     */
    public $autosizeRelationDefault = 'images';

    protected $requiredProperties = ['autosizeRelation'];

    public function __construct($model)
    {
        parent::__construct($model);

        $this->model->bindEvent('model.afterSave', [$this, 'afterModelSave']);
        $this->model->bindEvent('model.beforeDelete', [$this, 'beforeModelDelete']);

        $this->model->bindEvent('model.beforeCreate', function() use ($model) {
            $attributes = $model->getAttributes();
            if(array_key_exists('autosizeRelation', $attributes)) {
                unset($attributes['autosizeRelation']);
                $model->attributes = $attributes;
            }
        });
    }

    public function afterModelSave()
    {
        if ($this->model->hasRelation($this->getRelationImage())) {
            $related = $this->model->{$this->getRelationImage()}();
            if ($related) {
                $sessionKey = post('_session_key');
                $images = $related->withDeferred($sessionKey)->get();
                if ($images->count()) {
                    $this->resizeImages($images);
                }
            }
        }
    }

    public function beforeModelDelete()
    {
        if ($this->model->hasRelation($this->getRelationImage())) {
            $images = $this->model->{$this->getRelationImage()};
            if ($images) {
                foreach ($images as $image) {
                    $image->delete();
                }
            };
        }
    }

    public function getAutosizeRelationAttribute()
    {
        return ($this->model->propertyExists('autosizeRelation')) ? $this->model->autosizeRelation : null;
    }

    public function setAutosizeRelationAttribute()
    {
        $this->model->attributes['autosizeRelation'] =  ($this->model->propertyExists('autosizeRelation')) ? $this->model->autosizeRelation : null;
    }

    public function getRelationImage()
    {
        return ($this->getAutosizeRelationAttribute()) ? $this->getAutosizeRelationAttribute() : $this->autosizeRelationDefault;
    }

    /**
     * @param null $images
     *
     * @return int|void
     */
    public function resizeImages($images = null)
    {

        if (is_null($images) && $this->model->hasRelation($this->getRelationImage())) {
            $images = $this->model->{$this->getRelationImage()}();
        }

        if (!$images || !count($images)) {
            return;
        }
        if (!$images->count()) {
            return;
        }

        $resized = 0;

        $max_image_width = WidgetSettings::get('max_image_width');
        $max_image_height = WidgetSettings::get('max_image_height');
        foreach ($images as $image) {
            /** @var \Intervention\Image\Image $img */
            $img = Image::make(base_path().$image->getPath());
            $imgHeight = $img->height();
            $imgWidth = $img->width();
            $width = null;
            $height = null;
            if ($imgWidth > $max_image_width || $imgHeight > $max_image_height) {
                if ($imgWidth >= $imgHeight && $imgWidth > $max_image_width) {
                    $width = $max_image_width;
                } else {
                    $height = $max_image_height;
                }

                $img->resize(
                    $width,
                    $height,
                    function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    }
                )->save();
                $resized++;
            }
        }

        return $resized;
    }

}