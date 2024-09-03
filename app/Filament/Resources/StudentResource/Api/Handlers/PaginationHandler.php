<?php
namespace App\Filament\Resources\StudentResource\Api\Handlers;

use Illuminate\Http\Request;
use Filament\Facades\Filament;
use Rupadana\ApiService\ApiService;
use Spatie\QueryBuilder\QueryBuilder;
use Rupadana\ApiService\Http\Handlers;
use App\Filament\Resources\StudentResource;

class PaginationHandler extends Handlers {
    public static string | null $uri = '/';

    public static bool $public = false;
    public static string | null $resource = StudentResource::class;


    public function handler()
    {
        $query = static::getEloquentQuery();
        $model = static::getModel();

        $query = QueryBuilder::for($query)
        ->allowedFields($this->getAllowedFields() ?? [])
        ->allowedSorts($this->getAllowedSorts() ?? [])
        ->allowedFilters($this->getAllowedFilters() ?? [])
        ->allowedIncludes($this->getAllowedIncludes() ?? [])
        ->paginate(request()->query('per_page'))
        ->appends(request()->query());

        return static::getApiTransformer()::collection($query);
    }

    protected static function getEloquentQuery()
    {
        $query = app(static::getModel())->query();

        if (static::isScopedToTenant() && ApiService::tenancyAwareness() && Filament::getCurrentPanel()) {
            $query = static::modifyTenantQuery($query);
        }

        return $query;
    }

    protected static function modifyTenantQuery($query)
    {
        // Example logic: Add a tenant-specific filter
        if (static::isScopedToTenant()) {
            $tenantId = static::getCurrentTenantId(); // Implement this method as needed
            $query->where('school_id', $tenantId);
        }

        return $query;
    }

    protected static function getCurrentTenantId()
    {
        return "9ce424fc-2787-418e-bd79-a2e283ca3b73";
    }

}