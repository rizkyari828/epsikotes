<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;




/**
 *
 */
class Role extends Model
{

    public function getRole($roleName){


        $networks = DB::table('psi.mst_roles')
        ->whereRaw('upper(mst_roles.role_name) like upper(\'%'.$roleName.'%\')')
        ->select('mst_roles.role_name','mst_roles.role_id')
        ->get();

        return $networks;

    }

}
