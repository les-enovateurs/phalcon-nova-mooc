{% extends 'layouts/unconnected.volt' %}{% block content %}
    {%  if errors is defined %}
        <div class="alert alert-danger">
            {{ errors }}
        </div>
    {% endif %}

    <form method="post" class="form-centrer text-center">
        <img class="mb-4" src="{{ url('img/logo72.png')}}" alt="logo">
        <h1 class="h3 mb-3 font-weight-normal">Register to NovaMooc</h1>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-address-card"></i></span>
            </div>
            {{ register_form.render("lastname") }}
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-address-card"></i></span>
            </div>
            {{ register_form.render("firstname") }}
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-at"></i></span>
            </div>
            {{ register_form.render("email") }}
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-key"></i></span>
            </div>
            {{ register_form.render("password") }}
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-key"></i></span>
            </div>
            {{ register_form.render("password_confirmation") }}
        </div>

        <div class="mb-3">
            {{ register_form.render('submit_button') }}
        </div>

        <small>If you already have an account,<a href="{{ url("/") }}" alt="connection"> click here to login</a></small>

    </form>
{% endblock %}