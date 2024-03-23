<?php

namespace App\Filament\Clusters;

use Filament\Clusters\Cluster;

/**
 * Crm Cluster.
 * Clusters is a hierarchical structure that allows resources and pages to be grouped together.
 * 
 * @class Crm
 * @package App\Filament\Clusters
 */
class Crm extends Cluster
{
    /**
     * Get cluster breadcrumb.
     * 
     * @return string
     */
    public static function getClusterBreadcrumb(): ?string
    {
        return strtoupper(trans_choice('messages.crm', 1));
    }

    /**
     * Get navigation label.
     * 
     * @return string
     */
    public static function getNavigationLabel(): string
    {
        return strtoupper(trans_choice('messages.crm', 1));
    }

    /**
     * Get navigation icon.
     * 
     * @return string
     */
    public static function getNavigationIcon(): ?string
    {
        return 'heroicon-o-identification';
    }

    /**
     * Get navigation group.
     * 
     * @return string
     */
    public static function getNavigationGroup(): ?string
    {
        return trans_choice('entities.ecommerce', 2);
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
