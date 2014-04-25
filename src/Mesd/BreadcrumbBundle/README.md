README
======

About
-----

The BreadcrumbBundle is a fully customizable breadcrumb generator.

Requirements
------------

 * Symfony2 2.1 and up.
 * PHP 5.3.4 and up.

Installation
------------

TODO

Documentation
-------------

To include in your application, insert following block of code
in a twig template, preferrably one called on most or all pages
(i.e. index.html.twig or base.html.twig).

    {% block breadcrumb %}
        {% render 'MesdBreadcrumbBundle:Default:index'
            with { 'options': { separator: '/',
                                paramLoc:  'before',
                                home:      'home' } }
        %}
    {% endblock breadcrumb %}

The "[Quick Tour][2]" tutorial gives you a first feeling of the framework. If,
like us, you think that Symfony2 can help speed up your development and take
the quality of your work to the next level, read the official
[Symfony2 documentation][3].

Contributing
------------

Symfony2 is an open source, community-driven project. If you'd like to contribute,
please read the [Contributing Code][4] part of the documentation. If you're submitting
a pull request, please follow the guidelines in the [Submitting a Patch][5] section
and use [Pull Request Template][6].

Running Symfony2 Tests
----------------------

Information on how to run the Symfony2 test suite can be found in the
[Running Symfony2 Tests][7] section.

[1]: http://symfony.com/download
[2]: http://symfony.com/get_started
[3]: http://symfony.com/doc/current/
[4]: http://symfony.com/doc/current/contributing/code/index.html
[5]: http://symfony.com/doc/current/contributing/code/patches.html#check-list
[6]: http://symfony.com/doc/current/contributing/code/patches.html#make-a-pull-request
[7]: http://symfony.com/doc/master/contributing/code/tests.html