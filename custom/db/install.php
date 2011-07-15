<?php

function xmldb_message_custom_install() {
    global $DB;
    $result = true;

    $provider = new stdClass();
    $provider->name  = 'custom';
    $DB->insert_record('message_processors', $provider);
    return $result;
}
