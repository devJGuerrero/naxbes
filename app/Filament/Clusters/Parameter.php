<?php

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;

/**
 * Parameter Cluster.
 * Clusters is a hierarchical structure that allows resources and pages to be grouped together.
 * 
 * @class Parameter
 * @package App\Filament\Clusters
 */
class Parameter extends Cluster
{
    /**
     * Get cluster breadcrumb.
     * 
     * @return string
     */
    public static function getClusterBreadcrumb(): ?string
    {
        return trans_choice('messages.parameter', 2);
    }

    /**
     * Get navigation label.
     * 
     * @return string
     */
    public static function getNavigationLabel(): string
    {
        return trans_choice('messages.parameter', 2);
    }

    /**
     * Get navigation icon.
     * 
     * @return string
     */
    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-cog-6-tooth';
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
        return 1;
    }
}
