<?php

/**
 * Class Events_test
 * 
 * @property Events_model $events_model
 */
class Events_test extends TestCase
{
    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();

        $CI =& get_instance();
        $CI->load->library('Seeder');
        $CI->seeder->call('UsersSeeder_30');
        $CI->seeder->call('AdminUserSeeder');
        $CI->seeder->call('EventsSeeder_30');
        $CI->seeder->call('InvitationsSeeder_Admin');
    }

    public function setUp()
    {
        $this->resetInstance();
        $this->CI->load->model('Events_model');
        $this->events_model = $this->CI->Events_model;
    }

    /**
     * @test
     */
    public function 一覧画面に遷移できる()
    {
        // 管理者でログイン
        $data = ['email' => 'admin@admin.com','password' => 'admin'];
        $this->request('POST', '/', $data);

        // Verify
        $output = $this->request('GET', ['Events', 'index']);
        $this->assertContains('予定一覧', $output);

        // Teardown ログアウト
        $this->request('GET', 'logout');
    }

    /**
     * @test
     */
    public function 一般ユーザーが一覧画面に遷移できる()
    {
        // 一般ユーザーでログイン
        $data = ['email' => 'email1@example.com','password' => 'password'];
        $this->request('POST', '/', $data);

        // Verify
        $output = $this->request('GET', ['Events', 'index']);
        $this->assertContains('予定一覧', $output);

        // Teardown ログアウト
        $this->request('GET', 'logout');
    }

    /**
     * @test
     */
    public function 存在しないイベントの場合は存在しませんページに遷移する()
    {
        // 管理者でログイン
        $data = ['email' => 'admin@admin.com','password' => 'admin'];
        $this->request('POST', '/', $data);

        $max_id = $this->events_model->get_max_id();

        // Verify
        $output = $this->request('GET', ['Events', 'edit', $max_id + 1]);
        $this->assertContains('Event Not Found', $output);

        // Teardown ログアウト
        $this->request('GET', 'logout');
    }

    /**
     * @test
     */
    public function 新規イベント登録画面に遷移できる()
    {
        // 管理者でログイン
        $data = ['email' => 'admin@admin.com','password' => 'admin'];
        $this->request('POST', '/', $data);

        // Verify
        $output = $this->request('GET', ['Events', 'create']);
        $this->assertContains('予定登録', $output);

        // Teardown ログアウト
        $this->request('GET', 'logout');
    }

    /**
     * @test
     */
    public function 管理者じゃない場合は新規イベント登録画面に遷移できない()
    {
        // 一般ユーザーでログイン
        $data = ['email' => 'email1@example.com','password' => 'password'];
        $this->request('POST', '/', $data);

        // Verify
        $this->request('GET', ['Events', 'create']);
        $this->assertRedirect('/');

        // Teardown ログアウト
        $this->request('GET', 'logout');
    }

    /**
     * @test
     */
    public function イベント登録できること()
    {
        // 管理者でログイン
        $data = ['email' => 'admin@admin.com','password' => 'admin'];
        $this->request('POST', '/', $data);

        $before = count($this->events_model->find());

        // Exercise
        $post = [
            'title' => 'タイトル',
            'date' => '2016/4/23',
            'start_time' => '18:00',
            'end_time' => '20:00',
            'place' => '場所',
            'number_of_people' => '15',
            'description' => '備考',
        ];
        $this->request('POST', ['Events', 'create'], $post);

        $after = count($this->events_model->find());

        // 更新前の件数に1件追加されている
        $this->assertEquals($before + 1, $after);

        // Teardown ログアウト
        $this->request('GET', 'logout');
    }

    /**
     * @test
     */
    public function バリデーションチェックの確認()
    {
        // 管理者でログイン
        $data = ['email' => 'admin@admin.com','password' => 'admin'];
        $this->request('POST', '/', $data);

        // Setup
        $before = count($this->events_model->find());

        // 必須チェック
        $post = [
            'title' => '',
            'date' => '',
            'start_time' => '',
            'end_time' => '',
            'place' => '',
            'number_of_people' => '',
            'description' => '',
        ];
        $output = $this->request('POST', ['Events', 'create'], $post);
        $this->assertContains('タイトル欄は必須フィールドです', $output);
        $this->assertContains('日付欄は必須フィールドです', $output);
        $this->assertContains('募集人数欄は必須フィールドです', $output);

        // 日付妥当性チェック
        $post = [
            'title' => 'タイトル',
            'date' => '2016/13/99',
            'start_time' => '99:99',
            'end_time' => '99:99',
            'place' => '場所',
            'number_of_people' => 'a',
            'description' => '備考',
        ];
        $output = $this->request('POST', ['Events', 'create'], $post);
        $this->assertContains('日付欄は yyyy/mm/dd形式である必要があります。', $output);
        $this->assertContains('開始時間欄の時刻が正しくありません。', $output);
        $this->assertContains('終了時間欄の時刻が正しくありません。', $output);
        $this->assertContains('募集人数欄は0より大きい値でなければいけません。', $output);

        // 日付妥当性チェック
        $post = [
            'title' => 'タイトル',
            'date' => '2016/4/23',
            'start_time' => 'a',
            'end_time' => 'b',
            'place' => '場所',
            'number_of_people' => '15',
            'description' => '備考',
        ];
        $output = $this->request('POST', ['Events', 'create'], $post);
        $this->assertContains('開始時間欄は HH:MM形式である必要があります。', $output);
        $this->assertContains('終了時間欄は HH:MM形式である必要があります。', $output);

        // 日付妥当性チェック
        $post = [
            'title' => 'タイトル',
            'date' => '2016/4/23',
            'start_time' => 'aa:bb',
            'end_time' => 'cc:dd',
            'place' => '場所',
            'number_of_people' => '15',
            'description' => '備考',
        ];
        $output = $this->request('POST', ['Events', 'create'], $post);
        $this->assertContains('開始時間欄が数字ではありません。', $output);
        $this->assertContains('終了時間欄が数字ではありません。', $output);

        // 日付妥当性チェック
        $post = [
            'title' => 'タイトル',
            'date' => '2016/4/23',
            'start_time' => '-1:-2',
            'end_time' => '-3:-4',
            'place' => '場所',
            'number_of_people' => '15',
            'description' => '備考',
        ];
        $output = $this->request('POST', ['Events', 'create'], $post);
        $this->assertContains('開始時間欄の時刻が正しくありません。', $output);
        $this->assertContains('終了時間欄の時刻が正しくありません。', $output);

        $after = count($this->events_model->find());

        // 更新前後で件数が変わらない
        $this->assertEquals($before, $after);

        // Teardown ログアウト
        $this->request('GET', 'logout');
    }

    /**
     * @test
     */
    public function イベントを編集できる()
    {
        // 管理者でログイン
        $data = ['email' => 'admin@admin.com','password' => 'admin'];
        $this->request('POST', '/', $data);

        // SetUp データ
        $event = array(
            'title' => 'タイトル_変更前',
            'start_time' => '2016/4/23 18:00',
            'end_time' => '2016/4/23 20:00',
            'place' => '場所_変更前',
            'number_of_people' => '15',
            'description' => '備考_変更前'
        );
        $this->events_model->save($event);

        // Exercise
        $post = [
            'title' => 'タイトル_変更後',
            'date' => '2016/4/24',
            'start_time' => '19:00',
            'end_time' => '21:00',
            'place' => '場所_変更後',
            'number_of_people' => '16',
            'description' => '備考_変更後',
        ];
        $this->request('POST', ['Events', 'edit' ,$event['id']], $post);

        $sut = $this->events_model->find($event['id']);

        // Verify
        $this->assertEquals('タイトル_変更後', $sut['title']);
        $this->assertEquals('場所_変更後', $sut['place']);
        $this->assertEquals('16', $sut['number_of_people']);
        $this->assertEquals('備考_変更後', $sut['description']);
        // 詳細ページにリダイレクトする
        $this->assertRedirect('/events');

        // Teardown ログアウト
        $this->request('GET', 'logout');
    }

    /**
     * @test
     */
    public function 管理者はイベントの削除ができる()
    {
        // 管理者でログイン
        $data = ['email' => 'admin@admin.com','password' => 'admin'];
        $this->request('POST', '/', $data);

        $events = $this->events_model->find();
        $before = count($events);

        // Exercise
        $this->request('GET', ['Events', 'delete', $events[0]["id"]]);

        $after = count($this->events_model->find());

        // 1件削除されている
        $this->assertEquals($before - 1, $after);

        // Teardown ログアウト
        $this->request('GET', 'logout');
    }

    /**
     * @test
     */
    public function 一般ユーザーはイベントの削除ができない()
    {
        // 一般ユーザーでログイン
        $data = ['email' => 'email1@example.com','password' => 'password'];
        $this->request('POST', '/', $data);

        $events = $this->events_model->find();
        $before = count($events);

        // Exercise
        $this->request('GET', ['Events', 'delete', $events[0]["id"]]);

        $after = count($this->events_model->find());

        // 1件削除されていない
        $this->assertEquals($before, $after);
        // ホームにリダイレクトする
        $this->assertRedirect('/');

        // Teardown ログアウト
        $this->request('GET', 'logout');
    }

    /**
     * @test
     */
    public function paginationで次のページへ移動する()
    {
        self::setUpBeforeClass();

        // 管理者でログイン
        $data = ['email' => 'admin@admin.com','password' => 'admin'];
        $this->request('POST', '/', $data);

        // Exercise
        $output = $this->request('GET', ['Events', 'pages', '10']);

        // Verify
        $this->assertContains('イベント12', $output);

        // Teardown ログアウト
        $this->request('GET', 'logout');
    }
    
    /**
     * @test
     */
    public function 参加ボタンのクリック()
    {
        self::setUpBeforeClass();

        // 管理者でログイン
        $data = ['email' => 'admin@admin.com','password' => 'admin'];
        $this->request('POST', '/', $data);

        $expected = 1;

        $event_id = $this->events_model->get_max_id();
        $data = ['event_id' => $event_id,'status' => '1'];

        $this->ajaxRequest('POST', 'events/update_status', $data);
        $sut = $this->events_model->find($event_id);
        $this->events_model->get_attendee($sut);
        $this->assertEquals($expected, $sut['attend_count']);

        // Teardown ログアウト
        $this->request('GET', 'logout');
    }
}
