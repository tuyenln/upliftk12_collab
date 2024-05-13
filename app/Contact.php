<?php

// Contact.php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model{

    protected $timestamp = false;

    public function addNew($params){
      extract($params);
      $this->name = $name;
      $this->title = $title;
      $this->district_name = $district_name;
      $this->school_name = $school_name;
      $this->phone = $phone;
      $this->email = $email;
      $this->tyon = $tyon;
      $this->save();
    }   

}