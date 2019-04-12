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
 * Winter block.
 *
 * @package   block_winter
 * @copyright 2019 @inmaelearning
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

class block_winter extends block_base {
    public function init() {
        $this->title = get_string('pluginname', 'block_winter');
    }

    public function instance_allow_multiple() {
        return true;
    }

    public function applicable_formats() {
        return array('all' => true);
    }

    public function instance_allow_config() {
        return true;
    }

    public function specialization() {

        // Load userdefined title and make sure it's never empty.
        if (empty($this->config->title)) {
            $this->title = get_string('pluginname', 'block_winter');
        } else {
            $this->title = format_string($this->config->title, true, ['context' => $this->context]);
        }
    }

    public function get_content() {
        global $CFG;

        // Default info.
        $defaultpremier = date("F j, Y", 1555293600);
        $defaulthouse = get_string('house:stark', 'block_winter');

        if (!isset($this->config)) {
            $this->config = new stdClass();
        }
        $this->content = new stdClass;

        if (empty($this->config->premier)) {
            $this->config->premier = $defaultpremier;
        } else {
            // Premier information.
            $premierchapter = date("F j, Y", $this->config->premier);
            $daysleft = date("d", $this->config->premier - time());
            // Write visual info.
            $outputhtml = html_writer::tag('b', get_string('premier:info', 'block_winter', $premierchapter));
            $outputhtml .= html_writer::empty_tag('br');
            $outputhtml .= get_string('premier:left', 'block_winter', $daysleft);
            $this->content->text = $outputhtml;
        }

        if (empty($this->config->house)) {
            $this->config->house = $defaulthouse;
        } else {
            // House parameters.
            $imgurl = new moodle_url($CFG->wwwroot . '/blocks/winter/img/'. $this->config->house.'.jpg');
            // Writing HTML house information.
            $outputhtml = html_writer::tag('b', get_string('house:info', 'block_winter', get_string('house:' . $this->config->house, 'block_winter')));
            $outputhtml .= html_writer::empty_tag('br');
            $outputhtml .= html_writer::img($imgurl, get_string('house:' . $this->config->house, 'block_winter'), array('style' => 'max-width: 100%'));
            $this->content->footer = $outputhtml;
        }

        if ($this->content !== NULL) {
            // Show house and chapter.
            return $this->content;
        }

        if (empty($this->instance)) {
            $this->content = '';
            return $this->content;
        }

        // There is not information about premier of the next chapter and your favourite house, show default data.
        $this->content = new stdClass;
        $this->content->premier = $defaultpremier;
        $this->content->house = $defaulthouse;
        return $this->content;
    }
}
