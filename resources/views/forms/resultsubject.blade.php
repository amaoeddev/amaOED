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
        <br>

        <table width="100%" cellpadding="1" cellspacing="0px">
            <thead>
            <th>NO.</th>
            <th>USN</th>
            <th>Firstname</th>
            <th>Lastname</th>
            <th>Term</th>
            <th>Level</th>
            <th>Subject Code</th>
            <th>Subject Name</th>
        </thead>
        <tbody><?php $count = 1; ?>
            @foreach($sql as $sqls)
            <tr>
                <td><?php echo $count++; ?></td>
                <td>{{$sqls->studentid}}</td>
                <td>{{$sqls->fname}}</td>
                <td>{{$sqls->lname}}</td>
                <td>{{$sqls->term}}</td>
                <td>{{$sqls->level}}</td>
                <td>{{$sqls->subjectcode}}</td>
                <td>{{$sqls->subjectname}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>



