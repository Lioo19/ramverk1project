<?php

/**
 * Mount the controller onto a mountpoint.
 */

return [
    "routes" => [
        [
            "info" => "Questions controller.",
            "mount" => "q",
            "handler" => "\Lioo19\Questions\QuestionsController",
        ],
    ]
];
