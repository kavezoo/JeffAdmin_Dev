<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\City $city
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit City'), ['action' => 'edit', $city->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete City'), ['action' => 'delete', $city->id], ['confirm' => __('Are you sure you want to delete # {0}?', $city->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Cities'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New City'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="cities view content">
            <h3><?= h($city->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Shortname') ?></th>
                    <td><?= h($city->shortname) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($city->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Zip') ?></th>
                    <td><?= h($city->zip) ?></td>
                </tr>
                <tr>
                    <th><?= __('Lat') ?></th>
                    <td><?= h($city->lat) ?></td>
                </tr>
                <tr>
                    <th><?= __('Lng') ?></th>
                    <td><?= h($city->lng) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($city->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Club Count') ?></th>
                    <td><?= $this->Number->format($city->club_count) ?></td>
                </tr>
                <tr>
                    <th><?= __('User Count') ?></th>
                    <td><?= $city->user_count === null ? '' : $this->Number->format($city->user_count) ?></td>
                </tr>
                <tr>
                    <th><?= __('Pos') ?></th>
                    <td><?= $this->Number->format($city->pos) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($city->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($city->modified) ?></td>
                </tr>
                <tr>
                    <th><?= __('Visible') ?></th>
                    <td><?= $city->visible ? __('Yes') : __('No'); ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Clubs') ?></h4>
                <?php if (!empty($city->clubs)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Clubpresident Id') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Short Name') ?></th>
                            <th><?= __('Logo') ?></th>
                            <th><?= __('Email') ?></th>
                            <th><?= __('Enabled') ?></th>
                            <th><?= __('Address') ?></th>
                            <th><?= __('Phone') ?></th>
                            <th><?= __('Web') ?></th>
                            <th><?= __('Facebook') ?></th>
                            <th><?= __('Insta') ?></th>
                            <th><?= __('User Count') ?></th>
                            <th><?= __('Competition Count') ?></th>
                            <th><?= __('National Membership Fee Date') ?></th>
                            <th><?= __('Visible') ?></th>
                            <th><?= __('Pos') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($city->clubs as $club) : ?>
                        <tr>
                            <td><?= h($club->id) ?></td>
                            <td><?= h($club->clubpresident_id) ?></td>
                            <td><?= h($club->name) ?></td>
                            <td><?= h($club->short_name) ?></td>
                            <td><?= h($club->logo) ?></td>
                            <td><?= h($club->email) ?></td>
                            <td><?= h($club->enabled) ?></td>
                            <td><?= h($club->address) ?></td>
                            <td><?= h($club->phone) ?></td>
                            <td><?= h($club->web) ?></td>
                            <td><?= h($club->facebook) ?></td>
                            <td><?= h($club->insta) ?></td>
                            <td><?= h($club->user_count) ?></td>
                            <td><?= h($club->competition_count) ?></td>
                            <td><?= h($club->national_membership_fee_date) ?></td>
                            <td><?= h($club->visible) ?></td>
                            <td><?= h($club->pos) ?></td>
                            <td><?= h($club->created) ?></td>
                            <td><?= h($club->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Clubs', 'action' => 'view', $club->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Clubs', 'action' => 'edit', $club->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'Clubs', 'action' => 'delete', $club->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $club->id),
                                    ]
                                ) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Competitions') ?></h4>
                <?php if (!empty($city->competitions)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Organizing Club Id') ?></th>
                            <th><?= __('Venue Name') ?></th>
                            <th><?= __('Venue Address') ?></th>
                            <th><?= __('Google Maps Url') ?></th>
                            <th><?= __('Competition Text Template Id') ?></th>
                            <th><?= __('Modified By') ?></th>
                            <th><?= __('National Competition') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('Subtitle') ?></th>
                            <th><?= __('Subtitle2') ?></th>
                            <th><?= __('First Date Of Application') ?></th>
                            <th><?= __('Application Deadline') ?></th>
                            <th><?= __('Competition Datetime') ?></th>
                            <th><?= __('Start Datetime') ?></th>
                            <th><?= __('End Datetime') ?></th>
                            <th><?= __('Description') ?></th>
                            <th><?= __('Minimum Team Size') ?></th>
                            <th><?= __('Lunch For The Attendant') ?></th>
                            <th><?= __('Racing Pipe 1 Title') ?></th>
                            <th><?= __('Racing Pipe 2 Title') ?></th>
                            <th><?= __('Racing Pipe 3 Title') ?></th>
                            <th><?= __('Pipe Type') ?></th>
                            <th><?= __('Pipe Parameters') ?></th>
                            <th><?= __('Tobacco Type') ?></th>
                            <th><?= __('Tobacco Weight') ?></th>
                            <th><?= __('Currency') ?></th>
                            <th><?= __('Entry Fee Member') ?></th>
                            <th><?= __('Entry Fee Non Member') ?></th>
                            <th><?= __('Lunch Description') ?></th>
                            <th><?= __('Lunch Price') ?></th>
                            <th><?= __('Racing Pipe 1 Price Member') ?></th>
                            <th><?= __('Racing Pipe 1 Price Non Member') ?></th>
                            <th><?= __('Racing Pipe 2 Price Member') ?></th>
                            <th><?= __('Racing Pipe 2 Price Non Member') ?></th>
                            <th><?= __('Racing Pipe 3 Price Member') ?></th>
                            <th><?= __('Racing Pipe 3 Price Non Member') ?></th>
                            <th><?= __('Racing Pipe 1 Image') ?></th>
                            <th><?= __('Racing Pipe 2 Image') ?></th>
                            <th><?= __('Racing Pipe 3 Image') ?></th>
                            <th><?= __('User Count') ?></th>
                            <th><?= __('National Pipe Club Member Count') ?></th>
                            <th><?= __('Attendant Count') ?></th>
                            <th><?= __('Visible') ?></th>
                            <th><?= __('Pos') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($city->competitions as $competition) : ?>
                        <tr>
                            <td><?= h($competition->id) ?></td>
                            <td><?= h($competition->organizing_club_id) ?></td>
                            <td><?= h($competition->venue_name) ?></td>
                            <td><?= h($competition->venue_address) ?></td>
                            <td><?= h($competition->google_maps_url) ?></td>
                            <td><?= h($competition->competition_text_template_id) ?></td>
                            <td><?= h($competition->modified_by) ?></td>
                            <td><?= h($competition->national_competition) ?></td>
                            <td><?= h($competition->name) ?></td>
                            <td><?= h($competition->title) ?></td>
                            <td><?= h($competition->subtitle) ?></td>
                            <td><?= h($competition->subtitle2) ?></td>
                            <td><?= h($competition->first_date_of_application) ?></td>
                            <td><?= h($competition->application_deadline) ?></td>
                            <td><?= h($competition->competition_datetime) ?></td>
                            <td><?= h($competition->start_datetime) ?></td>
                            <td><?= h($competition->end_datetime) ?></td>
                            <td><?= h($competition->description) ?></td>
                            <td><?= h($competition->minimum_team_size) ?></td>
                            <td><?= h($competition->lunch_for_the_attendant) ?></td>
                            <td><?= h($competition->racing_pipe_1_title) ?></td>
                            <td><?= h($competition->racing_pipe_2_title) ?></td>
                            <td><?= h($competition->racing_pipe_3_title) ?></td>
                            <td><?= h($competition->pipe_type) ?></td>
                            <td><?= h($competition->pipe_parameters) ?></td>
                            <td><?= h($competition->tobacco_type) ?></td>
                            <td><?= h($competition->tobacco_weight) ?></td>
                            <td><?= h($competition->currency) ?></td>
                            <td><?= h($competition->entry_fee_member) ?></td>
                            <td><?= h($competition->entry_fee_non_member) ?></td>
                            <td><?= h($competition->lunch_description) ?></td>
                            <td><?= h($competition->lunch_price) ?></td>
                            <td><?= h($competition->racing_pipe_1_price_member) ?></td>
                            <td><?= h($competition->racing_pipe_1_price_non_member) ?></td>
                            <td><?= h($competition->racing_pipe_2_price_member) ?></td>
                            <td><?= h($competition->racing_pipe_2_price_non_member) ?></td>
                            <td><?= h($competition->racing_pipe_3_price_member) ?></td>
                            <td><?= h($competition->racing_pipe_3_price_non_member) ?></td>
                            <td><?= h($competition->racing_pipe_1_image) ?></td>
                            <td><?= h($competition->racing_pipe_2_image) ?></td>
                            <td><?= h($competition->racing_pipe_3_image) ?></td>
                            <td><?= h($competition->user_count) ?></td>
                            <td><?= h($competition->national_pipe_club_member_count) ?></td>
                            <td><?= h($competition->attendant_count) ?></td>
                            <td><?= h($competition->visible) ?></td>
                            <td><?= h($competition->pos) ?></td>
                            <td><?= h($competition->created) ?></td>
                            <td><?= h($competition->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Competitions', 'action' => 'view', $competition->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Competitions', 'action' => 'edit', $competition->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'Competitions', 'action' => 'delete', $competition->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $competition->id),
                                    ]
                                ) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Users') ?></h4>
                <?php if (!empty($city->users)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Club Id') ?></th>
                            <th><?= __('Username') ?></th>
                            <th><?= __('Email') ?></th>
                            <th><?= __('Password') ?></th>
                            <th><?= __('First Name') ?></th>
                            <th><?= __('Last Name') ?></th>
                            <th><?= __('Phone') ?></th>
                            <th><?= __('Avatar') ?></th>
                            <th><?= __('Token') ?></th>
                            <th><?= __('Token Expires') ?></th>
                            <th><?= __('Api Token') ?></th>
                            <th><?= __('Activation Date') ?></th>
                            <th><?= __('Secret') ?></th>
                            <th><?= __('Secret Verified') ?></th>
                            <th><?= __('Tos Date') ?></th>
                            <th><?= __('Active') ?></th>
                            <th><?= __('Enabled') ?></th>
                            <th><?= __('Is Superuser') ?></th>
                            <th><?= __('Role') ?></th>
                            <th><?= __('Membership Status') ?></th>
                            <th><?= __('Membership Joined Date') ?></th>
                            <th><?= __('Club Membership Fee Date') ?></th>
                            <th><?= __('National Membership Fee Date') ?></th>
                            <th><?= __('Application Notified') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th><?= __('Additional Data') ?></th>
                            <th><?= __('Last Login') ?></th>
                            <th><?= __('Lockout Time') ?></th>
                            <th><?= __('Login Token') ?></th>
                            <th><?= __('Login Token Date') ?></th>
                            <th><?= __('Token Send Requested') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($city->users as $user) : ?>
                        <tr>
                            <td><?= h($user->id) ?></td>
                            <td><?= h($user->club_id) ?></td>
                            <td><?= h($user->username) ?></td>
                            <td><?= h($user->email) ?></td>
                            <td><?= h($user->password) ?></td>
                            <td><?= h($user->first_name) ?></td>
                            <td><?= h($user->last_name) ?></td>
                            <td><?= h($user->phone) ?></td>
                            <td><?= h($user->avatar) ?></td>
                            <td><?= h($user->token) ?></td>
                            <td><?= h($user->token_expires) ?></td>
                            <td><?= h($user->api_token) ?></td>
                            <td><?= h($user->activation_date) ?></td>
                            <td><?= h($user->secret) ?></td>
                            <td><?= h($user->secret_verified) ?></td>
                            <td><?= h($user->tos_date) ?></td>
                            <td><?= h($user->active) ?></td>
                            <td><?= h($user->enabled) ?></td>
                            <td><?= h($user->is_superuser) ?></td>
                            <td><?= h($user->role) ?></td>
                            <td><?= h($user->membership_status) ?></td>
                            <td><?= h($user->membership_joined_date) ?></td>
                            <td><?= h($user->club_membership_fee_date) ?></td>
                            <td><?= h($user->national_membership_fee_date) ?></td>
                            <td><?= h($user->application_notified) ?></td>
                            <td><?= h($user->created) ?></td>
                            <td><?= h($user->modified) ?></td>
                            <td><?= h($user->additional_data) ?></td>
                            <td><?= h($user->last_login) ?></td>
                            <td><?= h($user->lockout_time) ?></td>
                            <td><?= h($user->login_token) ?></td>
                            <td><?= h($user->login_token_date) ?></td>
                            <td><?= h($user->token_send_requested) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Users', 'action' => 'view', $user->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Users', 'action' => 'edit', $user->id]) ?>
                                <?= $this->Form->postLink(
                                    __('Delete'),
                                    ['controller' => 'Users', 'action' => 'delete', $user->id],
                                    [
                                        'method' => 'delete',
                                        'confirm' => __('Are you sure you want to delete # {0}?', $user->id),
                                    ]
                                ) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>