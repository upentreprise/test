<?php

$tribe_options = get_option( 'tribe_events_calendar_options' );

if ( isset( $tribe_options ) && is_array( $tribe_options ) ) {
    $tribe_options['stylesheetOption'] = 'skeleton';
    $tribe_options['hideSubsequentRecurrencesDefault'] = true;
    $tribe_options['tribeEventsTemplate'] = '';
}
update_option( 'tribe_events_calendar_options', $tribe_options );

SF_Demo_Installer::add_term( 'Art', 'tribe_events_cat' );

$event_content = 'Maecenas leo nisi, efficitur at felis sit amet, lacinia auctor quam. Aliquam euismod pretium mattis. Aenean sollicitudin orci non orci gravida ullamcorper. Duis utres odios pellentesque, efficiturs odio vitae, aliquams arcu. Sed pulvinar lacus at neque imperdiet lobortis. Phasellus eget lectus rutrum, fringilla nibh ut, convallis orci. Quisque magna risus, lacinia a pharetra vel, gravida ac mi. Aenean ac interdum nisi, et vehicula nisl. Suspendisse potenti. Cras leo ex, congue eget dignissim nec, porta maximus erat. Etiam ornare arcu neque, in viverra eros egestas eu. Mauris diam velit, dictum et vehicula nec, sagittis nec sapien. Donec tincidunt purus et justo porttitor, non porttitor quam fermentum orci non aliquams arcu dolores ipsums.

Donec maximus a ante sit amet nisl nisi at arcu. Donec lobortis libero ex, a sollicitudin neque volutpat. Aenean pretium nisi id lectus cursus sagittis. Aliquam sit amet nisl pretium, consectetur purus non, porta libero. Integer dui dui, porta non mollis sit amet, pharetra nec risus. Donec fringilla ex non arcu auctor, vel faucibus felis pharetra. Pellentesque condimentum suscipit mi. Sed pretium, tellus et efficitur dapibus, metus nunc gravida ante, at interdum nisl nisi at arcu. Donec lobortis libero ex, a sollicitudin neque dapibus vitae. Maecenas volutpat est sit amet leo pretium mollis eu a odio dolores ipsums ficilis etras.’,
‘post_excerpt’ => ‘Maecenas leo nisi, efficitur at felis sit amet, lacinia auctor quam. Aliquam euismod pretium mattis. Aenean sollicitudin orci non orci gravida ullamcorper.';

$event_excerpt = 'Maecenas leo nisi, efficitur at felis sit amet, lacinia auctor quam. Aliquam euismod pretium mattis. Aenean sollicitudin orci non orci gravida ullamcorper. Duis utres odios pellentesque, efficiturs odio vitae, aliquams arcu. Sed pulvinar lacus at neque imperdiet lobortis. Phasellus eget lectus rutrum, fringilla nibh ut, convallis orci.';

$event_time = date( 'Y-m' );

$event_venue = SF_Demo_Installer::add_custom_post_type( array(
     'title' => 'South Campus',
     'post_type' => 'tribe_venue',
     'post_content' => $event_excerpt,
     'post_meta' => array(
         '_VenueOrigin' => 'events-calendar',
         '_VenueAddress' => '1234 Apple Avenue',
         '_VenueCity' => 'New York',
         '_VenueCountry' => 'United States',
         '_VenueState' => 'NY',
         '_VenueZip' => '111111',
         '_VenuePhone' => '800-123-4567',
         '_VenueURL' => 'https://talemy.themespirit.com',
         '_VenueShowMap' => 'true',
     )
));

$event_organizer = SF_Demo_Installer::add_custom_post_type( array(
     'title' => 'Talemy University',
     'post_type' => 'tribe_organizer',
     'post_content' => $event_excerpt,
     'post_meta' => array(
         '_OrganizerOrigin' => 'events-calendar',
         '_OrganizerOrganizerID' => '1001',
         '_OrganizerPhone' => '800-123-4567',
         '_OrganizerWebsite' => 'https://talemy.themespirit.com',
         '_OrganizerEmail' => 'support@themespirit.com',
     )
));

SF_Demo_Installer::add_custom_post_type(array(
     'title' => 'Hack Night',
     'post_type' => 'tribe_events',
     'post_content' => $event_content,
     'post_excerpt' => $event_excerpt,
     'post_meta' => array(
         '_EventOrigin' => 'events-calendar',
         '_EventShowMapLink' => '1',
         '_EventShowMap' => '1',
         '_EventStartDate' => $event_time .'-18 20:00:00',
         '_EventEndDate' => $event_time .'-18 23:00:00',
         '_EventURL' => 'https://talemy.themespirit.com',
         '_EventTimezone' => '',
         '_EventOrganizerID' => $event_organizer,
         '_EventVenueID' => $event_venue,
         '_EventRecurrence' => array(
             'rules' => array(
                 array(
                     'type' => 'Custom',
                     'custom' => array(
                         'interval' => 1,
                         'month' => array(),
                         'same-time' => 'yes',
                         'type' => 'Monthly',
                     ),
                     'end-type' => 'Never',
                     'EventStartDate' => $event_time .'-18 20:00:00',
                     'EventEndDate' => $event_time .'-18 23:00:00'
                 )
             ),
             'exclusions' => array(),
             'description' => ''
         )
     ),
     'taxonomy' => array( array( 'art' ), 'tribe_events_cat' )
));

