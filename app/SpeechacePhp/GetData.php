<?php

namespace App\SpeechacePhp;

class GetData {

    private $endpoint = "https://api.speechace.co/api/scoring/text/v0.5/json";
    private $apikey = "qFvn1DkDvVdyla9nYwiBlhoJTk2T9AaMmsZe%2BjfiLOu2uL%2BBsCpiett6LH8FJZ1q%2BJoJA7Emv8zyPIDv35pJexLQbC2%2BlCoX5MicukcS4kG90lzvNlDtBKBAaS4BA8ng";
    public $userId = "sptest";
    public $includeFluency = 1;
    public $text, $file;

    public function __construct($text, $file) {
        $this->text = $text;
        $this->file = $file;
    }

    /**
     * @param $userId
     */
    public function setUserId($userId){
        $this->userId = $userId;
    }

    /**
     * @return mixed|string
     */
    public function getResult(){
	    $ch = curl_init(
		    $this->endpoint.
		    "?key=".$this->apikey.
		    "&user_id=".$this->userId.
		    "&dialect="."en-us"
	    	  );

        curl_setopt_array($ch, $this->curlOptions());
        $raw = curl_exec($ch);

        if(curl_errno($ch) > 0) {
            return json_encode(array("message" => "There was an error using the speechace api: ".curl_error($ch)));
        }

        curl_close($ch);
        return $raw;
    }

    /**
     * @return array
     */
    protected function curlOptions(){
        return array(
            CURLOPT_POST => 1,
            CURLOPT_HTTPHEADER => array("Content-Type:multipart/form-data"),
            CURLOPT_POSTFIELDS => array(
                "text" => $this->text,
                "user_audio_file" => curl_file_create($this->file["tmp_name"]),
                "user_id" => $this->userId,
                "include_fluency" => $this->includeFluency,
            ),
            CURLOPT_RETURNTRANSFER => true
        );
    }

}
