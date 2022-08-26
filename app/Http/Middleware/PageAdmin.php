<?php

namespace App\Http\Middleware;

use Closure;
use App\Menu;
use App\RoleMenu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
class PageAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $role = Auth::guard('web')->user()->admin;
        $accessmenu = [];
        $route = explode('.',Route::currentRouteName());
        if($role){
            
                $role = Auth::guard('web')->user()->admin->role;
                $rolemenus = RoleMenu::select('menus.*')
                ->leftJoin('menus', 'menus.id', '=', 'role_menus.menu_id')
                ->where('role_id','=',$role?$role->id:0)
                ->where('role_access','=',1)
                ->orderBy('menus.menu_sort','asc')     
                ->get();
                $menu = Menu::where('menu_route',$route[0])->first();
                $actionmenu = [];
                if($menu){
                    $actions = RoleMenu::where('menu_id',$menu->id)->where('role_id',$role?$role->id:0)->get();
                    foreach($actions as $action){
                        if($action->create){
                            if(!in_array('create',$actionmenu)){
                                array_push($actionmenu,'create');
                            }
                        }
                        if($action->read){
                            if(!in_array('read',$actionmenu)){
                                array_push($actionmenu,'read');
                            }
                        }
                        if($action->update){
                            if(!in_array('update',$actionmenu)){
                                array_push($actionmenu,'update');
                            }
                        }
                        if($action->delete){
                            if(!in_array('delete',$actionmenu)){
                                array_push($actionmenu,'delete');
                            }
                        }
                        if($action->import){
                            if(!in_array('import',$actionmenu)){
                                array_push($actionmenu,'import');
                            }
                        }
                        if($action->export){
                            if(!in_array('export',$actionmenu)){
                                array_push($actionmenu,'export');
                            }
                        }
                        if($action->print){
                            if(!in_array('print',$actionmenu)){
                                array_push($actionmenu,'print');
                            }
                        }
                        if($action->sync){
                            if(!in_array('sync',$actionmenu)){
                                array_push($actionmenu,'sync');
                            }
                        }
                    }
                }
                View::share('actionmenu', $actionmenu);
                request()->merge(['actionmenu' => $actionmenu]);
                View::share('menuaccess', $rolemenus);
        }
        return $next($request);
    }
}
