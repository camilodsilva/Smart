<?php

namespace Smart\Security;

use Firebase\JWT\JWT as JWT;
use Smart\Resolvers\Resolver as Resolver;
use Smart\Database\Database as Database;
use Exception as Exception;

class Auth extends Database
{
    private $credentials = null;
    private $security = null;

    public function __construct()
    {
        $this->credentials = Resolver::getDatabaseInformation();
        $this->security = Resolver::getSecurityInformation();

        if (!isset($_SERVER['REQUEST_METHOD']) || !isset($_SERVER['REQUEST_URI'])) {
            echo json_encode(array(
                'code' => 400,
                'status' => 'error',
                'message' => 'Bad Request'
            ));
            exit;
        }
        parent::__construct(
            $this->credentials['dbType'],
			$this->credentials['dbHost'],
			$this->credentials['dbName'],
			$this->credentials['dbUser'],
			$this->credentials['dbPass']
        );
    }

    public function getAuthorizationHeader()
    {
        $token = null;
        $headers = apache_request_headers();
        
        if (isset($headers['Authorization'])) {
            $matches = array();
            preg_match('/Basic (.*)/', $headers['Authorization'], $matches);
            if(isset($matches[1])){
                $token = $matches[1];
            }
        }

        return $token;
    }

    public function getToken($search, $users, $exp = 180)
    {
        $result = array(
            'code' => '0',
            'status' => 'error',
            'message' => 'No match found'
        );

        foreach ($users as $user) {
            foreach ($user as $attribute => $value) {
                if ($search === $value) {
                    $result = array(
                        'code' => 200,
                        'status' => 'success',
                        'message' => 'Valid login credentials.',
                        'userid' => $value
                    );
                }
            }
        }

        // TODO: Define how much time the token will be available
        // on success generate jwt
        if (isset($result['status']) && $result['status'] === 'success') {
            $userid = $result['userid'];
            $issuedAt = time();
            $expirationTime = $issuedAt + $exp;  // jwt valid for 180 seconds from the issued time
            $payload = array(
                'userid' => $userid,
                'iat' => $issuedAt,
                'exp' => $expirationTime
            );
            $key = $this->security['jwtKey'];
            $alg = $this->security['jwtAlgorithm'];
            $jwt = JWT::encode($payload, $key, $alg);
            $result['jwt'] = $jwt;
        }

        return $result;
    }

    public function validateToken($jwt = null)
    {
        $result = array(
            'code' => 404,
            'status' => 'error',
            'message' => 'Not allowed!'
        );

        if($jwt === null) {
            $token = self::getAuthorizationHeader();
        }

        if (isset($jwt)) {
            $key = $this->security['jwtKey'];
            
            try {
                $decoded = JWT::decode($jwt, $key, array('HS256'));
                $decoded_array = (array)$decoded;
                $result = array(
                    'code' => 200,
                    'status' => 'success',
                    //'data' => self::getUserAccountData($decoded_array['userid']),
                    'jwt_payload' => $decoded_array
                );
            } catch (\Exception $e) {
                $result = array(
                    'code' => 0,
                    'status' => 'error',
                    'message' => 'Invalid JWT - Authentication failed!'
                );
            }
        }

        return $result;
    }
}