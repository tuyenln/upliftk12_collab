<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;


class CaseTable extends Model
{
    protected $table = 'cases';
    /*protected $fillable = [
        'identifier', 'uri', 'fullStatement', 'alternativeLabel', 'humanCodingScheme', 'listEnumeration', 'abbreviatedStatement', 'language', 'educationLevel', 'CFItemType',
        'conceptKeywords', 'conceptKeywordsURI', 'lastChangeDateTime', 'statusStartDate', 'statusEndDate'
    ];*/
    protected $fillable = [
        'identifier', 'fullStatement', 'humanCodingScheme', 'shortCode'
    ];

    public $timestamps = false;

}
