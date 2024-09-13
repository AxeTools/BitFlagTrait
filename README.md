<h1 align="center">AxeTools/BitFlagTrait</h1>

<p align="center">
    <strong>This is a php class trait that will provide methods for performing simple bitwise operations.</strong>
</p>

<p align="center">
    <a href="https://github.com/AxeTools/BitFlagTrait"><img src="https://img.shields.io/badge/source-AxeTools/BitFlagTrait-blue.svg?style=flat-square" alt="Source Code"></a>
    <a href="https://php.net"><img src="https://img.shields.io/packagist/php-v/AxeTools/BitFlagTrait.svg?style=flat-square&colorB=%238892BF" alt="PHP Programming Language"></a>
    <a href="https://github.com/AxeTools/BitFlagTrait/blob/2.x/LICENSE"><img src="https://img.shields.
io/packagist/l/AxeTools/BitFlagTrait.svg?style=flat-square&colorB=darkcyan" alt="Read License"></a>
    <a href="https://github.com/AxeTools/BitFlagTrait/actions/workflows/php.yml"><img src="https://img.shields.
io/github/actions/workflow/status/AxeTools/BitFlagTrait/php.yml?branch=2.x&logo=github&style=flat-square" alt="Build Status"></a>
</p>

This project uses [Semantic Versioning][].

[Bitwise operators][] allow for manipulation and examination of specific bits within an integer.

The `BitFlagTrait` gives simple methods for setting, getting and toggling the status of bits withing a reference 
integer.

This can be used for storage of the state of multiple flags or utilizing flags for class settings

## Installation

The preferred method of installation is via [Composer][]. Run the following command to install the package and add it as
a requirement to your project's `composer.json`:

```bash
composer require axetools/bitflagtrait
```

## Usage

The BitFlagTrait can be used with any class and will expose several protected methods that can be utilized to perform bitwise checks to a reference integer.

### Example: 
```php
<?php
class ShippingStatus {
    use AxeTools\Traits\BitFlag\BitFlagTrait;

    const FLAG_RECEIVED = 0b00001; // int value 1
    const FLAG_QUEUED   = 0b00010; // int value 2
    const FLAG_SHIPPED  = 0b00100; // int value 4

    private $status = 0;

    public function __construct($status){
        $this->status = $status;
    }
    
    public function hasShipped(){
        return self::hasFlag($this->status, self::FLAG_SHIPPED);
    }
}

$orderStatus = new ShippingStatus(ShippingStatus::FLAG_RECEIVED | ShippingStatus::FLAG_QUEUED);
var_dump($orderStatus->hasShipped()); // false

$orderStatus = new ShippingStatus(3);
var_dump($orderStatus->hasShipped()); // false

$orderStatus = new ShippingStatus(7);
var_dump($orderStatus->hasShipped()); // true

```

## hasFlag()

The `self::hasFlag()` static method to determine the current boolean value of a specific flag in the flagSet integer.

#### Description
```php
self::hasFlag(int $flagSet, int $flag): bool
```

#### Parameters
<dl>
<dt>flagSet</dt>
<dd>The integer that contains the current flag status.</dd>

<dt>flag</dt>
<dd>The flag to check the status of.</dd>
</dl>

#### Return Value
bool : the status of the flag contained in the flag status.

## setFlag()

The `self::setFlag()` static method to set the current boolean value of a specific flag in the flagSet integer.

#### Description
```php
self::setFlag(int &$flagSet, int $flag, bool $value): void
```

#### Parameters
<dl>
<dt>flagSet</dt>
<dd>The integer that contains the current flag status.  Passed by reference and will result in the updated integer</dd>

<dt>flag</dt>
<dd>The flag to set the value of.</dd>

<dt>value</dt>
<dd>The boolean value to set the flag position in the flag status integer.</dd>
</dl>

#### Return Value
void

## toggleFlag()

The `self::toggleFlag()` static method to toggle the current boolean value of a specific flag in the flagSet integer 
to it's opposite.

#### Description
```php
self::toggleFlag(int &$flagSet, int $flag): void
```

#### Parameters
<dl>
<dt>flagSet</dt>
<dd>The integer that contains the current flag status.  Passed by reference and will result in the updated integer</dd>

<dt>flag</dt>
<dd>The flag to set the value of.</dd>
</dl>

#### Return Value
void

### Notice:
Be aware of the storage medium and data types available to the class you use the trait with.  PHP is still 
deployed on some 32-bit systems.  SQL small and medium integers have limited number of flags available due to the max 
size.  Signed and unsigned SQL integers have different amount of flags available.

[composer]: http://getcomposer.org/
[semantic versioning]: https://semver.org/spec/v2.0.0.html
[bitwise operators]: https://www.php.net/manual/en/language.operators.bitwise.php