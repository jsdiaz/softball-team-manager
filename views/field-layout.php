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

$title = 'Field Layout';

ob_start();

?>
    <h3><?= $gameDateTimeHeader ?></h3>

    <div id="extra-player-table">
        <table>
            <tr>
                <th colspan="2">Extra Players</th>
            </tr>
<?php
if ($extraPlayers)
{
?>
<?php
    foreach ($extraPlayers as $player)
    {
        $shirtNum = getShirtNum($lineup, $player);
?>
            <tr style="color: #<?= $priColor ?>; background-color: #<?= $secColor ?>">
                <!-- center shirt num; put a badge (a thin color strip) for gender next to name -->
                <td><?= $shirtNum ? "#$shirtNum" : '' ?></td>
                <td><a style="color: #<?= $priColor ?>" href="<?= getPlayerURI($player) ?>"><?= getShortName($player) ?></a></td>
            </tr>
<?php
    }
}
else
{
?>
            <tr>
                <td>&lt;None&gt;</td>
            </tr>
<?php
}
?>
        </table>
    </div>

    <div id="softballField">
<?php
for ($i = 1; $i <= 10; $i++)
{
    $player = getPlayerAtFieldPos($lineup, $i);
    $shirtNum = getShirtNum($lineup, $player);
?>
        <div id="field-pos-<?= $i ?>" class="playerPos playerPos-left">
            <p class="playerPos-GenderBadge playerPos-right gender-<?= getGender($player, true) ?>">
                &nbsp;
            </p>
<!-- TODO long names are getting wrapped. why? -->
            <p class="playerPos-left" style="color: #<?= $priColor ?>; background-color: #<?= $secColor ?>">
                <?= $shirtNum ? "#$shirtNum " : ' ' ?><a href="<?= getPlayerURI($player) ?>" style="color: #<?= $priColor ?>"><?= getShortName($player) ?></a>
            </p>
        </div>
<?php
}
?>
    </div>

    <p>View the <a href="<?= getLineupURI($lineup) ?>">Lineup</a>.</p>
<?php

$content = ob_get_clean();

require dirname(__FILE__) . '/../templates/layout.php';
