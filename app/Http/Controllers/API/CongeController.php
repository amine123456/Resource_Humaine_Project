<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Conges;
use Carbon\Carbon;
use Notifications;
use App\Notifications\CongeNotification;

class CongeController extends Controller


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

    public function index(){
        
        $user =  auth('api')->user();
        return Conges::latest()->where('employer_id' , '=' , $user->id)->paginate(10);
       
            //return view('Conge.DemandeConge' , compact('employer'));
            
    }

    public function indexadmin(){

        
        //$conge = Conges::all();
       


       
     return  Conges::latest()->paginate(4);
      
        
      


       
            //return view('Conge.DemandeConge' , compact('employer'));
            
    }
        // public function sendConge(Request $request){

        //             $admin = User::where('type' ,'admin')->first() ;
        //             $conge = new Conges;
        //             $conge->employer_id = Auth::User()->id;
        //             $conge->admin_id = $admin->id  ;
        //             $conge->save();
        //             return $conge;

              

        //     // $conge = new Conges;
        //     // $conge->employer_id = Auth::User()->id;
        //     // $conge->admin_id = (int) $request ->input('admin') ;
        //     // return $conge;
            
        // }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation

    // store in the database
            $user =  auth('api')->user();
            User::findOrFail(1)->notify(new CongeNotification($user));
            return  Conges::create([
                'employer_id' => $request['id'] ,
                'starting_day' => $request['debutConge'] , 
                'date_fin' => $request['finConge'],
                'nom'   => $request['name'] , 
                     
            ]);

            

        

           
            
    }

    public function update(Request $request , $id)
    {
       
        $conge = Conges::findOrFail($id);     
    //    $conge->put($request->status);
    
    
        if($conge->status == 2){
            if($conge->status = 0){

            }
        }
        else if($conge->status == 1){
            $conge->status = 0;
        }else if($conge->status == 0){
            $conge->status = 1;
        }   
        $conge->update();
      

        return $conge ;


    }

    public function destroy($id)

    {   
        $conge  = Conges::findOrFail($id);
        //supprimer l'employer 
        $conge->delete();
        return ['message' => 'Conge Supprimer'];
    }


    public function ChartConge(){
        $conges = Conges::orderBy('starting_day')->get();
        return $conges ;
    }


    
    public function CongeAccepter(){
        $conges = Conges::where("status" , "=" , "1")->get();
        return $conges ;
    }



    public function modif(Request $request, $id){

        $conges  = Conges::findOrFail($id);
        
        $datedebut = $request['dateDebut'];   
        $datefin = $request['dateFin'];
       

       
        $conges->starting_day =  $datedebut ; 
        $Employer->date_fin = $datefin ;
       
       
        $conges->update();

        return $conges ;

    }
}
