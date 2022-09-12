<?php


namespace App\Tests\Api;

use App\Error;
use App\Tests\ApiTester;
use Codeception\Example;
use Codeception\Util\HttpCode;

class SaveContactTestCest
{
    public function _before(ApiTester $I)
    {
    }

    /**
     * @param ApiTester $I
     * @param Example $example
     * @dataProvider SaveContactDataProvider
     */
    public function saveContactTest(ApiTester $I, Example $example)
    {
        $endPoint = "/v1.0/contact";

        $I->wantToTest($example['name']);

        $I->sendPost($endPoint, $example['body']);
        $I->seeResponseCodeIs($example['httpCode']);
        $I->seeResponseIsJson();

        if (HttpCode::BAD_REQUEST == $example['httpCode']) {
            $errorCode = $I->grabDataFromResponseByJsonPath('$errors[0].code');
            $I->assertEquals($errorCode[0], $example['errorCode']);
        }

        //@todo add check in db
    }

    private function SaveContactDataProvider()
    {
        return [
            [
                'name' => 'firstName empty',
                'body' => [],
                'errorCode' => Error::SAVE_CONTACT_FIRST_NAME_NOT_BLANK_CODE,
                'httpCode' => HttpCode::BAD_REQUEST
            ],
            [
                'name' => 'lastName empty',
                'body' => [
                    "firstName" => "Apfel"
                ],
                'errorCode' => Error::SAVE_CONTACT_LAST_NAME_NOT_BLANK_CODE,
                'httpCode' => HttpCode::BAD_REQUEST
            ],
            [
                'name' => 'address empty',
                'body' => [
                    "firstName" => "Apfel",
                    "lastName" => "Gurke"
                ],
                'errorCode' => Error::SAVE_CONTACT_ADDRESS_NOT_BLANK_CODE,
                'httpCode' => HttpCode::BAD_REQUEST
            ],
            [
                'name' => 'phone empty',
                'body' => [
                    "firstName" => "Apfel",
                    "lastName" => "Gurke",
                    "address" => "Munchen, Leopold Str 187"
                ],
                'errorCode' => Error::SAVE_CONTACT_PHONE_NOT_BLANK_CODE,
                'httpCode' => HttpCode::BAD_REQUEST
            ],
            [
                'name' => 'phone not valid',
                'body' => [
                    "firstName" => "Apfel",
                    "lastName" => "Gurke",
                    "address" => "Munchen, Leopold Str 187",
                    "phone" => "Munchen",
                ],
                'errorCode' => Error::SAVE_CONTACT_PHONE_REGEX_CODE,
                'httpCode' => HttpCode::BAD_REQUEST
            ],
            [
                'name' => 'birthday empty',
                'body' => [
                    "firstName" => "Apfel",
                    "lastName" => "Gurke",
                    "address" => "Munchen, Leopold Str 187",
                    "phone" => "491122334455",
                ],
                'errorCode' => Error::SAVE_CONTACT_BIRTHDAY_NOT_BLANK_CODE,
                'httpCode' => HttpCode::BAD_REQUEST
            ],
            [
                'name' => 'birthday not valid',
                'body' => [
                    "firstName" => "Apfel",
                    "lastName" => "Gurke",
                    "address" => "Munchen, Leopold Str 187",
                    "phone" => "491122334455",
                    "birthday" => "ssdf"
                ],
                'errorCode' => Error::SAVE_CONTACT_BIRTHDAY_NOT_VALID_DATETIME_CODE,
                'httpCode' => HttpCode::BAD_REQUEST
            ],
            [
                'name' => 'email empty',
                'body' => [
                    "firstName" => "Apfel",
                    "lastName" => "Gurke",
                    "address" => "Munchen, Leopold Str 187",
                    "phone" => "491122334455",
                    "birthday" => "1995-05-05"
                ],
                'errorCode' => Error::SAVE_CONTACT_EMAIL_NOT_BLANK_CODE,
                'httpCode' => HttpCode::BAD_REQUEST
            ],
            [
                'name' => 'email not valid',
                'body' => [
                    "firstName" => "Apfel",
                    "lastName" => "Gurke",
                    "address" => "Munchen, Leopold Str 187",
                    "phone" => "491122334455",
                    "birthday" => "1995-05-05",
                    "email" => "sss"
                ],
                'errorCode' => Error::SAVE_CONTACT_EMAIL_NO_VALID_EMAIL_CODE,
                'httpCode' => HttpCode::BAD_REQUEST
            ],
            [
                'name' => 'success',
                'body' => [
                    "firstName" => "Apfel",
                    "lastName" => "Gurke",
                    "address" => "Munchen, Leopold Str 187",
                    "phone" => "491122334456",
                    "birthday" => "1995-05-05",
                    "email" => "apfel.gurken@gmail.com"
                ],
                'errorCode' => null,
                'httpCode' => HttpCode::OK
            ],
        ];
    }
}
