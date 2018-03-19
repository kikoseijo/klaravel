
# Responses traits

This two traits are meant to be using deppening on your respones, but the LumenResponsesTrait should work fine
for boths: Laravel and Lumen.

```
use Ksoft\Klaravel\Traits\JsonTrait;
use Ksoft\Klaravel\Traits\LumenResponsesTrait;
```


```
class BaseKrudController extends Controller
{
    use LumenResponsesTrait, KrudControllerTrait;

```
