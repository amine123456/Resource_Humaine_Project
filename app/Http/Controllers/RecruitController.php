<?php

namespace App\Http\Controllers;
use App\Recruit;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
//use Illuminate\Http\UploadedFile;
use App\Notifications\RecrutementNotification;
use Illuminate\Support\Facades\Auth;
use Notifications;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Nexmo\Laravel\Facade\Nexmo;



class RecruitController extends Controller
{

    use AuthenticatesUsers;


    public function index()
    {     
       
    }


    public function store(Request $request){

           
        $value_to_insert = Input::get('group1') == 'oui' ? 1 : 0;

        $file = $request->file('fileA');

        if($request->hasFile('fileA')){
            $fileNameWithExt = $file->getClientOriginalName();

            $fileName = pathinfo($fileNameWithExt , PATHINFO_FILENAME);
            //$extension = $file->extension();
            $extension = $request->file('fileA')->getClientOriginalExtension();

            $fileNameToStore = $fileName.'_'.time().'.'.$extension;

            $path = $request->file('fileA')->storeAs('/' , $fileNameToStore);
           

            $recrutement = new Recruit ;
            $recrutement->cin = request('cin');
            $recrutement->name = request('name') ;
            $recrutement->email = request('email') ;
            $recrutement->numtel = request('numtel');
            $recrutement->type = request('type');
            $recrutement->date_naiss = request('date_naiss');
            $recrutement->adresse = request('adresse');
            $recrutement->CV =  $fileNameToStore;
            $recrutement->permis = $value_to_insert;
            $recrutement->password = Hash::make($request['password']);
            $recrutement->save();

        }

        // $file = $request->file('fileA');

        // if ($request->fileA != $file){
        //     $name = time().'.' . explode ('/' , explode(':' , substr($request->fileA , 0 , strpos
        //         ($request->photo, ';')))[1])[1];

        //         \Image::make($request->fileA)->save(public_path('img/profile/').$name);
        //         $request->merge(['cv' => $file]);

        //         $userPhoto = public_path('img/profile/').$file;
        //         if(file_exists($userPhoto)){
        //                 @unlink($userPhoto);
        //         }

               
        // }

        
      

       
        // $recrutement =  Recruit::create([
        //     'cin' => $request['cin'] , 
        //     'name' => $request['name'] , 
        //     'email' => $request['email'] ,  
        //     'numtel' =>  $request['numtel'] , 
        //     'type' =>  $request['type'] ,
        //    'date_naiss' => $request['date_naiss'],
        //     'adresse' => $request['adresse'],
        //      'CV' =>  $userPhoto,
        //     'permis' => $value_to_insert ,
        //     'password' => Hash::make($request['password']),    
        // ]);

        $user = $request['name'];
        User::findOrFail(1)->notify(new RecrutementNotification($user));

        return back();
        // return view('auth.login1');

    }

    public function getdata(){
        //->except(['number' , '=' , '55899020'])
        $recrutement = Recruit::where("status" , "=" , "0")->paginate(10);
        return $recrutement ;
        
    }

    public function completestore(Request $request){


            $request = $request['email'];
            $recuit = Recruit::findOrFail($request);

            
            $cin = $request['cin'];
            $name = $request['name'];
            $numtel = $request['numtel'];
            $type = $request['type'];
            $date_naiss = $request['date_naiss'];
            $adresse = $request['adresse'];
            $permis = $request['permis'] ;

            $recruit->cin = $cin ; 
            $recruit->name = $name ; 
            
            $recruit->numtel = $numtel ; 
            
            if(!empty($request->type)){
                $request->merge(['type' ]);
            }
            $recruit->date_naiss = $date_naiss ;
            $recruit->adresse =  $adresse ;
            $recruit->permis = $permis ;

            $recruit->update()->all();

    }

    

    public function update(Request $request ,$id )
    {
       
        $recrutement = Recruit::findOrFail($id);     
    //    $conge->put($request->status);
    
    
       
         if($recrutement->status == 0){
            $recrutement->status = 1;
                User::create([
                'cin' => $recrutement->cin , 
                'name' =>$recrutement->name , 
                'email' => $recrutement->email ,  
                'numtel' =>  $recrutement->numtel ,         
                'type' => $recrutement->type ,
                'password' => $recrutement->password , 
                                     
                ]);

                Nexmo::message()->send([
                    'to'   => '21658465352',
                    'from' => 'SRTB',
                    'text' => $recrutement->name.'Votre Demande de recrutement a ete accepter vueillez consulter votre compte '
                ]);
                $recrutement->update(['status' => '1']);
                // $recrutement->delete();
                
                // if(!empty( $recrutement->password)){
                //     $recrutement->merge(['password' => Hash::make($request['password'])]);
                // }
        }   
           
        return $recrutement ;


    }

    public function ChartRecruit(){
        $logs = Recruit::all();
        return $logs;
    }



    public function RecruitAccepte(){

        $recrutement = Recruit::where("status" , "=" , "1")->get();
        return $recrutement ;

      
    }



    public function destroy($id)

    {   
        $conge  = Recruit::findOrFail($id);
        //supprimer l'employer 
        $conge->delete();
        return ['message' => 'Conge Supprimer'];
    }
}
