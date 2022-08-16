<?php
define( 'MODULE_PAYMENT_LUNAR_TEXT_TITLE', 'Lunar' );
define( 'MODULE_PAYMENT_LUNAR_TEXT_DESCRIPTION', 'Lunar' );

define( 'TABLE_LUNAR', 'lunar' );


define( 'PL_TEXT_TXN_ID', 'Transaction ID' );
define( 'PL_TEXT_PAYMENT_STATUS', 'Payment Status' );
define( 'PL_TEXT_PAYMENT_DATE', 'Payment Date<br>(Y-m-d H:i:s)' );
define( 'PL_TEXT_ACTION', 'Action' );

define( 'MODULE_PAYMENT_LUNAR_AUTHORIZE_ORDER_STATUS_ID', 1 );

define( 'PL_CAPTURE_BUTTON_TEXT_FULL', 'Capture' );

define( 'MODULE_PAYMENT_LUNAR_REFUND_ORDER_STATUS_ID', 2 );
define( 'PL_REFUND_BUTTON_TEXT_FULL', 'Full Refund' );
define( 'PL_REFUND_BUTTON_TEXT', 'Refund' );
define( 'PL_REFUND_SECTION_TITLE', 'Order refund' );
define( 'PL_REFUND_TEXT_FULL_OR', 'or enter the partial ' );
define( 'PL_REFUND_AMOUNT_TEXT', 'Amount' );
define( 'PL_REFUND_PARTIAL_TEXT', 'refund amount here and click on Partial Refund' );
define( 'PL_REFUND_BUTTON_TEXT_PARTIAL', 'Partial Refund' );
define( 'PL_ACTION_FULL_REFUND', 'If you wish to refund this order in its entirety, click here:' );

define( 'PL_VOID_BUTTON_TEXT_FULL', 'Void' );


// ADMIN SETTINGS


define( 'PL_ADMIN_ENABLE_TITLE', 'Enable/Disable' );
define( 'PL_ADMIN_ENABLE_DESCRIPTION', '' );

define( 'PL_ADMIN_METHOD_TITLE_TITLE', 'Payment method title' );
define( 'PL_ADMIN_METHOD_TITLE_DESCRIPTION', '' );
define( 'PL_ADMIN_METHOD_TITLE_VALUE', 'Credit Card' );

define( 'PL_ADMIN_METHOD_DESCRIPTION_TITLE', 'Payment method description' );
define( 'PL_ADMIN_METHOD_DESCRIPTION_DESCRIPTION', '' );
define( 'PL_ADMIN_METHOD_DESCRIPTION_VALUE', 'Secure payment with credit card via © Lunar' );

define( 'PL_ADMIN_POPUP_TITLE_TITLE', 'Payment popup title' );
define( 'PL_ADMIN_POPUP_TITLE_DESCRIPTION', 'The text shown in the popup where the customer inserts the card details' );

/**
 * <p class="test-mode"> is added to some elements
 * to easily select & hide those fields if debug mode not enabled
 */
define( 'PL_ADMIN_TRANSACTION_MODE_TITLE', '<p class="test-mode">Transaction mode</p>' );
define( 'PL_ADMIN_TRANSACTION_MODE_VALUE', 'Live' ); // defaults to "Live" mode
define( 'PL_ADMIN_TRANSACTION_MODE_DESCRIPTION', '<p class="test-mode">In test mode, you can create a successful transaction with the card number 4100 0000 0000 0000 with any CVC and a valid expiration date</p>' );

define( 'PL_ADMIN_LIVE_MODE_APP_KEY_TITLE', 'App Key' );
define( 'PL_ADMIN_LIVE_MODE_APP_KEY_DESCRIPTION', 'Get it from your Lunar dashboard' );

define( 'PL_ADMIN_LIVE_MODE_PUBLIC_KEY_TITLE', 'Public Key' );
define( 'PL_ADMIN_LIVE_MODE_PUBLIC_KEY_DESCRIPTION', 'Get it from your Lunar dashboard' );

define( 'PL_ADMIN_TEST_MODE_APP_KEY_TITLE', '<p class="test-mode">Test mode App Key</p>' );
define( 'PL_ADMIN_TEST_MODE_APP_KEY_DESCRIPTION', '<p class="test-mode">Get it from your Lunar dashboard</p>' );

define( 'PL_ADMIN_TEST_MODE_PUBLIC_KEY_TITLE', '<p class="test-mode">Test mode Public Key</p>' );
define( 'PL_ADMIN_TEST_MODE_PUBLIC_KEY_DESCRIPTION', '<p class="test-mode">Get it from your Lunar dashboard</p>' );

define( 'PL_ADMIN_CAPTURE_MODE_TITLE', 'Capture mode' );
define( 'PL_ADMIN_CAPTURE_MODE_INSTANT', 'Instant' );
define( 'PL_ADMIN_CAPTURE_MODE_DELAYED', 'Delayed' );
define( 'PL_ADMIN_CAPTURE_MODE_DESCRIPTION', 'If you deliver your product instantly (e.g. a digital product), choose Instant mode. If not, use Delayed. In delayed mode you can capture the payment via the Transaction ID panel on the order edit page' );

define( 'PL_ADMIN_CHECKOUT_MODE_TITLE', 'Simulate order id on payment notes' );
define( 'PL_ADMIN_CHECKOUT_MODE_DESCRIPTION', 'Due to the payment taking place before the order is actually created, there is a way we can look into the database and see what the next order id could be. This works for most cases, but is not fool proof. <strong>Consider the limitations if you use this</strong>' );

define( 'PL_ADMIN_PAYMENT_ZONE_TITLE', 'Lunar Payment Zone' );
define( 'PL_ADMIN_PAYMENT_ZONE_DESCRIPTION', 'If you select a zone, you will limit the payment method for that zone' );

