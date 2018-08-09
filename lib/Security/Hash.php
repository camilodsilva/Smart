<?php

namespace Smart\Security;

class Hash
{

	/**
	 * @param string $algorithm The algorithm (md5, sha1, whirlpool, etx)
	 * @param string $data The data to encode
	 * @param string $salt the salt (This should be the same throughout the system probably)
	 * 
     * @return string The hashed/salted data
	 */
    public static function create($algorithm, $data, $salt)
    {
		$context = hash_init($algorithm, HASH_HMAC, $salt);
		hash_update($context, $data);

		return hash_final($context);
	}
}