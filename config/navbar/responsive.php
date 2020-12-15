<?php
/**
 * Supply the basis for the navbar as an array.
 */
return [
    // Use for styling the menu
    "id" => "rm-menu",
    "wrapper" => null,
    "class" => "rm-default rm-mobile",

    // Here comes the menu items
    "items" => [
        [
            "text" => "Home",
            "url" => "",
            "title" => "Go home",
        ],
        [
            "text" => "Questions",
            "url" => "questions",
            "title" => "Questions",
            "submenu" => [
                "items" => [
                    [
                        "text" => "Ask a Question",
                        "url" => "ask",
                        "title" => "Ask a Question",
                    ],
                    [
                        "text" => "Tags",
                        "url" => "questions/tags",
                        "title" => "Filter Qs on tags",
                    ],
                ],
            ],
        ],
        [
            "text" => "About",
            "url" => "about",
            "title" => "About this site",
        ],
        [
            "text" => "Sign in",
            "url" => "user/signin",
            "title" => "Sign in",
            "submenu" => [
                "items" => [
                    [
                        "text" => "Sign up",
                        "url" => "user/signup",
                        "title" => "Create new user",
                    ],
                ],
            ],
        ],
    ],
];
