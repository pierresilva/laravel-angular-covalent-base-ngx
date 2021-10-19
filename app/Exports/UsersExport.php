<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $items = User::with(User::getRelationships())->get();
        if (!$items) {
            return new Collection();
        }
        return $items;
    }

    public function headings(): array
    {

        $item = User::first();

        $attributes = array_keys($item->getAttributes());

        $names = [];
        foreach ($attributes as $attribute) {
            $names[] = mb_strtoupper($attribute);
        }

        $relationships = User::getRelationships();

        foreach ($relationships as $relationship) {
            $names[] = mb_strtoupper(\Str::snake($relationship));
        }

        return $names;
    }

    public function prepareRows($rows): array
    {
        return array_map(function ($model) {

            $relationships = User::getRelationships();
            foreach ($relationships as $relationship) {
                if ($model->{$relationship}) {
                    $relationString = '';
                    if ($model->{$relationship} instanceof Collection) {
                        foreach ($model->{$relationship} as $relation) {
                            $relationString .= $relation->name . ', ';
                        }
                    } else {
                        $relationString = $model->{$relationship}->name;
                    }

                    $model->{$relationship} = $relationString;
                }
            }

            return $model;
        }, $rows);
    }
}
