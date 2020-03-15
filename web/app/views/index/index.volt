{% extends 'layouts/unconnected.volt' %}{% block content %}
    {%  if errors is defined %}
        <div class="alert alert-danger">
            {{ errors }}
        </div>
    {% endif %}

    <form method="post" class="form-centrer text-center">
        <img class="mb-4" src="{{ url('img/logo72.png')}}" alt="logo">
        <h1 class="h3 mb-5 font-weight-normal">Login to NovaMooc</h1>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-at"></i></span>
            </div>
            {{ connection_form.render("email") }}
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-key"></i></span>
            </div>
            {{ connection_form.render("password") }}
        </div>

        <div class="mb-3">
            {{ connection_form.render('submit_button') }}
        </div>

        <small>If you don't have an account,<a href="{{ url("register") }}" alt="register"> click here to create one!</a></small>
    </form>
{% endblock %}