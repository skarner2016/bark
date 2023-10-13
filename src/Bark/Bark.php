<?php
/**
 * @desc
 * @author  skarner <2023-10-12 11:45>
 */

namespace Bark;

class Bark
{
    /**
     * token
     */
    public $token;
    
    public $timeout = 3;
    
    public $host = 'https://api.day.app/';
    
    public $params = [];
    
    public function host($host)
    {
        $this->host = $host;
        
        return $this;
    }
    
    public function token($token)
    {
        $this->token = $token;
        
        return $this;
    }
    
    public function title($title)
    {
        return $this->addParam('title', $title);
    }
    
    public function body($body)
    {
        return $this->addParam('body', $body);
    }
    
    public function level($level)
    {
        return $this->addParam('level', $level);
    }
    
    public function badge($badge)
    {
        return $this->addParam('badge', $badge);
    }
    
    public function autoCopy($autoCopy)
    {
        return $this->addParam('autoCopy', $autoCopy);
    }
    
    public function copy($copy)
    {
        return $this->addParam('copy', $copy);
    }
    
    public function sound($sound)
    {
        return $this->addParam('sound', $sound);
    }
    
    public function icon($icon)
    {
        return $this->addParam('icon', $icon);
    }
    
    public function group($group)
    {
        return $this->addParam('group', $group);
    }
    
    public function isArchive($isArchive)
    {
        return $this->addParam('isArchive', $isArchive);
    }
    
    public function url($url)
    {
        return $this->addParam('url', $url);
    }
    
    public function timeout($timeout)
    {
        return $this->addParam('timeout', $timeout);
    }
    
    /**
     * @desc    add request param
     * @param   $name
     * @param   $value
     * @return  $this
     * @author  skarner <2023-10-13 15:58>
     */
    public function addParam($name, $value)
    {
        $this->params[$name] = $value;
        
        return $this;
    }
    
    /**
     * @desc    send http request to bark server
     * @return  mixed
     * @throws  BarkException
     * @author  skarner <2023-10-13 15:57>
     */
    public function send()
    {
        if (!$this->token) {
            throw new BarkException("token is required");
        }
        
        $url = sprintf("%s%s?%s", $this->host, $this->token, http_build_query($this->params));
        
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_TIMEOUT, $this->timeout);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        $response  = curl_exec($curl);
        $httpCode  = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $httpInfo  = curl_getinfo($curl);
        $errorInfo = curl_error($curl);
        curl_close($curl);
    
        if ($httpCode != 200) {
            $errorMsg = sprintf("send http request failed, http_code:%s", $httpCode);
            throw new BarkException($errorMsg);
        }
        
        if (empty($httpInfo) || !isset($httpInfo['http_code']) || $httpInfo['http_code'] != 200) {
            throw new BarkException($errorInfo);
        }
     
        if (empty($response) || !is_string($response)) {
            throw new BarkException("response error");
        }
        
        return json_decode($response, true);
    }
}