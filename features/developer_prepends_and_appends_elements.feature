Feature: Developer prepends element
    As a Developer
    I want to dynamically prepend element with another
    In order to add elements into specific places

    Scenario: Adding a link to comments before header
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
         And it prepends "h1" with '<a href="{{ path("comments") }}">Comments</a>'
        Then final source of template "blog.html.twig" should be:
        """
        <html>
            <head><title>Blog</title></head>
            <body>
                <div id="blog">
                    <a href="{{ path("comments") }}">Comments</a>
                    <h1>Blog post</h1>
                    <p class="content">Interesting text</p>
                </div>
            </body>
        </html>
        """

    Scenario: Adding a "Read more" button after blog post content
        Given the template file "blog.html.twig" contains:
        """
        <html>
            <head><title>Blog</title></head>
            <body>
                <h2>Greetings</h2>
                <div class="container">
                    <div class="inner">Hello</div>
                    <div class="inner">Goodbye</div>
                </div>
            </body>
        </html>
        """
        When I define new override for "blog.html.twig"
         And it appends '<a href="{{ path("post_show", {"id": post.id}) }}">Read more</a>' to ".inner"
        Then final source of template "blog.html.twig" should be:
        """
        <html>
            <head><title>Blog</title></head>
            <body>
                <h2>Greetings</h2>
                <div class="container">
                    <div class="inner">Hello<a href="{{ path("post_show", {"id": post.id}) }}">Read more</a></div>
                    <div class="inner">Goodbye<a href="{{ path("post_show", {"id": post.id}) }}">Read more</a></div>
                </div>
            </body>
        </html>
        """
