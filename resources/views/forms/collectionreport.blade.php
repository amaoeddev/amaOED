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
    <masterlist>  
        <div style="margin-left: auto;margin-right: auto;width: 200px"><img src="{{asset('ama logo.png')}}" style="max-width: 200px;height: auto;"></div>
        <h4 class="header" style="text-align:center;">AMA Computer College</h4>        
    </masterlist>
    <br>
    <table width="100%" cellpadding="1" cellspacing="0px">
        <thead>
        <th>USN</th>
        <th>Name</th>
        <th>No. of Enrolled Subjects</th>
        <th>Total Payment</th>
        <th>Pending Amount</th>
    </thead>
    <tbody>
        @foreach($collection as $collections)
        <tr>
            <td>{{$collections->studentid}}</td>
            <td>{{$collections->fname}} {{$collections->lname}}</td>
            <td>{{$collections->enrolled}}</td>
            <td>{{$collections->payment}}</td>
            <td>{{$collections->balance}}</td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>