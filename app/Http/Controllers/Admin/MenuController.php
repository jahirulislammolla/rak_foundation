<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = Menu::query()
            ->with([
                'parent_menu:id,title'
            ])
            ->get();

       return view('admin.menu.index', compact('menus'));
               
       if($request->requestHeaderCheck())
       {
           $search = $request->search ?? '';

           $menus = Menu::query()
                ->with([
                    'parent_menu:id,title'
                ]) 
               ->select(
                   'id' , 
                   'title' ,
                   'year' ,
                   'writer' ,
                   'publisher' ,
                   'file' ,
                   'link' ,
                   'status'
               )
               ->when( $search, function ($query) use ($search) {
                   $query->Where('title', 'like', '%' . $search . '%')
                       ->orWhere('year', 'like', '%' . $search . '%')
                       ->orWhere('writer', 'like', '%' . $search . '%')
                       ->orWhere('publisher', 'like', '%' . $search . '%');
               })
               ->orderBy("id", "DESC")
               ->paginate(10);

           return view('admin.menu.data', 
                   compact('menus', 'search')
                   )->render();
       }


       return view('admin.menu.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $menu = new Menu();
        $menus = Menu::pluck('title','id');
        $permissions = DB::table('permissions')->get();

        return  view('admin.menu.create')
                ->with('menus',$menus)
                 ->with('menu',$menu)
                 ->with('permissions',$permissions);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'permission'=>'required',
            'priority'=>'required',
        ]);
        $menu  = new Menu();
         $menu->title = $request->title;
         $menu->parent_id = $request->parent_id;
         $menu->url = $request->url;
         $menu->permission = $request->permission;
         $menu->priority = $request->priority;
         $menu->icon = $request->icon;
         $menu->save();

        $this->forgetCache();

        Session::flash('message', 'Record created successfully');
        return redirect()->action('Admin\MenuController@index');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $menu =  Menu::where('id',$id)->first();
        $menus = Menu::pluck('title','id');
        $permissions = DB::table('permissions')->get();

       return view('admin.menu.edit')
           ->with('menu',$menu)
           ->with('menus',$menus)
           ->with('permissions',$permissions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'permission'=>'required',
            'priority'=>'required',
        ]);
        $menu  = Menu::find($request->id);
        $menu->title = $request->title;
        $menu->parent_id = $request->parent_id;
        $menu->url = $request->url;
        $menu->permission = $request->permission;
        $menu->priority = $request->priority;
        $menu->icon = $request->icon;
        $menu->save();

        $this->forgetCache();

        Session::flash('message', 'Record updated successfully');
        return redirect()->action('Admin\MenuController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();

        $this->forgetCache();

        Session::flash('message', 'Record Deleted successfully');
        return redirect()->route('menus.index');
    }

    private function forgetCache()
    {
        Cache::forget('AdminPanelMenus');
    }
}
