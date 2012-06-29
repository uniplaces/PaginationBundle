Uniplaces Pagination Bundle for Symfony2
========================================

### Instalation:

Add to .gitmodules:

```
[submodule "vendor/bundles/Uniplaces/PaginationBundle"]
	path = vendor/bundles/Uniplaces/PaginationBundle
	url = git://github.com/uniplaces/pagination.git
```

Then run:

```
git submodule init
git submodule update
```

And finally add this line to the bundles list in AppKernel.php:

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

