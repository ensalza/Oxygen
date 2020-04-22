# Oxygen
A class to manage objects, properties and JSON files in an easy way

This class make easy to convert simple recursive into other formats.
You can read structures or URLs from formats: XML, stdClass and JSON strings. 

```$o = new Oxygen();```


##XML
```$xml = "<xml><node>Content</node></xml>";
$o->addXML($xml, false);

$xml = "http://your-favorite-url.xml";
$o->addXML($xml,true);```


##stdClass
```
$object = new stdClass();
$object->node = "Content";

$o->addO($object);
```
##JSON
```$json = '{"node":"Content"}';
$o->addJSON($xml,false);

$json = "http://your-favorite-url.json";
$o->addJSON($xml,true);
```


It can return objets in XML, stdClass and JSON formats.
```$o->getO();
$o->getXML();
$o->getJSON();```


It can merge objects from this formats and build a bigger object with de sum of all objects.
```$object1 = new stdClass();
$object1->node1 = "Content";

$object2 = new stdClass();
$object2->node2 = "More content";

$o->addO($object1)->addO($object2);  
$o->getO();
```

Will return only one object with both properties inside, node1 and node2.

You can buid objects calling its properties directly without any implicit declaration. Oxygen assumes when a property is called and it is not previously set, it is a new Oxygen object with all its features available, so that you can write objects this way: 

```$o->node1 = "Content";
$o->node2->suboject = "More content";
```

An even 
```
$o->node2->suboject1->subobject2->subobject31 = "Much more content";
$o->node2->suboject1->subobject2->subobject32 = "Much more content";
$o->node2->suboject1->subobject2->subobject33 = "Much more content";
```



