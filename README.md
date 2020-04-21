# Oxygen
A class to manage objects, properties and JSON files in an easy way

This class make easy to convert simple recursive into other formats.
It can read structures or URLs from formats: XML, stdClass and JSON strings. 
It can return objets in XML, stdClass and JSON formats.

It can merge objects from this formats and build a bigger object with de sum of all objects.
When it detects a lower level object or array, it adds its elements to the main object making easy the proceess of merging objects.

You can buid objects implicit way like $o->prop1->prop2->prop3 = "x";  with no declaration. Oxygen creates an inner Oxygen object to handle this.



