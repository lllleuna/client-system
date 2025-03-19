<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\User;

class LoginTest extends DuskTestCase
{
    /**
     * Test that the homepage loads correctly with login button.
     *
     * @return void
     */
    public function testHomePageLoadsWithLoginButton()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('OFFICE OF TRANSPORTATION COOPERATIVES')
                    ->assertSee('INNOVATION TOWARDS MODERNIZATION')
                    ->assertPresent('button[onclick="openModal(\'modallog\')"]');
        });
    }

    /**
     * Test that the login modal appears when the login button is clicked.
     *
     * @return void
     */
    public function testLoginModalOpensWhenButtonClicked()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->click('button[onclick="openModal(\'modallog\')"]')
                    ->waitFor('form#log_form') // Wait for the modal to appear
                    ->assertVisible('form#log_form')
                    ->assertSee('Welcome!')
                    ->assertSee('Please sign in to your account');
        });
    }

    /**
     * Test login with valid credentials.
     *
     * @return void
     */
    public function testUserCanLoginWithValidCredentials()
{
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->click('button[onclick="openModal(\'modallog\')"]')
                    ->waitFor('form#log_form')
                    ->type('email_login', 'jo@gmail.com') //Change to Legit email
                    ->type('password', 'Pasdasdawqesd%343') // Change to Legit Password
                    ->press('Sign in')
                    ->waitForLocation('/email/verify') 
                    ->assertPathIs('/email/verify');
                    // ->screenshot('login-success'); // Take a screenshot for verification
        });
    }


    /**
     * Test login with invalid credentials.
     *
     * @return void
     */
    public function testUserCannotLoginWithInvalidCredentials()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->click('button[onclick="openModal(\'modallog\')"]')
                    ->waitFor('form#log_form')
                    ->type('email_login', 'wrong@example.com')
                    ->type('password', 'incorrect')
                    ->press('Sign in')
                    // After failed login, we should still be on the same page with the modal open
                    ->assertPathIs('/') 
                    ->assertVisible('form#log_form');
        });
    }

    /**
     * Test validation errors for empty fields.
     *
     * @return void
     */
    public function testLoginValidationErrors()
{
    $this->browse(function (Browser $browser) {
        $browser->visit('/')
                ->click('button[onclick="openModal(\'modallog\')"]') // Open login modal
                ->waitFor('form#log_form') // Wait for form to be visible
                ->type('email_login', 'johnmichaelcruz0937@gmail.com') // Enter email
                ->type('password', 'wrongpassword123') // Enter incorrect password
                ->press('Sign in') // Submit the form
                ->pause(500) // Allow time for the response
                ->waitForText('Email not found.') // Wait for error message
                ->assertSee('Email not found.'); // Assert the message appears
    });
}


    /**
     * Test that the login modal can be closed.
     *
     * @return void
     */
    public function testLoginModalCanBeClosed()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->click('button[onclick="openModal(\'modallog\')"]')
                    ->waitFor('form#log_form')
                    ->assertVisible('form#log_form')
                    // Click the close button
                    ->click('#modallog button.text-gray-400') // Update with your actual close button selector
                    ->pause(500) // Give time for modal animation
                    ->assertMissing('form#log_form:not([style*="display: none"])'); // Check modal is hidden
        });
    }
}