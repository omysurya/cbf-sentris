<?php

namespace App\Http\Middleware;

use Closure;

class Backend
{

    private $permissionDeniedText = "Sorry you don't have permission to access this area!";
    private $loginText = "Please login for first!";

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {        
        if(!getUserId()) {
            return redir(config('app.adminPath').'/login',$this->loginText);
        }

        $exception = ['user/profile','dashboard*'];

        $modulePath = $request->segment(2);
        $modulePath2 = $request->segment(2).'/'.$request->segment(3);
        $modulePathFinal = NULL;

        foreach($exception as $ex) {
            if(substr($ex, -1) == '*') {
                if($request->is(config('app.adminPath').'/'.$ex)) {
                    return $next($request);
                }
            }else{
                if($ex == $modulePath || $ex == $modulePath2) {
                    return $next($request);
                }
            }
        }

        if($modulePath!='menu' && $modulePath!='setting') {
            if(getPermission($modulePath,'can_view')==FALSE) {
                if(getPermission($modulePath2,'can_view')==FALSE) {
                    return redir(config('app.adminPath'),'View: '.$this->permissionDeniedText); 
                }else{
                    $modulePathFinal = $modulePath2;
                }                
            }else{
                $modulePathFinal = $modulePath;
            }

            $modulePathAdd = $modulePathFinal.'/add';
            $modulePathEdit = $modulePathFinal.'/edit';
            $modulePathDelete = $modulePathFinal.'/delete';      
            $modulePathDetail = $modulePathFinal.'/detail'; 
            $modulePathInfoDetail = $modulePathFinal.'/info-detail';           

            if($request->is(config('app.adminPath').'/'.$modulePathAdd.'*')) {                
                if(getPermission($modulePathFinal,'can_create')==FALSE) {
                    return redir(config('app.adminPath'),'Create: '.$this->permissionDeniedText); 
                }
            }elseif ($request->is(config('app.adminPath').'/'.$modulePathEdit.'*')) {
                if(getPermission($modulePathFinal,'can_update')==FALSE) {
                    return redir(config('app.adminPath'),'Edit: '.$this->permissionDeniedText); 
                }
            }elseif ($request->is(config('app.adminPath').'/'.$modulePathDelete.'*')) {
                if(getPermission($modulePathFinal,'can_delete')==FALSE) {
                    return redir(config('app.adminPath'),'Delete: '.$this->permissionDeniedText); 
                }
            }elseif ($request->is(config('app.adminPath').'/'.$modulePathDetail.'*')) {
                if(getPermission($modulePathFinal,'can_read')==FALSE) {
                    return redir(config('app.adminPath'),'Read: '.$this->permissionDeniedText); 
                }
            }

        }else{
            if(getRole() != 'SUPERADMIN') {
                return redir(config('app.adminPath'),$this->permissionDeniedText);    
            }
        }
        
        
        return $next($request);
    }
}
