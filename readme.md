## Composer
```
composer update

```
## Migrate Databas
```
php artisan migrate
php artisan db:seed
```

## Helper Provider
Copy Folder Helper
Copy app\Http\Providers\HelperServiceProvider.php
Add line to config\app.php
```php
App\Providers\HelperServiceProvider::class
```

# Middleware
Copy file app\Http\Middleware\PageAdmin.php to your project
Add line to app\Http\Middleware\Kernel.php
```php
 'page.admin'    => \App\Http\Middleware\PageAdmin::class
 ```

#  Use Route
```php
Route::group(['middleware' => ['auth','page.admin']], function () {
	#yourcode
});
```
#  Use Layout
```php
#yourhtmlcode
<ul class="sidebar-menu" data-widget="tree">
                  <li class="header">Main Navigation</li>
                    {!!buildMenuAdmin($menuaccess)!!}
                </ul>
#yourhtmlcode
```

# Modification Style 
Edit funtion **buildMenuAdmin** in **SidebarHelper.php**

# Implemention On Views
```php
@if (in_array('create', $actionmenu))
            <a href="{{route('role.create')}}" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Tambah">
              <i class="fa fa-plus"></i>
            </a>
            @endif
```
# Implemention On Controllers
```php
public function create(Request $request)
    {
        if (in_array('create', $request->actionmenu)) {
            return view('role.create');
        }
        else{
            abort(403);
        }
    }
```
### Happy Coding

