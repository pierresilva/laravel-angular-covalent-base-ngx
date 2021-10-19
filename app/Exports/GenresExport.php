<?php

namespace App\Exports;

use App\Models\Genre;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class GenresExport implements FromCollection, ShouldAutoSize, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $items = Genre::with(Genre::getRelationships())->get();
        if (!$items) {
            return new Collection();
        }
        return $items;
    }

    public function headings(): array
    {

        $item = Genre::first();

        $attributes = array_keys($item->getAttributes());

        $names = [];
        foreach ($attributes as $attribute) {
            $names[] = mb_strtoupper($attribute);
        }

        $relationships = Genre::getRelationships();

        foreach ($relationships as $relationship) {
            $names[] = mb_strtoupper($relationship);
        }

        return $names;
    }

    public function prepareRows($rows): array
    {
        return array_map(function ($model) {

            $relationships = Genre::getRelationships();
            foreach ($relationships as $relationship) {
                if ($model->{$relationship}) {
                    $relationString = '';
                    if ($model->{$relationship} instanceof Collection) {
                        $index = 0;
                        foreach ($model->{$relationship} as $relation) {
                            $relationString .= ($relation->name ?: $relation->title) . ((($index + 1) < $model->{$relationship}->count()) ? ', ' : '');
                            $index++;
                        }
                    } else {
                        $relationString = ($model->{$relationship}->name ?: $model->{$relationship}->title);
                    }

                    $model->{$relationship} = $relationString;
                }
            }

            return $model;
        }, $rows);
    }

}
