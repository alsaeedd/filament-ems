<?php

namespace App\Filament\Resources\EmployeeResource\Pages;

use App\Filament\Resources\EmployeeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Tab;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Employee;

class ListEmployees extends ListRecords
{
    protected static string $resource = EmployeeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
         'All' => Tab::make(),
         'Accounting' =>  Tab::make()
            ->modifyQueryUsing(fn (Builder $query): Builder => 
                $query->whereHas('department', fn (Builder $query) => 
                    $query->where('name', 'Accounting')
                )
            ),
         'Engineering' => Tab::make()
            ->modifyQueryUsing(fn (Builder $query): Builder => 
                    $query->whereHas('department', fn (Builder $query) => 
                        $query->where('name', 'Engineering')
                    )
                ),
         'Human Resources' =>  Tab::make()
            ->modifyQueryUsing(fn (Builder $query): Builder => 
                        $query->whereHas('department', fn (Builder $query) => 
                            $query->where('name', 'Human Resources')
                        )
                    ),
        ];
    }
}
