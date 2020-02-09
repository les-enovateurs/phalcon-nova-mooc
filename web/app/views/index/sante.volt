{% extends 'layouts/non_connecte.volt' %}

{% block contenu %}
    {%  if erreurs is defined %}
        <div class="alert alert-danger">
            {{ erreurs }}
        </div>
    {% endif %}

    <div class="form-centrer text-center">
        {{ message }}
    </div>
{% endblock %}