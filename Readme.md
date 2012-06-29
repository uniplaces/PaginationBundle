Uniplaces Pagination Bundle for Symfony2
========================================

### Instalation:

Add the submodule:

```
git submodule add git://github.com/uniplaces/PaginationBundle.git vendor/bundles/Uniplaces/PaginationBundle
```

Register the namespace in app/autoload.php:

```
'Uniplaces'        => __DIR__.'/../vendor/bundles',
```

And finally add load the budle in the bundles list in app/AppKernel.php:

```
new Uniplaces\PaginationBundle\UniplacesPaginationBundle()
```


### Basic usage:


In your controller:

```php
use Uniplaces\PaginationBundle\Paginator\Paginator;
use YourApp\YourBundle\Paginator\PageableObject;
```

```php
$paginator = new Paginator(new PageableObject($queryObject), $currentPage);
```

```php
return $this->render('UniplacesPaginationBundle:Default:test.html.twig', array('paginator' => $paginator));
```

In the view:

```
{{ paginate_widget(paginator, routeRoute, routeParameters) }}
```

The result:

```html
<div class="pagination">
    <ul>
        <li><a href="/app.php/list">&lt;&lt;&nbsp;First</a></li>
        <li><a href="/app.php/list">&lt;&nbsp;Previous</a></li>
        <li class="active"><a href="/app.php/list">1</a></li>
        <li><a href="/app.php/list/2">2</a></li>
        <li><a href="/app.php/list/3">3</a></li>
        <li><a href="/app.php/list/4">4</a></li>
        <li><a href="/app.php/list/5">5</a></li>
        <li><a href="/app.php/list/6">6</a></li>
        <li><a href="/app.php/list/7">7</a></li>
        <li><a href="/app.php/list/8">Next&nbsp;&gt;</a></li>
        <li><a href="/app.php/list/123">Last&nbsp;&gt;&gt;</a></li>
    </ul>
</div>
```

