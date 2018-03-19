<?php namespace Keios\MyWebsite\Models;

use Cache;
use October\Rain\Database\Model;

/**
 * Class Settings
 *
 * @package Keios\MyWebsite\Models
 */
class Settings extends Model
{

    /**
     * @var array
     */
    public $implement = ['System.Behaviors.SettingsModel'];

    /**
     * @var array
     */
    protected $guarded = ['*'];

    /**
     * @var array
     */
    public $translatable =
        [
            'facebook',
            'twitter',
            'linkedin',
            'googleplus',
            'googleplus_alias',
            'youtube',
            'email',
            'more_emails',
            'more_phones',
            'email2',
            'email3',
            'email4',
            'email5',
            'phone2',
            'phone3',
            'phone4',
            'phone5',
            'skype',
            'phone',
            'reddit',
            'dribble',
            'tumblr',
            'tumblr_alias',
            'website_title',
            'website_description',
            'website_keywords',
            'website_domain',
            'default_og_title',
            'default_og_description',
            'default_og_type',
            'default_twitter_title',
            'default_twitter_description',
            'twitter_card',
            'twitter_site',
            'company_name',
            'company_street',
            'company_city',
            'company_zip',
            'company_country',
            'company_vat',
            'default_tile_title',
            'default_tile_rss_feed',
        ];


    /**
     * @var array
     */

    protected $fillable =
        [
            'facebook',
            'twitter',
            'linkedin',
            'googleplus',
            'googleplus_alias',
            'youtube',
            'email',
            'more_emails',
            'more_phones',
            'email2',
            'email3',
            'email4',
            'email5',
            'phone2',
            'phone3',
            'phone4',
            'phone5',
            'skype',
            'phone',
            'reddit',
            'dribble',
            'tumblr',
            'tumblr_alias',
            'website_charset',
            'website_title',
            'website_description',
            'website_keywords',
            'website_favico',
            'website_robots',
            'website_revisit',
            'website_domain',
            'default_og_title',
            'default_og_description',
            'og_image',
            'default_og_type',
            'default_twitter_title',
            'default_twitter_description',
            'twitter_image',
            'twitter_card',
            'twitter_site',
            'twitter_player',
            'twitter_player_width',
            'twitter_player_height',
            'twitter_player_stream',
            'twitter_player_stream_content_type',
            'company_name',
            'company_street',
            'company_city',
            'company_zip',
            'company_country',
            'company_vat',
            'location',
            'google_key',
            'map_width',
            'map_height',
            'map_container_class',
            'map_style',
            'map_frameborder',
            'default_tile_title',
            'default_tile_rss_feed',
            'default_tile_background',
            'windows_image',
        ];

    /**
     * @var string
     */
    public $settingsCode = 'keios::mywebsite.settings';

    /**
     * @var array
     */
    public $attachOne = [
        'website_icon'             => ['System\Models\File'],
        'website_logo'             => ['System\Models\File'],
        'twitter_image'            => ['System\Models\File'],
        'og_image'                 => ['System\Models\File'],
        'windows_image'            => ['System\Models\File'],
        'windows_horizontal_image' => ['System\Models\File'],
    ];
    /**
     * @var string The database table used by the model.
     */
    public $settingsFields = 'fields.yaml';

    /**
     * Boot method
     */
    public static function boot()
    {
        // Call default functionality (required)
        parent::boot();

        // Check the translate plugin is installed
        if (!class_exists('RainLab\Translate\Behaviors\TranslatableModel')) {
            return;
        }

        // Extend the constructor of the model
        self::extend(
            function ($model) {

                // Implement the translatable behavior
                $model->implement[] = 'RainLab.Translate.Behaviors.TranslatableModel';

            }
        );
    }

    public function afterSave()
    {
        Cache::forget('mywebsite_settings');
    }

}
