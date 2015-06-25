<?php

  /**************************************************************************

  This file is part of Team Manager.

  Copyright © 2013 Mark Ross <krazkidd@gmail.com>

  Team Manager is free software: you can redistribute it and/or modify
  it under the terms of the GNU Affero General Public License as published by
  the Free Software Foundation, either version 3 of the License, or
  (at your option) any later version.

  Team Manager is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU Affero General Public License for more details.

  You should have received a copy of the GNU Affero General Public License
  along with Team Manager.  If not, see <http://www.gnu.org/licenses/>.

  **************************************************************************/

//TODO rename this file; this is db access stuff. all other models should go
//     through this to access db

require_once dirname(__FILE__) . '/../config/config.php';

$db_con = null;

function runQuery($queryStr)
{
    global $db_con;

    if (!$db_con) {
        $db_con = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        mysqli_set_charset($db_con, 'utf8');
    }

    $result = null;

    if ($db_con) {
        //TODO can I/should I escape all query strings here and not worry about it elsewhere? (yes)
        $result = mysqli_query($db_con, $queryStr);
    } else {
//DEBUG
        error_log('Database connection error (' . mysqli_connect_errno() . '): ' . mysqli_connect_error());
//END DEBUG
    }

    return $result;
}

function closeDB()
{
    global $db_con;

    if (!$db_con)
        return false;

    return mysqli_close($db_con);
}

