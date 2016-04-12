<?php
/**
 * Created by PhpStorm.
 * User: DaikiTakeuchi
 * Date: 2016/04/12
 * Time: 18:41
 */

class Events_model_test extends TestCase
{

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();

        $CI =& get_instance();
        $CI->load->library('Seeder');
        $CI->seeder->call('EventsSeeder');
        $CI->seeder->call('UsersSeeder');
    }

    public function setUp()
    {
        $this->resetInstance();
        $this->CI->load->model('Events_model');
        $this->CI->load->model('Invitation_model');
        $this->CI->load->model('Users_model');
        $this->events_model = $this->CI->Events_model;
        $this->invitation_model = $this->CI->Invitation_model;
        $this->users_model = $this->CI->Users_model;
    }

    /**
     * @test
     */
    public function イベントを全件取得()
    {
        $expected = 3;
        $actual = $this->events_model->get_events();
        $this->assertEquals($expected, count($actual));
    }

    /**
     * @test
     */
    public function ユーザーidを指定してイベントを取得()
    {

        $events = $this->events_model->get_events();
        $users = $this->users_model->get_users();

        foreach($events as $event) {
            foreach($users as $user) {
                $invitation = array(
                    'event_id' => $event['id'],
                    'user_id' => $user['id'],
                    'created_at' => date('Y/m/d H:i:s'),
                    'updated_at' => date('Y/m/d H:i:s')
                );
                $this->invitation_model->save($invitation);
            }
        }

        // test
        $expected = 3;
        $actual = $this->events_model->find_by_user_id($users[0]['id']);
        $this->assertEquals($expected, count($actual));

        // tearDown
        foreach($events as $event) {
            $this->events_model->delete($event);
        }
        $invitations = $this->invitation_model->find();
        foreach($invitations as $invitation) {
            $this->invitation_model->delete($invitation);
        }
    }

    /**
     * @test
     */
    public function イベントを新規登録する()
    {
        // setUp
        $event = array(
            'title' => 'イベント４',
            'place' => '場所４',
            'description' => '説明４',
            'start_time' => '2016/4/15 18:00',
            'end_time' => '2016/4/15 20:00',
            'number_of_people' => 15,
            'created_at' => date('Y/m/d H:i:s'),
            'updated_at' => date('Y/m/d H:i:s')
        );
        $this->events_model->save($event);

        // tearDown
        $this->events_model->delete($event);
    }

    /**
     * @test
     */
    public function イベントを更新する()
    {
        $expected = 'イベント５＿更新後';

        // setUp
        $event = array(
            'title' => 'イベント５',
            'place' => '場所５',
            'description' => '説明５',
            'start_time' => '2016/4/16 18:00',
            'end_time' => '2016/4/16 20:00',
            'number_of_people' => 15,
            'created_at' => date('Y/m/d H:i:s'),
            'updated_at' => date('Y/m/d H:i:s')
        );
        $this->events_model->save($event);

        $sut = $this->events_model->find($event['id']);
        $sut['title'] = $expected;

        // test
        $this->events_model->save($sut);

        $actual = $this->events_model->find($event['id'])['title'];

        $this->assertEquals($expected, $actual);

        // tearDown
        $this->events_model->delete($event);
    }
}
