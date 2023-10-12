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
    
    public function addParam($name, $value)
    {
        $this->params[$name] = $value;
        
        return $this;
    }
 
    public function send()
    {
        if (!$this->token) {
            throw new BarkException("token is required");
        }
    
        $url = sprintf("%s%s?%s",$this->host,  $this->token, http_build_query($this->params));
        
        
        // TODO: curl
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_TIMEOUT, $this->timeout);
        curl_exec($curl);
        
        
        
        dd(__METHOD__, __LINE__, $url, $this->host, $this->token, $this->params);
    }
}