<!DOCTYPE html>
<html lang="en">
    <head>
	<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta author="John Vincent Villanueva">
        <meta poweredby = "Nephila Web Technology, Inc">
        
        <link rel="stylesheet" href="{{ asset('printing.css') }}">
    </head>
    <body>
        <p style="margin-left: auto;margin-right: auto;width: 200px"><img src="{{asset('ama logo.png')}}" style="max-width: 200px;height: auto;"></p>
        <h4 class="header" style="text-align:center;">AMA Computer College</h4>
        <b><div class="header" style="text-align:center;">2016 - 2017</div></b>
        <h3 style="text-align:center;">REGISTRATION FORM</h3>
        <br>
        <table width='100%' border="0" style="border: 0px"> 
            <tr>
                <td style="border: 0px"><div style="display: inline-block;width: 100%;"><b style="padding-right: 20px;">NAME:</b></div></td>
                <td style="border: 0px"><div style="display: inline-block;width: 100%;"><b>{{strtoupper($studentInfo->lname)}}, {{strtoupper($studentInfo->fname)}} {{strtoupper($studentInfo->mname)}}</b></div></td>
                <td style="border: 0px"></td>
                <td style="border: 0px"></td>
            </tr>
            <tr>
                <td style="border: 0px"><div style="display: inline-block;width: 100%;"><b style="padding-right: 20px;">STUDENT ID:</b></td>
                <td style="border: 0px"><div style="display: inline-block;width: 100%;"><b>{{$studentInfo->studentid}}</b></div></td>
                <td style="border: 0px"></td>
                <td style="border: 0px"></td>
            </tr>
            <tr>
                <td style="border: 0px"><div style="display: inline-block;width: 100%;"><b style="padding-right: 20px;">PROGRAM CODE:</b></td>
                <td style="border: 0px"><div style="display: inline-block;width: 100%;">{{$studentCourse->programcode}}</div></td>
                <td style="border: 0px"><div style="display: inline-block;width: 100%; text-align: left;"><b>NATIONALITY:</b></div></td>
                <td style="border: 0px"><div style="display: inline-block;width: 100%; text-align: left;">{{$studentInfo->country}}</div></td>
            </tr>
            <tr>
                <td style="border: 0px"><div style="display: inline-block;width: 100%;"><b style="padding-right: 20px;">ADDRESS:</b></td>
                <td style="border: 0px"><div>{{$studentInfo->addr1}} {{$studentInfo->city}} {{$studentInfo->state}} {{$studentInfo->country}}</div></td>
                <td style="border: 0px"><div style="display: inline-block;width: 100%;"><b>BIRTHDATE:</b></div></td>
                <td style="border: 0px"></td>
            </tr>
        </table>
        <br>
        
        <table width="100%" cellpadding="1" cellspacing="0px">
            <thead>
                <th>SUBJECT</th>
                <th>DESCRIPTION</th>
                <th>UNITS</th>
            </thead>
            <tbody>
                @foreach($subjects as $subject)
                <tr>
                    <td>{{$subject->subjectcode}}</td>
                    <td>{{$subject->subjectname}}</td>
                    <td>{{$subject->unit}}</td>
                </tr>
                @endforeach
                <tr>
                    <th colspan="3"><div align="center">*****NOTHING FOLLOWS*****</div></th>
                </tr>
            </tbody>
        </table>
        
    </body>
</html>



