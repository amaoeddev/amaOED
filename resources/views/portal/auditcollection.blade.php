@extends('app')

@section('content')

<script type="text/javascript" src="script/select_jquery.js"></script>
<script>
$(document).ready(function(){
  $("#studentlist").fadeIn();
  $("#enrollmentreport").hide();
  $("#shortcoursereport").hide();
  
  $("#studentbtnlist").click(function(){
  $("#studentlist").fadeIn();
  $("#enrollmentreport").hide();
  $("#shortcoursereport").hide();
  });
    
  $("#enrollmentbtnreport").click(function(){
  $("#studentlist").hide();
  $("#enrollmentreport").fadeIn();
  $("#shortcoursereport").hide();
  });
  
  $("#shortcoursebtnreport").click(function(){
  $("#studentlist").hide();
  $("#enrollmentreport").hide();
  $("#shortcoursereport").fadeIn();
  });
    });
 
</script>

<div class="container">
   
    <div class="col-md-3 col-sm-12">
   
      
        <div class="list-group" >
        <div class="list-group-item active"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <b>Enrollment Report</b></div>    
        <div class = "list-group-item" id="enrollmentbtnreport">
        <a href="#"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Degree Courses</a>
        </div>
        <div class = "list-group-item" id="shortcoursebtnreport">
        <a href="#"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Short Courses</a>
        </div>
        </div>  
        
        
    </div>
       
    <div class="col-md-9 col-sm-12">
        
        <div class="row" id = "studentlist">  
        <div class="col-md-9 col-sm-12">    
            
         </div>
        </div>
        
        <div class = "row" id="enrollmentreport">    
            <div class="form-group">
            <div class="list-group-item-danger"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <b>Degree Courses Enrollment Report</b></div>              
            {!! Form::open(array('url'=>url('audit'))) !!}
            <div class="list-group-item" >
            <label for="datefrom"> From :</label> <input type="date" id="datefrom" name="datefrom" class="form-control" data-date-format="yyyy-mm-dd">
            <input type="hidden" name="whattype" value="table"></div>
            <div class="list-group-item">
            <label for="dateto"> To :</label> <input type="date" id="dateto" name="dateto" class="form-control" data-date-format="yyyy-mm-dd">
            </div> 
            <div class="list-group-item">
            <input type="submit" value="View" class="btn btn-primary form-control">
            {!! Form::close() !!}
            </div>
            </div>
        </div>
    
           <div class = "row" id="shortcoursereport">    
            <div class="form-group">
              <div class="list-group-item-info"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <b>Short Courses Enrollment Report</b></div>           
              {!! Form::open(array('url'=>url('auditshortcourse'))) !!}
            <div class="list-group-item" >
            <label for="datefrom"> From :</label> <input type="date" id="datefrom1" name="datefrom" class="form-control" data-date-format="yyyy-mm-dd">
            <input type="hidden" name="whattype" value="table"></div>
            <div class="list-group-item">
            <label for="dateto"> To :</label> <input type="date" id="dateto1" name="dateto" class="form-control" data-date-format="yyyy-mm-dd">
            </div> 
            <div class="list-group-item">
            <input type="submit" value="View" class="btn btn-primary form-control">
            {!! Form::close() !!}
            </div>
            </div>
        </div>
        <h1>Total Collection</h1><hr>
        <form action='/generate/totalcollection' method='POST'>
            <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
            <label>Month:</label>
            <select id='month' name='month'>
                <option value='%'></option>
                <option value='01-%'>January</option>
                <option value='02-%'>February</option>
                <option value='03-%'>March</option>
                <option value='04-%'>April</option>
                <option value='05-%'>May</option>
                <option value='06-%'>June</option>
                <option value='07-%'>July</option>
                <option value='08-%'>August</option>
                <option value='09-%'>September</option>
                <option value='10-%'>October</option>
                <option value='11-%'>November</option>
                <option value='12-%'>December</option>
            </select><br><br>
            <label>Year:</label>
            <select id="year" name="year">
            <script>
            var myDate = new Date();
            var year = myDate.getFullYear();
            for(var i = 2015; i < year+1; i++){
                    document.write('<option value="'+i+'">'+i+'</option>');
            }
            </script>
            </select><br><br>
            <input type='submit' value='Generate Report'>
        </form>
        </div>    
    </div>
<script>
    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);
     
    var checkin = $('#datefrom').datepicker().on('changeDate', function(ev) {
      if (ev.date.valueOf() > checkout.date.valueOf()) {
        var newDate = new Date(ev.date)
        newDate.setDate(newDate.getDate() + 1);
        checkout.setValue(newDate);
      }
      checkin.hide();
      $('#dateto')[0].focus();
    }).data('datepicker');
    var checkout = $('#dateto').datepicker().on('changeDate', function(ev) {
      checkout.hide();
    }).data('datepicker');
    
    
    
     var checkin1 = $('#datefrom1').datepicker().on('changeDate', function(ev) {
      if (ev.date.valueOf() > checkout1.date.valueOf()) {
        var newDate = new Date(ev.date)
        newDate.setDate(newDate.getDate() + 1);
        checkout1.setValue(newDate);
      }
      checkin1.hide();
      $('#dateto1')[0].focus();
    }).data('datepicker');
    var checkout = $('#dateto1').datepicker().on('changeDate', function(ev) {
      checkout1.hide();
    }).data('datepicker');
</script> 

@stop

