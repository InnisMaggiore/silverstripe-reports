<?php

class CustomSideReport_MissingPageTitleAndMetaDescription extends SS_Report {

    // the name of the report
    public function title() {
        return '(IM) Pages with Missing Page Titles and Meta Descriptions';
    }

    // what we want the report to return
    public function sourceRecords($params = null)
    {
        return Page::get()
            ->sort('Title')
            ->filterByCallback(function($item) {
                if ($item->ClassName == "RedirectorPage") {
                    return false;
                }

                // we try to have a special section for each page in the metadata
                // where we can specify keywords, etc. When we do that the field to
                // check should be that one.
                if ($item->hasField('PageTitle') && empty($item->PageTitle)) {
                    return true;
                }

                if (!$item->hasField('PageTitle') && empty($item->Title)) {
                    return true;
                }

                if (empty($item->MetaDescription)) {
                    return true;
                }
            });
    }

    // which fields on that object we want to show
    public function columns() {

        return array(
            'ID' => [
                "link" => true,
            ],
            'PageTitle' => [
                "title" => "SEO Page Title",
                "link" => true,
            ],
            'Title' => [
                "title" => "Title (not used if SEO Page Title exists)",
                "link" => true,
            ],
            'MetaDescription' => 'MetaDescription',
            'URLSegment' => 'URLSegment'
        );

    }

}
