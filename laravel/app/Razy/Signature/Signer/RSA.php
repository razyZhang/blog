<?php

namespace App\Razy\Signature\Signer;

use App\Razy\Signature\Contracts\Signer;

class RSA extends AbstractSigner implements Signer
{

    protected $cert;
    /**
     * public key for veirfy.
     *
     * @var mixed
     */
    protected $publicKey;

    /**
     * private key for sign.
     *
     * @var mixed
     */
    protected $privateKey;

    /**
     * algo.
     *
     * @var string
     */
    protected $algo;

    /**
     * Constructor.
     *
     * @param array $config
     */
    protected $config;

    public function __construct(array $config = [])
    {
        $this->setConfig($config);
        $this->config = $config;
    }

    /**
     * setPublicKey.
     *
     * @param mixed $publicKey
     *
     * @return $this
     */

    public function createKey($userinfo){

        $private_key = openssl_pkey_new(array(
            'digest_alg'        =>  $this->config['algo'], 
            'private_key_bits'  =>  $this->config['private_key_bits'],
        ));
        $csr = openssl_csr_new($userinfo,$private_key);
        $sscert = openssl_csr_sign($csr,null,$private_key,$this->config['vaild_time']);
        if (openssl_x509_export($sscert,$cert_key_string)) {
            $pub_src = openssl_pkey_get_public($cert_key_string);
            $pub_arr = openssl_pkey_get_details($pub_src);
            $pri_key ='';
            openssl_pkey_export($private_key,$pri_key);
            return array('public' => $pub_arr['key'],'private' => $pri_key);
        }else{
            return false;
        }
    }

    public function setPublicKey($publicKey)
    {
        $this->publicKey = $publicKey;

        return $this;
    }

    /**
     * getPublicKey.
     *
     * @return string
     */
    public function getPublicKey()
    {
        if (is_file($this->publicKey)) {
            return file_get_contents($this->publicKey);
        }

        return $this->publicKey;
    }

    /**
     * setPrivateKey.
     *
     * @param mixed $privateKey
     *
     * @return $this
     */

    public function readCert($certString,$username){
        $certs = [];
        openssl_pkcs12_read($certString,$certs,$username);
        $this->privateKey = $certs['pkey'];
        $this->cert = $certs['cert'];
        return $this;
    }

    public function setPrivateKey($privateKey)
    {

        $this->privateKey = $privateKey;

        return $this;
    }

    /**
     * getPrivateKey.
     *
     * @return string
     */
    public function getPrivateKey()
    {
        if (is_file($this->privateKey)) {
            return file_get_contents($this->privateKey);
        }

        return $this->privateKey;
    }

    /**
     * setAlgo.
     *
     * @param string $algo
     *
     * @return $this
     */
    public function setAlgo($algo)
    {
        $this->algo = $algo;

        return $this;
    }

    /**
     * getAlgo.
     *
     * @return string
     */
    public function getAlgo()
    {
        if ($this->algo && in_array($this->algo, openssl_get_md_methods(true))) {
            return $this->algo;
        }

        return 'sha256';
    }

    /**
     * make a signature.
     *
     * @param array $params
     *
     * @return string
     */
    public function sign($data)
    {
        $signString = $this->getSignString($data);

        $pkeyid = openssl_pkey_get_private($this->getPrivateKey());

        openssl_sign($signString, $signature, $pkeyid, $this->getAlgo());

        openssl_free_key($pkeyid);

        return base64_encode($signature);
    }

    /**
     * verify a sign.
     *
     * @param mixed $sign
     * @param array $params
     *
     * @return bool
     */
    public function verify($signature, $data)
    {
        $signature = base64_decode($signature);

        $signString = $this->getSignString($data);

        $pubkeyid = openssl_pkey_get_public($this->getPublicKey());

        return openssl_verify($signString, $signature, $pubkeyid, $this->getAlgo()) == 1;
    }
}
