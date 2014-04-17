Feature: Developer alters css classes
    As a Developer
    I want to dynamically change css classes of elements
    In order to modify template look easily

    Scenario: Adding "headline" class to headers
        Given the template file "post.html.twig" contains:
        """
        <html>
            <head><title>Blog</title></head>
            <body>
                <h1>Title</h1>
                <p>Blog post content</p>
            </body>
        </html>
        """
        When I define new override for "post.html.twig"
         And it adds class "headline" to "h1"
        Then final source of template "post.html.twig" should be:
        """
        <html>
            <head><title>Blog</title></head>
            <body>
                <h1 class="headline">Title</h1>
                <p>Blog post content</p>
            </body>
        </html>
        """

    Scenario: Toggling class on elements
        Given the template file "post.html.twig" contains:
        """
        <html>
            <head><title>Blog</title></head>
            <body>
                <h1>Title</h1>
                <p>Blog post content</p>
                <h1 class="headline">Title</h1>
                <p>Blog post content</p>
            </body>
        </html>
        """
        When I define new override for "post.html.twig"
         And it toggles class "headline" to "h1"
        Then final source of template "post.html.twig" should be:
        """
        <html>
            <head><title>Blog</title></head>
            <body>
                <h1 class="headline">Title</h1>
                <p>Blog post content</p>
                <h1>Title</h1>
                <p>Blog post content</p>
            </body>
        </html>
        """
