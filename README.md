# Interfaces in PHP

Object interfaces allow you to create code which specifies which methods a class must implement, without having to define how these methods are implemented. Interfaces share a namespace with classes and traits, so they may not use the same name.


# What can you have inside an interface ? 

- Obviously, public methods without implementation: immediately after the header (signature) of the method, you should end it with a semicolon:

```
interface MyInterface
{
    public function firstFunction();
    public static function secondFunction(SomeType $variable);
}
```


- A little less obvious (although it is described in the manual) is the fact that an interface can contain constants (of course, only public ones!):

```
interface SomeInterface
{
    public const STATUSES = [
        'OK'    => 0,
        'ERROR' => 1,
    ];
}

if (SomeInterface::STATUSES['OK'] === $status) {
    // ...
}
```

# What can't an interface contain?

Nothing else can. Except for public methods headers and public constants.
Cannot be included in the interface:
- Any properties
- Non-Public Methods
- Methods with implementation
- Non-public constants

# Signature compatibility

A signature is a description of a function (method), which includes:
- Access modifier
- Function (method) name
- Argument list, where for each argument: Type, Name, Default value or the "three dots" operator
- return type


Suppose we have two functions, A and B.
The signature of a function B is considered compatible with A (order matters, relation is not symmetrical!) in the strict sense if:

#### 1. They match perfectly

A trivial case, there is nothing to comment on here.

#### 2. B adds default arguments to A

A:
```
function foo($x);
```

Compatible B:
```
function foo($x, $y = null);
function foo($x, ...$args);
```


#### B narrows the range of A

A:

```
function foo(int $x);
```

Compatible B:
```
// A allowed to return any values, in B this area is narrowed only to integers
function foo(int $x): int;
```


# Interface inheritance

Interfaces can inherit from each other:

```
interface SpeakableInterface
{
    public function speak(): void;
}

interface HelloInterface extends SpeakableInterface
{
    public function hello();
}

class User implements HelloInterface
{    
    public function hello()
    {
        echo 'Hello';
    }
    
    public function speak(): void
    {
        echo 'Speak Hello';
    }
}
```

Class which implements HelloInterface must have implements all methods from HelloInterface and from SpeakableInterface.

Interesting fact that there are multiple inheritance in case of interfaces:

```
interface SpeakableInterface
{
    public function speak(): void;
}

interface WritebleInterface
{
    public function write(): void;
}

interface HelloInterface 
    extends SpeakableInterface, WritebleInterface
{
    public function hello();
}

class User implements HelloInterface
{    
    public function hello()
    {
        echo 'Hello';
    }
    
    public function speak(): void
    {
        echo 'Speak Hello';
    }
    
    public function write(): void
    {
        echo 'Write Hello';
    }
}
```

The class implementing the interface must declare all methods in the interface with a compatible signature. A class can implement multiple interfaces which declare a method with the same name. In this case, the implementation must follow the signature compatibility rules for all the interfaces. So covariance and contravariance can be applied.


In a derived interface, you can override a method from the parent interface. But only on the condition that either its signature will exactly match the signature of the parent, or it will be compatible (see the previous section):

```
interface First
{
    public function foo(int $x);
}

interface Second extends First
{

    // It's possible, but pointless
    public function foo(int $x);
    
    // This is not allowed, fatal error Declaration must be compatible
    public function foo(int $x, int $y);
    
    // This is possible because this signature is compatible with the parent - we just added an optional argument
    public function foo(int $x, int $y = 0);
    
    // This is also possible, all arguments after "..." are optional
    public function foo(int $x, ...$args);
    
    // And this is also possible
    public function foo(int $x, ...$args): int;
}
```
