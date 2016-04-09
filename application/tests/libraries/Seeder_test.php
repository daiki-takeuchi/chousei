<?php

class Seeder_test extends TestCase
{
    public function setUp()
    {
        $this->obj = new Seeder();
        $this->resetInstance();
        $this->CI->load->model('Users_model');
        $this->users_model = $this->CI->Users_model;
    }

    /**
     * @test
     */
    public function Seederの実行()
    {
        $expected = 3;
        $this->obj->call('UsersSeeder');
        $this->assertEquals($expected, $this->users_model->get_count_all());
    }
}