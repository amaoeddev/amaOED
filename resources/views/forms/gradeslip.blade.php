<!DOCTYPE html>
<html lang="en">
    <head>
	<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta author="John Vincent Villanueva">
        <meta poweredby = "Nephila Web Technology, Inc">
        
        <link rel="stylesheet" href="{{ asset('printing.css') }}">
        <title>Grade Slip - {{strtoupper($studentInfo->fname)}} {{strtoupper($studentInfo->lname)}}</title>
    </head>
    <body>
        <p><div align="center"><img src="{{asset('gradeslip.png')}}" style="width: 800px;height: 190px;"></div></p>
        <h2 class="header" style="text-align:center;">AMA University Online Education</h2>
        <h3><b><div class="header" style="text-align:center;">System Generated Grade Slip</div></b></h3>
        <br><hr style="display: block">
        <table width='100%' border="0" style="border: 0px"> 
            <tr>
                <td style="border: 0px"><div align="center" style="display: inline-block;width: 100%;"><b style="padding-right: 20px;">NAME: {{strtoupper($studentInfo->lname)}}, {{strtoupper($studentInfo->fname)}} {{strtoupper($studentInfo->mname)}} USN: {{$studentInfo->studentid}} COURSE: {{$studentCourse->programcode}}</b></div></td>
            </tr>
        </table><hr style="display: block">
        <br>
        
        <table width="100%" cellpadding="1" cellspacing="0px" style="border:none">
            <thead>
                <th width="100px" style="border:none"></th>
                <th style="border:none">COURSE</th>
                <th style="border:none">GRADE</th>
                <th style="border:none">ACTUAL</th>
                <th style="border:none">EQUIVALENT</th>
                <th width="100px" style="border:none"></th>
            </thead>
            <tbody style="border:none">
                @foreach($results as $result)
                <tr>
                    <td style="border:none"></td>
                    <td style="border:none">{{$result->Course}}</td>
                    <td style="border:none"><div align="center">{{$result->finalgrade}}</div></td><td style="border:none" width = 150px><div align="center">
                        @if ($result->finalgrade>=96) 1
                        @elseif ($result->finalgrade>=91) 1.25
                        @elseif ($result->finalgrade>=86) 1.50
                        @elseif ($result->finalgrade>=81) 1.75
                        @elseif ($result->finalgrade>=75) 2.00
                        @elseif ($result->finalgrade>=69) 2.25
                        @elseif ($result->finalgrade>=63) 2.50
                        @elseif ($result->finalgrade>=57) 2.75
                        @elseif ($result->finalgrade>=50) 3.00
                        @else 5.00
                        @endif
                        </div></td>
                    <td style="border:none" width = 150px><div align="center">
                        @if ($result->finalgrade>=96) A+
                        @elseif ($result->finalgrade>=91) A
                        @elseif ($result->finalgrade>=86) A-
                        @elseif ($result->finalgrade>=81) B+
                        @elseif ($result->finalgrade>=75) B
                        @elseif ($result->finalgrade>=69) B-
                        @elseif ($result->finalgrade>=63) C+
                        @elseif ($result->finalgrade>=57) C
                        @elseif ($result->finalgrade>=50) C-
                        @else F
                        @endif
                        </div></td>
                    <!--<td style="border:none" width = 150px><div align="center">A</div></td>-->
                    <td style="border:none"></td>
                </tr>
                @endforeach
                <tr>
                    <th style="border:none" colspan="5"><div align="center">*****NOTHING FOLLOWS*****</div></th>
                </tr>
            </tbody>
        </table><br>
        <div align="center" style= "color:red; font-size:7pt"><p>Note: This is a system generated form and does not require signature. For validation, you may reach us through our email address or hotlines.</p></div><br>
        <div align="center" style= "font-size:7pt"><p>AMA University Online Education #59 Panay Avenue Quezon City Philippines 1103</p></div>
        <div align="center" style= "font-size:7pt"><p>customer@amauonline.com / courseadmin@amauonline.com / helpdesk@amauonline.com</p></div>
        <div align="center" style= "font-size:7pt"><p>+632-8637030 / +63917-2092628 / +63928-4733069</p></div>
        
    </body>
</html>


