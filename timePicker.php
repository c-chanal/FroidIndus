<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/bootstrap-datetimepicker.min.css" />
    </head>
    <body>
        <div class="container">
            <div class="col-md-10">
                <div class='well'>
                    <div class="form-group">
                        <label for="time">Heure</label>
                        <div class='input-group date' id='datetimepicker1'>
                            <input type='text' class="form-control" id="time"/>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="date">Date</label>
                        <div class='input-group date' id='datetimepicker2'>
                            <input type='text' class="form-control" id="date" />
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script type="text/javascript" src="js/jquery.js"></script>
        <script type="text/javascript" src="js/moment.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/bootstrap-datetimepicker.min.js"></script>
        <script type="text/javascript" src="js/bootstrap-datetimepicker.fr.js"></script>
        <script type="text/javascript">
            $(function() {
                $('#datetimepicker1').datetimepicker({
                    language: 'fr',
                    pickDate: false,
                    defaultDate: new Date()
                });
                $('#datetimepicker2').datetimepicker({
                    language: 'fr',
                    pickTime: false,
                    defaultDate: new Date()
                });
            });
        </script>
    </body>
</html>