    <!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @if (Auth::guest())
        <title>AMA University Online</title>
        @else
        <title>{{ Auth::user()->fname }} {{ Auth::user()->lname }} - AMA University</title>       
        <style>
            .dropdown-submenu {
                position: relative;
            }

            .dropdown-submenu>.dropdown-menu {
                top: 0;
                left: 100%;
                margin-top: -6px;
                margin-left: -1px;
                -webkit-border-radius: 0 6px 6px 6px;
                -moz-border-radius: 0 6px 6px;
                border-radius: 0 6px 6px 6px;
            }

            .dropdown-submenu:hover>.dropdown-menu {
                display: block;
            }

            .dropdown-submenu>a:after {
                display: block;
                content: " ";
                float: right;
                width: 0;
                height: 0;
                border-color: transparent;
                border-style: solid;
                border-width: 5px 0 5px 5px;
                border-left-color: #ccc;
                margin-top: 5px;
                margin-right: -10px;
            }

            .dropdown-submenu:hover>a:after {
                border-left-color: #fff;
            }

            .dropdown-submenu.pull-left {
                float: none;
            }

            .dropdown-submenu.pull-left>.dropdown-menu {
                left: -100%;
                margin-left: 10px;
                -webkit-border-radius: 6px 0 6px 6px;
                -moz-border-radius: 6px 0 6px 6px;
                border-radius: 6px 0 6px 6px;
            }
        </style>
        <script>

//         var explode = function(){

