<?php


class Response
{
    private $_success;
    private $_httpStatusCode;
    private $_messages = array();
    private $_data;
    private $_toCache = false;
    private $_responseData = array();

    /**
     * Response constructor.
     * @param $_success
     * @param $_httpStatusCode
     * @param array $_messages
     * @param $_data
     * @param bool $_toCache
     */
    public function __construct($_success, $_httpStatusCode, array $_messages, $_data, bool $_toCache)
    {
        $this->_success = $_success;
        $this->_httpStatusCode = $_httpStatusCode;
        $this->_messages = $_messages;
        $this->_data = $_data;
        $this->_toCache = $_toCache;
    }

    /**
     * @param mixed $success
     * @return Response
     */
    public function setSuccess($success)
    {
        $this->_success = $success;
        return $this;
    }

    /**
     * @param mixed $httpStatusCode
     * @return Response
     */
    public function setHttpStatusCode($httpStatusCode)
    {
        $this->_httpStatusCode = $httpStatusCode;
        return $this;
    }

    /**
     * @param $message
     * @return Response
     */
    public function addMessage($message): Response
    {
        $this->_messages[] = $message;
        return $this;
    }

    /**
     * @param mixed $data
     * @return Response
     */
    public function setData($data)
    {
        $this->_data = $data;
        return $this;
    }

    /**
     * @param bool $toCache
     * @return Response
     */
    public function setToCache(bool $toCache): Response
    {
        $this->_toCache = $toCache;
        return $this;
    }

    /**
     * @param array $responseData
     * @return Response
     */
    public function setResponseData(array $responseData): Response
    {
        $this->_responseData = $responseData;
        return $this;
    }

    public function send($xmlBool = false)
    {
        // Set default content type
        if ($xmlBool) {
            header('Content-type: application/xml;charset=utf-8');
        } else {
            header('Content-type: application/json;charset=utf-8');
        }

        // Check if caching is true
        if ($this->_toCache === true) {
            header('Cache-control: max-age=60');
        } else {
            header('Cache-control: no-cache,no-store');
        }

        // If something is wrong with the request

        $this->_responseData['success'] = $this->_success;
        http_response_code($this->_httpStatusCode);
        $this->_responseData['statusCode'] = $this->_httpStatusCode;
        $this->_responseData['messages'] = $this->_messages;
        $this->_responseData['data'] = $this->_data;
        
        // Return array as json
        if ($xmlBool) {
            echo $this->arrayToXML($this->_responseData);
        } else {
            echo json_encode($this->_responseData);
        }
    }

    private  function arrayToXML($array) 
    { 
        $xml = '';
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $xml .= "<$key>";
                $xml .= $this->arrayToXML($value);
                $xml .= "</$key>";
            } else {
                $xml .= "<$key>$value</$key>";
            }
        }
        return $xml;
    } 
}