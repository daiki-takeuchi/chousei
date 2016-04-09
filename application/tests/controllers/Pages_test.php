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

    /**
     * @test
     */
    public function 引数なしでindexページへ移動した場合はホームへ遷移()
    {
        $output = $this->request('GET', ['Pages', 'index']);
        $this->assertContains('ようこそホームへ！', $output);
    }

    /**
     * @test
     */
    public function 引数にaboutを指定した場合はaboutページへ遷移()
    {
        $output = $this->request('GET', ['Pages', 'index','about']);
        $this->assertContains('about', $output);
    }

    /**
     * @test
     */
    public function 引数に存在しないページを指定した場合は404へ遷移()
    {
        $this->request('GET', ['Pages', 'index', 'aaa']);
        $this->assertResponseCode(404);
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
