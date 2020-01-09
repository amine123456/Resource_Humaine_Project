@extends('layouts.main')
@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-12 mt-3">
            <div class="card card-widget widget-user">
                <!-- Add the bg color to the header using any of the bg-* classes -->
                <div class="widget-user-header text-white" style="background-image:url('./iset1.jpg')">
                    <h3 class="widget-user-username">{{Auth::User()->name }}</h3>
                    <h5 class="widget-user-desc"></h5>
                </div>
                    </div>

                    <br><br><br>
                <form action="{{route('sendConge')}}" method="post" class="col s8">
                
                    <div class="input-field">
                                                           
                        <button class="btn btn-success"> Send Request </button>
                        @csrf

                    </div>
                
                </form>



              
               
               </div>
         
         
         
         </div>
     </div>
@endsection