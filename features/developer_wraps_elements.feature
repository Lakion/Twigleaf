Feature: Developer wraps elements
    As a Developer
    I want to dynamically surround elements
    In order to modify template structure easily

    Scenario: Wrapping element into a new block
        Given the template file "post.html.twig" contains:
        """
        <html>
            <head><title>Blog</title></head>
            <body>
                <div class="container">
                    <div class="inner">Hello</div>
                    <div class="inner">Goodbye</div>
                </div>
            </body>
        </html>
        """
        When I define new override for "post.html.twig"
         And it wraps ".inner" with '<div class="new"></div>'
        Then final source of template "post.html.twig" should be:
        """
        <html>
            <head><title>Blog</title></head>
            <body>
                <div class="container">
                    <div class="new">
                        <div class="inner">Hello</div>
                    </div>
                    <div class="new">
                        <div class="inner">Goodbye</div>
                    </div>
                </div>
            </body>
        </html>
        """
