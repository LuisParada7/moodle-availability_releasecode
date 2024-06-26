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
 * Installation
 *
 * @package availability_releasecode
 * @author Mark Nielsen
 **/
function xmldb_availability_releasecode_install() {
    global $DB;

    $dbman = $DB->get_manager();

    if ($dbman->table_exists('user_release_codes') && $DB->get_dbfamily() === 'mysql') {
        // Seed table with data from user_release_codes.
        $DB->execute("
            INSERT INTO {availability_releasecode} (userid, courseid, code)
                 SELECT r.userid, r.courseid, r.releasecode
                   FROM {user_release_codes} r
        ");
    }
}
