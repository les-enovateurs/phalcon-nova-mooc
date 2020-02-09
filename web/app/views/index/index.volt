{% extends 'layouts/non_connecte.volt' %}

{% block contenu %}
    {%  if erreurs is defined %}
        <div class="alert alert-danger">
            {{ erreurs }}
        </div>
    {% endif %}

    <form method="post" class="form-centrer text-center">
        <img class="mb-4" src="{{ url('img/logo72.png')}}" alt="logo">
        <h1 class="h3 mb-5 font-weight-normal">Connexion à NovaMooc</h1>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-at"></i></span>
            </div>
            {{ connexion_form.render("email") }}
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-key"></i></span>
            </div>
            {{ connexion_form.render("mot_de_passe") }}
        </div>

        <div class="mb-3">
            {{ connexion_form.render('bouton_de_soumission') }}
        </div>

        <small>Si vous n'avez pas de compte, <a href="{{ url("inscription") }}" alt="inscription">cliquez-ici pour en crée un !</a></small>
    </form>
{% endblock %}