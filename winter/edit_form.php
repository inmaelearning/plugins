<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Form for editing winter block instances.
 *
 * @copyright 2019 @inmaelearning
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */
class block_winter_edit_form extends block_edit_form {
    protected function specific_definition($mform) {
        global $CFG;

        // Fields for editing Winter block title and contents.
        // Header.
        $mform->addElement('header', 'configheader', get_string('blocksettings', 'block'));

        // Select premier of the chapter of Game of Thrones, It's optional.
        $name = get_string('premier', 'block_winter');
        $mform->addElement('date_time_selector', 'config_premier', $name, array('optional' => false));

        // Select your house. It's optional.
        $options = array(
            'stark' => get_string('house:stark', 'block_winter'),
            'lannister' => get_string('house:lannister', 'block_winter'),
            'targaryen' => get_string('house:targaryen', 'block_winter'),
            'tully' => get_string('house:tully', 'block_winter'),
            'greyjoy' => get_string('house:greyjoy', 'block_winter'),
            'arryn' => get_string('house:arryn', 'block_winter'),
            'baratheon' => get_string('house:baratheon', 'block_winter'),
            'martell' => get_string('house:martell', 'block_winter'),
            'bolton' => get_string('house:bolton', 'block_winter')
        );  
        $mform->addElement('select', 'config_house', get_string('house:select', 'block_winter'), $options);

        // Write a link to more information.
        $mform->addElement('text', 'config_url', get_string('url:info', 'block_winter'), $options);
        $mform->setType('config_url', PARAM_URL);
    }

}
