<?php

class CustomSideReport_ListofImagesAndFiles extends SS_Report {

    // the name of the report
    public function title() {
        return 'All Images and Files';
    }

    // what we want the report to return
    public function sourceRecords($params = null)
    {
        return File::get()
            ->sort('Title');
    }

    // which fields on that object we want to show
    public function columns()
    {
        $linkBase = singleton('CMSFileAddController')->Link('EditForm/field/File/item');
        $linkBaseEditLink = str_replace("/add","",$linkBase);
        $fields = array(
            'Title' => 'Title',
            'AbsoluteLink' => array(
                'title' => _t('CustomSideReport_ListofImagesAndFiles.ColumnFilename', 'Filename'),
                'formatting' => function($value, $item) use ($linkBaseEditLink) {
                   $shorterValue = substr($value, strpos($value, "/Uploads/")+9);
                    return sprintf('<a href="%s">%s</a>',
                        Controller::join_links($linkBaseEditLink, $item->ID."/edit"),
                        $shorterValue
                    );
                }
            )
        );

       return $fields;
    }
}
