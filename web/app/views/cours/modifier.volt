{% extends 'layouts/interface_enseignant.volt' %}

{% block contenu %}
    {%  if erreurs is defined %}
        <div class="alert alert-danger">
            {{ erreurs }}
        </div>
    {% endif %}

    <form method="post" class="form-centrer text-center">
        <img class="mb-4" src="{{ url('img/logo72.png')}}" alt="logo">
        <h1 class="h3 mb-5 font-weight-normal">Modifier un cours</h1>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-book"></i></span>
            </div>
            {{ cours_form.render("nom") }}
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-key"></i></span>
            </div>
            {{ cours_form.render("description") }}
        </div>

        <div class="mb-3">
            {{ cours_form.render('bouton_de_soumission') }}
        </div>
    </form>
{% endblock %}