<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use \Firebase\JWT\JWT;

use Exception as phpException;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var CLIRequest|IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be loaded automatically upon
     * class instantiation. These helpers will be available
     * to all other controllers that extend BaseController.
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Constructor.
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        // Do Not Edit This Line
        parent::initController($request, $response, $logger);

        // Preload any models, libraries, etc, here.

        // E.g.: $this->session = \Config\Services::session();
    }

    /**
     * TOKEN KEY.
     */
    public function getKey() : string
    {
        return "03102000";
    }

    /**
     * Generate OTP.
     */
    public function generateOTP(int $n) : string
    {
        $generator = "1357902468";      
        $result    = "";
      
        for ($i = 1; $i <= $n; $i++) {
            $result .= substr($generator, (rand()%(strlen($generator))), 1);
        }
      
        return $result;
    }

    /**
     * Send Email OTP.
     */
    public function sendVerification(String $email,String $otp)
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();                          
            $mail->Host       = 'smtp.gmail.com';
            $mail->Username   = 'banksampahbudiluhur@gmail.com';
            $mail->Password   = 'latxapaiejnamadl';
            $mail->Port       = 465;
            $mail->SMTPAuth   = true;
            $mail->SMTPSecure = 'ssl';
            $mail->Subject    = 'code OTP';
            $mail->Body       = "Terimakasih sudah bergabung bersama Bank Sampah Budiluhur.<br>berikut adalah code OTP anda:<br><h1>$otp</h1>";

            $mail->setFrom('banksampahbudiluhur@gmail.com', 'Bank Sampah Budiluhur');
            $mail->addAddress($email);
            $mail->isHTML(true);

            if($mail->send()) {
                return true;
            }
        } 
        catch (Exception $e) {
            return $e;
        }
    }

    /**
     * Generate New Token.
     */
    public function generateToken(string $id,string $id_nasabah,bool $rememberme): string
    {
        // $iat = time(); // current timestamp value
        // $nbf = $iat + 10;

        $payload = array(
            // "iat" => $iat, // issued at
            // "nbf" => $nbf, //not before in seconds
            "id"         => $id,
            "id_nasabah" => $id_nasabah,
            "expired"    => ($rememberme == true) ? time()+2592000 : time()+3600, 
        );

        return JWT::encode($payload, $this->getKey());
    }

    /**
     * Check token.
     */
    public function checkToken(string $token): array
    {
        try {
            $db          = \Config\Database::connect();
            $dataNasabah = $db->table('nasabah')->where("token", $token)->get()->getResultArray();
        } 
        catch (phpException $e) {
            return [
                'success' => false,
                'code'    => 500,
                'message' => $e->getMessage()
            ];
        }

        if (!empty($dataNasabah)) {
            try {
                $key     = $this->getKey();
                $decoded = JWT::decode($token, $key, array("HS256"));
                $decoded = (array)$decoded;
    
                if (time() < $decoded['expired']) {
    
                    $response = [
                        'status'   => 200,
                        'error'    => false,
                        'data'     => [
                            'id'         => $decoded['id'],
                            'id_nasabah' => $decoded['id_nasabah'],
                            'expired'    => $decoded['expired'] - time(),
                        ]
                    ];
    
                    return [
                        'success' => true,
                        'message' => $response
                    ];
                } 
                else {
                    try {
                        // set nasabah token null in database 
                        $data = [
                            'token' => null
                        ];

                        $db->table('nasabah')->where('token', $token)->update($data);
                        
                        if ($db->affectedRows()> 0) {
                            return [
                                'success' => false,
                                'code'    => 401,
                                'message' => 'token expired'
                            ];
                        }
                    } 
                    catch (phpException $e) {
                        return [
                            'success' => false,
                            'code'    => 500,
                            'message' => $e->getMessage()
                        ];
                    }
                }
            } 
            catch (phpException $ex) {
                return [
                    'success' => false,
                    'code'    => 401,
                    'message' => 'invalid token'
                ];
            }
        } 
        else {
            return [
                'success' => false,
                'code'    => 401,
                'message' => 'access denied'
            ];
        }
    }

    /**
     * Method Parser.
     */
    function _methodParser(string $variableName): void
    {
        // global $_PUT;

        $putdata  = fopen("php://input", "r");
        $raw_data = '';

        while ($chunk = fread($putdata, 1024))
            $raw_data .= $chunk;

        fclose($putdata);

        $boundary = substr($raw_data, 0, strpos($raw_data, "\r\n"));

        if(empty($boundary)){
            parse_str($raw_data,$data);
            $GLOBALS[ $variableName ] = $data;
            return;
        }

        $parts = array_slice(explode($boundary, $raw_data), 1);
        $data  = array();

        foreach ($parts as $part) {
            if ($part == "--\r\n") break;

            $part = ltrim($part, "\r\n");
            list($raw_headers, $body) = explode("\r\n\r\n", $part, 2);

            $raw_headers = explode("\r\n", $raw_headers);
            $headers = array();
            foreach ($raw_headers as $header) {
                list($name, $value) = explode(':', $header);
                $headers[strtolower($name)] = ltrim($value, ' ');
            }

            if (isset($headers['content-disposition'])) {
                $filename = null;
                $tmp_name = null;
                preg_match(
                    '/^(.+); *name="([^"]+)"(; *filename="([^"]+)")?/',
                    $headers['content-disposition'],
                    $matches
                );
                
                if(count($matches) !== 0){
                    list(, $type, $name) = $matches;
                }

                if( isset($matches[4]) )
                {
                    if( isset( $_FILES[ $matches[ 2 ] ] ) )
                    {
                        continue;
                    }

                    $filename       = $matches[4];
                    $filename_parts = pathinfo( $filename );
                    $tmp_name       = tempnam( ini_get('upload_tmp_dir'), $filename_parts['filename']);

                    $_FILES[ $matches[ 2 ] ] = array(
                        'error'=>0,
                        'name'=>$filename,
                        'tmp_name'=>$tmp_name,
                        'size'=>strlen( $body ),
                        'type'=>$value
                    );

                    file_put_contents($tmp_name, $body);
                }
                else
                {
                    $data[$name] = substr($body, 0, strlen($body) - 2);
                }
            }

        }
        $GLOBALS[ $variableName ] = $data;
        return;
    }
}