//         $.get('/checksession',function(data){
//             if(data=="false"){
//                 document.location='auth/logout';
//             }
//         })
//         setTimeout(explode, 2000);
//     }
//            setTimeout(explode, 2000);
//        </script>	

        @endif
        <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/fileinput.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/datepicker.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/jquery-ui-min.css') }}" rel="stylesheet">
        <link href="{{ asset('/css/jquery-ui-theme.css') }}" rel="stylesheet">
        <!-- Fonts -->
        <link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
                <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
        <script src="{{asset('/script/fileinput.js')}}"></script>
        <script src="{{asset('/script/bootstrap-datepicker.js')}}"></script>
        <script src="{{asset('/script/jquery-ui.min.js')}}"></script>
        <script src="/script/select_jquery.js"></script>
    </head>
    <body> 
        <div class= "container-fluid">
            <div class="col-md-12">
                <img class ="img-responsive" style ="margin-top:10px;" src = "{{ asset('/images/AMAOnlineEduc.png') }}" alt="AMA Online" />
            </div>
        </div>

        <nav class="navbar navbar-default" style="background-color: maroon;">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="http://www.amauonline.com">AMA University Online</a></li>
                        <li><a href="http://portal.amauonline.com">My Portal</a></li>
                        <li><a href="http://lms.amauonline.com">My Class</a></li>
                        @if(Auth::guest())
                        @else
                        @if(Auth::user()->accesslevel==1)
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Reports<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">

                                <!--                                                        <li><a href="#">Final Grades</a></li>-->
                                <li class="dropdown-submenu">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">List of Enrolled Students Per Program</a>
                                    <ul class="dropdown-menu">
                                        <li class="dropdown-submenu">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Academic Programs</a>
                                            <ul class="dropdown-menu">
                                                <li><a href={{url('bsit/students')}}>Bachelor of Science in Information Technology</a></li>
                                                <li><a href={{url('bscs/students')}}>Bachelor of Science in Computer Science</a></li>
                                                <li><a href={{url('bscpe/students')}}>Bachelor of Science in Computer Engineering</a></li>
                                                <li><a href={{url('bsa/students')}}>Bachelor of Science in Accountancy</a></li>
                                                <li><a href={{url('bse/students')}}>Bachelor of Arts in Economics</a></li>
                                                <li><a href={{url('abe/students')}}>Bachelor of Arts in English</a></li>
                                                <li><a href={{url('abmascom/students')}}>Bachelor of Arts in Mass Communication</a></li>
                                                <li><a href={{url('abpolsci/students')}}>Bachelor of Arts in Psychology</a></li>
                                                <li><a href={{url('bscs/students')}}>Bachelor of Arts in Political Science</a></li>
                                                <li><a href={{url('beed/students')}}>Bachelor of Elementary Education</a></li>
                                                <li><a href={{url('bsed-cs/students')}}>Bachelor of Secondary Education Major in Computer Science</a></li>
                                                <li><a href={{url('bsed-math/students')}}>Bachelor of Secondary Education Major in Mathematics</a></li>
                                                <li><a href={{url('bsed-english/students')}}>Bachelor of Secondary Education Major in English</a></li>
                                                <li><a href={{url('bsba-mis/students')}}>Bachelor of Science in Business Administration Major in MIS</a></li>
                                                <li><a href={{url('pg-mba/students')}}>Master in Business Administration</a></li>
                                                <li><a href={{url('pg-mit/students')}}>Master in Information Technology</a></li>
                                                <li><a href={{url('pg-mcs/students')}}>Master of Science in Computer Science</a></li>
                                            </ul>
                                        </li>
                                        <li class="dropdown-submenu">
                                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Short Courses</a>
                                            <ul class="dropdown-menu">
                                                <li><a href={{url('1/shortcourse/students')}}>XML - Based Web Application</a></li>
                                                <li><a href={{url('2/shortcourse/students')}}>Mail and Web Services</a></li>
                                                <li><a href={{url('3/shortcourse/students')}}>Network Security</a></li>
                                                <li><a href={{url('4/shortcourse/students')}}>Linux Adminstration</a></li>
                                                <li><a href={{url('6/shortcourse/students')}}>Multimedia Communications System</a></li>
                                                <li><a href={{url('7/shortcourse/students')}}>Multimedia Sound and Video</a></li>
                                                <li><a href={{url('8/shortcourse/students')}}>Web Application Development using JSP and OBDC</a></li>
                                                <li><a href={{url('9/shortcourse/students')}}>Web Application Development using PHP and MySQL</a></li>
                                                <li><a href={{url('10/shortcourse/students')}}>Visual Graphics Design 101</a></li>
                                                <li><a href={{url('11/shortcourse/students')}}>Illustrations 101</a></li>
                                                <li><a href={{url('17/shortcourse/students')}}>Digital Photography</a></li>
                                                <li><a href={{url('19/shortcourse/students')}}>Fundamentals of Accounting (Bookkeeping)</a></li>
                                                <li><a href={{url('20/shortcourse/students')}}>Visual Basic .NET</a></li>
                                                <li><a href={{url('21/shortcourse/students')}}>Principles of Operating System</a></li>
                                                <li><a href={{url('22/shortcourse/students')}}>Object Oriented Programming</a></li>
                                                <li><a href={{url('23/shortcourse/students')}}>MS SQL Server 2012</a></li>
                                                <li><a href={{url('24/shortcourse/students')}}>Mobile Programming 1</a></li>
                                                <li><a href={{url('24/shortcourse/students')}}>MS Certified Technology Specialist</a></li>
                                                <li><a href={{url('25/shortcourse/students')}}>Linux Essentials</a></li>
                                                <li><a href={{url('26/shortcourse/students')}}>MS Office Essentials</a></li>
                                                <li><a href={{url('27/shortcourse/students')}}>Introduction to World Wide Web</a></li>
                                                <li><a href={{url('28/shortcourse/students')}}>Database Management System 1</a></li>
                                                <li><a href={{url('29/shortcourse/students')}}>CISCO 1</a></li>
                                                <li><a href={{url('30/shortcourse/students')}}>CISCO 2</a></li>
                                                <li><a href={{url('31/shortcourse/students')}}>CISCO 3</a></li>
                                                <li><a href={{url('32/shortcourse/students')}}>CISCO 4</a></li>
                                                <li><a href={{url('33/shortcourse/students')}}>Computer Programming 1</a></li>
                                                <li><a href={{url('34/shortcourse/students')}}>Computer Programming 3</a></li>
                                                <li><a href={{url('35/shortcourse/students')}}>Unified Functional Testing</a></li>
                                                <li><a href={{url('36/shortcourse/students')}}>Application Lifecycle Management</a></li>
                                                <li><a href={{url('37/shortcourse/students')}}>Load Runner</a></li>
                                                <li><a href={{url('39/shortcourse/students')}}>Big Data Analytics</a></li>
                                            </ul>
                                        </li>
                                    </ul>

                                    <!--                                                        <li><a href="#">List of Paid Students</a></li>
                                                                                            <li><a href="#">Grade Slip</a></li>-->
                                <li><a href="/list/subject">List of Enrolled per Course</a></li>
                                <li><a href="/list/course">List of Enrolled per Course with Grades</a></li>
                                <li><a href="/passed/grades/course">List of Passed Students per Course with Grades</a></li>
                                <li><a href="/perstudent">Total Credited Course, Total Passed, Total Remaining Course</a></li>
                            </ul>
                        </li>
                        <!--                                            <li class="dropdown">
                                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Accounting and Audit<span class="caret"></span></a>
                                                                        <ul class="dropdown-menu" role="menu">
                                                                                <li><a href="#">Student's Account</a></li>
                                                                                <li><a href="#">Total Collection</a></li>
                                                                        </ul>
                                                                    </li>-->
                        @else
                        @endif
                        @if(Auth::user()->accesslevel==2)
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Reports<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="/totalcollection">Total Collection</a></li>
                                <li><a href="/collectionreport">Total Payment, Pending of Students</a></li>
                            </ul>
                            @endif
                            @endif
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        @if (Auth::guest())
                        <li><a href="{{ url('/auth/login') }}">Login</a></li>
                        <li><a href="{{ url('/auth/register') }}">Register</a></li>
                        @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->fname }} {{ Auth::user()->lname }}<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/auth/logout') }}">Logout</a></li>
                            </ul>
                        </li>

                        @endif
                    </ul>
                </div>
            </div>
        </nav>

        @yield('content')

        <!-- Scripts -->

        <footer class="footer">
            <div class="container_fluid">
                <p class="text-muted"> Copyright 2015, AMA University All Rights Reserved.</p>
            </div>
        </footer>

    </body>
</html>
