<?php
namespace Steven;
//namespace Doctrine\Common\Cache;

require '../vendor/autoload.php';

use Psr\SimpleCache\InvalidArgumentException;
use Steven\Cache\SessionCache;
use Steven\PersistentData\PersistentDataInterface;
use Steven\PersistentData\PersistentDataFactory;
use Doctrine\Common\Cache\ArrayCache;

use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Cache\Psr16Cache;

//use Steven\Cache\SessionCache;
//session_start();

class SDK{

    private $persistent;

    public function __construct($drive='')
    {
        $this->persistent = PersistentDataFactory::createPersistentDataHandler($drive);
    }

    public function setToken($token_str)
    {
        $this->persistent->set('token', $token_str);
    }

    public function setMutilToken($token_str){
        try {
            $this->persistent->setMultiple($token_str, 20);
        } catch (InvalidArgumentException $e) {
            return $e;
        }
    }

    public function getToken()
    {
        return $this->persistent->get('token');
    }

    private function hasToken($key)
    {
        return ($this->persistent->has($key));
    }

    public function getResult($token_str)
    {
        $token = $this->persistent->get('token');
        if ($token === $token_str && !is_null($token)){
            return 'this is result with token:'.$token;
        }

        if(!$this->hasToken('token')){
            return 'error you don not have token or expired';
        }
    }
}

//$SessionCache = new SessionCache();
//$cache = new SessionCache();
echo time().PHP_EOL;
$cache = new FilesystemAdapter();
$psr16Cache = new Psr16Cache($cache);

$array = array('key' => 'key123', 'token' => 'token_1234567890');
$sdk = new SDK($psr16Cache);
//$sdk->setMutilToken($array);
$token = $sdk->getToken();
$r = $sdk->getResult($token);
var_dump($r);