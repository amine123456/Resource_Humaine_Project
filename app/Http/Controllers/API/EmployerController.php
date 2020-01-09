<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;
use DB;
use Carbon;


class EmployerController extends Controller
{




    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
        
      
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {     $this->authorize('isAdmin');
        return User::latest()->paginate(100);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('isAdmin');

        //validation

        $this->validate($request , [
            'password' => 'required',
        ]);
    // store in the database
            return  User::create([
                'cin' => $request['cin'] , 
                'name' => $request['name'] , 
                'email' => $request['email'] , 
                'bio' => $request['bio'] , 
                'type' => $request['type'] , 
                'numtel' =>  $request['numtel'] , 
                'password' => Hash::make($request['password']),
                'salaire' => $request['salaire'] , 
                 'photo' => $request['photo'] , 
               
            ]);
           
            
    }



    public function   UpdateProfile(Request $request){

        $user =  auth('api')->user();
        $this->validate($request , [
            'email' => 'required|unique:users,email, '.$user->id,
            'password' => 'sometimes|required|min:6',
        ]);
        $CurrentPhoto = $user->photo;

        if ($request->photo != $CurrentPhoto){
            $name = time().'.' . explode ('/' , explode(':' , substr($request->photo , 0 , strpos
                ($request->photo, ';')))[1])[1];

                \Image::make($request->photo)->save(public_path('img/profile/').$name);
                $request->merge(['photo' => $name]);

                $userPhoto = public_path('img/profile/').$CurrentPhoto;
                if(file_exists($userPhoto)){
                        @unlink($userPhoto);
                }
        }

        if(!empty($request->password)){
            $request->merge(['password' => Hash::make($request['password'])]);
        }


        $user->update($request->all());
        return ['message' => 'Update the user info'] ;
    }




    public function  AfficheP()
    {       
        return  auth('api')->user();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('isAdmin');
        $Employer  = User::findOrFail($id);

        $this->validate($request , [
            'email' => 'unique:users,email, '.$Employer->id,
            'password' => 'sometimes|min:6',
            'salaire' => 'min:3', 
        ]);


        
        $cin = $request['cin'];
        $name = $request['name'];
        $numtel = $request['numtel'];   
        $salaire = $request['salaire'];
       

        $Employer->cin = $cin ; 
        $Employer->name = $name ; 
        $Employer->numtel = $numtel ; 
        $Employer->salaire = $salaire ;
       
       
        $Employer->update();


        // $Employer->salaire = $request['salaire'] ;
        // $Employer->update();
        return $Employer ;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)


    {
        
        $this->authorize('isAdmin');
        $Employer  = User::findOrFail($id);
        //supprimer l'employer 
        $Employer->delete();
        return ['message' => 'Employer Supprimer'];

    }

    public function search(){

        
        if($search = \Request::get('q')){
            $users = User::where(function($query) use ($search){
                $query->where('name' , 'LIKE' , '%'.$search.'%')->orWhere('email' , 'LIKE' , '%'.$search.'%');
            })->paginate(5);

           
        }else{
            $users = User::latest()->paginate(100);
        }
        return $users ;

    }

    public function Vuechardata(){


       // $table = User::orderBy('created_at' , 'desc')->groupBy('created_at')->get();

       $logs = User::all();
       

        //  $select = DB::raw("count(id) as count, DATE_FORMAT(created_at, '%M %d') as date");        
        //  $query = DB::table('User');
        //  $query->select($select);
        
        

        return $logs;
    
       

    }

   
}
