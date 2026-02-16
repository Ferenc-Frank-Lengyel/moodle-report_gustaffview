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
 * Display Student MyGrades Staff View 2.0 (Beta) report
 *
 * @package    report_gustaffview
 * @copyright  2026 Ferenc 'Frank' Fengyel, ferenc.lengyel@glasgow.ac.uk
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

use core\report_helper;
use core\output\comboboxsearch;

require('../../config.php');
require_once($CFG->libdir . '/adminlib.php');
require_once($CFG->dirroot.'/grade/report/lib.php');

$courseid = required_param('id', PARAM_INT);
$course = $DB->get_record('course', ['id' => $courseid], '*', MUST_EXIST);

$context = context_course::instance($course->id);
require_login($course);
require_capability('report/gustaffview:view', $context);
$PAGE->set_url('/report/gustaffview/index.php', ['id' => $course->id]);
$PAGE->set_pagelayout('report');
$PAGE->set_title(get_string('pluginname', 'report_gustaffview'));
$PAGE->set_heading($course->fullname);

// Params coming from the URL / form.
$userid     = optional_param('userid', null, PARAM_INT);
$usersearch = optional_param('usersearch', '', PARAM_TEXT);
$instanceid = null; // Unless you have some specific instance context.

$resetlink = new moodle_url('/report/gustaffview/index.php', ['id' => $courseid]);

$gradableusers = grade_report::get_gradable_users($courseid, $currentgroup);
// Validate whether the requested user is a valid gradable user in this course. If, not display the user select
// zero state.
if (empty($gradableusers) || ($userid && !array_key_exists($userid, $gradableusers))) {
    $userid = null;
}

$students = [];
foreach ($gradableusers as $u) {
    $students[] = [
        'id' => $u->id,
        'label' => fullname($u),
    ];
}

$defaultgradeshowactiveenrol = !empty($CFG->grade_report_showonlyactiveenrol);
$showonlyactiveenrol = get_user_preferences('grade_report_showonlyactiveenrol', $defaultgradeshowactiveenrol);
$showonlyactiveenrol = $showonlyactiveenrol || !has_capability('moodle/course:viewsuspendedusers', $context);

echo $OUTPUT->header();
echo $OUTPUT->heading(get_string('pluginname', 'report_gustaffview'));

echo 'to do';

echo $OUTPUT->footer();
