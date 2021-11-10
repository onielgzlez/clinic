<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Region;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\Request;


class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $org=Organization::all();
        $user=User::all();
        $city=City::all();
        $st=Region::all();
        return view('organizations.index',compact('user','org','city','st'));
    }

    public static function getLevels(){
        $org = Organization::all();  
        return $org;
    }

    //
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $org = new Organization;   // para mandar $org en blanco      
        $user=User::all();
        $city=City::all();              
        return view('organizations.create',compact('user','org','city'));
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {    
        $org = $request->except('profile_avatar','profile_avatar_remove','_token',);         
        
        if ($request->hasFile('photo'))
        {
        $org['photo']=$request->file('photo')->store('logo' , 'uploads');            
        }
        $org['appointments_day']=8;
        $Random_str = uniqid(6);  
        $org['slug']=$Random_str;
        Organization::insert($org); 
        return redirect('/organizations')->with('success', 'Clinica agregada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Organization $id 
     * @return \Illuminate\Http\Response
     */
    public function show(Organization $id)
    {
        //
        
        return view('organizations.edit', compact('org'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Organization  $org
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $org = Organization::findOrFail($id);
        $user = User::all();
        $city = City::all();
        
        return view('organizations.edit' , compact('user','org','city'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Organization  $org
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        /*$org = $request->except('_method','_token',);
        
        Organization::where('id','=',$id)->update($org);
        
        return view('organizations.index', compact('org'));*/

        if ($request->file('photo')) 
        {
            $path = $request->file('photo')->store('logo','uploads');
            $input['photo'] = $path;
        }

        $org = Organization::findOrFail($id);              
        $org->update($request->all());  
        return redirect('/organizations')->with('success', 'Clinica Modifica');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Organization  $org
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        //
        Organization::destroy($id);
        return redirect('/organizations')->with('success', 'Clinica Eliminada');
       
    }
}