define( 'PL_ADMIN_CAPTURE_STATUS_TITLE', 'On capture set order status to:' );
define( 'PL_ADMIN_CAPTURE_STATUS_DESCRIPTION', 'When a capture is made the order gets moved into this status' );

define( 'PL_ADMIN_CANCEL_STATUS_TITLE', 'On void set order status to:' );
define( 'PL_ADMIN_CANCEL_STATUS_DESCRIPTION', 'When a void is made the order gets moved into this status' );

define( 'PL_ADMIN_REFUND_STATUS_TITLE', 'On refund set order status to:' );
define( 'PL_ADMIN_REFUND_STATUS_DESCRIPTION', 'When a refund is made the order gets moved into this status' );

define( 'PL_ADMIN_SORT_ORDER_TITLE', 'LUNAR Sort order of display.' );
define( 'PL_ADMIN_SORT_ORDER_DESCRIPTION', 'Sort order of LUNAR display. Lowest is displayed first.' );


// GATEWAY ERRORS

define( 'PL_ERROR', 'Error:' );
define( 'PL_ERROR_NOT_FOUND', 'Transaction not found! Check the transaction key used for the operation.' );
define( 'PL_ERROR_INVALID_REQUEST', 'The request is not valid! Check if there is any validation after this message and adjust if possible, if not, and the problem persists, contact the developer.' );
define( 'PL_ERROR_FORBIDDEN', 'The operation is not allowed! You do not have the rights to perform the operation, make sure you have all the grants required on your Lunar account.' );
define( 'PL_ERROR_UNAUTHORIZED', 'The operation is not properly authorized! Check the credentials set in settings for Lunar.' );
define( 'PL_ERROR_CONFLICT', 'The operation leads to a conflict! The same transaction is being requested for modification at the same time. Try again later.' );
define( 'PL_ERROR_API_CONNECTION', 'Network issues ! Check your connection and try again.' );
define( 'PL_ERROR_EXCEPTION', 'There has been a server issue! If this problem persists contact the developer.' );


// ADMIN COMMENTS

define( 'PL_COMMENT_AUTHORIZE', 'FUNDS AUTHORIZED. Transaction ID: ' );
define( 'PL_COMMENT_CAPTURE', 'FUNDS CAPTURED. Transaction ID: ' );
define( 'PL_COMMENT_AMOUNT', 'Amount: ' );
define( 'PL_COMMENT_ORDER', 'Order: ' );
define( 'PL_COMMENT_CAPTURE_SUCCESS', 'Transaction captured successfully. Order: ' );
define( 'PL_COMMENT_CAPTURE_FAILURE', 'Error when capturing -- transaction_id: ' );
define( 'PL_COMMENT_PARTIAL_REFUND_ERROR', 'You requested a partial refund but did not specify an amount.' );
define( 'PL_COMMENT_REFUND', 'REFUND COMPLETED. Transaction ID: ' );
define( 'PL_COMMENT_REFUND_SUCCESS', 'Transaction refunded successfully. Order: ' );
define( 'PL_COMMENT_REFUND_FAILURE', 'Error during refund -- transaction_id: ' );
define( 'PL_COMMENT_VOID', 'TRANSACTION VOIDED. Transaction ID: ' );
define( 'PL_COMMENT_VOID_SUCCESS', 'Transaction voided Successfully. Order: ' );
define( 'PL_COMMENT_VOID_FAILURE', 'Error during void -- transaction_id: ' );
define( 'PL_COMMENT_TRANSACTION_NOT_FOUND', 'Transaction id is not found. Order:' );
define( 'PL_COMMENT_TRANSACTION_EMPTY', 'Either transaction id is null or empty. Order:' );
define( 'PL_COMMENT_TRANSACTION_FETCH_ISSUE', 'Transaction details couldn\'t be retrieved. Transaction id:' );


// ADMIN WARNINGS

define( 'PL_WARNING_TESTING', 'in Testing mode' );
define( 'PL_WARNING_TESTING_NOT_CONFIGURED', 'Testing Mode Not Configured' );
define( 'PL_WARNING_TESTING_NOT_CONFIGURED_FRONTEND', 'Lunar (Test Account) is not configured yet.' );
define( 'PL_WARNING_LIVE_NOT_CONFIGURED', 'Lunar module Not Configured' );
define( 'PL_WARNING_LIVE_NOT_CONFIGURED_FRONTEND', 'Lunar module is not configured yet.' );


// ORDER SYSTEM GATEWAY ERROR

define( 'PL_ORDER_ERROR_TRANSACTION_MISSING', 'The transaction id is missing, it seems that the authorization failed or the reference was not sent. Please try the payment again. The previous payment will not be captured.' );
define( 'PL_ORDER_ERROR_TRANSACTION_MISMATCH', 'The transaction id couldn\'t be found, please contact the store owner, there may be a mismatch in configuration.' );
define( 'PL_ORDER_ERROR_TRANSACTION_AMOUNT_MISMATCH', 'The transaction amount is incorrect, please contact the store owner, there may be a mismatch in configuration.' );
define( 'PL_ORDER_ERROR_TRANSACTION_FAILURE', 'There is no history stored for this order, there has been an error during the transaction. Check the Lunar log files.' );


// PAYMENT STATUSES

define( 'PL_STATUS_AUTHORIZED', 'Authorized' );
define( 'PL_STATUS_CAPTURED', 'Captured' );
define( 'PL_STATUS_PARTIALLY_REFUNDED', 'Partially refunded' );
define( 'PL_STATUS_REFUNDED', 'Fully Refunded' );
define( 'PL_STATUS_CANCELLED', 'Cancelled' );


?>
