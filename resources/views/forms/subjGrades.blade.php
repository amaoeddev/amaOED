@extends('app')

@section('content')

<script type="text/javascript" src="script/select_jquery.js"></script>
<script>
    function showUser(level) {
        $.ajax({
            type: "GET",
            url: "/persubjects/" + level
        });
    }
</script>
<script>
    $(document).ready(function () {
        $("#studentlist").fadeIn();
        $("#enrollmentreport").hide();
        $("#shortcoursereport").hide();

        $("#studentbtnlist").click(function () {
            $("#studentlist").fadeIn();
            $("#enrollmentreport").hide();
            $("#shortcoursereport").hide();
        });

        $("#enrollmentbtnreport").click(function () {
            $("#studentlist").hide();
            $("#enrollmentreport").fadeIn();
            $("#shortcoursereport").hide();
        });

        $("#shortcoursebtnreport").click(function () {
            $("#studentlist").hide();
            $("#enrollmentreport").hide();
            $("#shortcoursereport").fadeIn();
        });
    });
    

</script>

<div class="container">

    <div class="col-md-3 col-sm-12">


        <div class="list-group">
            <div class="list-group-item active"><span class="glyphicon glyphicon-th-list" aria-hidden="true"></span> <b>Dashboard</b></div>
            <div class = "list-group-item" id="studentbtnlist">
                <a href="#"><span class="glyphicon glyphicon-stats" aria-hidden="true"></span> Student Directory</a>
            </div>
        </div>
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
<script type="text/javascript">
    window.onload = function () {
        getCourse();
    };
</script>
    <div class="col-md-9 col-sm-12">
        <h3>Student per Course with Grades</h3><hr>
        <form action="{{url('/list/grades/')}}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <select name="course" id="course">
                <option>Select Course:</option>
            </select><br><br>
            <input type="submit" value="Submit">
        </form>
            
    </div>
</div>
<script>
    var nowTemp = new Date();
    var now = new Date(nowTemp.getFullYear(), nowTemp.getMonth(), nowTemp.getDate(), 0, 0, 0, 0);

    var checkin = $('#datefrom').datepicker().on('changeDate', function (ev) {
        if (ev.date.valueOf() > checkout.date.valueOf()) {
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() + 1);
            checkout.setValue(newDate);
        }
        checkin.hide();
        $('#dateto')[0].focus();
    }).data('datepicker');
    var checkout = $('#dateto').datepicker().on('changeDate', function (ev) {
        checkout.hide();
    }).data('datepicker');



    var checkin1 = $('#datefrom1').datepicker().on('changeDate', function (ev) {
        if (ev.date.valueOf() > checkout1.date.valueOf()) {
            var newDate = new Date(ev.date)
            newDate.setDate(newDate.getDate() + 1);
            checkout1.setValue(newDate);
        }
        checkin1.hide();
        $('#dateto1')[0].focus();
    }).data('datepicker');
    var checkout = $('#dateto1').datepicker().on('changeDate', function (ev) {
        checkout1.hide();
    }).data('datepicker');
</script> 

@stop

