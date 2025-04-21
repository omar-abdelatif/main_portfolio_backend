<a {{ $attributes->class(['btn'])->merge(['id' => str_replace('.', '-', $route),'href' => isset($params) ? route($route, $params) : route($route) ]) }}>
    <i class="{{ $icon }}"></i>
</a>