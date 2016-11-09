<?php

function sngrs_social_widget_func() {
    $networks = array('whatsapp' => array (
                        'icon' => 'whatsapp',
                        'url' => array('06 43 62 56 65'),
                        'ios' => '',
                        'android' => '',
                        'alt' => 'WhatsApp'),
                      'facebook' => array (
                        'icon' => 'facebook',
                        'url' => 'https://www.facebook.com/RogierWasHier',
                        'ios' => '',
                        'android' => '',
                        'alt' => 'Facebook'),
                    'instagram' => array (
                        'icon' => 'instagram',
                        'url' => 'https://www.instagram.com/sngrs_com/',
                        'ios' => '',
                        'android' => '',
                        'alt' => 'Instagram'),
                    'snapchat' => array (
                        'icon' => 'snapchat-ghost',
                        'url' => array('rogier_rogier'),
                        'ios' => '',
                        'android' => '',
                        'alt' => 'Snapchat'),
                    'linkedin' => array (
                        'icon' => 'linkedin',
                        'url' => 'https://nl.linkedin.com/in/rogiersangers',
                        'ios' => '',
                        'android' => '',
                        'alt' => 'LinkedIn'),
                      'lastfm' => array (
                        'icon' => 'lastfm',
                        'url' => 'https://last.fm/user/rogiersangers',
                        'ios' => '',
                        'android' => '',
                        'alt' => 'LastFM '),
                    'flickr' => array (
                        'icon' => 'flickr',
                        'url' => 'https://www.flickr.com/photos/rogiersangers/',
                        'ios' => '',
                        'android' => '',
                        'alt' => 'Flickr'),
                     'spotify' => array (
                        'icon' => 'spotify',
                        'url' => 'https://open.spotify.com/user/sangerspotify2015',
                        'ios' => 'spotify:user:sangerspotify2015',
                        'android' => 'spotify:user:sangerspotify2015',
                        'alt' => 'Spotify'),
                    'googleplus' => array (
                        'icon' => 'google-plus-official',
                        'url' => 'https://plus.google.com/b/112406964076869424514/112406964076869424514',
                        'ios' => '',
                        'android' => '',
                        'alt' => 'Google+'),
                    'github' => array (
                        'icon' => 'github',
                        'url' => 'https://github.com/HahaIkBenRogier',
                        'ios' => '',
                        'android' => '',
                        'alt' => 'Github'),
                     'foursquare' => array (
                        'icon' => 'foursquare',
                        'url' => 'https://foursquare.com/rogier_s',
                        'ios' => '',
                        'android' => '',
                        'alt' => 'Foursquare'),
                    'youtube' => array (
                        'icon' => 'youtube',
                        'url' => 'https://www.youtube.com/channel/UC7R64RuiO_JPt0V-2WxNuVg',
                        'ios' => '',
                        'android' => '',
                        'alt' => 'Youtube'),
                    'soundcloud' => array (
                        'icon' => 'soundcloud',
                        'url' => 'https://soundcloud.com/jeboyrodjer',
                        'ios' => '',
                        'android' => '',
                        'alt' => 'Soundcloud'));
    
    $list = "";
    foreach($networks as $network){
        //print_r($network);
        //echo $network['icon'];
        
        if (is_array($network['url'])) {
            $url = "#";
        } else {
            $url = $network['url'];
        };
       $list .= "<a aria-hidden='true' class='fa fa-".$network['icon']."' alt='".$network['alt']."' href='".$url."'></a>"; 
    }
    return $list;
    
}

?>