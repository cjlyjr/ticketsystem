<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Userpost;
use Illuminate\Support\Facades\Auth;
use DB;
use Session;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class UserPostController extends Controller
{
    

     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        if (Auth::check())
        {
            $this->middleware('auth',['except'=>['index','show']]);
        }
        else
        {
            $this->middleware('auth',['except'=>['index','show','update']]);
        }
       
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  
    public function index(Request $request)
    {
        try{
            $posts=Userpost::orderBy('created_at','desc')->paginate(10);  
        
            $posts->transform(function($post,$key){
               
              
                if(!empty($post->ticketreply))
                {
                    $post->ticketreply=unserialize($post->ticketreply);
                   
                }
                else
                {
                    $post->ticketreply= $post->ticketreply;
                } 
                return $post;
               
            });
           
           // return view('userpost.index')->with('posts',$posts);
          // return view('userpost.index',['posts'=>$posts]);
        
          $svalue = session('key');
          if(DB::connection()->getDatabaseName()=="")
          {
              $error="can not connect to database";
              return view('userpost.index',['posts'=>$posts,'svalue'=>$svalue,'error'=>$error]);
          }
          return view('userpost.index',['posts'=>$posts,'svalue'=>$svalue]);
        }
        catch(\Illuminate\Database\QueryException $ex)
         { 
            //dd($ex->getMessage()); 
            // Note any method of class PDOException can be called on $ex.
            echo "please check README.md file,ensure your database connect or table  is right";
          }
        
    }
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('userpost.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /***************get upload files extension */
    
    public function store(Request $request)
    {
        try
        {
            $this->validate($request,[
                'title'=>'required',
                'content'=>'required',
               // 'filename'=>'image|nullable|max:1999'
             
               'fileimg'=>'mimes:docx,jpg,jpeg,png,gif,txt,docx,zip,html,xlsx,xls,mp4,webm'
               
             ]);
             //Handle file upload
           
             if($request->hasfile('fileimg'))
              {
                    
                
                     $filenamewithExt=$request->file('fileimg')->getClientOriginalName();
                     //Get only filename
                     $filename=pathinfo($filenamewithExt,PATHINFO_FILENAME);
                     //Get only ext
                     $extension=$request->file('fileimg')->getClientOriginalExtension();
                     
                     //Filename to store
                     $fileNameToStore=$filename.'_'.time().'.'.$extension;
                     //Upload Image to file
                     //$path=$request->file('fileimg')->storeAs('public/uploadfiles',$fileNameToStore);
                     $request->file('fileimg')->move('uploadfiles',$fileNameToStore);
                     
                   
                  
     
                    
                 
              }
              else{
                  $fileNameToStore='';
              }
             
            //create new ticket 
            $post=new Userpost;
            $post->title=$request->input('title');
            $post->ticketcontent=$request->input('content');
            $post->user_id=auth()->user()->id;
            $post->fileimg=$fileNameToStore;
            $post->save();
            return redirect('/')->with('success','New ticket created');
        }
        catch(\Illuminate\Database\QueryException $ex)
         { 
            //dd($ex->getMessage()); 
            // Note any method of class PDOException can be called on $ex.
            echo "please check README.md file,ensure your database connect or table  is right";
          }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $post=UserPost::find($id);
       
            // $reply= DB::table('userposts')->where('id', $id)->value('ticketreply');
            //$orders= explode(";", $reply);
           
            if(!empty($post->ticketreply))
            {
             $post->ticketreply=unserialize($post->ticketreply);
            }
            else
            {
             $post->ticketreply= $post->ticketreply;
            }
          
       
            return view('userpost.show',['post'=>$post]);
        }catch(\Illuminate\Database\QueryException $ex)
         { 
            //dd($ex->getMessage()); 
            // Note any method of class PDOException can be called on $ex.
            echo "please check README.md file,ensure your database connect or table  is right";
          }
        
    

      
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $post=UserPost::find($id);
       
            //Check for correct user
           if(!empty($post))
           {
              if(auth()->user()->id ==$post->user_id)
                {
                    return view('userpost.edit')->with('post',$post);
                }
               
           }
           else
           {
            return redirect('/')->with('error','Unauthorized Page');
           }
    
        }catch(\Illuminate\Database\QueryException $ex)
        { 
           //dd($ex->getMessage()); 
           // Note any method of class PDOException can be called on $ex.
           echo "please check README.md file,ensure your database connect or table  is right";
         }
        
        
        
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
        try{

        
        $post=Userpost::find($id);
        $reply=DB::table('userposts')->where('id', $id)->value('ticketreply');
        
       $cc=[];               
        if (Auth::check())
        {
            $this->validate($request,[
                'title'=>'required',
                'content'=>'required',
                'fileimg'=>'mimes:docx,jpg,jpeg,png,gif,txt,docx,zip,html,xlsx,xls,mp4,webm'
             ]);
            //update ticket 
           
            $post->title=$request->input('title');
            $post->ticketcontent=$request->input('content');
            if($request->hasfile('fileimg'))
            {
                  
              
                   $filenamewithExt=$request->file('fileimg')->getClientOriginalName();
                   //Get only filename
                   $filename=pathinfo($filenamewithExt,PATHINFO_FILENAME);
                   //Get only ext
                   $extension=$request->file('fileimg')->getClientOriginalExtension();
                  
                   //Filename to store
                   $fileNameToStore=$filename.'_'.time().'.'.$extension;
                   //Upload Image to file
                  // $path=$request->file('fileimg')->storeAs('public/uploadfiles',$fileNameToStore);
                   $request->file('fileimg')->move('uploadfiles',$fileNameToStore);
              
                
   
                  
               
            }
            else{
                $fileNameToStore='';
            }
            $post->fileimg=$fileNameToStore;
            $post->save();
            return redirect('/')->with('success','The ticket updated');
            
           
            
        }
        else
        {
            //tickets reply
            $this->validate($request,[
              
                'contentticket'=>'required'
             ]);
           
            if(($reply)!==null)
            {
                $cc=unserialize($reply);
            }
            else
            {
                $cc=$reply;
            }
            $post->ticketreply=$request->input('contentticket');
            $cc[]=$post->ticketreply;
           // array_push($cc,$post->ticketreply);
            $post->ticketreply=serialize($cc);
            
          
            $post->save();
            
            return redirect('/')->with('success','Your ticket reply posted');
        }
    }catch(\Illuminate\Database\QueryException $ex)
    { 
       //dd($ex->getMessage()); 
       // Note any method of class PDOException can be called on $ex.
       echo "please check README.md file,ensure your database connect or table  is right";
     }

       
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{

        
        $post=UserPost::find($id);
        $reply=DB::table('userposts')->where('id', $id)->value('ticketreply');
        if(!empty($post))
       {
          if(auth()->user()->id ==$post->user_id)
            {
                $post->delete();
                return redirect('/')->with('success','The ticket Removed');
            }
           
       }
       else
       {
        return redirect('/')->with('error','Unauthorized Page');
       }
    }
    catch(\Illuminate\Database\QueryException $ex)
         { 
            //dd($ex->getMessage()); 
            // Note any method of class PDOException can be called on $ex.
            echo "please check README.md file,ensure your database connect or table  is right";
          }
       
    }
    /**************delete reply */
    public function delete(Request $request,$id,$key)
    {
        try{

        $post=Userpost::find($id);
        $reply=DB::table('userposts')->where('id', $id)->value('ticketreply');
        
       $cc=[];               
        if (Auth::check())
        {
           
            if(($reply)!==null)
            {
                $cc=unserialize($reply);
               unset($cc[$key]);
                
            }
            else
            {
                $cc=$reply;
            }
            
          
            $post->ticketreply=serialize($cc);
            
          
            $post->save();
        }
       
            
            return redirect('/')->with('success','Your ticket reply posted');
        }
        catch(\Illuminate\Database\QueryException $ex)
         { 
            //dd($ex->getMessage()); 
            // Note any method of class PDOException can be called on $ex.
          echo "please check README.md file,ensure your database connect or table  is right";
          }
    }

     /************** reply get  ticket*/
     public function getreply(Request $request,$id,$key)
     {
         try{
         $post=Userpost::find($id);
         $reply=DB::table('userposts')->where('id', $id)->value('ticketreply');
         $replyarray=[];               
         if(!empty($post))
         {
            if(auth()->user()->id ==$post->user_id)
              {
               
                  if(!empty($reply))

                  {
                    
                    $replyarray=unserialize($reply);
                  }
                  else
                  {
                    $replyarray=$reply;
                  }
                
              }
             
         }
         else
         {
          return redirect('/')->with('error','Unauthorized Page');
         }
         
         return view('userpost.reply',['post'=>$post,'key'=>$key,'replyarray'=>$replyarray]);
     
        }
        catch(\Illuminate\Database\QueryException $ex)
         { 
            //dd($ex->getMessage()); 
            // Note any method of class PDOException can be called on $ex.
           echo "please check README.md file,ensure your database connect or table  is right";
          }
    }
     /***********add array */
     public function reply_insert_after( array $array, $key, array $new ) {
        $keys = array_keys( $array );
        $index = array_search( $key, $keys );
        $pos = false === $index ? count( $array ) : $index + 1;
        return array_merge( array_slice( $array, 0, $pos ), $new, array_slice( $array, $pos ) );
    }
      /************** reply post  ticket*/
     public function postreply(Request $request,$id,$key)
    {
       try{
        $post=Userpost::find($id);
        $reply=DB::table('userposts')->where('id', $id)->value('ticketreply');
        
       $cc=[];               
        if (Auth::check())
        {
            $this->validate($request,[
              
                'contentadmin'=>'required'
             ]);
            if(($reply)!==null)
            {
                $cc=unserialize($reply);
               
               
            }
            else
            {
                $cc=$reply;
            }
           

            //$nn=$cc[$key];
            $nn=[];
           
           
            $post->ticketreply=$request->input('contentadmin');
            $newarray=array("<div class='useranswer'>user answer:".$post->ticketreply."</div>");
           
            $nn=$this->reply_insert_after($cc, $key, $newarray);
           
            $post->ticketreply=serialize($nn);
            
          
            $post->save();
        }
       
            
            return redirect('/')->with('success','Your ticket reply posted');
    
    }
    catch(\Illuminate\Database\QueryException $ex)
         { 
            //dd($ex->getMessage()); 
            // Note any method of class PDOException can be called on $ex.
           echo "please check README.md file,ensure your database connect or table  is right";
          }
}
   

}





