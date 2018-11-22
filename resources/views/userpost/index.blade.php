@extends('layouts.app')
@section('content')
  
      <h3>Ticket List</h3>
      
      @if(!empty($svalue))
        {{$svalue}}
      @endif
    
      @if(count($posts)>0)
     <ul class="list-group ulstyle">
        
        @foreach($posts as $post)
        <li class="list-group-item">
           <div><h3><a href="{{asset('/userpost')}}/{{$post->id}}">{{$post->title}}</a></h3></div>
           
           <div class="distance"><small>Ticket post on {{$post->created_at}} by  {{$post->user->name}}</small></div>
           <div>
              <?php 
              $fxls ='uploadfiles/'.$post->fileimg;
             if(file_exists($fxls))
              {
               $ext=pathinfo($post->fileimg, PATHINFO_EXTENSION);
              if(!empty($ext))
              {
               
               echo '<ul class="list-group ">';
              echo '<p class="patt" ><span>Check attachment files</span></p>';
              
               echo '<li class="list-group-item attachement">';
               
              
              if($ext=="xlsx" || $ext=="xls" || $ext=="csv")
              {
               require '../vendor/autoload.php';
  //create directly an object instance of the IOFactory class, and load the xlsx file
  
  //$fxls ='robots.txt';
  $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($fxls);
  
  
  //read excel data and store it into an array
  $xls_data = $spreadsheet->getActiveSheet()->toArray(null, true, true, true);
  
  
  //now it is created a html table with the excel file data
  $html_tb ='<table border="1"><tr><th>'. implode('</th><th>', $xls_data[1]) .'</th></tr>';
  $nr = count($xls_data); //number of rows
  for($i=2; $i<=$nr; $i++){
   $html_tb .='<tr><td>'. implode('</td><td>', $xls_data[$i]) .'</td></tr>';
  }
  $html_tb .='</table>';
  
  echo $html_tb;
              }
              elseif($ext=="html")
              {
               echo file_get_contents($fxls);
              }
              elseif($ext=="xml")
              {
  
              }
              elseif($ext=="doc" || $ext=="docx")
              {
               
  // Creating the new document...
              $phpWord = new \PhpOffice\PhpWord\PhpWord();
               //require '../vendor/phpoffice/phpword/bootstrap.php';
               
               //$objReader= \PhpOffice\PhpWord\IOFactory::createReader('Word2007');
               //$phpWord= $objReader->load($fxls);
               
             
               
               /***convert docx to html***/
               $phpWord = \PhpOffice\PhpWord\IOFactory::load($fxls);
               $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'HTML');
               $objWriter->save('temp.html');
               echo file_get_contents('temp.html');
              }
              
              elseif($ext=="zip")
              {
               $zip=zip_open($fxls);
               if($zip)
               {
                 while($zip_entry=zip_read($zip))
                 {
                   echo "<p>";
                     echo "Zip name:".zip_entry_name($zip_entry)."<br/>";
                     if(zip_entry_open($zip,$zip_entry))
                     {
                       echo "File Contents:<br/>";
                       $contents=zip_entry_read($zip_entry);
                       echo "$contents<br/>";
                       zip_entry_close($zip_entry);
                     }
                     echo "</p>";
  
                 
                 }
             
               zip_close($zip);
               }
              }
             
              elseif($ext=="mp4" || $ext=="webm" )
              {
               echo '<video  controls>';
               echo '<source src= "'.$fxls.'" type="video/'.$ext.'" style="width:100%;">';
               echo "Your browser does not support the video tag.";
               echo '</video>';
              }
              elseif($ext=="txt" )
              {
               $myfile=fopen($fxls,"r") or die("Unable to open file");
               echo fread($myfile,filesize($fxls));
               fclose($myfile);
              }
              elseif($ext=="jpg" || $ext=="png" ||$ext=="gif" || $ext=="jpeg")
              {
               echo '<img class="img-fluid" src="'.$fxls.'" />';
               
              }
              
              echo '</li>';
              
              echo '</ul>';
             }
             }
             ?>
  
  
            
         </div>
           @if(!empty($post->ticketreply))
           <ul class="list-group">
             
           
            @foreach($post->ticketreply as $key=>$item)
            <li class="list-group-item replyli">
              {!!$item!!}
              @if(!Auth::guest())
              @if(Auth::user()->id==$post->user_id)
              <div>
              <a href="{{URL('/userpost/reply/'.$post->id.'/'.$key)}}" class="btn btn-primary replybutton">Reply</a> 
              {!!Form::open(['action'=>['UserPostController@delete',$post->id,$key],'method'=>'POST','class'=>'float-right'])!!}
                 {{Form::hidden('_method','PUT')}}
                 {{Form::submit('Delete ticket reply',['class'=>'btn btn-warning'])}}
              {!!Form::close()!!}
              </div>
              @endif
              @endif
            </li>
            @endforeach
             
            </ul>
            @else
             <p>this ticket no reply</p>
            @endif
        
            
           @if(Auth::guest())
           <div>
           <div  class="float-right btn btn-success replybt"><a href="{{asset('/userpost')}}/{{$post->id}}">Ticket reply</a></div>
        @endif
        </li>
          @endforeach
       
    </ul>
        {{$posts->links()}}
      @else
       <p>No any ticket now</p>
      @endif
      

   
@endsection




             
           


