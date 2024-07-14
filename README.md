# BitFlagTrait
Bitwise trait to allow for bitwise checks against integer values

[Bitwise operators] allow for manipulation and examination of specific bits within an integer.

The `BitFlagTrait` gives simple methods for setting, getting and toggling the status of bits withing a reference 
integer.

This can be used for storage of the state of multiple flags or utilizing flags for class settings


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
        return self::getFlag($this->status, self::FLAG_SHIPPED);
    }
}

$orderStatus = new ShippingStatus(ShippingStatus::FLAG_RECEIVED | ShippingStatus::FLAG_QUEUED);
var_dump($orderStatus->hasShipped()); // false

$orderStatus = new ShippingStatus(3);
var_dump($orderStatus->hasShipped()); // false

$orderStatus = new ShippingStatus(7);
var_dump($orderStatus->hasShipped()); // true

```

### Notice:
Be aware of the storage medium and data types available to the class you use the trait with.  PHP is still 
deployed on some 32-bit systems.  SQL small and medium integers have limited number of flags available due to the max 
size.  Signed and unsigned SQL integers have different amount of flags available.


[Bitwise operators]: https://www.php.net/manual/en/language.operators.bitwise.php