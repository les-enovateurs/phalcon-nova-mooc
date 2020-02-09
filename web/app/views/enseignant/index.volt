{% extends 'layouts/interface_enseignant.volt' %}

{% block contenu %}

    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Vos cours</h1>
    </div>

    <div class="container">
        <div class="row">
            {% for cour in cours %}
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img">
                            <rect width="100%" height="100%" fill="#55595c"></rect>
                            <text x="40%" y="50%" fill="#eceeef" dy=".3em">{{ cour.nom }}</text>
                        </svg>
                        <div class="card-body">
                            <p class="card-text">{{ cour.description }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ url("cours/modifier/")~cour.id }}" class="btn btn-sm btn-warning">Modifier</a>
                                    <a href="{{ url("cours/supprimer/")~cour.id }}" class="btn btn-sm btn-danger">Supprimer</a>
                            </div>
                        </div>
                    </div>
                </div>
            {% else %}
                <p>Aucun cours n'a encore été crée.</p>
            {% endfor %}
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img">
                        <rect width="100%" height="100%" fill="#55595c"></rect>
                        <text x="35%" y="50%" fill="#eceeef" dy=".3em">Nouveau cours</text>
                    </svg>
                    <div class="card-body">
                        <p class="card-text">Ajouter un nouveau cours à votre collection.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ url("cours/nouveau") }}" class="btn btn-sm btn-primary">Ajouter</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{% endblock %}