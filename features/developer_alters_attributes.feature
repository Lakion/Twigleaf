Feature: Developer alters attributes
    As a Developer
    I want to dynamically change element attributes
    In order to modify template easily

    Scenario: Adding dynamic data attribute to element
        Given the template file "form.html.twig" contains:
        """
        <html>
            <head><title>Blog edit</title></head>
            <body>
                <form method="post" action="#">
                    <input type="text" name="search" id="search-input">
                    <button type="submit">Search</button>
                </form>
            </body>
        </html>
        """
        When I define new override for "form.html.twig"
         And it sets "#search-input" attribute "data-url" to "{{ ajax_url }}"
        Then final source of template "form.html.twig" should be:
        """
        <html>
            <head><title>Blog edit</title></head>
            <body>
                <form method="post" action="#">
                    <input type="text" name="search" id="search-input" data-url="{{ ajax_url }}">
                    <button type="submit">Search</button>
                </form>
            </body>
        </html>
        """

    Scenario: Altering the name of the search field
        Given the template file "form.html.twig" contains:
        """
        <html>
            <head><title>Blog edit</title></head>
            <body>
                <form method="post" action="#">
                    <input type="text" name="search" id="search-input">
                    <button type="submit">Search</button>
                </form>
            </body>
        </html>
        """
        When I define new override for "form.html.twig"
         And it sets "#search-input" attribute "name" to "ajax"
        Then final source of template "form.html.twig" should be:
        """
        <html>
            <head><title>Blog edit</title></head>
            <body>
                <form method="post" action="#">
                    <input type="text" name="ajax" id="search-input">
                    <button type="submit">Search</button>
                </form>
            </body>
        </html>
        """
