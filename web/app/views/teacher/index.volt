{% extends 'layouts/teach.volt' %}

{% block content %}

    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Your courses</h1>
    </div>

    <div class="container">
        <div class="row">
            {% for course in courses %}
                <div class="col-md-4">
                    <div class="card mb-4 shadow-sm">
                        <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img">
                            <rect width="100%" height="100%" fill="#55595c"></rect>
                            <text x="40%" y="50%" fill="#eceeef" dy=".3em">{{ course.title }}</text>
                        </svg>
                        <div class="card-body">
                            <p class="card-text">{{ course.description }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ url("course/update/")~course.id }}" class="btn btn-sm btn-warning">Update</a>
                                    <a href="{{ url("course/delete/")~course.id }}" class="btn btn-sm btn-danger">Delete</a>
                            </div>
                        </div>
                    </div>
                </div>
            {% else %}
                <p>No courses have been created yet.</p>
            {% endfor %}
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice" focusable="false" role="img">
                        <rect width="100%" height="100%" fill="#55595c"></rect>
                        <text x="35%" y="50%" fill="#eceeef" dy=".3em">New course</text>
                    </svg>
                    <div class="card-body">
                        <p class="card-text">Add a new course to your collection.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ url("course/new") }}" class="btn btn-sm btn-primary">Add</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
{% endblock %}