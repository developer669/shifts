<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <link rel="stylesheet" href="includes/style.css">
    <link rel="shortcut icon" href="images/icon.png">
    <title>Ultimate Scheduler</title>
</head>
<body class="configuration">
<div class="container">
    <header>
        <a id="logo" href="#">Ultimate Scheduler</a>
        <div>
            <div class="dropdown">
                <a href="#" class="dropdown-toggle" class="menu1" data-toggle="dropdown"><img src="images/profile.png"></a>
                <ul class="dropdown-menu" aria-labelledby="menu1">
                </ul>
            </div>
            <div class="dropdown">
                <a href="#" class="dropdown-toggle" class="menu1" data-toggle="dropdown"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span></a>
                <ul class="dropdown-menu" aria-labelledby="menu1">
                </ul>
            </div>
            <div class="dropdown">
                <a href="#" class="dropdown-toggle" class="menu1" id="notification" data-toggle="dropdown"><span class="glyphicon glyphicon-bell" aria-hidden="true"></span></a>
                <span class="buttonBadge"></span>
                <ul class="dropdown-menu" aria-labelledby="menu1">
                    <li>
                        <a href="constrains.html">Moshe cohen sent new constrains
                            <div class="clear"></div>
                            <small>20 min ago</small>
                        </a>
                    </li>
                    <li>
                        <a href="#"><b>Remember to publish new shifts
                            <div class="clear"></div>
                            <small>Important</small></b>
                        </a>
                    </li>
                    <li>
                        <a href="#">Tal Kot sent new constrains
                            <div class="clear"></div>
                            <small>Yesterday at 10:23am</small>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </header>
    <div class="clear"></div>
    <nav>
        <ul>
            <li><a href="index.html"><span class="glyphicon glyphicon-calendar" aria-hidden="true" data-placement="right" title="Dashboard"></span><p>  Dashboard</p></a></li>
            <li><a href="#"><span class="glyphicon glyphicon-user" aria-hidden="true" data-placement="right" title="Users Management"></span><p>  Users Management</p></a></li>
            <li><a href="constrains.html"><span class="glyphicon glyphicon-list-alt" aria-hidden="true" data-placement="right" title="Constrains"></span><p>  Constrains</p></a></li>
            <li><a href="#"><span class="glyphicon glyphicon-time" aria-hidden="true" data-placement="right" title="Working Time"></span><p>  Working Time</p></a></li>
            <li><a href="#"><span class="glyphicon glyphicon-signal" aria-hidden="true" data-placement="right" title="Performance"></span><p>  Performance</p></a></li>
            <li><a href="configuration.html"><span class="glyphicon glyphicon-cog" aria-hidden="true" data-placement="right" title="Configuration"></span><p>  Configuration</p></a></li>
        </ul>
    </nav>
    <main>
        <h1>Configuration</h1>
        <section>
                <form id="configForm">
                    <div class="input-group">
                        <input type="text" name="companyName" class="form-control" placeholder="Company Name" required disabled>
                    </div>
                    <div class="input-group">
                        <input type="text" name="firstName" class="form-control" placeholder="First Name" required>
                    </div>
                    <div class="input-group">
                        <input type="text" name="lastName" class="form-control" placeholder="Last Name" required>
                    </div>
                    <div class="clear"></div>
                    <div class="input-group">
                        <h4>Shifts definition</h4>
                        <a href="#"><span class="glyphicon glyphicon-plus add"></span></a>
                        <div id="shifts"></div>
                    </div>
                    <div class="input-group">
                    <button type="button" class="btn approve settings"> Apply</button>
                    <button type="reset" class="btn reset"> Reset</button>
                    </div>
                </form>
        </section>
        <div class="alert alert-success" role="alert">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Success!</strong> <p>New configurations have been saved</p>
        </div>
    </main>
    <div class="clear"></div>
    <footer>
        <p>Copyright © Ultimate Scheduler. All Rights Reserved</p>
    </footer>
</div>

<script type="text/javascript" src="includes/tableExport.js"></script>
<script type="text/javascript" src="includes/jquery.base64.js"></script>
<script type="text/javascript" src="includes/jspdf/libs/sprintf.js"></script>
<script type="text/javascript" src="includes/jspdf/jspdf.js"></script>
<script type="text/javascript" src="includes/jspdf/libs/base64.js"></script>
<script src="includes/app.js"></script>
<script src="includes/moment-with-locales.min.js"></script>
<script src="includes/moment-timezone.min.js"></script>
</body>
</html>