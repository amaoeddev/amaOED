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

    <div class="col-md-9 col-sm-12">
        <h3>Student per Course</h3><hr>
        <form action="{{url('/grade/subject')}}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <select name="level" onchange="getLevel(this.value)">
                <option value=null>Select level:</option>
                <option value="1st">First Level</option>
                <option value="2nd">Second Level</option>
                <option value="3rd">Third Level</option>
                <option value="4th">Fourth Level</option>
            </select><br><br>
            <select name="term" onchange="getValue(level.value, this.value)" id="term">
                <option>Select term:</option>
            </select><br><br>
            <select name="subject" id="subject">
                <option>Select Subject:</option>
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

