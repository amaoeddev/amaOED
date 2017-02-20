@extends('app')

@section('content')

<script type="text/javascript" src="script/select_jquery.js"></script>
<script>
$(document).ready(function(){
  $("#studentlist").fadeIn();
 
  $("#studentbtnlist").click(function(){
  $("#studentlist").fadeIn();
  });
    });
 
</script>

<div class="container">
    
    
    <div class="col-md-12">
    <div class="col-md-9">
        <div class="form-group">
        {!! Form::open(array('url'=>url('evaluation'))) !!}
            <input type="text" name="search" class="form-control">
        </div>
         </div>
        <div class="col-md-3">
        <input type="submit" value="search" class="btn btn-primary form-control">
        {!! Form::close() !!}
        </div>
        
    
    
        <div class="col-md-12">
        <div id ="studentlist">    
        <table class="table table-bordered">
            <tr><td>Ref</td><td>Name</td><td align="center">View</td></tr>
             <?php $count = 1;?>
            @foreach($users as $user)
            <tr><td><?php echo $count++;?></td><td>{{$user->fname}} {{$user->lname}}</td><td align="center"><a href='{{url("view/$user->id")}}'>view</a></td></tr>
    @endforeach
    </table>
            </div>
        </div>
</div>
</div>
@stop