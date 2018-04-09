<?php 

namespace YPC\Ripple\Http\Controllers;

class RoleController extends Controller{


    /**
     * Show all roles
     * 
     * @return \Illuminate\Http\Response
     */
    public function rolesIndex(){
        
        return view('Ripple::roles.rolesIndex');
    }
}