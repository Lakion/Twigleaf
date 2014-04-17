Feature: Developer replaces elements
    As a Developer
    I want to dynamically replace elements
    In order to modify template without altering the source file

    Scenario: Replacing elements using css selector
        Given the template file "foo.html.twig" contains:
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
        When I define new override for "foo.html.twig"
         And it replaces "h1" with '<h1>New post</h1>'
        Then final source of template "foo.html.twig" should be:
        """
        <html>
            <head><title>Blog</title></head>
            <body>
                <div id="container">
                    <h1>New post</h1>
                    <p>Blog post content</p>
                </div>
            </body>
        </html>
        """

    Scenario: Replacing button with another one
        Given the template file "create.html.twig" contains:
        """
        <html>
            <head><title>Edit product #42</title></head>
            <body>
                <div id="actions">
                    <a href="#" class="btn btn-delete">Delete product</a>
                    <a href="#" class="btn btn-edit">Edit product</a>
                </div>
            </body>
        </html>
        """
        When I define new override for "create.html.twig"
         And it replaces "a.btn-delete" with '<a href="#" class="btn btn-hide">Hide</a>'
        Then final source of template "create.html.twig" should be:
        """
        <html>
            <head><title>Edit product #42</title></head>
            <body>
                <div id="actions">
                    <a href="#" class="btn btn-hide">Hide</a>
                    <a href="#" class="btn btn-edit">Edit product</a>
                </div>
            </body>
        </html>
        """
