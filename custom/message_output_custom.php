<?php

///////////////////////////////////////////////////////////////////////////
//                                                                       //
// NOTICE OF COPYRIGHT                                                   //
//                                                                       //
// Moodle - Modular Object-Oriented Dynamic Learning Environment         //
//          http://moodle.com                                            //
//                                                                       //
// Copyright (C) 1999 onwards  Martin Dougiamas  http://moodle.com       //
//                                                                       //
// This program is free software; you can redistribute it and/or modify  //
// it under the terms of the GNU General Public License as published by  //
// the Free Software Foundation; either version 2 of the License, or     //
// (at your option) any later version.                                   //
//                                                                       //
// This program is distributed in the hope that it will be useful,       //
// but WITHOUT ANY WARRANTY; without even the implied warranty of        //
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the         //
// GNU General Public License for more details:                          //
//                                                                       //
//          http://www.gnu.org/copyleft/gpl.html                         //
//                                                                       //
///////////////////////////////////////////////////////////////////////////

/**
 * custom message processor
 *
 * @author Andrew Davis
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package message_custom
 */
require_once($CFG->dirroot.'/message/output/lib.php');

class message_output_custom extends message_output {
    /**
     * Processes the message
     * @param object $eventdata the event data submitted by the message sender plus $eventdata->savedmessageid
     */
    function send_message($eventdata) {

        //uncomment this code to see what data is available
        //the die() is there to stop processing so you can see the debug output
        /*
        var_dump('custom message processor processing a message');
        echo '<hr />';
        var_dump(get_user_preferences('message_processor_custom_myfield', null, $eventdata->userto->id));
        echo '<hr />';
        var_dump($eventdata);
        die();
        */

        return true;
    }

    /**
     * Creates necessary fields in the messaging config form.
     * @param object $mform preferences form class
     */
    function config_form($preferences) {
        global $USER;
        $string = get_string('myfield','message_custom').': <input size="30" name="custom_myfield" value="'.$preferences->custom_myfield.'" />';
        return $string;
    }

    /**
     * Parses the form submitted data and saves it into preferences array.
     * @param object $mform preferences form class
     * @param array $preferences preferences array
     */
    function process_form($form, &$preferences) {
        if (isset($form->custom_myfield)) {
            $preferences['message_processor_custom_myfield'] = $form->custom_myfield;
        }
    }

    /**
     * Loads the config data from database to put on the form (initial load)
     * @param array $preferences preferences array
     * @param int $userid the user id
     */
    function load_data(&$preferences, $userid) {
        $preferences->custom_myfield = get_user_preferences( 'message_processor_custom_myfield', '', $userid);
    }
}
