<?php
/* vim:set softtabstop=4 shiftwidth=4 expandtab: */
/**
 *
 * LICENSE: GNU Affero General Public License, version 3 (AGPL-3.0-or-later)
 * Copyright 2001 - 2020 Ampache.org
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <https://www.gnu.org/licenses/>.
 *
 */

// Because this is a reset of the persons password make the form a little more secure

use Ampache\Module\Access;
use Ampache\Module\Util\Ui;

$display_fields = (array) AmpConfig::get('registration_display_fields'); ?>
<?php AmpError::display('general'); ?>
    <table class="tabledata">
            <tr>
                <td><?php echo T_('Full Name'); ?>:</td>
                <td>
                    <?php echo scrub_out($client->fullname); ?>
                </td>
            </tr>
        <tr>
            <td><?php echo T_('E-mail'); ?>:</td>
            <td>
                <?php echo scrub_out($client->email); ?>
            </td>
        </tr>
            <tr>
                <td><?php echo T_('Website'); ?>:</td>
                <td>
                    <?php echo scrub_out($client->website); ?>
                </td>
            </tr>
            <tr>
                <td><?php echo T_('State'); ?>:</td>
                <td>
                    <?php echo scrub_out($client->state); ?>
                </td>
            </tr>
            <tr>
                <td><?php echo T_('City'); ?>:</td>
                <td>
                    <?php echo scrub_out($client->city); ?>
                </td>
            </tr>
        <tr>
            <td>
                <?php echo T_('Avatar'); ?> (&lt; <?php echo Ui::format_bytes(AmpConfig::get('max_upload_size')); ?>)
            </td>
        <tr>
            <td>
        </td>
        <td>
          <?php
                if ($client->f_avatar) {
                    echo $client->f_avatar;
                } ?>
            </td>
        </tr>
        <tr>
            <td>
                <?php echo T_('API Key'); ?>
                <?php if (Access::check('interface', 100)) { ?>
                    <a href="<?php echo AmpConfig::get('web_path'); ?>/admin/users.php?action=show_generate_apikey&user_id=<?php echo $client->id; ?>"><?php echo Ui::get_icon('random', T_('Generate new API key')); ?></a>
                <?php } ?>
            </td>
            <td>
                <span>
                    <?php if ($client->apikey) { ?>
                    <br />
                    <div style="background-color: #ffffff; border: 8px solid #ffffff; width: 128px; height: 128px;">
                        <div id="apikey_qrcode"></div>
                    </div>
                    <br />
                    <script>$('#apikey_qrcode').qrcode({width: 128, height: 128, text: '<?php echo $client->apikey; ?>', background: '#ffffff', foreground: '#000000'});</script>
                    <?php echo $client->apikey; ?>
                    <?php
                } ?>
                </span>
            </td>
        </tr>
        <?php if ($client->rsstoken) { ?>
        <tr>
            <td>
                <?php echo T_('RSS Token'); ?>
                <?php if (Access::check('interface', 100)) { ?>
                    <a href="<?php echo AmpConfig::get('web_path'); ?>/admin/users.php?action=show_generate_rsstoken&user_id=<?php echo $client->id; ?>"><?php echo Ui::get_icon('random', T_('Generate new RSS token')); ?></a>
                <?php } ?>
            </td>
            <td>
                <span>
                    <?php echo $client->rsstoken; ?>
                </span>
            </td>
        </tr>
        <?php } ?>
    </table>
