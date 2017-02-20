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
        <h3 style="text-align:center;">Student per Course with Grades</h3>
        <br>
        <br>
        
        <table width="100%" cellpadding="1" cellspacing="0px">
            <thead>
                <th>No.</th>
                <th>FIRSTNAME</th>
                <th>LASTNAME</th>
                <th>COURSE</th>
                <th>FINAL GRADE</th>
            </thead>
            <tbody><?php $count = 1; ?>
                @foreach($results as $result)
                <tr>
                    <td><?php echo $count++; ?></td>
                    <td>{{$result->firstname}}</td>
                    <td>{{$result->lastname}}</td>
                    <td>{{$result->fullname}}</td>
                    <td>{{$result->finalgrade}}</td>
                </tr>
                @endforeach
                <tr>
                    <th colspan="5"><div align="center">*****NOTHING FOLLOWS*****</div></th>
                </tr>
            </tbody>
        </table>
        
    </body>
</html>



