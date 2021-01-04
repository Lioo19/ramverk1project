<?php

/**
 * Supply the basis for the navbar as an array.
 */

$login = $_SESSION["login"] ?? null;
if ($login === "yes") {
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
                            "url" => "tags",
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
                "text" => "Profile",
                "url" => "me",
                "title" => "Profile",
                "submenu" => [
                    "items" => [
                        [
                            "text" => "Sign out",
                            "url" => "user/signout",
                            "title" => "Sign out",
                        ],
                    ],
                ],
            ],
        ],
    ];
} else {
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
}
