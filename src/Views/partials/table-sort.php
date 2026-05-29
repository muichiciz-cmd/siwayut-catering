<?php
$s = $sort_by ?? 'created_at';
$d = $dir ?? 'DESC';
$sortUrl = function($col) use ($s, $d) {
    $next = ($s === $col && $d === 'asc') ? 'desc' : 'asc';
    return '?' . http_build_query(array_merge($_GET, ['sort_by' => $col, 'dir' => $next]));
};
$sortIcon = function($col) use ($s, $d) {
    if ($s !== $col) return '<span class="opacity-0 group-hover:opacity-40 transition-opacity"><svg class="inline align-middle" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m8 10 4-4 4 4"/><path d="m8 14 4 4 4-4"/></svg></span>';
    $arrow = $d === 'asc' ? 'm8 10 4-4 4 4' : 'm8 14 4 4 4-4';
    return '<span class="text-gold"><svg class="inline align-middle" xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="' . $arrow . '"/></svg></span>';
};
