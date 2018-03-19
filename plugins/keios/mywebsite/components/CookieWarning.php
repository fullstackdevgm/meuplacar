<?php namespace Keios\MyWebsite\Components;

use Cms\Classes\ComponentBase;

/**
 * Class CookieWarning
 *
 * @package Keios\Mywebsite\Components
 */
class CookieWarning extends ComponentBase
{

    /**
     * @return array
     */
    public function componentDetails()
    {
        return [
            'name'        => 'Cookie Warning',
            'description' => 'Displays EU Cookie Warning',
        ];
    }

    /**
     * @return array
     */
    public function defineProperties()
    {
        return [];
    }

    /**
     * Cookie Warning onRun Method
     */
    public function onRun()
    {
        $this->addJs('/plugins/keios/mywebsite/assets/js/cookie.js');
        $this->addCss('/plugins/keios/mywebsite/assets/css/cookie.css');

    }

}