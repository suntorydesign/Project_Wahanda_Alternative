<?php


// Config database
define('DB_TYPE', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'dbwahanda');
define('DB_USER', 'root');
define('DB_PASS', '');

// The sitewide hashkey, do not change this because its used for passwords!
// This is for other hash keys... Not sure yet
define('HASH_GENERAL_KEY', 'MixitUp200');

// This is for database passwords only
define('HASH_PASSWORD_KEY', 'dvlGroupbestgroupITinVietNam');

// eVoucher due date
define('EVOUCHER_DUE_DATE', 5);

// Max eVoucher quantity
define('MAX_QUANTITY_EVOUCHER', 9);

// Max pagination item
define('MAX_PAGINATION_ITEM', 1);

//IDLE TIME (secs)
define('IDLE_TIME', 60*9);

//IDLE TIME (milisecs)
define('IDLE_CHECK', 60000*1);

//RESULT PER SHOW MORE
define('RESULT_PER_SHOW_MORE', 2);

