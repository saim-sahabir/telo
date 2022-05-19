<?php 
class Custom{
	
	function encrypt_decrypt($key, $type){	
			# type = encrypt/decrypt
		   $CI =& get_instance();
			$secret = "APANaga262gagtByIGI1BpVXZTJagaga6526gcsAG8GZl8pagagadwwa84";
			if( !$key ){ return false; }
			
			if($type=='decrypt'){
				$key = urldecode($key);
				$string = strtr(
        $key,
        array(
            '.' => '+',
            '-' => '=',
            '~' => '/'
        )
       );

				$original = $CI->encrypt->decode($string,$secret);
				return $original;
				
			}elseif($type=='encrypt'){

				$verification_key = $CI->encrypt->encode($key,$secret);
				return urlencode(strtr(
            $verification_key,
            array(
                '+' => '.',
                '=' => '-',
                '/' => '~'
            )
            )
			);
			}
			
			return FALSE;	# if function is not used properly
		}
	}
?>