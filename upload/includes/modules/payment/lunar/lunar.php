<?php


/**
 * @param array $payment_payload
 *
 * @return string
 */
function get_lunar_pay_script( $payment_payload = array() ) {
	$js = zen_draw_hidden_field( 'txn_no', '' ) . "\n\n";

	$js .= '<script src="https://sdk.paylike.io/a.js"></script>' . "\n" .
	       '<script type="text/javascript">' . "\n" .
	       'let publicKey = {key: "' . $payment_payload['publicId'] . '"}' . "\n" .
	       'let lunar = Paylike(publicKey)' . "\n" .
	       'function pay(e) { ' . "\n" .
	       ' e.preventDefault();' . "\n" .
	       ' lunar.pay({' . "\n" .
		   '    test: ' . $payment_payload['test_mode'] . ',' . "\n" .
	       '    title: "' . $payment_payload['popUpTitle'] . '",' . "\n" .
	       '    amount: { ' . "\n" .
		   '        currency: "' . $payment_payload['currency'] . '",' . "\n" .
		   '        exponent: ' . $payment_payload['exponent'] . ',' . "\n" .
		   '        value: ' . $payment_payload['amount'] . ',' . "\n" .
	       '	},' . "\n" .
	       '    locale: "' . $payment_payload['locale'] . '",' . "\n" .
	       '	custom: { ' . "\n" .
	       '        orderId: "' . $payment_payload['orderId'] . '",' . "\n" .
	       '		products: ' . $payment_payload['products'] . ',' . "\n" .
	       '		customer: {' . "\n" .
	       '			name: "' . $payment_payload['customer']['name'] . '",' . "\n" .
	       '			email: "' . $payment_payload['customer']['email'] . '",' . "\n" .
	       '			phoneNo: "' . $payment_payload['customer']['phoneNo'] . '",' . "\n" .
	       '			address: "' . $payment_payload['customer']['address'] . '",' . "\n" .
	       '			IP: "' . $payment_payload['customer']['ip'] . '"' . "\n" .
	       '		    },' . "\n" .
	       '        platform: {' . "\n" .
	       '            name: "Zen Cart",' . "\n" .
	       '            version: "' . $payment_payload['version'] . '",' . "\n" .
	       '            },' . "\n" .
	       '        module_version: {' . "\n" .
	       '            version: "' . $payment_payload['lunar_module_version'] . '",' . "\n" .
	       '            }' . "\n" .
	       '		}' . "\n" .
	       '	}, function(err, res) {' . "\n" .
	       '		if (err) {' . "\n" .
	       '			return console.log(err)' . "\n" .
	       '		} else {' . "\n" .
	       '			$("input[name=txn_no]").val(res.transaction.id) ' . "\n" .
	       '			$("#checkout_confirmation").attr("action", "' . zen_href_link( FILENAME_CHECKOUT_PROCESS, '', 'SSL' ) . '") ' . "\n" .
	       '     $("#btn_submit").attr("disabled", "disabled") ' . "\n" .
	       '			$("#checkout_confirmation").submit() ' . "\n" .
	       '		}' . "\n" .
	       '	})' . "\n" .
	       '}' . "\n" .
	       '</script>' . "\n\n";

	$js .= '<script type="text/javascript">' . "\n" .
	       '$(window).on("load", function() { ' . "\n" .
	       '	$("#btn_submit").attr("type", "button").attr("onclick", "pay(event)") ' . "\n" .
	       '}) ' . "\n\n" .
	       'function submitonce() { ' . "\n" .
	       '	return false ' . "\n" .
	       '} ' . "\n" .
	       '</script>';

	return $js;
}

/**
 * Write debug information to log file
 *
 * @param        $error
 * @param int    $lineNo
 * @param string $file
 */
function lunar_debug( $error, $lineNo = 0, $file = '' ) {
	$lunar_instance_id = time();
	$logfilename         = 'includes/modules/payment/lunar/logs/lunar_' . $lunar_instance_id . '.log';
	if ( defined( 'DIR_FS_LOGS' ) ) {
		$logfilename = DIR_FS_LOGS . '/lunar__' . $lunar_instance_id . '.log';
	}
	$fp = @fopen( $logfilename, 'a' );
	@fwrite( $fp, date( 'M d Y G:i' ) . ' -- ' . $error . "\n File:" . $file . "\n Line:" . $lineNo . "\n\n" );
	@fclose( $fp );
}

?>