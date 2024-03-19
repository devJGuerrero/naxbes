<?php

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;

/**
 * Geolocation Cluster.
 * Clusters is a hierarchical structure that allows resources and pages to be grouped together.
 * 
 * @class Geolocation
 * @package App\Filament\Clusters
 */
class Geolocation extends Cluster
{
    /**
     * Get cluster breadcrumb.
     * 
     * @return string
     */
    public static function getClusterBreadcrumb(): ?string
    {
        return trans_choice('messages.geolocation', 1);
    }

    /**
     * Get navigation label.
     * 
     * @return string
     */
    public static function getNavigationLabel(): string
    {
        return trans_choice('messages.geolocation', 1);
    }

    /**
     * Get navigation icon.
     * 
     * @return string
     */
    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-map-pin';
    }

    /**
     * Get navigation group.
     * 
     * @return string
     */
    public static function getNavigationGroup(): ?string
    {
        return trans_choice('messages.configurations', 2);
    }

    /**
     * Get navigation sort.
     * 
     * @return int
     */
    public static function getNavigationSort(): ?int
    {
        return 2;
    }
}
