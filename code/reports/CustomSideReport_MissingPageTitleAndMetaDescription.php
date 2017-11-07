<?php

class CustomSideReport_MissingPageTitleAndMetaDescription extends SS_Report {

    // the name of the report
    public function title() {
        return 'Pages with Missing Page Titles and Meta Descriptions';
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

                if (empty($item->Title)) {
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
            'Title' => [
                "title" => "Title",
                "link" => true,
            ],
            'MetaDescription' => 'MetaDescription',
            'URLSegment' => 'URLSegment'
        );

    }

}
