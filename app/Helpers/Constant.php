<?php

namespace App\Helpers;

class Constant
{
   /*
   |--------------------------------------------------------------------------
   | Query Constants
   |--------------------------------------------------------------------------
   | Here is where you can define all query constants.
   |
   */
   const PER_PAGE = 10;
   const ORDER_BY_COLUMN = 'id';
   const ORDER_BY_VALUE = 'desc';

   /*
   |--------------------------------------------------------------------------
   | Default CRUD operation messages
   |--------------------------------------------------------------------------
   | Here is where you can define all CRUD operation or any exception messages.
   |
   */
   const MESSAGE_FETCHED = 'Record fetched successfully.';
   const MESSAGE_CREATED = 'Record created successfully.';
   const MESSAGE_UPDATED = 'Record updated successfully.';
   const MESSAGE_DELETED = 'Record deleted successfully.';
   const RECORD_NOTFOUND = 'Oops! Record does not exist.';
   const MESSAGE_UNKNOWN = 'Something went wrong, Please try again.';
   const MESSAGE_LOGIN = 'Logged in successfully.';
   const MESSAGE_LOGOUT = 'Logged out successfully.';
   const MESSAGE_INVALID_CREDENTIALS = 'Incorrect credentials, Please try again.';
   const MESSAGE_DEACTIVATED = 'Your account is deactivated, Please contact admin.';
   const MESSAGE_UNAUTHORIZED = 'Unauthorized';
}
