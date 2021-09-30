<?php

require_once './includes/functions.inc.php'; // Imports functions

$GLOBALS["conn"] = mysqli_connect('localhost', 'root', '', 'oyinmobile', 3306, '../../../../../Applications/XAMPP/xamppfiles/var/mysql/mysql.sock');

class FunctionTest extends \PHPUnit\Framework\TestCase
{

    public function testEmptyInputSignUpReturnsTrueIfAnyInputIsEmpty()
    {
        $this->assertTrue(emptyInputSignup("Jane", "Doe", "", "123", "123"));
    }

    public function testIfInvalidEmailReturnsFalseForInvalidEmailFormat()
    {
        $this->assertTrue(invalidEmail("invalidemail"));
    }

    public function testPasswordMatchReturnsTrueIfPasswordsDonotMatch()
    {
        $this->assertTrue(pwdMatch("hA*dPass", "Password"));
    }

    public function testEmailExistsReturnsArrayIfEmailAlreadyInDatabase()
    {
        $this->assertIsArray(emailExists($GLOBALS["conn"], "john@gmail.com"));
    }

    public function testEmptySearchReturnsTrueIfNothingIsTypedInSearchInput()
    {
        $this->assertTrue(emptySearch(""));
    }

    public function testEmptyInputLoginReturnsTrueIfNoEmailOrPasswordIsTypedInLoginInput()
    {
        $this->assertTrue(emptyInputLogin("email@gmail.com", ""));
    }

    public function testEmptyInputAddphoneReturnsTrueIfAnyFieldIsLeftEmptyWhenAddingNewPhone()
    {
        $this->assertTrue(emptyInputAddphone('phone_name', 'curr_owner', 'prev_owner', 'imei', 'purchased_from', 'date_purchased', 'reported_stolen', ''));
    }

    public function testPhoneUploadsFolderExistAndIsWritable()
    {
        $this->assertDirectoryExists('../MobileVerificationApplication/phone_uploads');
        $this->assertDirectoryIsWritable('../MobileVerificationApplication/phone_uploads');
    }
}
