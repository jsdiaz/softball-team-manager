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

require dirname(__FILE__) . '/begin-controller.php';

require_once dirname(__FILE__) . '/../models/auth.php';

doRequireLogin();

require_once dirname(__FILE__) . '/../models/game.php';
require_once dirname(__FILE__) . '/../models/team.php';
require_once dirname(__FILE__) . '/../models/lineup.php';
require_once dirname(__FILE__) . '/../models/calendar.php';

if (isset($gameID) && isset($teamID) && isset($leagueID)) {
    //TODO allow user to see others' lineups only after the game is finished
    //     (make sure user's playerID is on roster or is manager)

    $gameInfo = getGameInfo($gameID);
    $teamInfo = getTeamInfo($teamID);

    $gameTime = mktimeFromMySQLDateTime($gameInfo['DateTime']);
    $gameDateTimeHeader = date('l\, F j\, Y', $gameTime) . ' @ ' . date('g\:i a', $gameTime);
    $lineup = getLineup($gameID, $teamID, $leagueID);
    $positions = getPositions($lineup);
    $extraPlayers = getExtraPlayers($lineup);
    $priColor = getPrimaryColor($teamInfo);
    $secColor = getSecondaryColor($teamInfo);

    unset($gameInfo, $teamInfo);

    require dirname(__FILE__) . '/../views/field-layout.php';
} else {
    $msgTitle = "Bad Field Layout Request";
    $msg = "Your request didn't have a valid combination of gameid, teamid, and leagueid.";
    $msgClass = "failure";
    require dirname(__FILE__) . '/../views/show-message.php';
}

require dirname(__FILE__) . '/end-controller.php';

