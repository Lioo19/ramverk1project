<?php

/**
 * Supply the basis for the navbar as an array.
 */

return [
    // Use for styling the menu
    "class" => "my-navbar",

    // Here comes the menu items/structure
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
        ],
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
        [
            "text" => "About",
            "url" => "about",
            "title" => "About this site",
        ],
        [
            "text" => "Sign in",
            "url" => "user/signin",
            "title" => "Sign in",
        ],
        [
            "text" => "Sign up",
            "url" => "user/signup",
            "title" => "Create new user",
        ],
    ],
];
