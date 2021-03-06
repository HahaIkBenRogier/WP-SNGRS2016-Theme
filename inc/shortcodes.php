<?php

// BIRTHDAY
function sngrs_shortcode_birthday() {
	$d1 = new DateTime;
    $d2 = new DateTime('1998-03-15');
    $diff = $d2->diff($d1);
    return $diff->y;
}
add_shortcode( 'sngrs_birthday', 'sngrs_shortcode_birthday' );

// MAIL UNREAD
function sngrs_mail_unread_shortcode() {
    //sngrs_mail_unread_func();
    return get_option( 'sngrs_mail_unread' );
}
add_shortcode( 'sngrs_mail_unread', 'sngrs_mail_unread_shortcode' );

// MAIL ALL
function sngrs_mail_all_shortcode() {
    //sngrs_mail_all_func();
    return get_option( 'sngrs_mail_all' );
}
add_shortcode( 'sngrs_mail_all', 'sngrs_mail_all_shortcode' );

// WHATPULSE
function sngrs_whatpulse_shortcode( $atts , $content = null ) {
    //sngrs_whatpulse_func();
    if ($content === "clicks" || "keys" || "download" || "upload" ) {
        $Total = get_option( 'sngrs_whatpulse_'.$content );
        $daysAmount = get_option( 'sngrs_whatpulse_days');
        
        $zin1 = " muiskliks ";
        if ($content === "clicks") {
            $zin1 = " muiskliks ";
        } if ($content === "keys") {
            $zin1 = " toetsen ingedrukt ";
        } if ($content === "download") {
            $zin1 = " MB aan downloads ";
        } if ($content === "upload") {
            $zin1 = " MB aan uploads ";
        }
        
        $Hour = round($Total / ($daysAmount * 24), 0).$zin1."per uur";
        $Day = round($Total / ($daysAmount * 24), 0).$zin1."per dag";
        $Week = round($Total / ($daysAmount * 24), 0).$zin1."per week";
        $Month = round($Total / ($daysAmount * 24), 0).$zin1."per maand";
        
        /* return  "<script> 
                jQuery(document).ready(function() {
                    var array_".$content." = ['".$Hour."', '".$Day."', '".$Week."', '".$Month."'];
                    statWhatpulse(array_".$content.");
                });
                </script>
                <span class='stats ".$content."'>".$Day."</span>"; */
        
    }
}
add_shortcode( 'sngrs_whatpulse', 'sngrs_whatpulse_shortcode' );

// LASTFM - RECENT
function sngrs_lastfm_recent_diff($diff) {
    $calc = $diff / 60;
    $minute = round($calc,0);
    
    if ($minute < 60 ){
         $txt = "meer dan ".$minute." minuten geleden";
    }
    if ($minute > 60) {
        $hour = $minute / 60;
        $txt = "meer dan ".round($hour, 0)." uur geleden";
    } if ($minute > 1440) {
        $day = $minute / (60 * 24);
        $txt = "meer dan ".round($day, 0)." dag geleden";
    } if ($minute > 2880) {
        $day = $minute / (60 * 24);
        $txt = "meer dan ".round($day, 0)." dagen geleden";
    } if ($minute > 10080) {
        $week = $minute / (60 * 24 * 7);
        $txt = "meer dan ".round($week, 0)." week geleden";
    } if ($minute > 20160) {
        $week = $minute / (60 * 24 * 7);
        $txt = "meer dan ".round($week, 0)." weken geleden";
    } if ($minute > 43920) {
        $month = $minute / (60 * 24 * 30.5);
        $txt = "meer dan ".round($month, 0)." maand geleden";
    } if ($minute > 87840) {
        $month = $minute / (60 * 24 * 30.5);
        $txt = "meer dan ".round($month, 0)." maanden geleden";
    } if ($minute > 525600) {
        $year = $minute / (60 * 24 * 365);
        $txt = "meer dan ".round($year, 0)." jaar geleden";
    } if ($minute > 1051200) {
        $year = $minute / (60 * 24 * 365);
        $txt = "meer dan ".round($year, 0)." jaren geleden";
    }
    return $txt;
    
}
function sngrs_lastfm_recent_shortcode() {
    sngrs_lastfm_recent_function();
   /* $tentracks = get_option('sngrs_lastfm_recent');
    $script_array = "<script>var array_recent = ".$tentracks.";
                    console.log( array_recent )</script>";
    $hoi = json_decode($tentracks, true);
    $diff = time() - $hoi[0]['time'];
    $time = sngrs_lastfm_recent_diff($diff);
    
     $span_text = "<span class='stats recent'>".$time." naar <b>".$hoi[0]['title']."</b> van <b>".$hoi[0]['artist']."</b></span>";
    //$span_text = "<span class='stats recent'><b>".$hoi[0]['title']."</b> van <b>".$hoi[0]['artist']."</b> (".$time.")</span>";
    return $script_array.$span_text; */
    
}
add_shortcode( 'sngrs_lastfm_recent', 'sngrs_lastfm_recent_shortcode' );

// LASTFM - TOP ARTIST
function sngrs_lastfm_top_shortcode() {
    //sngrs_lastfm_top_function();
    $topartists = get_option('sngrs_lastfm_top');
    $script_array = "<script>var array_topartists = ".$topartists.";
                    console.log( array_topartists )</script>";
    $hoi = json_decode($topartists, true);
    
    $span_text = "<span class='stats topartist'><b>".$hoi[0]['count']."</b> keer naar <b>".$hoi[0]['artist']."</b> geluisterd.</span>";
    return $script_array.$span_text;
    
}
add_shortcode( 'sngrs_lastfm_top', 'sngrs_lastfm_top_shortcode' );

// WIDGET - SOCIAL NETWORKS
function sngrs_social_widget_shortcode() {
    return sngrs_social_widget_func();
}
add_shortcode( 'sngrs_social_widget', 'sngrs_social_widget_shortcode' );

?>