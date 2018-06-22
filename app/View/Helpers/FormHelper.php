<?php
/**
 * Created by PhpStorm.
 * User: danneco87
 * Date: 16/02/2018
 * Time: 15:27
 */

namespace App\View\Helpers;


use Collective\Html\FormBuilder;
use Collective\Html\FormFacade;

class FormHelper
{
    function adminCreate()
    {
        $array = [
            'first_name' => 'firstname',
            'last_name' => 'firstname',
            'email' => 'email',
        ];
    }
}