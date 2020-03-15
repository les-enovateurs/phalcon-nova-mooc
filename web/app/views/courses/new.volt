{% extends 'layouts/teach.volt' %}

{% block content %}
    {%  if errors is defined %}
        <div class="alert alert-danger">
            {{ errors }}
        </div>
    {% endif %}

    <form method="post" class="form-centrer text-center">
        <img class="mb-4" src="{{ url('img/logo72.png')}}" alt="logo">
        <h1 class="h3 mb-5 font-weight-normal">Create a course</h1>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-book"></i></span>
            </div>
            {{ course_form.render("title") }}
        </div>

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fas fa-key"></i></span>
            </div>
            {{ course_form.render("description") }}
        </div>

        <div class="mb-3">
            {{ course_form.render('submit_button') }}
        </div>
    </form>
{% endblock %}