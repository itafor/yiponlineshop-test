<?php

namespace App\Services;

use Illuminate\Http\Response;
use Smarty\Smarty;

class SmartyRenderer
{
    public function __construct(private readonly Smarty $smarty)
    {
        $this->smarty->setTemplateDir(resource_path('smarty'));
        $this->smarty->setCompileDir(storage_path('framework/smarty/compile'));
        $this->smarty->setCacheDir(storage_path('framework/smarty/cache'));
        $this->smarty->escape_html = true;
    }

    /**
     * @param array<string, mixed> $data
     */
    public function render(string $template, array $data = [], int $status = 200): Response
    {
        $shared = [
            'appName' => config('app.name', 'YipOnline Shop'),
            'assetBase' => asset(''),
            'csrf' => csrf_token(),
            'currentUser' => auth()->user(),
            'cartCount' => collect(session('cart.items', []))->sum('quantity'),
            'flashSuccess' => session('success'),
            'flashError' => session('error'),
            'errorsBag' => session('errors')?->all() ?? [],
            'oldInput' => session()->getOldInput(),
        ];

        foreach (array_merge($shared, $data) as $key => $value) {
            $this->smarty->assign($key, $value);
        }

        return response($this->smarty->fetch($template), $status);
    }
}
