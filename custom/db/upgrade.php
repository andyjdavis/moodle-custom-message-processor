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
 * Upgrade code for my message processor
 *
 * @author Andrew Davis
 * @license http://www.gnu.org/copyleft/gpl.html GNU Public License
 * @package message_custom
 */

function xmldb_message_custom_upgrade($oldversion) {
    global $CFG, $DB;

    $dbman = $DB->get_manager();

    if ($oldversion < 2011062400.00) {
        $processor = new stdClass();
        $processor->name  = 'custom';
        if (!$DB->record_exists('message_processors', array('name' => $processor->name)) ){
            $DB->insert_record('message_processors', $processor);
        }

        //my message processor savepoint reached
        upgrade_plugin_savepoint(true, 2011062400.00, 'message', 'custom');
    }

    return true;
}