SF_Demo_Installer::add_custom_post_type(array(
     'title' => 'Kids Festival',
     'post_type' => 'tribe_events',
     'post_content' => $event_content,
     'post_excerpt' => $event_excerpt,
     'post_meta' => array(
         '_EventOrigin' => 'events-calendar',
         '_EventShowMapLink' => '1',
         '_EventShowMap' => '1',
         '_EventAllDay' => 'yes',
         '_EventStartDate' => $event_time .'-20',
         '_EventEndDate' => $event_time .'-20',
         '_EventURL' => 'https://talemy.themespirit.com',
         '_EventTimezone' => '',
         '_EventOrganizerID' => $event_organizer,
         '_EventVenueID' => $event_venue,
         '_EventRecurrence' => array(
             'rules' => array(
                 array(
                     'type' => 'Custom',
                     'custom' => array(
                         'interval' => 1,
                         'month' => array(),
                         'same-time' => 'yes',
                         'type' => 'Monthly',
                     ),
                     'end-type' => 'Never',
                     'EventStartDate' => $event_time .'-20 00:00:00',
                     'EventEndDate' => $event_time .'-20 23:59:59'
                 )
             ),
             'exclusions' => array(),
             'description' => ''
         )
     ),
     'taxonomy' => array( array( 'art' ), 'tribe_events_cat' )
));

SF_Demo_Installer::add_custom_post_type(array(
     'title' => 'Wonders of the Night Sky Show',
     'post_type' => 'tribe_events',
     'post_content' => $event_content,
     'post_excerpt' => $event_excerpt,
     'post_meta' => array(
         '_EventOrigin' => 'events-calendar',
         '_EventShowMapLink' => '1',
         '_EventShowMap' => '1',
         '_EventStartDate' => $event_time .'-20 08:00:00',
         '_EventEndDate' => $event_time .'-20 11:00:00',
         '_EventCurrencySymbol' => '$',
         '_EventCost' => '100',
         '_EventURL' => 'https://talemy.themespirit.com',
         '_EventTimezone' => '',
         '_EventOrganizerID' => $event_organizer,
         '_EventVenueID' => $event_venue,
         '_EventRecurrence' => array(
             'rules' => array(
                 array(
                     'type' => 'Custom',
                     'custom' => array(
                         'interval' => 1,
                         'month' => array(),
                         'same-time' => 'yes',
                         'type' => 'Monthly',
                     ),
                     'end-type' => 'Never',
                     'EventStartDate' => $event_time .'-20 08:00:00',
                     'EventEndDate' => $event_time .'-20 11:00:00'
                 )
             ),
             'exclusions' => array(),
             'description' => ''
         )
     ),
     'taxonomy' => array( array( 'art' ), 'tribe_events_cat' )
));

SF_Demo_Installer::add_custom_post_type(array(
     'title' => 'Yoga Day',
     'post_type' => 'tribe_events',
     'post_content' => $event_content,
     'post_excerpt' => $event_excerpt,
     'post_meta' => array(
         '_EventOrigin' => 'events-calendar',
         '_EventShowMapLink' => '1',
         '_EventShowMap' => '1',
         '_EventAllDay' => 'yes',
         '_EventStartDate' => $event_time .'-21 00:00:00',
         '_EventEndDate' => $event_time .'-21 23:59:59',
         '_EventURL' => 'https://talemy.themespirit.com',
         '_EventTimezone' => '',
         '_EventOrganizerID' => $event_organizer,
         '_EventVenueID' => $event_venue,
         '_EventRecurrence' => array(
             'rules' => array(
                 array(
                     'type' => 'Custom',
                     'custom' => array(
                         'interval' => 1,
                         'month' => array(),
                         'same-time' => 'yes',
                         'type' => 'Monthly',
                     ),
                     'end-type' => 'Never',
                     'EventStartDate' => $event_time .'-21 00:00:00',
                     'EventEndDate' => $event_time .'-21 23:59:59'
                 )
             ),
             'exclusions' => array(),
             'description' => ''
         )
     ),
     'taxonomy' => array( array( 'art' ), 'tribe_events_cat' )
));

