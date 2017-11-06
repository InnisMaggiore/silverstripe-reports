<?php
/**
 * Created by PhpStorm.
 * User: sara
 * Date: 10/19/17
 * Time: 9:19 AM
 */
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
            ->where(
                "\"ClassName\" != 'RedirectorPage' AND (\"PageTitle\" = '' OR \"MetaDescription\" = '' OR \"PageTitle\" IS NULL OR \"MetaDescription\" IS NULL OR \"PageTitle\" LIKE '<p></p>' OR \"MetaDescription\" LIKE '<p></p>' OR \"PageTitle\" LIKE '<p>&nbsp;</p>' OR \"MetaDescription\" LIKE'<p>&nbsp;</p>')"
            );
    }

    // which fields on that object we want to show
    public function columns() {
        return array(
            "Title" => array(
                "title" => "Title",
                "link" => true,
            ),
        );

    }

}
