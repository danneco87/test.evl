<?php
/**
 * Created by PhpStorm.
 * User: danneco87
 * Date: 04/12/2017
 * Time: 20:53
 */
namespace App\View\Helpers;

use App\Models\Matches;

class MatchesHelper
{
   function getTableData($id)
    {
        return Matches::getMatchData($id);
    }
}