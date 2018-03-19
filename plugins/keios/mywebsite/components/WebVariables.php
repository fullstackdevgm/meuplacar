<?php namespace Keios\MyWebsite\Components;

use Cms\Classes\ComponentBase;
use Keios\MyWebsite\Models\Settings;
use Cache;

/**
 * Class WebVariables
 *
 * @package Keios\MyWebsite\Components
 */
class WebVariables extends ComponentBase
{

    /**
     * @return array
     */
    public function componentDetails()
    {
        return [
            'name'        => 'keios.mywebsite::lang.keys.myvariables',
            'description' => 'keios.mywebsite::lang.keys.myvariables_desc',
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
     * WebVariables onRun method
     */
    public function onRun()
    {
        $source = Settings::instance();

        if (!Cache::has('mywebsite_settings')) {
            $toCache = $this->cacheImagePaths($source);
            Cache::put('mywebsite_settings', $toCache, 118000);
        }

        $cachedSettings = Cache::get('mywebsite_settings');
        $websiteIcon = $cachedSettings[ 'website_icon' ];
        $websiteLogo = $cachedSettings[ 'website_logo' ];
        $ogImage = $cachedSettings[ 'og_image' ];
        $twitterImage = $cachedSettings[ 'twitter_image' ];
        $windowsImage = $cachedSettings[ 'windows_image' ];
        $windowsHorizontalImage = $cachedSettings[ 'windows_horizontal_image' ];

        $settings = $source->value;

        if (!is_array($settings)) {
            return;
        }

        if ($this->getSetting($source, 'facebook')) {
            $this->page[ 'my_facebook' ] = $this->getSetting($source, 'facebook');
            $this->page[ 'link_facebook' ] = 'https://facebook.com/'.$this->getSetting($source, 'facebook');
        }
        if ($this->getSetting($source, 'twitter')) {
            $this->page[ 'my_twitter' ] = $this->getSetting($source, 'twitter');
            $this->page[ 'link_twitter' ] = 'https://twitter.com/'.$this->getSetting($source, 'twitter');
        }
        if ($this->getSetting($source, 'phone')) {
            $this->page[ 'my_phone' ] = $this->getSetting($source, 'phone');
            $this->page[ 'link_phone' ] = 'phone:'.$this->getSetting($source, 'phone');
        }
        if ($this->getSetting($source, 'phone2')) {
            $this->page[ 'my_phone2' ] = $this->getSetting($source, 'phone2');
            $this->page[ 'link_phone2' ] = 'phone:'.$this->getSetting($source, 'phone2');
        }
        if ($this->getSetting($source, 'phone')) {
            $this->page[ 'my_phone3' ] = $this->getSetting($source, 'phone3');
            $this->page[ 'link_phone3' ] = 'phone:'.$this->getSetting($source, 'phone3');
        }
        if ($this->getSetting($source, 'phone')) {
            $this->page[ 'my_phone4' ] = $this->getSetting($source, 'phone4');
            $this->page[ 'link_phone4' ] = 'phone:'.$this->getSetting($source, 'phone4');
        }
        if ($this->getSetting($source, 'phone5')) {
            $this->page[ 'my_phone5' ] = $this->getSetting($source, 'phone5');
            $this->page[ 'link_phone5' ] = 'phone:'.$this->getSetting($source, 'phone5');
        }
        if ($this->getSetting($source, 'linkedin')) {
            $this->page[ 'my_linkedin' ] = $this->getSetting($source, 'linkedin');
            $this->page[ 'link_linkedin' ] = 'http://linkedin.com/in/'.$this->getSetting($source, 'linkedin');
        }
        if ($this->getSetting($source, 'email')) {
            $this->page[ 'my_email' ] = $this->getSetting($source, 'email');
            $this->page[ 'link_email' ] = 'mailto:'.$this->getSetting($source, 'email');
        }
        if ($this->getSetting($source, 'email2')) {
            $this->page[ 'my_email2' ] = $this->getSetting($source, 'email2');
            $this->page[ 'link_email2' ] = 'mailto:'.$this->getSetting($source, 'email2');
        }
        if ($this->getSetting($source, 'email3')) {
            $this->page[ 'my_email3' ] = $this->getSetting($source, 'email3');
            $this->page[ 'link_email3' ] = 'mailto:'.$this->getSetting($source, 'email3');
        }
        if ($this->getSetting($source, 'email4')) {
            $this->page[ 'my_email4' ] = $this->getSetting($source, 'email4');
            $this->page[ 'link_email4' ] = 'mailto:'.$this->getSetting($source, 'email4');
        }
        if ($this->getSetting($source, 'email5')) {
            $this->page[ 'my_email5' ] = $this->getSetting($source, 'email5');
            $this->page[ 'link_email5' ] = 'mailto:'.$this->getSetting($source, 'email5');
        }
        if ($this->getSetting($source, 'youtube')) {
            $this->page[ 'my_youtube' ] = $this->getSetting($source, 'youtube');
            $this->page[ 'link_youtube' ] = 'https://youtube.com/user/'.$this->getSetting($source, 'youtube');
        }
        if ($this->getSetting($source, 'dribble')) {
            $this->page[ 'my_dribble' ] = $this->getSetting($source, 'dribble');
            $this->page[ 'link_dribble' ] = 'http:/dribble.com/'.$this->getSetting($source, 'dribble');
        }
        if ($this->getSetting($source, 'reddit')) {
            $this->page[ 'my_reddit' ] = $this->getSetting($source, 'reddit');
            $this->page[ 'link_reddit' ] = 'http://reddit.com/user/'.$this->getSetting($source, 'reddit');
        }
        if ($this->getSetting($source, 'googleplus')) {
            $this->page[ 'my_googleplus' ] = $this->getSetting($source, 'googleplus');
            $this->page[ 'link_googleplus' ] = 'https://plus.google.com/'.$this->getSetting($source, 'googleplus');
        }
        if ($this->getSetting($source, 'skype')) {
            $this->page[ 'my_skype' ] = $this->getSetting($source, 'skype');
            $this->page[ 'link_skype' ] = 'skype:'.$this->getSetting($source, 'skype');
        }
        if ($this->getSetting($source, 'tumblr')) {
            $this->page[ 'my_tumblr' ] = $this->getSetting($source, 'tumblr');
            $this->page[ 'link_tumblr' ] = $this->getSetting($source, 'tumblr');
        }
        if ($this->getSetting($source, 'website_charset')) {
            $this->page[ 'website_charset' ] = $this->getSetting($source, 'website_charset');
        }
        if ($this->getSetting($source, 'website_title')) {
            $this->page[ 'website_title' ] = $this->getSetting($source, 'website_title');
        }
        if ($this->getSetting($source, 'website_description')) {
            $this->page[ 'website_description' ] = $this->getSetting($source, 'website_description');
        }
        if ($this->getSetting($source, 'website_keywords')) {
            $this->page[ 'website_keywords' ] = $this->getSetting($source, 'website_keywords');
        }

        if ($websiteIcon) {
            $this->page[ 'website_icon' ] = $websiteIcon;
        }
        if ($websiteLogo) {
            $this->page[ 'website_logo' ] = $websiteLogo;
        }
        if ($this->getSetting($source, 'website_robots')) {
            $this->page[ 'website_robots' ] = $this->getSetting($source, 'website_robots');
        }
        if ($this->getSetting($source, 'website_revisit')) {
            $this->page[ 'website_revisit' ] = $this->getSetting($source, 'website_revisit');
        }
        if ($this->getSetting($source, 'website_domain')) {
            $this->page[ 'website_domain' ] = $this->getSetting($source, 'website_domain');
        }
        if ($this->getSetting($source, 'default_og_title')) {
            $this->page[ 'default_og_title' ] = $this->getSetting($source, 'default_og_title');
        }
        if ($this->getSetting($source, 'default_og_description')) {
            $this->page[ 'default_og_description' ] = $this->getSetting($source, 'default_og_description');
        }
        if ($ogImage) {
            $this->page[ 'default_og_image' ] = $ogImage;
        }
        if ($this->getSetting($source, 'default_og_type')) {
            $this->page[ 'default_og_type' ] = $this->getSetting($source, 'default_og_type');
        }
        if ($this->getSetting($source, 'default_twitter_title')) {
            $this->page[ 'default_twitter_title' ] = $this->getSetting($source, 'default_twitter_title');
        }
        if ($this->getSetting($source, 'default_twitter_description')) {
            $this->page[ 'default_twitter_description' ] = $this->getSetting($source, 'default_twitter_description');
        }
        if ($twitterImage) {
            $this->page[ 'default_twitter_image' ] = $twitterImage;
        }
        if ($this->getSetting($source, 'twitter_card')) {
            $this->page[ 'twitter_card' ] = $this->getSetting($source, 'twitter_card');
        }
        if ($this->getSetting($source, 'twitter')) {
            $this->page[ 'twitter_site' ] = $this->getSetting($source, 'twitter');
        }
        if ($this->getSetting($source, 'twitter_player')) {
            $this->page[ 'twitter_player' ] = $this->getSetting($source, 'twitter_player');
        }
        if ($this->getSetting($source, 'twitter_player_width')) {
            $this->page[ 'twitter_player_width' ] = $this->getSetting($source, 'twitter_player_width');
        }
        if ($this->getSetting($source, 'twitter_player_height')) {
            $this->page[ 'twitter_player_height' ] = $this->getSetting($source, 'twitter_player_height');
        }
        if ($this->getSetting($source, 'twitter_player_stream')) {
            $this->page[ 'twitter_player_stream' ] = $this->getSetting($source, 'twitter_player_stream');
        }
        if ($this->getSetting($source, 'twitter_player_stream_content_type')) {
            $this->page[ 'twitter_player_stream_content_type' ] = $this->getSetting(
                $source,
                'twitter_player_stream_content_type'
            );
        }
        if ($this->getSetting($source, 'company_name')) {
            $this->page[ 'company_name' ] = $this->getSetting($source, 'company_name');
        }
        if ($this->getSetting($source, 'company_street')) {
            $this->page[ 'company_street' ] = $this->getSetting($source, 'company_street');
        }
        if ($this->getSetting($source, 'company_zip')) {
            $this->page[ 'company_zip' ] = $this->getSetting($source, 'company_zip');
        }
        if ($this->getSetting($source, 'company_city')) {
            $this->page[ 'company_city' ] = $this->getSetting($source, 'company_city');
        }
        if ($this->getSetting($source, 'company_country')) {
            $this->page[ 'company_country' ] = $this->getSetting($source, 'company_country');
        }
        if ($this->getSetting($source, 'company_vat')) {
            $this->page[ 'company_vat' ] = $this->getSetting($source, 'company_vat');
        }

        if ($this->getSetting($source, 'default_tile_title')) {
            $this->page[ 'default_tile_title' ] = $this->getSetting($source, 'default_tile_title');
        }
        if ($this->getSetting($source, 'default_tile_background')) {
            $this->page[ 'default_tile_background' ] = $this->getSetting($source, 'default_tile_background');
        }
        if ($this->getSetting($source, 'default_tile_rss_feed')) {
            $this->page[ 'default_tile_rss_feed' ] = $this->getSetting($source, 'default_tile_rss_feed');
        }
        if ($windowsImage) {
            $this->page[ 'windows_image' ] = $windowsImage;
        }
        if ($windowsHorizontalImage) {
            $this->page[ 'windows_horizontal_image' ] = $windowsHorizontalImage;
        }

        $url = $this->page->url;
        $params = $this->controller->vars[ 'this' ][ 'param' ];

        foreach ($params as $key => $value) {
            if (str_replace(':', '', $value) == $key) {
                $url = str_replace('?', '', str_replace($value, '', $url));
            } else {
                $url = str_replace('?', '', str_replace(':'.$key, $value, $url));
            }
        }

        $this->page[ 'page_raw_url' ] = $url;
    }

    /**
     * @param object $source
     * @param string $param
     *
     * @return mixed
     */
    private function getSetting($source, $param)
    {
        $source->initTranslatableContext();

        return $source->getTranslateAttribute($param);
    }

    /**
     * @param object $source
     *
     * @return array
     */
    public function cacheImagePaths($source)
    {
        $websiteIcon = $source->website_icon;
        $websiteLogo = $source->website_logo;
        $ogImage = $source->og_image;
        $twitterImage = $source->twitter_image;
        $windowsImage = $source->windows_image;
        $windowsHorizontalImage = $source->windows_horizontal_image;
        $toCache = [
            'website_icon'             => $websiteIcon,
            'website_logo'             => $websiteLogo,
            'og_image'                 => $ogImage,
            'twitter_image'            => $twitterImage,
            'windows_image'            => $windowsImage,
            'windows_horizontal_image' => $windowsHorizontalImage,
        ];

        return $toCache;
    }
}