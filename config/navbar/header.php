<?php
/**
 * Supply the basis for the navbar as an array.
 */
return [
    // Use for styling the menu
    "wrapper" => null,
    "class" => "my-navbar rm-default rm-desktop",

    // Here comes the menu items
    "items" => [
        [
            "text" => "Home",
            "url" => "",
            "title" => "Get Home",
        ],
        [
            "text" => "Questions",
            "url" => "q",
            "title" => "Questions",
            "submenu" => [
                "items" => [
                    [
                        "text" => "Ask a Question",
                        "url" => "q/ask",
                        "title" => "Ask a Question",
                    ],
                    [
                        "text" => "Tags",
                        "url" => "q/tags",
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
            "text" => "Users",
            "url" => "user/all",
            "title" => "All users",
        ],
        [
            "text" => "Sign in",
            "url" => "user/login",
            "title" => "Login",
            "submenu" => [
                "items" => [
                    [
                        "text" => "Sign up",
                        "url" => "user/create",
                        "title" => "Create new user",
                    ],
                ],
            ],
        ],
    ],
];
