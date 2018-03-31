@extends('layouts.app') @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
          
           @if($video->isPrivate() && auth()->check() && $video->ownedByUser(auth()->user()))
           <div class="alert alert-danger">
                Your video currently private. Only you can see it.
            </div>
           @endif
           
           @if($video->canBeAccessed(Auth::user()) )
              <video-player video-uid="{{$video->uid}}" video-url="{{$video->getStreamUrl()}}"  ></video-player>
           @endif
           
               
           @if(!$video->canBeAccessed(auth()->user()))
           <div class="video-placeholder">
                <div class="video-placeholder__header">
                        The video is private.
                  </div>
             </div>
           @endif
           <div class="card">

               <div class="card-body">
                   <h4>{{$video->title}}</h4>
                   <div class="pull-right">
                       <div class="video__views">
                         {{--  //   {{$video->viewCount()}} {{str_plural('view',$video->viewCount())}}  --}}
                            
                       </div>
                   </div>
                   <div class="media ">
                       <div class="media-left ">
                           <a href="/users/{{$video->user->name}}">{{$video->user->name}}
                            </a>
                       </div>
                      
                   </div>
               </div>

           </div>
           <br> @if($video->description)
           <div class="card card-default">

               <div class="card-body">
                   {!! nl2br(e($video->description)) !!}
               </div>
           </div>
<br>
           @endif
    
          
        </div>
    </div>
    @endsection