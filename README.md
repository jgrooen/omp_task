
## OMP Tasks

### The first task
is to write a function in Laravel called ``` humanReadableNumber($number,
$decimalPlaces, $language)``` that converts a number to a human-readable format in two
languages: Farsi (fa) and English (en). The function should take three arguments:

-  The number to be converted (this can be a string, integer, or float).
-  The number of decimal places to be considered (this can be null or an integer).
-  The language code (either 'fa' or 'en').

Your function should be able to pass a unit test called "HumanReadableNumberTest" which
tests these requirements. Consider the different number formats, decimal separators, and
thousand separators in these languages when writing your function.

### The second task
is to implement a custom payment gateway provider that can seamlessly integrate with multiple payment gateway APIs using PHP.

Your implementation should handle:

- the creation of charges,
- handling webhooks from each gateway (for example, Shaparak, Jibit,
Zibal, Vandar),
- and securely storing payment information.

Your solution should be maintainable, scalable, and secure, following best practices for software
design, security, and design patterns. Additionally, your architecture should be robust enough to
handle failover scenarios – if one gateway fails, the system should be capable of switching over
to the next available gateway seamlessly.


## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
