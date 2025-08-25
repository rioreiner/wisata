<?php

if (!function_exists('formatPrice')) {
    function formatPrice($price)
    {
        return 'Rp ' . number_format($price, 0, ',', '.');
    }
}

if (!function_exists('getStatusBadge')) {
    function getStatusBadge($status)
    {
        $badges = [
            'active' => 'success',
            'inactive' => 'secondary',
            'published' => 'success',
            'draft' => 'warning',
            'approved' => 'success',
            'pending' => 'warning',
            'rejected' => 'danger'
        ];

        return $badges[$status] ?? 'secondary';
    }
}