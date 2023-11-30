<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class RegistrationTest extends DuskTestCase
{

    public function test_homepage(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    //->screenshot('home-' . now()->format('Y-m-d_His'))
                    ->screenshot('homepage')
                    ->assertSee('Latest Blog News');
        });
    }

    public function test_registration(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visitRoute('register')
                ->type('name', 'John Test')
                ->type('username', 'testuser9')
                ->type('email', 'testuser9@example.com')
                ->type('password', 'test123')
                ->screenshot('register')
                ->press('Submit')
                ->assertRouteIs('home')
                ->screenshot('home_after_registration');
        });
    }
}
