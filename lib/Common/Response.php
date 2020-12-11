<?php

namespace Cleantalk\Common;

/**
 * Response class
 */
class Response {

    /**
    * Received feedback nubmer
    * @var int
    */
    public $received = null;

    /**
    *  Is stop words
    * @var int
    */
    public $stop_words = null;

    /**
    * Cleantalk comment
    * @var string
    */
    public $comment = null;

    /**
    * Is blacklisted
    * @var int
    */
    public $blacklisted = null;

    /**
    * Is allow, 1|0
    * @var int
    */
    public $allow = null;

    /**
    * Request ID
    * @var int
    */
    public $id = null;

    /**
    * Request errno
    * @var int
    */
    public $errno = null;

    /**
    * Error string
    * @var string
    */
    public $errstr = null;

    /**
    * Is fast submit, 1|0
    * @var string
    */
    public $fast_submit = null;

    /**
    * Is spam comment
    * @var string
    */
    public $spam = null;

    /**
    * Is JS
    * @var int
    */
    public $js_disabled = null;

    /**
    * Sms check
    * @var int
    */
    public $sms_allow = null;

    /**
    * Sms code result
    * @var int
    */
    public $sms = null;

    /**
    * Sms error code
    * @var int
    */
    public $sms_error_code = null;

    /**
    * Sms error code
    * @var string
    */
    public $sms_error_text = null;

    /**
    * Stop queue message, 1|0
    * @var int
    */
    public $stop_queue = null;

    /**
    * Account should by deactivated after registration, 1|0
    * @var int
    */
    public $inactive = null;

    /**
    * Account status
    * @var int
    */
    public $account_status = -1;

    /**
    * @var array Contains codes returned from server
    */
    public $codes = array();

    /**
    * Create server response
    *
    * @param array $response
    * @param CleantalkResponse $obj
    */
    function __construct( $response = null, $obj = null ) {
        if ($response && is_array($response) && count($response) > 0) {
            foreach ($response as $param => $value) {
                $this->{$param} = $value;
            }
        } else {
            $this->errno = (isset($obj->errno)) ? $obj->errno : 0;
            $this->errstr = (isset($obj->errstr)) ? preg_replace("/.+(\*\*\*.+\*\*\*).+/", "$1", $obj->errstr) : null;

            $this->stop_words = isset($obj->stop_words) ? utf8_decode($obj->stop_words) : null;
            $this->comment = isset($obj->comment) ? utf8_decode($obj->comment) : null;
            $this->blacklisted = (isset($obj->blacklisted)) ? $obj->blacklisted : null;
            $this->allow = (isset($obj->allow)) ? $obj->allow : 1;
            $this->id = (isset($obj->id)) ? $obj->id : null;
            $this->fast_submit = (isset($obj->fast_submit)) ? $obj->fast_submit : 0;
            $this->spam = (isset($obj->spam)) ? $obj->spam : 0;
            $this->js_disabled = (isset($obj->js_disabled)) ? $obj->js_disabled : 0;
            $this->sms_allow = (isset($obj->sms_allow)) ? $obj->sms_allow : null;
            $this->sms = (isset($obj->sms)) ? $obj->sms : null;
            $this->sms_error_code = (isset($obj->sms_error_code)) ? $obj->sms_error_code : null;
            $this->sms_error_text = (isset($obj->sms_error_text)) ? $obj->sms_error_text : null;
            $this->stop_queue = (isset($obj->stop_queue)) ? $obj->stop_queue : 0;
            $this->inactive = (isset($obj->inactive)) ? $obj->inactive : 0;
            $this->account_status = (isset($obj->account_status)) ? $obj->account_status : -1;
            $this->received = (isset($obj->received)) ? $obj->received : -1;
            $this->codes = (isset($obj->codes)) ? explode(' ', $obj->codes) : array();

            if ($this->errno !== 0 && $this->errstr !== null && $this->comment === null)
                $this->comment = '*** ' . $this->errstr . ' Antispam service cleantalk.org ***';
        }
    }
}