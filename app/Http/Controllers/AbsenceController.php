<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Absences;
use App\User;


class AbsenceController extends Controller
{
   

    public function NonJustifier(Request $request){

        if($request->certificat){
            $name = time().'.' . explode ('/' , explode(':' , substr($request->certificat , 0 , strpos
            ($request->certificat, ';')))[1])[1];

            \Image::make($request->certificat)->save(public_path('img/absences/').$name);
           // $request->merge(['photo' => $name]);

           // $userPhoto = public_path('img/absences/').$CurrentPhoto;
            // if(file_exists($userPhoto)){
            //         @unlink($userPhoto);
            // }

        return  Absences::create([
            'cin' => $request['cin'] , 
            'name' => $request['name'] , 
            'email' => $request['email'] , 
            'absenter' => $request['DebutAbsences'] , 
            'jusqua' => $request['FinAbsences'] ,
            'certificat' => $name, 
            
        
        ]);
    }
                
    }



    public function store(Request $request){



       

        return  Absences::create([
            'cin' => $request['cin'] , 
            'name' => $request['name'] , 
            'email' => $request['email'] , 
            'absenter' => $request['DebutAbsences'] , 
            'jusqua' => $request['FinAbsences'] ,
            //'certificat' => $fileNameToStore, 
            // 'photo' => $request['photo'] , 
        
        ]);
    }



    public function LoadAbsences(){
        $absences = Absences::all();
        return $absences  ; 
    }



    public function update(Request $request , $id){

     $absences = Absences::findOrFail($id);

     return Absences::update([
        'cin' => $request['cin'] , 
        'name' => $request['name'] , 
        'email' => $request['email'] , 
        'absenter' => $request['absenter'] , 
        'jusqua' => $request['jusqua'] ,
     ]);

        

    }


    public function AbsenceJustifier(){
        $absence = Absences::where("certificat", "!=" , "false" )->get();
        return $absence ;
    }

    public function AbsenceNonJustifier(){
        $absence = Absences::where("certificat", "=" , "false" )->get();
        return $absence ;
    }

    public function destroy($id){
        $absences = Absences::findOrFail($id);
        $absences->delete();
        return 'deleted' ;

    }
}
