<?php

namespace Tests\Unit;

use App\Models\Poll;
use Tests\CreatesApplication;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\BrowserKitTesting\TestCase as BaseTestCase;

class PollTest extends BaseTestCase
{
    use CreatesApplication;

    public $baseUrl = 'http://localhost';
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->visit('/')
            ->see('Make your questionnaire')  ;
        $this->assertTrue(true);
    }
    public function testLogin()
    {
        $this->visit('/login')
            ->see('Login')
            ->type('olya@gmail.com','email')
            ->type('olya123','password')
            ->press('Login')
            ->seePageIs('/home')
            ->see('Olya')
        ;
        $this->assertTrue(true);
    }
    public function testCreate()
    {
        $oldcount = Poll::all()->count();
        $this->visit('/login')
            ->see('Login')
            ->type('olya@gmail.com','email')
            ->type('olya123','password')
            ->press('Login')
            ->seePageIs('/home')
            ->click('Polls')
            ->seePageIs('/polls')
            ->click('Create a new poll')
            ->seePageIs('/polls/create')
            ->see('Create a new poll')
            ->type('New test poll','title')
            ->type('This one test poll','text')
            ->press('Ok')
            ->seePageIs('/polls')
            ;
        $newcount = Poll::all()->count();
        $this->assertEquals($oldcount+1,$newcount);
        $this->seeInDatabase('poll',['title'=>'New test poll','text'=>'This one test poll']);

    }
    public function testDelete()
    {
        $oldcount = Poll::all()->count();
        $onepoll = Poll::all()->last();
        $this->visit('/login')
            ->see('Login')
            ->type('olya@gmail.com','email')
            ->type('olya123','password')
            ->press('Login')
            ->seePageIs('/home')
            ->click('Polls')
            ->seePageIs('/polls')
            ->press('delete-'.$onepoll->id)
        ;
        $newcount = Poll::all()->count();
        $this->assertEquals($oldcount-1,$newcount);
        $this->dontSeeInDatabase('poll',['id'=>$onepoll->id,'title'=>$onepoll->title,'text'=>$onepoll->text]);
    }



    /**
     * Creates the application.
     *
     * Needs to be implemented by subclasses.
     *
     * @return \Symfony\Component\HttpKernel\HttpKernelInterface
     */

}
