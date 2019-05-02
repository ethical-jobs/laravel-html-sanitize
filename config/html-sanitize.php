<?php

use EthicalJobs\Sanitize\Filters;

return [

    /*
    |--------------------------------------------------------------------------
    | Pre filters
    |--------------------------------------------------------------------------
    |
    | Filters run prior to HTML sanitization
    |
    */
    'pre-filters' => [
        Filters\UnJustify::class,
        Filters\ConvertHeadings::class,
        Filters\RemoveDoubleBreaks::class,
        Filters\RemoveSpaces::class,
        Filters\ConvertPsuedoHeadings::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Post filters
    |--------------------------------------------------------------------------
    |
    | Filters run after to HTML sanitization
    |
    */
    'post-filters' => [
        Filters\RemoveEmptyElements::class,
        Filters\RemoveSpaces::class,
    ],

    'htmlpurifier' => [

        /*
        |--------------------------------------------------------------------------
        | Core.Encoding
        |--------------------------------------------------------------------------
        |
        | The encoding to convert input to.
        |
        | http://htmlpurifier.org/live/configdoc/plain.html#Core.Encoding
        |
        */
        'Core.Encoding' => 'utf-8',

        /*
        |--------------------------------------------------------------------------
        | Core.SerializerPath
        |--------------------------------------------------------------------------
        |
        | The HTML purifier serializer cache path.
        |
        | http://htmlpurifier.org/live/configdoc/plain.html#Cache.SerializerPath
        |
        */
        'Cache.SerializerPath' => storage_path('html-sanitize'),

        /*
        |--------------------------------------------------------------------------
        | HTML.Doctype
        |--------------------------------------------------------------------------
        |
        | Doctype to use during filtering.
        |
        | http://htmlpurifier.org/live/configdoc/plain.html#HTML.Doctype
        |
        */
        'HTML.Doctype' => 'HTML 4.01 Transitional',

        /*
        |--------------------------------------------------------------------------
        | HTML.Allowed
        |--------------------------------------------------------------------------
        |
        | The allowed HTML Elements with their allowed attributes.
        |
        | http://htmlpurifier.org/live/configdoc/plain.html#HTML.Allowed
        |
        */
        'HTML.Allowed' => 'h1,h2,h3,h4,h5,strong,em,i,ul,ol,li,a[href|target|rel],img[alt|src],p[style],br',

        /*
        |--------------------------------------------------------------------------
        | HTML.Nofollow
        |--------------------------------------------------------------------------
        |
        | If enabled, nofollow rel attributes are added to all outgoing links.
        |
        | http://htmlpurifier.org/live/configdoc/plain.html#HTML.Nofollow
        |
        */
        'HTML.Nofollow' => true,

        /*
        |--------------------------------------------------------------------------
        | HTML.ForbiddenElements
        |--------------------------------------------------------------------------
        |
        | The forbidden HTML elements. Elements that are listed in
        | this string will be removed, however their content will remain.
        |
        | For example if 'p' is inside the string, the string: '<p>Test</p>',
        |
        | Will be cleaned to: 'Test'
        |
        | http://htmlpurifier.org/live/configdoc/plain.html#HTML.ForbiddenElements
        |
        */
        'HTML.ForbiddenElements' => 'span',

        /*
        |--------------------------------------------------------------------------
        | Attr.AllowedFrameTargets
        |--------------------------------------------------------------------------
        |
        | Lookup table of all allowed link frame targets
        |
        | http://htmlpurifier.org/live/configdoc/plain.html#Attr.AllowedFrameTargets
        |
        */
        'Attr.AllowedFrameTargets' => ['_blank', '_top', '_self', '_parent'],

        /*
        |--------------------------------------------------------------------------
        | CSS.AllowedProperties
        |--------------------------------------------------------------------------
        |
        | The Allowed CSS properties.
        |
        | http://htmlpurifier.org/live/configdoc/plain.html#CSS.AllowedProperties
        |
        */
        'CSS.AllowedProperties' => 'text-align,font-weight,font-style,text-decoration',

        /*
        |--------------------------------------------------------------------------
        | AutoFormat.AutoParagraph
        |--------------------------------------------------------------------------
        |
        | The Allowed CSS properties.
        |
        | This directive turns on auto-paragraphing, where double
        | newlines are converted in to paragraphs whenever possible.
        |
        | http://htmlpurifier.org/live/configdoc/plain.html#AutoFormat.AutoParagraph
        |
        */
        'AutoFormat.AutoParagraph' => true,

        /*
        |--------------------------------------------------------------------------
        | AutoFormat.RemoveEmpty
        |--------------------------------------------------------------------------
        |
        | When enabled, HTML Purifier will attempt to remove empty
        | elements that contribute no semantic information to the document.
        |
        | http://htmlpurifier.org/live/configdoc/plain.html#AutoFormat.RemoveEmpty
        |
        */
        'AutoFormat.RemoveEmpty' => true,

        /*
        |--------------------------------------------------------------------------
        | AutoFormat.Custom
        |--------------------------------------------------------------------------
        |
        | This directive can be used to add custom auto-format injectors. 
        | Specify an array of injector names (class name minus the prefix) or concrete implementations. Injector class must exist.
        |
        | http://htmlpurifier.org/live/configdoc/plain.html#AutoFormat.Custom
        |
        */
        'AutoFormat.Custom' => [],
    ],
];