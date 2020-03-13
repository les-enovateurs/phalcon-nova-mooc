{% extends 'layouts/non_connecte.volt' %}

{% block contenu %}
    {%  if erreurs is defined %}
        <div class="alert alert-danger">
            {{ erreurs }}
        </div>
    {% endif %}

    <form method="post" class="form-centrer text-center">
        <img class="mb-4" src="{{ url('img/logo72.png')}}" alt="logo">
        <h1 class="h3 mb-3 font-weight-normal">Inscription à NovaMooc</h1>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-address-card"></i></span>
            </div>
            {{ inscription_form.render("lastname") }}
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-address-card"></i></span>
            </div>
            {{ inscription_form.render("firstname") }}
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-at"></i></span>
            </div>
            {{ inscription_form.render("email") }}
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-key"></i></span>
            </div>
            {{ inscription_form.render("password") }}
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-key"></i></span>
            </div>
            {{ inscription_form.render("password_confirmation") }}
        </div>

        <div class="mb-3">
            {{ inscription_form.render('bouton_de_soumission') }}
        </div>

        <small>Si vous avez déjà un compte, <a href="{{ url("/") }}" alt="connexion">cliquez-ici pour vous connecter</a></small>

    </form>
{% endblock %}