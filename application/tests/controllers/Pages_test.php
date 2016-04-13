<?php

/**
 * Created by PhpStorm.
 * User: daiki_takeuchi
 * Date: 2015/09/08
 * Time: 8:41
 */
class Pages_test extends TestCase
{

    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();

        $CI =& get_instance();
        $CI->load->library('Seeder');
        $CI->seeder->call('UsersSeeder');
    }

    public function setUp()
    {
        // Teardown ログアウト
        $this->request('GET', 'logout');
    }

    /**
     * @test
     */
    public function 引数なしでindexページへ移動した場合はログインへ遷移()
    {
        $output = $this->request('GET', ['Pages', 'index']);
        $this->assertContains('<title>Login | 調整くん</title>', $output);
    }

    /**
     * @test
     */
    public function ログインしている場合にindexページへ移動した場合はホームへ遷移()
    {
        $data = [
            'email' => 'email1@example.com',
            'password' => 'password',
        ];
        // ログイン
        $this->request('POST', '/', $data);

        // ログインしている場合にindexページへ移動した場合はホームへ遷移
        $this->request('GET', ['Pages', 'index']);
        $this->assertRedirect('/home', 302);

        // Teardown ログアウト
        $this->request('GET', 'logout');
    }

    /**
     * @test
     */
    public function ログインしている場合にログインするとホームに遷移()
    {
        $data = [
            'email' => 'email1@example.com',
            'password' => 'password',
        ];
        // ログインするとホームに遷移する
        $this->request('POST', '/', $data);
        $this->assertRedirect('/home', 302);

        // ログイン状態でログイン画面に遷移するとホームに遷移する
        $this->request('GET', '/');
        $this->assertRedirect('/home', 302);

        // Teardown ログアウト
        $this->request('GET', 'logout');
    }

    /**
     * @test
     */
    public function パスワードが違う場合はログインできない()
    {
        $data = [
            'email' => 'email1@example.com',
            'password' => 'bad password',
        ];
        // ログインする
        $output = $this->request('POST', '/', $data);
        $this->assertContains('メールアドレスかパスワードが異なります。', $output);
    }

    /**
     * @test
     */
    public function 存在しないemailの場合はログインできない()
    {
        $data = [
            'email' => 'not_exist_email@example.com',
            'password' => 'password',
        ];
        // ログインする
        $output = $this->request('POST', '/', $data);
        $this->assertContains('メールアドレスかパスワードが異なります。', $output);
    }

    /**
     * @test
     */
    public function ホームに遷移()
    {
        $data = [
            'email' => 'email1@example.com',
            'password' => 'password',
        ];

        // ログインするとホームに遷移する
        $this->request('POST', '/', $data);

        // ログイン状態でホーム画面に遷移するとホームに遷移する
        $output = $this->request('GET', 'home');
        $this->assertContains('<title>ホーム | 調整くん</title>', $output);

        // Teardown ログアウト
        $this->request('GET', 'logout');
    }

    /**
     * @test
     */
    public function ログインしてない場合にホームに遷移するとログインにリダイレクト()
    {
        // ログインしてない場合にホームに遷移するとログインにリダイレクトする
        $this->request('GET', 'home');
        $this->assertRedirect('/', 302);
    }

    /**
     * @test
     */
    public function test_APPPATH()
    {
        $actual = realpath(APPPATH);
        $expected = realpath(__DIR__ . '/../..');
        $this->assertEquals(
            $expected,
            $actual,
            'Your APPPATH seems to be wrong. Check your $application_folder in tests/Bootstrap.php'
        );
    }
}