SF_Demo_Installer::add_custom_post_type(array(
     'title' => 'English Study Group Meetup',
     'post_type' => 'tribe_events',
     'post_content' => $event_content,
     'post_excerpt' => $event_excerpt,
     'post_meta' => array(
         '_EventOrigin' => 'events-calendar',
         '_EventShowMapLink' => '1',
         '_EventShowMap' => '1',
         '_EventStartDate' => $event_time .'-23 08:00:00',
         '_EventEndDate' => $event_time .'-23 11:00:00',
         '_EventCurrencySymbol' => '$',
         '_EventCost' => '30',
         '_EventURL' => 'https://talemy.themespirit.com',
         '_EventTimezone' => '',
         '_EventOrganizerID' => $event_organizer,
         '_EventVenueID' => $event_venue,
         '_EventRecurrence' => array(
             'rules' => array(
                 array(
                     'type' => 'Custom',
                     'custom' => array(
                         'interval' => 1,
                         'month' => array(),
                         'same-time' => 'yes',
                         'type' => 'Monthly',
                     ),
                     'end-type' => 'Never',
                     'EventStartDate' => $event_time .'-23 08:00:00',
                     'EventEndDate' => $event_time .'-23 11:00:00'
                 )
             ),
             'exclusions' => array(),
             'description' => ''
         )
     ),
     'taxonomy' => array( array( 'art' ), 'tribe_events_cat' )
));

SF_Demo_Installer::add_custom_post_type(array(
     'title' => 'WordPress Group Meetup',
     'post_type' => 'tribe_events',
     'post_content' => $event_content,
     'post_excerpt' => $event_excerpt,
     'post_meta' => array(
         '_EventOrigin' => 'events-calendar',
         '_EventShowMapLink' => '1',
         '_EventShowMap' => '1',
         '_EventStartDate' => $event_time .'-10 09:00:00',
         '_EventEndDate' => $event_time .'-10 11:00:00',
         '_EventURL' => 'https://talemy.themespirit.com',
         '_EventTimezone' => '',
         '_EventOrganizerID' => $event_organizer,
         '_EventVenueID' => $event_venue,
         '_EventRecurrence' => array(
             'rules' => array(
                 array(
                     'type' => 'Custom',
                     'custom' => array(
                         'interval' => 1,
                         'montly' => array(),
                         'same-time' => 'yes',
                         'type' => 'Monthly',
                     ),
                     'end-type' => 'Never',
                     'EventStartDate' => $event_time .'-10 09:00:00',
                     'EventEndDate' => $event_time .'-10 11:00:00'
                 )
             ),
             'exclusions' => array(),
             'description' => ''
         )
     ),
     'taxonomy' => array( array( 'art' ), 'tribe_events_cat' )
));


SF_Demo_Installer::add_custom_post_type(array(
     'title' => 'Guided Tours',
     'post_type' => 'tribe_events',
     'post_content' => $event_content,
     'post_excerpt' => $event_excerpt,
     'post_meta' => array(
         '_EventOrigin' => 'events-calendar',
         '_EventShowMapLink' => '1',
         '_EventShowMap' => '1',
         '_EventStartDate' => $event_time .'-07 08:00:00',
         '_EventEndDate' => $event_time .'-07 11:00:00',
         '_EventCurrencySymbol' => '$',
         '_EventCost' => '80',
         '_EventURL' => 'https://talemy.themespirit.com',
         '_EventTimezone' => '',
         '_EventOrganizerID' => $event_organizer,
         '_EventVenueID' => $event_venue,
         '_EventRecurrence' => array(
             'rules' => array(
                 array(
                     'type' => 'Custom',
                     'custom' => array(
                         'interval' => 1,
                         'montly' => array(),
                         'same-time' => 'yes',
                         'type' => 'Monthly',
                     ),
                     'end-type' => 'Never',
                     'EventStartDate' => $event_time .'-07 08:00:00',
                     'EventEndDate' => $event_time .'-07 11:00:00'
                 )
             ),
             'exclusions' => array(),
             'description' => ''
         )
     ),
     'taxonomy' => array( array( 'art' ), 'tribe_events_cat' )
));

SF_Demo_Installer::add_custom_post_type(array(
     'title' => 'Serenity Art Exhibition',
     'post_type' => 'tribe_events',
     'post_content' => $event_content,
     'post_excerpt' => $event_excerpt,
     'post_meta' => array(
         '_EventOrigin' => 'events-calendar',
         '_EventShowMapLink' => '1',
         '_EventShowMap' => '1',
         '_EventStartDate' => $event_time .'-10 20:00:00',
         '_EventEndDate' => $event_time .'-10 21:00:00',
         '_EventCurrencySymbol' => '$',
         '_EventCost' => '50',
         '_EventURL' => 'https://talemy.themespirit.com',
         '_EventTimezone' => '',
         '_EventOrganizerID' => $event_organizer,
         '_EventVenueID' => $event_venue,
         '_EventRecurrence' => array(
             'rules' => array(
                 array(
                     'type' => 'Custom',
                     'custom' => array(
                         'interval' => 1,
                         'month' => array(),
                         'same-time' => 'yes',
                         'type' => 'Monthly',
                     ),
                     'end-type' => 'Never',
                     'EventStartDate' => $event_time .'-10 20:00:00',
                     'EventEndDate' => $event_time .'-10 21:00:00'
                 )
             ),
             'exclusions' => array(),
             'description' => ''
         )
     ),
     'taxonomy' => array( array( 'art' ), 'tribe_events_cat' )
));