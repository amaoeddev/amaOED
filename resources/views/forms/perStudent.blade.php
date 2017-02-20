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
                <th>NO.</th>
                <th>USN</th>
                <th>NAME</th>
                <th>NOT YET TAKEN</th>
                <th>PAID</th>
                <th>CREDITED</th>
                <th>FOR PAYMENT</th>
                <th>PASSED</th>
                <th>NOT REQUIRED</th>
            </thead>
            <tbody><?php $count = 1; ?>
                @foreach($result as $results)
                <tr>
                    <td><?php echo $count++; ?></td>
                    <td>{{$results->studentid}}</td>
                    <td>{{$results->lname}}, {{$results->fname}} {{$results->mname}}</td>
                    <td>{{$results->not_yet_taken + $results->not_yet_taken2}}</td>
                    <td>{{$results->paid}}</td>
                    <td>{{$results->credited}}</td>
                    <td>{{$results->for_payment}}</td>
                    <td>{{$results->passed}}</td>
                    <td>{{$results->not_required}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
      
    </body>
</html>



