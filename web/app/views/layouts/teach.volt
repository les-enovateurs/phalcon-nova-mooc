{{ get_doctype() }}
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{ renderTitle() }}
    {{ assets.outputCSS('head') }}
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('img/favicon.ico') }}"/>
</head>
<body>
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
        <h5 class="my-0 mr-md-auto font-weight-normal">Hi {{ user.firstname }},</h5>
        <a class="btn btn-outline-primary" href="{{ url("/logout") }}">Log out</a>
    </div>
    {% block content %} {% endblock %}
    <footer class="pt-4 my-md-5 pt-md-5 border-top">
        <div class="row">
            <div class="col-12 col-md">
                <img class="mb-2" src="{{ url('img/logo72.png')}}" alt="" width="24" height="24">
                <small class="d-block mb-3 text-muted">NovaMooc &copy; <?php echo date('Y'); ?></small>
            </div>
            <div class="col-6 col-md">
                <h5>About</h5>
                <ul class="list-unstyled text-small">
                    <li><a class="text-muted" href="#">The Team</a></li>
                    <li><a class="text-muted" href="#">Contact us</a></li>
                </ul>
            </div>
        </div>
    </footer>
</div>
</body>
</html>
