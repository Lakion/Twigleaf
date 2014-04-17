Feature: Developer unwraps elements
    As a Developer
    I want to dynamically remove surrounding elements
    In order to modify template structure easily

    Scenario: Unwrapping button from a div
        Given the template file "post.html.twig" contains:
        """
        <html>
            <head><title>Blog</title></head>
            <body>
                <div class="container">
                    <div class="new">
                        <a class="inner">Hello</a>
                    </div>
                    <div class="new">
                        <a class="inner">Goodbye</a>
                    </div>
                </div>
            </body>
        </html>
        """
        When I define new override for "post.html.twig"
         And it unwraps ".inner"
        Then final source of template "post.html.twig" should be:
        """
        <html>
            <head><title>Blog</title></head>
            <body>
                <div class="container">
                    <a class="inner">Hello</a>
                    <a class="inner">Goodbye</a>
                </div>
            </body>
        </html>
        """
