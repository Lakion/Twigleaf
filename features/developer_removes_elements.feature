Feature: Developer removes elements
    As a Developer
    I want to dynamically remove elements
    In order to modify template without altering the source file

    Scenario: Removing elements using css selector
        Given the template file "foo.html.twig" contains:
        """
        <html>
            <head><title>Blog</title></head>
            <body>
                <div id="container">
                    <h1>Title</h1>
                    <p>Blog post content</p>
                    <div id="comments">
                        <ul>
                            <li>Nice work</li>
                            <li>Great post</li>
                        </ul>
                    </div>
                </div>
            </body>
        </html>
        """
        When I define new override for "foo.html.twig"
         And it removes elements matching "div#comments"
        Then final source of template "foo.html.twig" should be:
        """
        <html>
            <head><title>Blog</title></head>
            <body>
                <div id="container">
                    <h1>Title</h1>
                    <p>Blog post content</p>
                </div>
            </body>
        </html>
        """

    Scenario: Removing multiple elements matching selector
        Given the template file "foo.html.twig" contains:
        """
        <html>
            <head><title>Blog</title></head>
            <body>
                <div id="container">
                    <h1>Title</h1>
                    <p>Blog post content</p>
                    <div class="comment">
                        Comment 1
                    </div>
                    <div class="comment">
                        Comment 2
                    </div>
                    <div class="comment">
                        Comment 3
                    </div>
                </div>
            </body>
        </html>
        """
        When I define new override for "foo.html.twig"
         And it removes elements matching ".comment"
        Then final source of template "foo.html.twig" should be:
        """
        <html>
            <head><title>Blog</title></head>
            <body>
                <div id="container">
                    <h1>Title</h1>
                    <p>Blog post content</p>
                </div>
            </body>
        </html>
        """

    Scenario: Removing a button in template
        Given the template file "foo.html.twig" contains:
        """
        <html>
            <head><title>Blog</title></head>
            <body>
                <div id="container">
                    <h1>Title</h1>
                    <p>Blog post content</p>
                    <a class="btn btn-remove" href="#">Delete post</a>
                </div>
            </body>
        </html>
        """
        When I define new override for "foo.html.twig"
         And it removes elements matching "a.btn-remove:contains('Delete post')"
        Then final source of template "foo.html.twig" should be:
        """
        <html>
            <head><title>Blog</title></head>
            <body>
                <div id="container">
                    <h1>Title</h1>
                    <p>Blog post content</p>
                </div>
            </body>
        </html>
        """
