<?php

// MAIL UNREAD
function sngrs_mail_unread_func( ) {
	$hosts = get_option('sngrs_mail_secure');
	
	    $unread = 0;
	    foreach($hosts as $host){
	        $inbox = imap_open($host['hostname'], $host['username'], $host['password']) or die('Cannot connect to '. key($host).': ' . imap_last_error());
	        $emails = imap_search($inbox,'UNSEEN');
	        $count = count($emails);
	        $unread+= $count;
	        imap_close($inbox);
	    }
    
   
	    update_option( 'sngrs_mail_unread', $unread );
	    
	    $ip = "sngrs_mail_unread ".time()."\n";
        file_put_contents(get_stylesheet_directory() . '/inc/log.txt', $ip, FILE_APPEND);
        echo "EIND!";
};

function sngrs_mail_unread_cron_recurrence( $schedules ) {
	$schedules[''] = array(
		'display' => __( '', 'textdomain' ),
		'interval' => 900,
	);
	return $schedules;
}
add_filter( 'cron_schedules', 'sngrs_mail_unread_cron_recurrence' );

function sngrs_mail_unread_cron() {
	if ( ! wp_next_scheduled( 'sngrs_mail_unread_func' ) ) {
		wp_schedule_event( current_time( 'timestamp' ), '', 'sngrs_mail_unread_func' );
	}
}
add_action( 'wp', 'sngrs_mail_unread_cron' );

// MAIL ALL
function sngrs_mail_all_func( ) {
	    $hosts = get_option('sngrs_mail_secure');
	
	    $all = 0;
	    foreach($hosts as $host){
	        $inbox = imap_open($host['hostname'], $host['username'], $host['password']) or die('Cannot connect to '. key($host).': ' . imap_last_error());
	        $emails = imap_search($inbox,'UNDELETED');
	        $count = count($emails);
	        $all+= $count;
	        imap_close($inbox);
	    }
	
	        update_option( 'sngrs_mail_all', $all );
	    
	    $ip = "sngrs_mail_all ".time()."\n";
        file_put_contents(get_stylesheet_directory() . '/inc/log.txt', $ip, FILE_APPEND);
};

function sngrs_mail_all_cron_recurrence( $schedules ) {
	$schedules[''] = array(
		'display' => __( '', 'textdomain' ),
		'interval' => 900,
	);
	return $schedules;
}

function sngrs_mail_all_cron() {
	if ( ! wp_next_scheduled( 'sngrs_mail_all_func' ) ) {
		wp_schedule_event( current_time( 'timestamp' ), '', 'sngrs_mail_all_func' );
	}
}
add_action( 'wp', 'sngrs_mail_all_cron' );

// WHATPULSE
function sngrs_whatpulse_func( ) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://api.whatpulse.org/user.php?user=haharogier&formatted=yes&format=json");
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $json_content = curl_exec($ch);
    curl_close($ch);
    $data = json_decode($json_content, true);

    $diff = time() - $data['DateJoinedUnixTimestamp'];

    $items = array("days" => floor($diff / (60 * 60 * 24)),
                  "clicks" => str_replace( ',', '', $data['Clicks'] ),
                  "keys" => str_replace( ',', '', $data['Keys'] ),
                   "download" => $data['DownloadMB'],
                   "upload" => $data['UploadMB']
                  );

    foreach($items as $key => $value){
            update_option( 'sngrs_whatpulse_'. $key, $value );
    }
    
    $ip = "sngrs_whatpulse ".time()."\n";
    file_put_contents(get_stylesheet_directory() . '/inc/log.txt', $ip, FILE_APPEND);
} ;

function sngrs_whatpulse_cron() {
	if ( ! wp_next_scheduled( 'sngrs_whatpulse_func' ) ) {
		wp_schedule_event( current_time( 'timestamp' ), 'daily', 'sngrs_whatpulse_func' );
	}
}
add_action( 'wp', 'sngrs_whatpulse_cron' );

// LASTFM - RECENT
// Scheduled Action Hook
function sngrs_lastfm_recent_function( ) {
	$api = get_option('sngrs_lastfm_secure');
		$ch = curl_init();
	    curl_setopt($ch, CURLOPT_URL, "http://ws.audioscrobbler.com/2.0/?method=user.getrecenttracks&user=rogiersangers&api_key=".$api."&format=json");
	    curl_setopt($ch, CURLOPT_HEADER, 0);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	    $json_content = curl_exec($ch);
	    curl_close($ch);
	    $data = json_decode($json_content, true);
	    $recent = $data['recenttracks']['track'];
	    print_r($recent);
	
	    /* $tentracks = array();
	    for ($tracks = 0; $tracks < 10; ++$tracks) {
	        $track = $recent[$tracks];
	        //print_r($track);
	        if (array_key_exists('date', $track)) {
	            $array = array('artist' => $track['artist']['#text'],
	                      'title' => $track['name'],
	                      'time' => $track['date']['uts']);
	            //print_r($array);
	            array_push($tentracks, $array);
	        } 
	    }
	
	    $tentracks = json_encode($tentracks);
	
	   update_option( 'sngrs_lastfm_recent', $tentracks ); */
	
	    $ip = "sngrs_lastfm_recent ".time()."\n";
	    file_put_contents(get_stylesheet_directory() . '/inc/log.txt', $ip, FILE_APPEND);
}

// Custom Cron Recurrences
function sngrs_lastfm_recent_cron_recurrence( $schedules ) {
	$schedules['2minutely'] = array(
		'display' => __( 'Elke 2 minuten', 'textdomain' ),
		'interval' => 120,
	);
	return $schedules;
}
add_filter( 'cron_schedules', 'sngrs_lastfm_recent_cron_recurrence' );

// Schedule Cron Job Event
function sngrs_lastfm_recent_cron() {
	if ( ! wp_next_scheduled( 'sngrs_lastfm_recent_function' ) ) {
		wp_schedule_event( current_time( 'timestamp' ), '2minutely', 'sngrs_lastfm_recent_function' );
	}
}
add_action( 'wp', 'sngrs_lastfm_recent_cron' );

// LASTFM TOP ARTISTS
function sngrs_lastfm_top_function( ) {
    //echo "HOI"; echo "HOI";echo "HOI";echo "HOI";echo "HOI";
    //trigger_error("Run!", E_USER_ERROR);
    $api = get_option('sngrs_lastfm_secure');
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "http://ws.audioscrobbler.com/2.0/?method=user.gettopartists&user=rogiersangers&api_key=".$api."&format=json&limit=25");
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $json_content = curl_exec($ch);
    curl_close($ch);
    $data = json_decode($json_content, true);
    $list = $data['topartists']['artist'];
    //print_r($recent);

    $topartists = array();
    for ($artists = 0; $artists < 25; ++$artists) {
        $artist = $list[$artists];
        $array = array('artist' => $artist['name'],
                        'count' => $artist['playcount']);
        array_push($topartists, $array);
    }

    $topartists = json_encode($topartists);
    //return $topartists;

        update_option( 'sngrs_lastfm_top', $topartists );

    $ip = "sngrs_lastfm_top ".time()."\n";
    file_put_contents(get_stylesheet_directory() . '/inc/log.txt', $ip, FILE_APPEND); 
};

?>