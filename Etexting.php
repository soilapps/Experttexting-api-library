<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/**
 * CodeIgniter ExpertTexting Library
 *
 * A CodeIgniter library to interact with ExpertTexting
 *
 * @package         CodeIgniter
 * @category        Libraries
 * @author          Tarique Mosharraf, TextRid
 * @link            https://github.com/soilapps/Experttexting-api-library/Etexting.php
 * @link            http://textrid.com
 * @license         http://www.opensource.org/licenses/mit-license.html
 */
class Etexting
{
    protected $username;
    protected $password;
    protected $end_point;
    protected $apikey;
	
    public function __construct()
    {
        $this->_ci = & get_instance();
        /*
         * Load config items
         */
        $this->_ci->load->config('etexting');
        $this->username = $this->_ci->config->item('USERNAME');
        $this->password = $this->_ci->config->item('PASSWORD');
        $this->apikey = $this->_ci->config->item('APIKEY');
        $this->end_point = $this->_ci->config->item('END_POINT');
    }
   
    /**
     * Send an SMS message
     * @param array $sms_data
     * @return type 
     */
    public function send_sms($msg , $fromnumbeer , $tonumber )
    {
		$fieldcnt=6;
		$fieldstring = "Userid=$this->username&pwd=$this->password&APIKEY=$this->apikey&MSG=$msg&FROM=$fromnumbeer&To=$tonumber";
		$url =  $this->end_point."/SendSMS";
		
		$ch = curl_init();
		curl_setopt($ch,CURLOPT_URL,$url);
		curl_setopt($ch,CURLOPT_POST,$fieldcnt);
		curl_setopt($ch,CURLOPT_POSTFIELDS,$fieldstring);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
		$res = curl_exec($ch);
		curl_close($ch);
		return $res;
    }
 
}
/* End of file Etexting.php */
