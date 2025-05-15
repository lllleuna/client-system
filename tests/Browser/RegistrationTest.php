<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use App\Models\RegisteredUserController;

class RegistrationTest extends DuskTestCase
{

    /**
     * Test the registration page loads correctly
     */
    public function testRegistrationPageLoads()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/users/create')
                    ->assertSee('Transport Cooperative Registration')
                    ->assertSee('Create your account to access cooperative management services')
                    ->assertSee('Account Creation');
        });
    }


    /**
     * Test the submit button is disabled until all required fields are filled
     */
    public function testSubmitButtonDisabledUntilRequiredFieldsFilled()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/users/create')
                    ->assertDisabled('#submitBtn')
                    ->assertSeeIn('#submitBtn', 'Create Account');
        });
    }

    /**
     * Test the CDA registration number format validation
     */
    public function testCdaRegistrationNumberValidation()
{
    $this->browse(function (Browser $browser) {
        $browser->visit('/users/create')
                // Attempt to enter letters (should not be allowed)
                ->clear('cda_reg_no')
                ->type('cda_reg_no', 'ABC') 
                ->pause(500)
                // Assert that the field does not contain letters
                ->assertInputValue('cda_reg_no', '') // Field should remain empty

                // Attempt to enter numbers (should be accepted)
                ->type('cda_reg_no', '12345678')
                ->pause(500)
                // Assert that the field correctly accepts numbers
                ->assertInputValue('cda_reg_no', '12345678')

                // Test entering exactly 8 digits (should pass validation)
                ->clear('cda_reg_no')
                ->type('cda_reg_no', '12345678')
                ->pause(500)
                ->assertDontSee('Enter an 8-digit number');
    });
}



    /**
     * Test the password visibility toggle
     */
    public function testPasswordVisibilityToggle()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/users/create')
                    ->type('password', 'Password123!')
                    ->assertAttribute('input[name="password"]', 'type', 'password')
                    ->click('#togglePassword')
                    ->assertAttribute('input[name="password"]', 'type', 'text')
                    ->click('#togglePassword')
                    ->assertAttribute('input[name="password"]', 'type', 'password');
        });
    }

    /**
     * Test the password confirmation validation
     */
    public function testPasswordConfirmationValidation()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/users/create')
                    ->type('password', 'Password123!')
                    ->type('password_confirmation', 'Password123!')
                    ->assertSee('Passwords match')
                    ->clear('password_confirmation')
                    ->type('password_confirmation', 'Password!')
                    ->assertSee('Passwords do not match');
        });
    }

    /**
     * Test the password strength requirements
     */
    public function testPasswordStrengthRequirements()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/users/create')
                    // Test for length requirement
                    ->type('password', 'pass')
                    ->clear('password')
                    ->type('password', 'passwordpassword')
                    ->assertSee('Password must be at least 12 characters long.')
                    
                    // Test for uppercase requirement
                    ->clear('password')
                    ->type('password', 'passwordpassword')
                    ->clear('password')
                    ->type('password', 'passwordPassword')
                    ->assertSee('Password must contain at least one capital letter.')
                    
                    // Test for special character requirement
                    ->clear('password')
                    ->type('password', 'passwordPassword')
                    ->clear('password')
                    ->type('password', 'passwordPassword!')
                    ->assertSee('Password must contain at least one special character.');
        });
    }

    /**
     * Test the contact number format validation
     */
    public function testContactNumberValidation()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/users/create')
                    // Test entering letters (should not be accepted)
                    ->clear('contact_no')
                    ->typeSlowly('contact_no', 'abc')
                    ->pause(500)
                    ->assertInputValueIsNot('contact_no', 'abc') // Ensure field does not retain letters
                    ->assertSee('10 digits Only')

                    // Test entering more than 10 digits (should be limited)
                    ->clear('contact_no')
                    ->type('contact_no', '1234567890123')
                    ->pause(500)
                    ->assertInputValue('contact_no', '1234567890') // Ensure it truncates extra digits

                    // Test valid 10-digit input (should pass validation)
                    ->clear('contact_no')
                    ->type('contact_no', '9123456789')
                    ->pause(500)
                    ->assertDontSee('Enter 10 digits only');
        });
    }


    /**
     * Test ID type selection changes the ID number format hint
     */
    public function testIdTypeSelectionChangesFormatHint()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/users/create')
                    ->assertSee('Please select an ID type first')
                    ->select('id_type', 'passport')
                    ->assertSee('Format: Letter followed by 8 digits')
                    ->select('id_type', 'driver_license')
                    ->assertSee('Format: A12-345678 (New) or N12345678 (Old)')
                    ->select('id_type', 'sss')
                    ->assertSee('Format: 12-3456789-0');
        });
    }

    /**
     * Test successful form submission
     */
    public function testSuccessfulRegistration()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/users/create')
                    ->type('cda_reg_no', '12345678')
                    ->type('tc_name', 'Test Cooperative')
                    ->type('chair_fname', 'John')
                    ->type('chair_mname', 'M')
                    ->type('chair_lname', 'Doe')
                    ->type('chair_suffix', 'Jr')
                    ->type('contact_no', '9123456789')
                    ->select('id_type', 'passport')
                    ->type('id_number', 'P12345678')
                    ->type('email', 'test@example.com')
                    ->type('password', 'Password123!')
                    ->type('password_confirmation', 'Password123!')
                    ->assertEnabled('#submitBtn')
                    ->press('Create Account')
                    ->pause(2000);
        });
    }

    /**
     * Test email format validation
     */
    public function testEmailFormatValidation()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/users/create')
                    ->type('email', 'invalidemail')
                    ->assertSee('Please include an @ in the email address')
                    ->clear('email')
                    ->type('email', 'valid@example.com')
                    ->assertDontSee('Please include an @ in the email address');
        });
    }

    /**
     * Test unique email validation
     */
    public function testUniqueEmailValidation()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/users/create')
                    // Fill out the form with an existing email
                    ->type('cda_reg_no', '12345678')
                    ->type('tc_name', 'Test Cooperative')
                    ->type('chair_fname', 'John')
                    ->type('chair_lname', 'Doe')
                    ->type('contact_no', '9123456789')
                    ->select('id_type', 'passport')
                    ->type('id_number', 'P12345678')
                    ->type('email', 'jo@gmail.com') // Existing email Change
                    ->type('password', 'Password123!')
                    ->type('password_confirmation', 'Password123!')
                    
                    // Submit the form
                    ->press('Create Account')

                    // Wait for validation message instead of using pause
                    ->waitForText('The email has already been taken.')

                    // Ensure the form does NOT reset (email field should still have the entered value)
                    ->assertInputValue('email', 'jo@gmail.com'); //Existing email Change
        });
    }

}