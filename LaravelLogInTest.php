<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;


class LaravelLogInTest extends DuskTestCase
{
    //You should enter email and password which are not in database.
   //Password must be 6 characters long.
   public $firstname= 'Miks';
   public $email= 'miksmiksic@gmail.com';
   public $password= 'luksiiadii';


//Test 1
    public function testCanNotSeeHome()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/home')
            ->assertDontSee('Dashboard');
        });
    }

//Test 2
     public function testRegister()
    {
         
        $this->browse(function (Browser $browser) 
        {
            $browser->visit('/register')
                    ->type('name', $this->firstname)
                    ->type('email', $this->email)
                    ->type('password', $this->password)
                    ->type('password_confirmation',$this->password)
                    ->click('button[type="submit"]')
                    ->pause(2000)
                    ->assertSee('Dashboard')
                    ->assertPathIs('/home')
                    ->click('a[id="navbarDropdown"]')
                    ->click('#navbarSupportedContent > ul.navbar-nav.ml-auto > li > div > a');
        }); 
     } 

//Test 3
       public function testLogIn()
    {

        
         $this->browse(function (Browser $browser) 
         {

         $browser->visit('/login')
                  ->type('email', $this->email)
                  ->type('password', $this->password)
                  ->click('button[type="submit"]')
                  ->assertPathIs('/home')
                  ->assertSee('You are logged in!');
       });
    }


//Test 4
    public function testLogOut()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/home')
                    ->click('a[id="navbarDropdown"]')
                    ->click('#navbarSupportedContent > ul.navbar-nav.ml-auto > li > div > a')
                    ->pause(1000)
                    ->assertSee('Laravel')
                    ->assertPathIs('/');
        });
    }

//Test 5
    public function testUserCanSeeHomePage()
    {
        $this->browse(function (Browser $browser) {
            $browser
            ->visit('/login')
            ->type('email', $this->email)
            ->type('password', $this->password)
            ->click('button[type="submit"]')
            ->assertSee('Dashboard');
        });
    }


}


