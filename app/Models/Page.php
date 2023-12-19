<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $guarded = [];

    /**
     * Return's page data with media file
     * @param  array $where
     * @return Illuminate\Database\Query\Builder
     */
    public function getPage(array $where)
    {
        return self::select(
                'pages.*',
                'media_files.filename as mediafile',
                'media_files.alt_text as mediafile_alt'
            )
            ->leftJoin('media_files', 'pages.media_file_id', 'media_files.id')
            ->where($where)
            ->first();
    }
}
