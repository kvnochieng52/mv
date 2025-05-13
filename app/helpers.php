<?php

use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

if (!function_exists('inertia')) {
    /**
     * Inertia helper to render a component with data
     * 
     * @param string $component
     * @param array $props
     * @return \Inertia\Response
     */
    function inertia($component, $props = [])
    {
        return Inertia::render($component, $props);
    }
}
