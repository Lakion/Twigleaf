Feature: Developer alters css attributes
    As a Developer
    I want to dynamically change style of elements
    In order to modify template look easily

    Scenario: Adding margin to an element
        Given the template file "css.html.twig" contains:
        """
        <html>
            <head><title>Blog</title></head>
            <body>
                <h1>Title</h1>
                <p>Blog post content</p>
            </body>
        </html>
        """
        When I define new override for "css.html.twig"
         And it sets "h1" css attribute "margin-top" to "5px"
        Then final source of template "css.html.twig" should be:
        """
        <html>
            <head><title>Blog</title></head>
            <body>
                <h1 style="margin-top: 5px;">Title</h1>
                <p>Blog post content</p>
            </body>
        </html>
        """

    Scenario: Modifying color of a headline
        Given the template file "css.html.twig" contains:
        """
        <html>
            <head><title>Blog</title></head>
            <body>
                <h1 style="color: #000000;">Title</h1>
                <p>Blog post content</p>
            </body>
        </html>
        """
        When I define new override for "css.html.twig"
         And it sets "h1" css attribute "color" to "#1abb9c"
        Then final source of template "css.html.twig" should be:
        """
        <html>
            <head><title>Blog</title></head>
            <body>
                <h1 style="color: #1abb9c;">Title</h1>
                <p>Blog post content</p>
            </body>
        </html>
        """
