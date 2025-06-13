<?php
class PaginationHelper {
    public static function buildUrl($page, $params = []) {
        $currentParams = $_GET;
        $currentParams['page'] = $page;
        
        // Merge with additional params
        $currentParams = array_merge($currentParams, $params);
        
        // Remove empty values
        $currentParams = array_filter($currentParams, function($value) {
            return $value !== '' && $value !== null;
        });
        
        return '/product?' . http_build_query($currentParams);
    }
    
    public static function getPaginationInfo($currentPage, $totalPages, $totalItems, $itemsPerPage) {
        $startItem = ($currentPage - 1) * $itemsPerPage + 1;
        $endItem = min($currentPage * $itemsPerPage, $totalItems);
        
        return [
            'current_page' => $currentPage,
            'total_pages' => $totalPages,
            'total_items' => $totalItems,
            'items_per_page' => $itemsPerPage,
            'start_item' => $startItem,
            'end_item' => $endItem,
            'has_previous' => $currentPage > 1,
            'has_next' => $currentPage < $totalPages,
            'previous_page' => max(1, $currentPage - 1),
            'next_page' => min($totalPages, $currentPage + 1)
        ];
    }
}
?>