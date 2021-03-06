<?php

return array(
    'dbError' => "<style>.dbError{padding: 2px;background-color: pink;border: 1px solid #f75353;color: #f75353;font-family:arial;}.dbError small{display: block;}</style><div class='dbError'>There has been an error, details below.<small>Connection Error No.: {0}</small><small>Connection Error Message: {1}.</small><small>Error No.: {2}</small><small>Error Message: {3}.</small></div>",
    //Validation errors
    'validationRequiredError' => "`{0}` is a required field.<br>",
    'validationEmailError' => "`{0}` must be a valid email address.<br>",
    'validationIntError' => "`{0}` must be a valid number without decimal, commas not allowed.<br>",
    'validationFloatError' => "`{0}` must be a valid number, decimals are allowed, commas not allowed.<br>",
    'validationIpError' => "`{0}` must be a valid IP address.<br>",
    'validationUrlError' => "`{0}` must be a valid URL.<br>",
    'validationDateError' => "`{0}` must be a valid date in `{1}` format.<br>",
    //General messages
    'noRecordFound' => "Sorry, no record found.",
    'invalidAccess' => "Sorry, you are not allowed to access this page.",
    'noDeletionRecordError' => 'Sorry, the record you are trying to delete cannot be found. It has either already been deleted or updated by another user.',
    'noRestorationRecordError' => 'Sorry, the record you are trying to restore cannot be found. It has either already been restored or updated by another user.',
    'recordDeleted' => 'This record has been deleted and can be restored till this screen is reloaded.',
    'recordDeletedNoRestoreAccess' => 'Record deleted successfully.',
    'recordRestored' => 'Record restored successfully.',
    'recordAdded' => 'Record added successfully.',
    'recordUpdated' => 'Record updated successfully.',
    'recordDuplicationError' => 'A record with the same `{0}` already exists.',
    'confirmationMessage' => 'Are you sure?',
    'submit' => 'Submit',
    'reset' => 'Reset',
    'addNew' => 'Add New..',
    'logIn' => 'Log In',
    'lostPassword' => 'Lost Password',
    'provideEmailBelow' => 'Provide your email address below.',
    'rememberMe' => 'Remember me.',
    'generalError' => 'Sorry, there has been an error, you may try again.',
    'invalidLogin' => 'Invalid login, please try again.',
    'edit' => 'Edit',
    'duplicate' => 'Duplicate',
    'delete' => 'Delete',
    'restore' => 'Restore',
    'search' => 'Search',
    'clearSearch' => 'Clear Search',
    'searchBy' => 'Search By',
    'sr' => 'Sr.',
    /* Pageset data starts */
    'manage' => 'Manage',
    'add' => 'Add',
    'update' => 'Update',
    'download' => 'Download',
    'select' => 'Select..',
        /* Pageset data ends */
);
