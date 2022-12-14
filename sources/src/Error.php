<?php

declare(strict_types=1);


namespace App;

class Error
{
    const SAVE_CONTACT_FIRST_NAME_NOT_BLANK_CODE = 1;
    const SAVE_CONTACT_LAST_NAME_NOT_BLANK_CODE = 2;
    const SAVE_CONTACT_ADDRESS_NOT_BLANK_CODE = 3;
    const SAVE_CONTACT_PHONE_NOT_BLANK_CODE = 4;
    const SAVE_CONTACT_BIRTHDAY_NOT_BLANK_CODE = 5;
    const SAVE_CONTACT_EMAIL_NOT_BLANK_CODE = 6;
    const SAVE_CONTACT_PHONE_REGEX_CODE = 7;
    const SAVE_CONTACT_BIRTHDAY_NOT_VALID_DATETIME_CODE = 8;
    const SAVE_CONTACT_EMAIL_NO_VALID_EMAIL_CODE = 9;
    const SAVE_CONTACT_DB_EXCEPTION_CODE = 10;

    const SEARCH_CONTACT_NAME_NOT_BLANK_CODE = 11;
}