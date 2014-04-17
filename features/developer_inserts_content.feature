Feature: Developer inserts content before or after elements
    As a Developer
    I want to dynamically insert content
    In order to add elements into specific places

    Scenario: Adding a link to comments before container
        Given the template file "blog.html.twig" contains:
        """
        <html>
            <head><title>Blog</title></head>
            <body>
                <div id="blog">
                    <h1>Blog post</h1>
                    <p class="content">Interesting text</p>
                </div>
            </body>
        </html>
        """
        When I define new override for "blog.html.twig"
         And it inserts '<a href="{{ path("comments") }}">Comments</a>' before "div#blog"
        Then final source of template "blog.html.twig" should be:
        """
        <html>
            <head><title>Blog</title></head>
            <body>
                <a href="{{ path("comments") }}">Comments</a>
                <div id="blog">
                    <h1>Blog post</h1>
                    <p class="content">Interesting text</p>
                </div>
            </body>
        </html>
        """

    Scenario: Adding a "Read more" button after blog post
        Given the template file "blog.html.twig" contains:
        """
        <html>
            <head><title>Blog</title></head>
            <body>
                <div id="blog">
                    {% for post in posts %} 
                    <h1>{{ post.title }}</h1>
                    <p class="content">{{ post.content }}</p>
                    {% endfor %}
                </div>
            </body>
        </html>
        """
        When I define new override for "blog.html.twig"
         And it inserts '<a href="{{ path("post_show", {"id": post.id}) }}">Read more</a>' after "p.content"
        Then final source of template "blog.html.twig" should be:
        """
        <html>
            <head><title>Blog</title></head>
            <body>
                <div id="blog">
                    {% for post in posts %} 
                    <h1>{{ post.title }}</h1>
                    <p class="content">{{ post.content }}</p>
                    <a href="{{ path("post_show", {"id": post.id}) }}">Read more</a>
                    {% endfor %}
                </div>
            </body>
        </html>
        """
