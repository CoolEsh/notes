<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <link href="/css/jquery-ui.min.css" rel="stylesheet" />
    <link href="/css/bootstrap/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            padding-top: 50px;
        }
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="/js/jquery-ui.min.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <script src="/js/scripts/main.js"></script>

    {$this->headTitle()}
    {$this->headMeta()}
    {$this->headScript()}
    {$this->headLink()}
    {$this->headStyle()}
</head>

<body>

<div class="navbar navbar-inverse navbar-fixed-top navigation" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="/">Notes</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">Add <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="/note/add-text/">Text note</a></li>
                        <li><a href="/note/add-todo/">To-do list</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>

{$this->layout()->content}

<div id="modal_dialog" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal_dialog_title"></h4>
            </div>
            <div class="modal-body">
                <p class="modal_dialog_message"></p>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>

</body>
</html>