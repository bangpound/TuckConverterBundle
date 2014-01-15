TuckConverterBundle
===================

Adds the Symfony2 command "container:convert" which converts service config files to other formats

What it does
------------
You can specify the file to convert either on the commandline:

    ./app/console container:convert yml path/to/file.xml

Or leave out the file and do the conversion interactively.

    ./app/console container:convert yml

Adding the -o flag will output the new file instead of prompting you to write it, presumably so you can pipe it to
another process somewhere.

The actual conversion is based on Symfony's built-in loaders and dumpers, so this should be exceedingly reliable.

TODO
----
- Create a version that converts strings as well as files
- Remove a coupling on input for file extension
- Update the DependencyInjection/*Extension files as well (perhaps with PHP-Parser?)
- Moar tests