## MyWebsite

Simple OctoberCMS plugin that helps with setting up and maintaining a website.

With this plugin, it will be super easy for customers to make such changes on the website like 
changing website logo, fav icons, location in map widget, social media links and much more.

Developers will appreciate a maintaince idea for generic templates provided to many companies. 

Plugin Currently Includes

- WebVariables component
- MyMap component
- CookieWarning component
- *... any idea what can we add?*

**WebVariables** component will provide a range of twig variables, defined in
settings, to use on the website and will generate meta tags where dropped. 

**MyMap** component will provide Google Map widget for selected location.
Requires Google API Console account.

**CookieWarning** should be implemented just after body tag of the layout - it 
will display Cookie Warning to new visitors.

We take a symbolic minimum fee of 5$ for this plugin, because we plan to develop it 
and include more widgets, depending on its popularity. 


### WebVariables


If you put it into layout without writing {% component "webvariables" %}, it will provide you with
twig variables listed below.

If you use {% component %} tag, you should do it in a head section of the website, as it generates
 meta tags automatically. You should override it with partial *webvariables/default.htm* in order to
  provide author meta tag manually.

For fav icon, you should upload an image of at least 144x144, 
so the WebVariables component could generate thumbs for favicon and apple touch icons.

The rest of the variables can be used in various ways, for example to generate social media icons:

```
{% if my_facebook %}
<a href="{{ link_facebook }}"><i class="fa fa-facebook"></i></a>
{% endif %}
{% if my_twitter %}
<a href="{{ link_twitter }}"><i class="fa fa-twitter"></i></a>
{% endif %}
```

Note, that social accounts have {{ my_network }} tag for the account name and {{ link_network }} for direct link.


### MyMap Component


Setting this component up requires Google API access, similarly to **Rainlab Google Analytics** plugin.

**Google API Console**

- Log in to [Google API Console](https://console.developers.google.com/) and create a new project or use an existing one.
- On the project page go to the *APIs & auth* > *APIs* section and enable *Google Maps Embed API* and *Google Static Maps API*. 
- Go to the *APIs & auth* -> *Credentials* section on the project page and click *Add Credentials* -> API Key.
- In a popup window, select *Browser Key*
- Put some friendly name and in the referrers input, put \*.yourdomain.com/\* and click *Create*
- Copy *Key* (mixed letters and digits string from the *API Keys* table) to your clipboard. 

**Backend**

- Go to **Settings** -> **MyWebsite** -> **MyMap**.
- In **Current location** field write your address like you would in Google Maps search.
- In **API key** field paste API key from your clipboard
- You can leave rest of the fields empty, or use them to customize the layout of the map.


### CookieWarning Component

Component dedicated to UE developers and customers. Provides nice cookie warning message. 
It should be put at the start of the body part of your layout.


### Translations


WebVariables model implements translatable feature, you should be able to select language in each setting field.

If you want to translate Cookie Warning, simply overwrite the component partial with partials/cookiewarning/default.htm 
and use translate plugin *Translate Messages* option in Settings.


### List of available twig variables


```
facebook
twitter
linkedin
googleplus
googleplus_alias
youtube
email
email2
email3
email4
email5
phone2
phone3
phone4
phone5
skype
phone
reddit
dribble
tumblr
tumblr_alias
link_facebook
link_twitter
link_phone
link_phone2
link_phone3
link_phone4
link_phone5
link_linkedin
link_email
link_email2
link_email3
link_email4
link_email5
link_youtube
link_dribble
link_reddit
link_googleplus
link_skype
link_tumblr
website_charset
website_title
website_description
website_keywords
website_favico
website_robots
website_revisit
website_domain
default_og_title
default_og_description
default_og_image
default_og_type
default_twitter_title
default_twitter_description
default_twitter_image
twitter_card
twitter_site
twitter_player
twitter_player_width
twitter_player_height
twitter_player_stream
twitter_player_stream_content_type
company_name
company_street
company_city
company_zip
company_country
company_vat
```

### Default Meta fields inserted with WebVariables component

```
<meta charset="{{ website_charset }}">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>{{ this.page.title }} | {{ website_title }}</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="{{ website_description }}" />
<meta name="keywords" content="{{ website_keywords }}" />
<meta name="author" content="" />

<link rel="shortcut icon" href="{{ website_icon.thumb(64,64) }}" type="image/png">
<link rel="apple-touch-icon" href="{{ website_icon.path }}" />
<link rel="apple-touch-icon" sizes="72x72" href="{{ website_icon.thumb(72,72) }}" />
<link rel="apple-touch-icon" sizes="114x114" href="{{ website_icon.thumb(114,114) }}" />
<link rel="apple-touch-icon" sizes="144x144" href="{{ website_icon.thumb(144,144) }}" />

<meta name="robots" content="{{ website_robots }}">
<meta name="revisit-after" content="{{ website_revisit }}">

<meta property="og:title" content="{{ this.page.title }} | {{ default_og_title }}">
<meta property="og:description" content="{{ default_og_description }}">
<meta property="og:image" content="{{ default_og_image }}">
<meta property="og:url" content="{{ website_domain }}" />
<meta property="og:type" content="{{ default_og_type }}">
<meta property="og:site_name" content="{{ website_title }}">

<meta name="twitter:title" content="{{ this.page.title }} | {{ default_twitter_title }}">
<meta name="twitter:description" content="{{ default_twitter_description }}">
<meta name="twitter:image" content="{{ default_twitter_image }}">
<meta name="twitter:card" content="{{ twitter_card }}">
<meta name="twitter:site" content="@{{ twitter_site }}">
<meta name="twitter:creator" content="">

```

### ToDo:

- Customizable options for CookieWarning component.